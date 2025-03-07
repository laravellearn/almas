<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'organization_id',
        'isActive',
    ];

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function organization(){
        return $this->belongsTo(Organization::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
