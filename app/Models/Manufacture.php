<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Manufacture extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name','image','image','status'
    ];
    protected $dates = ['deleted_at']; 
}
