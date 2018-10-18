<?php

namespace App;

use App\Traits\HasApprovals;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use HasApprovals, SoftDeletes;
    
    const APPROVAL_PROPERTIES = [
        'title',
        'overview_short',
        'overview'
    ];
    
    protected $fillable = [
      'title',
      'overview_short',
      'overview',
      'price',
      'live',
      'approved',
      'finished',
    ];
    
    protected static function boot()
    {
        parent::boot();
        static::creating(function($file) {
            $file->identifier = uniqid(true);
        });
    }
    
    public function getRouteKeyName()
    {
        return 'identifier';
    }
    
    public function visible()
    {
        if(auth()->user()->isAdmin()) {
            return true;
        }

        if(auth()->user()->isTheSameAs($this->user())) {
            return true;
        }
        
        return $this->live && $this->approved;
    }
    
    public function mergeApprovalProperties()
    {
        $this->update(
            array_only(
                $this->approvals->first()->toArray(),
                self::APPROVAL_PROPERTIES
            )
        );
    }
    
    public function deleteAllApprovals()
    {
        $this->approvals()->delete();
    }
    
    public function deleteUnapprovedUpload()
    {
        $this->uploads()->unapproved()->delete();
    }
    
    public function scopeFinished(Builder $builder)
    {
        return $builder->where('finished', true);
    }
    
    public function isFree()
    {
        return $this->price == 0;
    }
    
    public function uploads()
    {
        return $this->hasMany(Upload::class);
    }
    
    public function approvals(){
        return $this->hasMany(FileApproval::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function needsApproval(array $approvalProperties)
    {
        if($this->currentPropertiesDifferToGiven($approvalProperties)){
            return true;
        }
        
        if($this->uploads()->unapproved()->count()) {
            return true;
        }
        
        return false;
    }
    
    public function approve()
    {
        $this->updateToBeVisible();
        $this->approveAllUploads();
    }
    
    public function approveAllUploads()
    {
        $this->uploads()->update([
            'approved' => true
        ]);
    }
    
    public function updateToBeVisible()
    {
        $this->update([
            'live' => true,
            'approved' => true,
        ]);
    }
    
    public function currentPropertiesDifferToGiven(array $properties) {
        return array_only($this->toArray(),self::APPROVAL_PROPERTIES) != $properties;
    }
    
    public function createApproval(array $approvalProperties)
    {
        $this->approvals()->create($approvalProperties);
    }
}
