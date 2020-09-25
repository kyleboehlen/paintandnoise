<?php

namespace App\Http\Helpers\Functions;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use DB;
use Log;

// Models
use App\Models\Zips\CachedZipSearches;
use App\Models\Zips\CachedZipCodes;

class ZipHelper
{
    static function search($zip_code)
    {
        $search_id = 0;
        $radius = config('local.radius');

        // Check for exsisting search
        $match = CachedZipSearches::where('zip_code', $zip_code)->where('radius', $radius)->with('cachedzipcodes')->first();

        if(is_null($match))
        {
            $insert = array();
            $params = array( // for zipwise api call
                'key' => config('local.zip_wise.api_key'),
                'zip' => $zip_code,
                'radius' => $radius,
                'page' => 0,
                'format' => 'json',
            );
            
            $zip_codes = self::call($params);
            while(!empty($zip_codes))
            {
                $insert = array_merge($insert, $zip_codes);

                $params['page']++;
                $zip_codes = self::call($params);
            }
    
            if(!empty($insert))
            {
                $timestamp = Carbon::now()->toDatetimeString();
                $search = new CachedZipSearches([
                    'zip_code' => $zip_code,
                    'radius' => $radius,
                    'timestamp' => $timestamp,
                ]);

                if(!$search->save())
                {
                    Log::error('Failed to save a new cached zip search.', [
                        'zip_code' => $zip_code,
                        'radius' => $radius,
                    ]);
                }
                else
                {
                    $cached_zip_codes = array();
                    foreach($insert as $cached_zip)
                    {
                        array_push($cached_zip_codes, [
                            'searches_id' => $search->id,
                            'zip_code' => $cached_zip,
                        ]);
                    }

                    if(CachedZipCodes::insert($cached_zip_codes))
                    {
                        $search_id = $search->id;
                    }
                    else
                    {
                        Log::error('Failed to save zip codes for a cached zip search.', [
                            'searches_id' => $search->id
                        ]);

                        // Delete failed search
                        $search->delete();
                    }
                }
            }
        }
        else
        {
            $search_id = $match->id;
        }

        return CachedZipCodes::where('searches_id', $search_id)->get()->pluck('zip_code')->toArray();
    }

    private static function call($params)
    {
        $zip_codes = array();
        $response = Http::get('https://www.zipwise.com/webservices/radius.php', $params);

        // Verify response type
        if($response->ok())
        {
            $results = json_decode($response->body(), true)['results'];

            if(count($results) > 1)
            {
                $zip_codes = array_column($results, 'zip');
            }
            else
            {
                $error = $results['error'] ?? 'UNKNOWN ERROR';
                Log::error("ZipWise call returned error: $error", [
                    $params
                ]);
            }
        }
        else
        {
            $status = $response->status();
            Log::error("ZipWise call returned a $status status.", [
                $params
            ]);
        }

        return $zip_codes;
    }
}