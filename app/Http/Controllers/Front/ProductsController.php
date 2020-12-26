<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Product;
class ProductsController extends Controller
{
    public function listing($url){
		$catCount = Category::where(['url'=>$url,'status'=>1])->count();
		if($catCount >0){
			$catDetails = Category::categoryDetails($url);
			$categoryProduct = Product::with('brand')->whereIn('category_id',$catDetails['catsId'])->where('status',1)->get()->toArray();
			/* echo"<pre>";
			print_r($catDetails);
			print_r($categoryProduct);
			die; */
			return view('front.product.products')->with(['controller'=>'preoduct','categoryProduct'=>$categoryProduct,'catDetails'=>$catDetails]);
		}else{
			abort(404);
		}
	}
}
