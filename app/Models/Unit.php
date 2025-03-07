<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['title','parent_id','organization_id','description','isActive'];

    public function parent()
    {
        return $this->belongsTo(Unit::class,'parent_id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

}
