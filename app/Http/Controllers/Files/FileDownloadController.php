<?php

namespace App\Http\Controllers\Files;

use App\{File, Http\Controllers\Controller, Sale};
use Illuminate\Http\Request;

class FileDownloadController extends Controller
{
    public function show(File $file, Sale $sale)
    {
        if (!$file->visible()) {
            return abort(403);
        }
        
        if(!$file->matchesSale($sale)) {
            return abort(404);
        }
    }
}
