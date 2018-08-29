<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name','image_url','quentity','buying_price','salling_price','category_id','user_id'];
}
