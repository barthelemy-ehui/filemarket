<?php

namespace App\Http\Controllers\Account;

use App\File;
use App\Http\Requests\File\{StoreFileRequest, UpdateFileRequest};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FileController extends Controller
{
    public function index(Request $request)
    {
        $files = auth()->user()->files()->latest()->finished()->get();
        
        return view('account.files.index', [
            'files' => $files
        ]);
    }
    
    public function create(File $file)
    {
        if(!$file->exists) {
            $file = $this->createAndReturnSkeletonFile();
    
            return redirect()->route('account.files.create', $file);
        }
        
        $this->authorize('touch', $file);
     
        return view('account.files.create', compact('file'));
    }
    
    
    public function store(File $file, StoreFileRequest $request)
    {
        $this->authorize('touch', $file);
        $file->fill($request->only(['title','overview','overview_short','price']));
        $file->finished = true;
        
        $file->save();
        
        
        return redirect()->route('account.files.index')
            ->withSuccess('Thanks, submitting for review');
    }
    
    public function update(File $file, UpdateFileRequest $request)
    {
        $this->authorize('touch', $file);
        
        $approvalProperties = $request->only(File::APPROVAL_PROPERTIES);
        
        if($file->needsApproval($approvalProperties)) {
            $file->createApproval($approvalProperties);
            return back()->withSuccess('Thanks! We will review your changes soon.');
        }
    
        $data = $request->only(['live','price']);
        $data['live'] = $data['live']== 'on'?true:false;
        $file->update($data);
        
        return back()->withSuccess('File updated!');
    }
    
    public function edit(File $file)
    {
        $this->authorize('touch', $file);
        
        return view('account.files.edit', [
            'file' => $file,
            'approval' => $file->approvals->first(),
        ]);
    }
    
    private function createAndReturnSkeletonFile()
    {
        return auth()->user()->files()->create([
            'title' => 'Untitle',
            'overview' => 'None',
            'overview_short' => 'None',
            'price' => 0,
            'finished' => false
        ]);
    }
}
