<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Admin Controller
Route::prefix('admin')->namespace('Admin')->group(function () {
	//login url
    Route::match(['get', 'post'], '/login', 'AdminController@login');
	
	//Matches The "/admin/dashboard" URL
	Route::group(['middleware'=>['admin']],function(){
	Route::get('/dashboard', 'AdminController@adminUser');	
	Route::get('/logout', 'AdminController@adminLogout');
	Route::get('/password', 'AdminController@passwordChange');
	Route::post('/password-setting', 'AdminController@passwordSetting');
	Route::match(['get','post'],'/details', 'AdminController@adminDetails');
	
	//section controller
	Route::get('section', 'SectionController@section');
	Route::post('/section/status', 'SectionController@sectionStatus');
	
	//category
	Route::get('/category', 'CategoryContoller@category');
	Route::match(['get','post'],'/add-edit-category/{id?}', 'CategoryContoller@addEditCategory');
	Route::post('/change-category', 'CategoryContoller@changeCategory');
	Route::post('/edit-category', 'CategoryContoller@editCategory');
	Route::get('/delete-category/{id?}', 'CategoryContoller@deleteCategory');
	Route::get('/category-image-delete/{image}/{id?}', 'CategoryContoller@categoryImageDelete');
	Route::match(['get','post'],'/category/status/{id?}','CategoryContoller@categoryStatus');
	
	//Products
	Route::get('/product', 'ProductController@product');
	Route::post('/product/status', 'ProductController@productStatus');
	Route::get('/product/delete/{id?}', 'ProductController@productDelete');
	Route::match(['get','post'],'/product/add-edit-product/{id?}', 'ProductController@addEditProduct');
	Route::get('/product-image-delete/{image}/{id?}', 'ProductController@productImageDelete');
	Route::get('/product-video-delete/{video}/{id?}', 'ProductController@productvideoDelete');
	Route::match(['get','post'],'/product/add-attributes/{id?}', 'ProductController@addAttributes');
	Route::match(['get','post'],'/product/update-attributes/', 'ProductController@updateAttributes');
	Route::match(['get','post'],'/product/attribute-status/{id?}', 'ProductController@productAttrStatus');
	Route::match(['get','post'],'/product/attribute-delete/{id?}', 'ProductController@productAttrDelete');
	Route::match(['get','post'],'/product/add-images/{id?}', 'ProductController@addImages');
	Route::match(['get','post'],'/product/add-images/status/{id?}', 'ProductController@productImageStatus');
	Route::match(['get','post'],'/product/add-images/delete/{id?}', 'ProductController@producstImageDelete');
	
	//Brands
	Route::get('/brands', 'BrandController@brands');
	Route::match(['get','post'],'/brands/status/{id?}', 'BrandController@brandStatus');
	Route::match(['get','post'],'/brands/delete/{id?}', 'BrandController@brandDelete');
	Route::match(['get','post'],'/brands/add-edit/{id?}', 'BrandController@brandAddEdit');
	
	// Banners
	Route::get('banners', 'BannersController@banners');
	Route::match(['get','post'],'/banners/status/{id?}', 'BannersController@bannersStatus');
	Route::match(['get','post'],'/banners/delete/{id?}', 'BannersController@bannersDelete');
	Route::match(['get','post'],'/banners/add-edit/{id?}', 'BannersController@banneAddEdit');
	
	});
	
});

Route::get('/admin', 'AdminController@adminUser');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Front controller
Route::namespace('Front')->group(function () {
	Route::get('/', 'IndexController@index');
	Route::get('/{url}', 'ProductsController@listing');
});
