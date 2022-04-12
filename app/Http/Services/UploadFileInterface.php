<?php

namespace App\Http\Services;
use Illuminate\Http\Concerns\InteractsWithInput;

interface UploadFileInterface
{
    public function upload(InteractsWithInput $file, $path, $types = null);
}