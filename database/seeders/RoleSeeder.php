<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reviewAdmin = Role::create(['name' => 'Admin Review']);
        $departmentAdmin = Role::create(['name' => 'Admin Departemen']);

        $flaggingReview = Permission::create(['name' => 'flagging_review']);
        $sendReview = Permission::create(['name' => 'send_review']);
        $categorizingReview = Permission::create(['name' => 'categorizing_review']);
        $commentReview = Permission::create(['name' => 'comment_review']);
        $updateReviewDatabase = Permission::create(['name' => 'update_review_database']);
        $deleteReview = Permission::create(['name' => 'delete_review']);

        $makeCategory = Permission::create(['name' => 'make_category']);
        $makeTopic = Permission::create(['name' => 'make_topic']);
        $deleteCategory = Permission::create(['name' => 'delete_category']);
        $deleteTopic = Permission::create(['name' => 'delete_topic']);

        $reviewAdmin->givePermissionTo($makeCategory);
        $reviewAdmin->givePermissionTo($makeTopic);
        $reviewAdmin->givePermissionTo($flaggingReview);
        $reviewAdmin->givePermissionTo($sendReview);
        $reviewAdmin->givePermissionTo($categorizingReview);
        $reviewAdmin->givePermissionTo($commentReview);
        $reviewAdmin->givePermissionTo($updateReviewDatabase);
        $reviewAdmin->givePermissionTo($deleteReview);
        $reviewAdmin->givePermissionTo($deleteCategory);
        $reviewAdmin->givePermissionTo($deleteTopic);

        $departmentAdmin->givePermissionTo($commentReview);
    }
}
