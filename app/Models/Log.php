<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    protected $fillable = ['ip','user_id','action','description'];

    public function user()
    {
        return $this->BelongsTo(User::class);
    }
        

    public function setDescriptionAttribute($description)
    {
        $this->attributes['description'] = mb_strtolower($description);
    }

    public function getCreatedAtAttribute($created_at)
    {
        $v1 = new \Verta($created_at);
        $v1 = $v1->format('H:i:s - Y/m/d');
        return $v1;
    }

}
