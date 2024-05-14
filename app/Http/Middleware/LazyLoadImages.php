<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;

class LazyLoadImages
{
    public function handle($request, Closure $next)
    {
        // $cacheKey = 'lazy_loading:lazy' . $request->fullUrl();

        // return Cache::remember($cacheKey, now()->addMinutes(60), function () use ($next, $request) {
        $response = $next($request);

        $content = $response->getContent();

        $modifiedContent = $this->addLazyLoadingAttribute($content);

        $response->setContent($modifiedContent);

        return $response;
        // });
    }

    // Add lazy loading attribute to image tags
    private function addLazyLoadingAttribute($content)
    {
        // Add loading="lazy" to images
        $content = preg_replace('/<img(.*?)>/', '<img$1 loading="lazy">', $content);

        // Add loading="lazy" to iframes
        $content = preg_replace('/<iframe(.*?)>/', '<iframe$1 loading="lazy">', $content);

        // Add loading="lazy" to videos
        $content = preg_replace('/<video(.*?)>/', '<video$1 loading="lazy">', $content);

        // // Add loading="lazy" to images inside div tags
        // $content = preg_replace_callback(
        //     '/<div(.*?)>(.*?)<\/div>/s',
        //     function ($matches) {
        //         return '<div' . $matches[1] . '>' . preg_replace('/<img(.*?)>/', '<img$1 loading="lazy">', $matches[2]) . '</div>';
        //     },
        //     $content
        // );

        // // Add loading="lazy" to iframes inside div tags
        // $content = preg_replace_callback(
        //     '/<div(.*?)>(.*?)<\/div>/s',
        //     function ($matches) {
        //         return '<div' . $matches[1] . '>' . preg_replace('/<iframe(.*?)>/', '<iframe$1 loading="lazy">', $matches[2]) . '</div>';
        //     },
        //     $content
        // );

        return $content;
    }
}
