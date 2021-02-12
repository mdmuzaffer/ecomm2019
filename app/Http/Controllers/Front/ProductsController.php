<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\ProductsAttribute;
use App\Cart;
use Session;
use Validator;
use Auth;
use DB;
class ProductsController extends Controller
{
    public function listing(Request $request){
		
		//get current url path after public or domain
		$url = $request->path();
		
		if($request->ajax()){
			$ajaxData = $request->all();
			
			//echo"<pre>";print_r($ajaxData);die;
			
			$ajaxurl = $ajaxData['url'];
			
			$catCount = Category::where(['url'=>$ajaxurl,'status'=>1])->count();
			if($catCount >0){
				$catDetails = Category::categoryDetails($url);
				$categoryProduct = Product::with('brand')->whereIn('category_id',$catDetails['catsId'])->where('status',1);
				
				//filter method product of fabric
				if(isset($ajaxData ['fabric']) && !empty($ajaxData['fabric'])){
					$categoryProduct->whereIn('products.fabric',$ajaxData ['fabric']);
				}
				//filter method product of sleeve
				if(isset($ajaxData ['sleeve']) && !empty($ajaxData['sleeve'])){
					$categoryProduct->whereIn('products.sleeve',$ajaxData ['sleeve']);
				}
				//filter method product of pattern
				if(isset($ajaxData ['pattern']) && !empty($ajaxData['pattern'])){
					$categoryProduct->whereIn('products.pattern',$ajaxData ['pattern']);
				}
				//filter method product of fit
				if(isset($ajaxData ['fit']) && !empty($ajaxData['fit'])){
					$categoryProduct->whereIn('products.fit',$ajaxData ['fit']);
				}
				//filter method product of occasion
				if(isset($ajaxData ['occasion']) && !empty($ajaxData['occasion'])){
					$categoryProduct->whereIn('products.occasion',$ajaxData ['occasion']);
				}
				//If selected sort method product
				if(isset($ajaxData ['sort']) && !empty($ajaxData['sort'])){
					if($ajaxData['sort'] =="latest_product"){
					$categoryProduct = $categoryProduct->orderBy('id','DESC');
					}elseif($ajaxData['sort'] =="product_name_az"){
						$categoryProduct = $categoryProduct->orderBy('product_name','DESC');
					}elseif($ajaxData['sort'] =="product_name_za"){
						$categoryProduct = $categoryProduct->orderBy('product_name','ASC');
					}elseif($ajaxData['sort'] =="lowest_price"){
						$categoryProduct = $categoryProduct->orderBy('product_price','ASC');
					}elseif($ajaxData['sort'] =="height_price"){
						$categoryProduct = $categoryProduct->orderBy('product_price','DESC');
					}
				}else{
					$categoryProduct = $categoryProduct->orderBy('id','DESC');
				}
				$categoryProduct = $categoryProduct->paginate(30);
				return view('front.product.ajax_product_list')->with(['controller'=>'preoduct','page_type'=>'front_page','categoryProduct'=>$categoryProduct,'catDetails'=>$catDetails,'url'=>$url]);
			}else{
			abort(404);
			}
			
		}else{
			// product filter array added
			$productFilter = Product::productFilter();
			$fabricArray = $productFilter['fabricArray'];
			$sleeveArray = $productFilter['sleeveArray'];
			$patternArray = $productFilter['patternArray'];
			$fitArray = $productFilter['fitArray'];
			$occasionArray = $productFilter['occasionArray'];
			
			$catCount = Category::where(['url'=>$url,'status'=>1])->count();
			if($catCount >0){
				$catDetails = Category::categoryDetails($url);
				$categoryProduct = Product::with('brand')->whereIn('category_id',$catDetails['catsId'])->where('status',1);
				$categoryProduct = $categoryProduct->orderBy('id','DESC');
				$categoryProduct = $categoryProduct->paginate(30);
				
				//echo"<pre>";print_r($categoryProduct); die;
				
				return view('front.product.products')->with(['controller'=>'preoduct','page_type'=>'front_page','categoryProduct'=>$categoryProduct,'catDetails'=>$catDetails,'url'=>$url,'fabricArray'=>$fabricArray,'sleeveArray'=>$sleeveArray,'patternArray'=>$patternArray,
		'fitArray'=>$fitArray,'occasionArray'=>$occasionArray,'page_list'=>'product_list']);
			}else{
			abort(404);
			}
		}
	}
	// single product page details
	public function productDetails($code,$id){
		$proDetails = Product::with(['category','section','attribute'=>function($query){$query->where('status',1);},'images','brand'])->find($id)->toArray();
		$latestProduct = Product::where('category_id',$proDetails['category']['id'])->where('id','!=', $proDetails['id'])->get()->toArray();
		return view('front.product.product_details')->with(['controller'=>'preoduct','proDetails'=>$proDetails,'page_type'=>'front_page','latestProduct'=>$latestProduct]);
		
	}
	
