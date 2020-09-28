<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Seed categories
        $this->call(CategoriesSeed::class);

        // Seed admin tools
        $this->call(AdminToolsSeed::class);

        // Seed admin permissions
        $this->call(AdminPermissionsSeed::class);

        // Seed super admin
        $this->call(SuperAdminSeed::class);
        
        // Seed super admin permissions
        $this->call(SuperAdminPermissionsSeed::class);

        // Seed poster statuses
        $this->call(PostersStatusesSeed::class);

        // Seed socials
        $this->call(SocialsSeed::class);

        // Seed posts types
        $this->call(PostsTypesSeed::class);

        // Seed categories posts types
        $this->call(CategoriesPostsTypesSeed::class);
    }
}