<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    public $fillable = ['product_name','product_slug','short_description','long_description','hero_image','other_images','category','brand','mrp','sale_price','created_by','updated_by'];
}
