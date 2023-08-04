<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use PhpParser\Node\Stmt\Return_;

class Url extends Model
{
    use HasFactory;

    protected $fillable=[
        'full_url',
        'url_desc',
        'shorten_url',
        'user_id',
        'visits',
    ];

    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->diffForHumans();
    }

    public function getRouteKeyName()
    {
        return  'shorten_url';
    }
}
