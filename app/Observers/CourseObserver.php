<?php

namespace App\Observers;

use App\Models\Escuela\Course;
use Illuminate\Support\Facades\Cache;

class CourseObserver
{
    /**
     * Handle the Course "created" event.
     */
    public function created(Course $course): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the Course "updated" event.
     */
    public function updated(Course $course): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the Course "deleted" event.
     */
    public function deleted(Course $course): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the Course "restored" event.
     */
    public function restored(Course $course): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the Course "force deleted" event.
     */
    public function forceDeleted(Course $course): void
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('Courses:courses_all');
    }
}
