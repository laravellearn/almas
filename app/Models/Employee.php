<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['name','isActive','organization_id','personalID','parentUnit_id','childUnit_id','unit_id'];


    public function parentUnit()
    {
        return $this->belongsTo(Unit::class,'parentUnit_id');
    }

    public function childUnit()
    {
        return $this->belongsTo(Unit::class,'childUnit_id');
    }

    public function organization()
    {
        return $this->BelongsTo(Organization::class);
    }


}
