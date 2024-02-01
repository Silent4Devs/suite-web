<?php

namespace App\Jobs;

use Throwable;
use Illuminate\Bus\Queueable;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessImageCompressor implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filePath;
    protected $route;
    protected $width;
    /**
     * Create a new job instance.
     */
    public function __construct($filePath, $route, $width)
    {
        $this->filePath = $filePath;
        $this->route = $route;
        $this->width = $width;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $uploadedFile = new UploadedFile($this->filePath, basename($this->filePath));

        $image = Image::make($uploadedFile)->encode('png', 70)->resize($this->width, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        $image->save($this->route);
        } catch (\Exception $e) {
            Log::error('Error processing job: ' . $e->getMessage());
            throw $e; // Re-throw the exception to mark the job as failed
        }

    }
}
