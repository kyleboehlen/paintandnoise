<?php

use Illuminate\Database\Seeder;

// Constant Helpers
use App\Http\Helpers\Constants\Posters\Statuses;

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

        foreach($statuses as $status)
        {
            try
            {
                // Insert status
                DB::table('posters_statuses')->insert(array($status));
            }
            catch(\Exception $e)
            {
                // Set message vars
                $id = $status['id'];
                $name = $status['name'];

                // Print duplicate error message to console
                echo "Posters Status $id ($name) already exsists in the database, skipping...\n";
            }
        }
    }
}
