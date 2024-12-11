<?php

namespace App\Observers;

use App\Models\Escuela\Lesson;
use App\Models\Escuela\Platform;
use Illuminate\Support\Facades\Storage;

class LessonObserver
{
    public function creating(Lesson $lesson)
    {
        $url = $lesson->url;
        $platform_id = $lesson->platform_id;

        $typePlatform = $this->platformFormat($lesson->platform_id);

        switch ($typePlatform) {
            case 'Youtube':
                # code...

                $patron = '%^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/watch\?v=|/embed/|/v/))([\w-]+)(?:\S*)$%x';
                $array = preg_match($patron, $url, $parte);

                $lesson->iframe = '<iframe width="100%" height="381" src="https://www.youtube.com/embed/'.$parte[1].'?rel=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';

                break;

            case 'Vimeo':
                # code...
                $patron = '/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/';
                $array = preg_match($patron, $url, $parte);
                $lesson->iframe = '<iframe src="https://player.vimeo.com/video/'.$parte[2].'" width="640" height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>';
                break;

            case 'Texto':
                # code...
                break;

            case 'Documento':
                # code...
                break;

            default:
                # code...
                break;
        }

    }

    public function updating(Lesson $lesson)
    {
        $url = $lesson->url;
        $platform_id = $lesson->platform_id;

        $typePlatform = $this->platformFormat($lesson->platform_id);

        switch ($typePlatform) {
            case 'Youtube':
                # code...

                $patron = '%^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/watch\?v=|/embed/|/v/))([\w-]+)(?:\S*)$%x';
                $array = preg_match($patron, $url, $parte);

                $lesson->iframe = '<iframe width="100%" height="381" src="https://www.youtube.com/embed/'.$parte[1].'?rel=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';

                break;

            case 'Vimeo':
                # code...
                $patron = '/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/';
                $array = preg_match($patron, $url, $parte);
                $lesson->iframe = '<iframe src="https://player.vimeo.com/video/'.$parte[2].'" width="640" height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>';
                break;

            case 'Texto':
                # code...
                break;

            case 'Documento':
                # code...
                break;

            default:
                # code...
                break;
        }
    }

    public function deleting(Lesson $lesson)
    {
        if ($lesson->resource) {
            Storage::delete($lesson->resource->url);
            $lesson->resource->delete();
        }
    }

    public function platformFormat($platform_id){
        $platf = Platform::where('id', $platform_id)->first();
        return $platf->name;
       //  dd($this->formatType);
   }
}
