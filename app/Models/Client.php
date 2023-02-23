<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory,SoftDeletes;
    public $fillable = ['client_name','company_name','created_by','updated_by','mobile_number','whatsapp_number','email','enquiry'];
}
