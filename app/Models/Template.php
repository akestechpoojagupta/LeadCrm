<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Template extends Model
{
    use HasFactory,SoftDeletes;
    public $fillable = ['client_id','meta_key','meta_description','created_by','updated_by'];
}
