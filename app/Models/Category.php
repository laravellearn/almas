<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['title','description','parent_id','isActive'];

    public function parent()
    {
        return $this->belongsTo(Category::class,'parent_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function repairs()
    {
        return $this->belongsToMany(Repair::class);
    }



}
