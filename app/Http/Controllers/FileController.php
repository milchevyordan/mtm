<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class FileController extends Controller
{
    public function download($path): BinaryFileResponse
    {
        return response()->download(Storage::disk('public')->path($path), $path);
    }
}
