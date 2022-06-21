<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Resource extends Model
{
    protected $fillable = ['complaint_id','image_url'];
}