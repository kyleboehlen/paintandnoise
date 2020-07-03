<?php

use Illuminate\Database\Seeder;

// Helpers
use App\Http\Helpers\Constants\Posters\Statuses;
use App\Http\Helpers\Functions\SeedHelper;

// Models
use App\Models\Posters\PostersStatuses;

class PostersStatusesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = array(
            array(
                'id' => Statuses::APPROVED,
                'name' => 'Approved',
            ),
            array(
                'id' => Statuses::UNDER_REVIEW,
                'name' => 'Under Review',
            ),
            array(
                'id' => Statuses::APPLIED,
                'name' => 'Applied',
            ),
            array(
                'id' => Statuses::DENIED,
                'name' => 'Denied',
            ),
            array(
                'id' => Statuses::REVISION_REQUIRED,
                'name' => 'Revision Required',
            ),
            array(
                'id' => Statuses::BANNED,
                'name' => 'Banned',
            ),
        );

        $failures = 0;
        foreach($statuses as $status)
        {
            $poster_status = PostersStatuses::find($status['id']);

            if(!is_null($poster_status))
            {
                $poster_status->fill($status);
            }
            else
            {
                $poster_status = new PostersStatuses($status);
            }

            // Error handling if model fails to save
            if(!$poster_status->save())
            {
                $failures++;

                // Log error
                $id = $status['id'];
                $name = $status['name'];
                Log::error("Failed to seed posters status $id ($name)");
            }
        }

        // Print failures
        SeedHelper::printFailures($failures);
    }
}
