<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Log;

// Helpers
use App\Http\Helpers\Constants\Admin\Tools;
use App\Http\Helpers\Functions\SeedHelper;

// Models
use App\Models\Admin\AdminTools;

class AdminToolsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tools = array(
            array(
                'id' => Tools::ADMIN_USERS,
                'name' => 'Admin Users',
                'route_name' => 'admin.users',
            ),
            array(
                'id' => Tools::REPORTED_POSTS,
                'name' => 'Reported Posts',
                'route_name' => 'admin.reported-posts',
            ),
            array(
                'id' => Tools::POSTERS,
                'name' => 'Posters',
                'route_name' => 'admin.posters',
            ),
            array(
                'id' => Tools::STATS,
                'name' => 'Stats',
                'route_name' => 'admin.stats',
            ),
            array(
                'id' => Tools::FAQS,
                'name' => 'FAQs',
                'route_name' => 'admin.faq',
            ),
        );

        $failures = 0;
        foreach($tools as $tool)
        {
            $admin_tool = AdminTools::find($tool['id']);

            if(!is_null($admin_tool))
            {
                $admin_tool->fill($tool);
            }
            else
            {
                $admin_tool = new AdminTools($tool);
            }

            // Error handling if model fails to save
            if(!$admin_tool->save())
            {
                $failures++;

                // Log error
                $id = $tool['id'];
                $name = $tool['name'];
                Log::error("Failed to seed admin tool: $id ($name)");
            }
        }

        // Print failures
        SeedHelper::printFailures($failures);
    }
}
