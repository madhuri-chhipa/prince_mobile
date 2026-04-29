<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralInquiry extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'mobile','email', 'message'
    ];
    protected $table = 'general_inquiry';
}
