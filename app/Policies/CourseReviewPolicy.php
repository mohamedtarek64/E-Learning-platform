<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\CourseReview;
use Illuminate\Auth\Access\HandlesAuthorization;

class CourseReviewPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:CourseReview');
    }

    public function view(AuthUser $authUser, CourseReview $courseReview): bool
    {
        return $authUser->can('View:CourseReview');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:CourseReview');
    }

    public function update(AuthUser $authUser, CourseReview $courseReview): bool
    {
        return $authUser->can('Update:CourseReview');
    }

    public function delete(AuthUser $authUser, CourseReview $courseReview): bool
    {
        return $authUser->can('Delete:CourseReview');
    }

    public function restore(AuthUser $authUser, CourseReview $courseReview): bool
    {
        return $authUser->can('Restore:CourseReview');
    }

    public function forceDelete(AuthUser $authUser, CourseReview $courseReview): bool
    {
        return $authUser->can('ForceDelete:CourseReview');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:CourseReview');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:CourseReview');
    }

    public function replicate(AuthUser $authUser, CourseReview $courseReview): bool
    {
        return $authUser->can('Replicate:CourseReview');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:CourseReview');
    }

}