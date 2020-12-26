<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category(){
		return $this->belongsTo('App\Category', 'category_id')->select('id','category_name','status','category_image');
	}
	public function section(){
		return $this->belongsTo('App\Section', 'section_id')->select('id','name','status');
	}
	public function attribute(){
		return $this->hasMany('App\ProductsAttribute','product_id');
	}
	public function images(){
	return $this->hasMany('App\ProductsImage','product_id');
	}
	public function brand(){
		return $this->belongsTo('App\Brand', 'brand_id');
	}
	
}