	//change price of attribute size according
	public function getAttributePrice(Request $request){
		if($request->ajax()){
		$ajaxData = $request->all();
		$prodAttr = ProductsAttribute::where(['product_id'=>$ajaxData['mainProductId'],'id'=>$ajaxData['productId'],'size'=>$ajaxData['size']])->get()->first()->toArray();
		$disAttrPrice = Product::getDiscountAttrPrice($ajaxData['mainProductId'],$ajaxData['size']);
		$disAttrPrice = json_decode(json_encode($disAttrPrice));
		
			if(count($prodAttr) > 0){
			 return response()->json(['success'=>1,"productAttribute"=>$prodAttr,"discount"=>$disAttrPrice],200);
			}else{
				return response()->json(['success'=>0],200);
			}
			return response()->json(['error'=>0,'message'=>'Result not found'],404);
		}
	}
	
	//Add to cart
	public function addToCart(Request $request){
		if($request->isMethod('post')){
		$cartData = $request->all();
		
		$request->validate([
        'size' => 'required',
        'quty' => 'required',
		]);
	
		$attrData = ProductsAttribute::where(['product_id'=>$cartData['product_id'],'size'=>$cartData['size']])->get()->first()->toArray();
			if($attrData['stock']< $cartData['quty']){
				return back()->with('errors','Required Quantity is not available');
			}
			$session_id = Session::get('session_id');
			if(empty($session_id)){
			$session_id = Session::getId();
			Session::put('session_id',$session_id);
			}
			
			$cartCount = Cart::where(['product_id'=>$cartData['product_id'], 'size'=>$cartData['size']])->count();
			if($cartCount >0){
				return back()->with('errors','Already added product in your cart !');
			}
			if(Auth::check()){
				$user_id = Auth::user()->id;
			}else{
				$user_id =0;
			}
			
			
			$cart = new Cart;
			$cart->session_id = $session_id;
			$cart->user_id = $user_id;
			$cart->product_id = $cartData['product_id'];
			$cart->size = $cartData['size'];
			$cart->quantity = $cartData['quty'];
			$cart->save();
			return redirect('cart')->with('success','Product has been added in your cart!');
		}
	}
	
	Public function addCart(){
		$cartItems = Cart::cartItems();
		return view('front.cart.products_summary')->with(['controller'=>'product','cartItems'=>$cartItems,'page_type'=>'front_page']);
	}
	
	public function updatecartitemsQwt(Request $request){
	
		if($request->ajax()){
			$itemsData = $request->all();
			$cartItem = Cart::find($itemsData['proId'])->toArray();
			
			$cartItem['product_id'];
			$cartItem['size'];
			$attributeItem = ProductsAttribute::select('stock')->where(['product_id'=>$cartItem['product_id'],'size'=>$cartItem['size']])->first()->toArray();
			if($itemsData['newqwt']>$attributeItem['stock']){
				$cartItems = Cart::cartItems();
				return response()->json(['status'=>false,'view'=>(String)View::make('front.cart.cart_list')->with(compact('cartItems'))]);
			}else{
				Cart::where('id',$itemsData['proId'])->update(['quantity'=>$itemsData['newqwt']]);
				//$cartData = Cart::where('id',$itemsData['proId'])->first()->toArray();
				//print_r($cartData);
				//die($session_id);
				$cartItems = Cart::cartItems();
				return response()->json(['status'=>true,'view'=>(String)View::make('front.cart.cart_list')->with(compact('cartItems'))]);
			}
		}
	
	}
	
	public function deletecartitemsQwt(Request $request){
		if($request->ajax()){
		$deleteData = $request->all();
			if(!empty($deleteData['proId'])){
				$cart = Cart::find($deleteData['proId']);
				$cart->delete();
				$cartItems = Cart::cartItems();
				return response()->json(['status'=>true,'view'=>(String)View::make('front.cart.cart_list')->with(compact('cartItems'))]);
			}
		}
	}
	
	
}
