<?php

use Spatie\MediaLibrary\Support\PathGenerator;

use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PathCustomGenerator implements PathGenerator
{
    public function getPath(Media $media) : string
    {
        if ($media instanceof Post) {
            return 'user_id/' . $media->user_id . '/' . $media->id;
        }
        return $media->id;
    }

    public function getPathForConversions(Media $media) : string
    {
        return $this->getPath($media) . 'conversions/';
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getPath($media) . 'responsive/';
    }
}