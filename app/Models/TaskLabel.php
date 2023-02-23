<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskLabel extends Model
{
    use HasFactory,SoftDeletes;
    public $fillable = ['client_id','title','color','slug','created_by','updated_by'];
}
