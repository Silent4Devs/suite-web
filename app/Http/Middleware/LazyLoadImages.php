<?php

namespace App\Http\Middleware;

use Closure;

class LazyLoadImages
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Modify the HTML response to add lazy loading to image tags
        $content = $response->getContent();
        $modifiedContent = $this->addLazyLoadingToImages($content);

        // Set the modified content back in the response
        $response->setContent($modifiedContent);

        return $response;
    }

    // Add lazy loading attribute to image tags
    private function addLazyLoadingToImages($content)
    {
        // Use a regular expression to match and modify image tags
        $pattern = '/<img(.*?)>/';
        $replacement = '<img$1 loading="lazy">';
        $modifiedContent = preg_replace($pattern, $replacement, $content);

        return $modifiedContent;
    }
}
