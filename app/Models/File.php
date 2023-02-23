<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class File extends Model
{
    use HasFactory,SoftDeletes;
    public $fillable = ['client_id','file_name','file_path','created_by','updated_by'];
    
}
