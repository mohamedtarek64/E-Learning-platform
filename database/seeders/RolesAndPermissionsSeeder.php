<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permissions
        $permissions = [
            // Admin Permissions
            'manage_users',
            'manage_all_courses',
            'manage_settings',
            'approve_instructors',
            'feature_courses',
            'view_all_analytics',
            'handle_refunds',
            'manage_categories',
            'moderate_content',

            // Instructor Permissions
            'create_courses',
            'edit_own_courses',
            'publish_courses',
            'view_own_analytics',
            'respond_to_students',
            'manage_announcements',
            'view_earnings',
            'request_payouts',

            // Student Permissions
            'browse_courses',
            'enroll_in_courses',
            'watch_lessons',
            'take_quizzes',
            'submit_assignments',
            'ask_questions',
            'rate_courses',
            'earn_certificates',

            // Assistant Instructor Permissions
            'manage_assigned_courses',
            'grade_assignments',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create Roles and Assign Permissions

        // Super Admin
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        // Instructor
        $instructorRole = Role::create(['name' => 'instructor']);
        $instructorRole->givePermissionTo([
            'create_courses',
            'edit_own_courses',
            'publish_courses',
            'view_own_analytics',
            'respond_to_students',
            'manage_announcements',
            'view_earnings',
            'request_payouts',
            'browse_courses',
            'watch_lessons',
            'take_quizzes',
        ]);

        // Student
        $studentRole = Role::create(['name' => 'student']);
        $studentRole->givePermissionTo([
            'browse_courses',
            'enroll_in_courses',
            'watch_lessons',
            'take_quizzes',
            'submit_assignments',
            'ask_questions',
            'rate_courses',
            'earn_certificates',
        ]);

        // Assistant Instructor
        $assistantRole = Role::create(['name' => 'assistant_instructor']);
        $assistantRole->givePermissionTo([
            'manage_assigned_courses',
            'grade_assignments',
            'respond_to_students',
            'view_own_analytics',
            'watch_lessons',
        ]);
    }
}
