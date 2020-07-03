<?php

namespace App\Models\Socials;

use Illuminate\Database\Eloquent\Model;

class Socials extends Model
{
    public $timestamps = false;
    
    public function buildUrl($array)
    {
        $url = str_replace('{url}', $this->url, $this->profile_link_pattern);

        foreach($array as $key => $value)
        {
            $url = str_replace(('{' . $key . '}'), $value, $url);
        }
        
        return $url;
    }
}
