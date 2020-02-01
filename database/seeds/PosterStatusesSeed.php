<?php

use Illuminate\Database\Seeder;

class PosterStatusesSeed extends Seeder
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
                'id' => 1,
                'name' => 'Approved',
            ),
            array(
                'id' => 2,
                'name' => 'Under Review',
            ),
            array(
                'id' => 3,
                'name' => 'Applied',
            ),
            array(
                'id' => 4,
                'name' => 'Denied',
            ),
            array(
                'id' => 5,
                'name' => 'Revision Required',
            ),
            array(
                'id' => 6,
                'name' => 'Banned',
            ),
        );

        foreach($statuses as $status)
        {
            try
            {
                // Insert status
                DB::table('poster_statuses')->insert(array($status));
            }
            catch(\Exception $e)
            {
                // Set message vars
                $id = $status['id'];
                $name = $status['name'];

                // Print duplicate error message to console
                echo "Status $id ($name) already exsists in the database, skipping...\n";
            }
        }
    }
}
