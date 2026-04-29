<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'title','slug','image','sort_order','short_description','description','status'
    ];
    protected $dates = ['deleted_at']; 
}
