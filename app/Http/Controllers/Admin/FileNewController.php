<?php

namespace App\Http\Controllers\Admin;

use App\File;
use App\Mail\Files\{ FileApproved, FileRejected};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class FileNewController extends Controller
{
    public function index()
    {
        $files = File::unapproved()->finished()->oldest()->get();
        
        return view('admin.files.new.index', [
            'files' => $files
        ]);
    }
    
    public function update(File $file)
    {
        $file->approve();
        
        Mail::to($file->user)->send(new FileApproved($file));
        
        return back()->withSuccess("{$file->title} has been approved");
    }
    
    public function destroy(File $file)
    {
        $file->delete();
        $file->uploads->each->delete();
    
        Mail::to($file->user)->send(new FileRejected($file));
        
        return back()->withSuccess("{$file->title} has been rejected");
    }
}
