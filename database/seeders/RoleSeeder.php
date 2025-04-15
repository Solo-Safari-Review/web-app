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
        $reviewAdmin = Role::create(['name' => 'review_admin']);
        $departmentAdmin = Role::create(['name' => 'department_admin']);

        $makeCategory = Permission::create(['name' => 'make_category']);
        $makeTopic = Permission::create(['name' => 'make_topic']);
        $flaggingReview = Permission::create(['name' => 'flagging_review']);
        $sendReview = Permission::create(['name' => 'send_review']);
        $categorizingReview = Permission::create(['name' => 'categorizing_review']);
        $commentReview = Permission::create(['name' => 'comment_review']);
        $seeReview = Permission::create(['name' => 'see_review']);
        $updateReviewDatabase = Permission::create(['name' => 'update_review_database']);
        $updateReviewStatus = Permission::create(['name' => 'update_review_status']);

        $reviewAdmin->givePermissionTo($makeCategory);
        $reviewAdmin->givePermissionTo($makeTopic);
        $reviewAdmin->givePermissionTo($flaggingReview);
        $reviewAdmin->givePermissionTo($sendReview);
        $reviewAdmin->givePermissionTo($categorizingReview);
        $reviewAdmin->givePermissionTo($commentReview);
        $reviewAdmin->givePermissionTo($seeReview);
        $reviewAdmin->givePermissionTo($updateReviewDatabase);
        $reviewAdmin->givePermissionTo($updateReviewStatus);

        $departmentAdmin->givePermissionTo($commentReview);
        $departmentAdmin->givePermissionTo($seeReview);
    }
}
