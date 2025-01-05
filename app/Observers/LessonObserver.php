<?php

namespace App\Observers;

use App\Models\Escuela\Lesson;
use App\Models\Escuela\Platform;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class LessonObserver
{
    public function creating(Lesson $lesson)
    {
        $url = $lesson->url;
        $platform_id = $lesson->platform_id;

        $formatPlatform = $this->platformFormat($platform_id);

        if ($formatPlatform == 'Youtube') {
            $patron = '%^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/watch\?v=|/embed/|/v/))([\w-]+)(?:\S*)$%x';
            $array = preg_match($patron, $url, $parte);

            $lesson->iframe = '<iframe width="100%" height="381" src="https://www.youtube.com/embed/' . $parte[1] . '?rel=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        } elseif ($formatPlatform == 'Vimeo') {
            $patron = '/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/';
            $array = preg_match($patron, $url, $parte);
            $lesson->iframe = '<iframe src="https://player.vimeo.com/video/' . $parte[2] . '" width="640" height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>';
        }

        $this->forgetCache();
    }

    public function updating(Lesson $lesson)
    {
        $url = $lesson->url;
        $platform_id = $lesson->platform_id;

        $formatPlatform = $this->platformFormat($platform_id);

        if ($formatPlatform == 'Youtube') {
            $patron = '%^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/watch\?v=|/embed/|/v/))([\w-]+)(?:\S*)$%x';
            $array = preg_match($patron, $url, $parte);

            $lesson->iframe = '<iframe width="100%" height="381" src="https://www.youtube.com/embed/' . $parte[1] . '?rel=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        } elseif ($formatPlatform == 'Vimeo') {
            $patron = '/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/';
            $array = preg_match($patron, $url, $parte);
            $lesson->iframe = '<iframe src="https://player.vimeo.com/video/' . $parte[2] . '" width="640" height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>';
        }

        $this->forgetCache();
    }

    public function deleting(Lesson $lesson)
    {
        if ($lesson->resource) {
            Storage::delete($lesson->resource->url);
            $lesson->resource->delete();
        }

        $this->forgetCache();
    }

    public function platformFormat($pid)
    {
        $platf = Platform::where('id', $pid)->first();
        return $platf->name;
        //  dd($this->formatType);
    }

    private function forgetCache()
    {
        Cache::forget('Courses:courses_all');
    }
}
