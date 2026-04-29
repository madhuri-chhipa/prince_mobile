<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name', 'slug','icon','image','brochure','price','sort_description', 'description','meta_title','meta_keyword','meta_description','sort_order','status','is_featured'
    ];
    protected $dates = ['deleted_at']; 
}
