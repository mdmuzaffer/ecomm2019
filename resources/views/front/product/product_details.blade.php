<?php use App\Product; ?>
@extends('layouts.front_layout.front')
@section('content')
<div class="span9">
	<ul class="breadcrumb">
		<li><a href="{{url('/')}}">Home</a> <span class="divider">/</span></li>
		<li><a href="{{url($proDetails['category']['url'])}}">{{$proDetails['category']['category_name']}}</a> <span class="divider">/</span></li>
		<li class="active">{{$proDetails['product_name']}}</li>
	</ul>
<div class="row">
	<div style="width:500; margin-left:335px;">
		@if ($message = Session::get('success'))
			<br>
			<div class="alert alert-success alert-block">
				<button type="button" class="close" data-dismiss="alert">×</button>	
				<strong>{{ $message }}</strong>
			</div>
		@endif
		
	@if (session()->has('errors'))
		<div class="alert alert-danger">
			<ul>
				{{session('errors')}}
			</ul>
		</div>
	@endif
			
	</div>
	<div id="gallery" class="span3">
		<a href="{{asset('admin_images/product_images/small/'.$proDetails['main_image'])}}" title="@if(isset($proDetails['meta_title'])){{$proDetails['meta_title']}}@endif">
			<img src="{{asset('admin_images/product_images/small/'.$proDetails['main_image'])}}" style="width:100%" alt="@if(isset($proDetails['meta_title'])){{$proDetails['meta_title']}}@endif"/>
		</a>
		<div id="differentview" class="moreOptopm carousel slide">
			<div class="carousel-inner">
				<div class="item active">
					@if(isset($proDetails['images']) && !empty($proDetails['images']))
						@foreach($proDetails['images'] as $images)
							<a href="{{asset('admin_images/images_product/small/'.$images['image'])}}"> 
								<img style="width:29%" src="{{asset('admin_images/images_product/small/'.$images['image'])}}" alt=""/>
							</a>
						@endforeach()
					@endif
				</div>
			</div>
			<!-- <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
			<a class="right carousel-control" href="#myCarousel" data-slide="next">›</a> -->
		</div>
		
		<div class="btn-toolbar">
			<div class="btn-group">
				<span class="btn"><i class="icon-envelope"></i></span>
				<span class="btn" ><i class="icon-print"></i></span>
				<span class="btn" ><i class="icon-zoom-in"></i></span>
				<span class="btn" ><i class="icon-star"></i></span>
				<span class="btn" ><i class=" icon-thumbs-up"></i></span>
				<span class="btn" ><i class="icon-thumbs-down"></i></span>
			</div>
		</div>
	</div>
	<div class="span6">
		<h3>{{$proDetails['product_name']}}</h3>
		<small>- @if(isset($proDetails['brand']) && !empty($proDetails['brand'])){{$proDetails['brand']['name']}}@endif</small>
		<hr class="soft"/>
		<small class="attrItems">10 items in stock</small>
		<form class="form-horizontal qtyFrm" method="post" action="{{url('/add-to-cart')}}">
		@csrf
			<div class="control-group">
			<?php $discounted_price = Product::getDiscountPrice($proDetails['id'])?>

				@if($proDetails['product_discount']>=0)
					@if(isset($discounted_price) && !empty($discounted_price))
						<del><h4 class="ChangeAttributePrice">Rs. {{$proDetails['product_price']}}</h4></del>
						<h6 class="ChangeAttributeDiscountPrice" style="text-align:centre; color:red;"><p>Discounted Price: {{ $discounted_price }}</p></h6>
					@else
					<h4 class="ChangeAttributePrice">Rs. {{$proDetails['product_price']}}</h4>
					@endif
				@endif
				
					<input type="hidden" name="product_id" value="{{$proDetails['id']}}"/>
					<select class="span2 pull-left" id="getAttribute" main-product="{{$proDetails['id']}}" name="size">
						<option value="">{{('Select')}}</option>
						@if(isset($proDetails['attribute']) && !empty($proDetails['attribute']))
							@foreach($proDetails['attribute'] as $attribute)
							<option value="{{$attribute['size']}}" product_id="{{$attribute['id']}}">{{$attribute['size']}}</option>
							@endforeach
						@endif
					</select>
					<input type="number" name="quty" class="span1" placeholder="Qty."/>
					<button type="submit" class="btn btn-large btn-primary pull-right"> Add to cart <i class=" icon-shopping-cart"></i></button>
				</div>
			</div>
		</form>
	
		<hr class="soft clr"/>
		<p class="span6">{{$proDetails['description']}}</p>
		<a class="btn btn-small pull-right" href="#detail">More Details</a>
		<br class="clr"/>
		<a href="#" name="detail"></a>
		<hr class="soft"/>
	</div>
	
	<div class="span9">
		<ul id="productDetail" class="nav nav-tabs">
			<li class="active"><a href="#home" data-toggle="tab">Product Details</a></li>
			<li><a href="#profile" data-toggle="tab">Related Products</a></li>
		</ul>
		<div id="myTabContent" class="tab-content">
			<div class="tab-pane fade active in" id="home">
				<h4>Product Information</h4>
				<table class="table table-bordered">
					<tbody>
						<tr class="techSpecRow"><th colspan="2">Product Details</th></tr>
						<tr class="techSpecRow"><td class="techSpecTD1">Brand: </td><td class="techSpecTD2">@if(isset($proDetails['brand']) && !empty($proDetails['brand'])){{$proDetails['brand']['name']}}@endif</td></tr>
						<tr class="techSpecRow"><td class="techSpecTD1">Code:</td><td class="techSpecTD2">@if(isset($proDetails['product_code'])){{$proDetails['product_code']}}@endif</td></tr>
						<tr class="techSpecRow"><td class="techSpecTD1">Color:</td><td class="techSpecTD2">@if(isset($proDetails['product_color'])){{$proDetails['product_color']}}@endif</td></tr>
						<tr class="techSpecRow"><td class="techSpecTD1">Fabric:</td><td class="techSpecTD2">@if(isset($proDetails['fabric'])){{$proDetails['fabric']}}@endif</td></tr>
						<tr class="techSpecRow"><td class="techSpecTD1">Pattern:</td><td class="techSpecTD2">@if(isset($proDetails['pattern'])){{$proDetails['pattern']}}@endif</td></tr>
					</tbody>
				</table>
				
				<h5>Washcare</h5>
				<p>@if(isset($proDetails['wash_care'])){{$proDetails['wash_care']}}@endif</p>
				<h5>Disclaimer</h5>
				<p>
					There may be a slight color variation between the image shown and original product.
				</p>
			</div>
			<div class="tab-pane fade" id="profile">
				<div id="myTab" class="pull-right">
					<a href="#listView" data-toggle="tab"><span class="btn btn-large"><i class="icon-list"></i></span></a>
					<a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i class="icon-th-large"></i></span></a>
				</div>
				<br class="clr"/>
				<hr class="soft"/>
				<div class="tab-content">
					<div class="tab-pane" id="listView">
					
					
						@foreach($latestProduct as $latest)
						<div class="row">
							<div class="span2">
								<img src="{{asset('frontend/themes/images/products/4.jpg')}}" alt=""/>
							</div>
							<div class="span4">
								<h3>New | Available</h3>
								<hr class="soft"/>
								<h5>{{$latest['product_name']}} </h5>
								<p>{{$latest['description']}}</p>
								<a class="btn btn-small pull-right" href="">View Details</a>
								<br class="clr"/>
							</div>
							<div class="span3 alignR">
							<?php $discounted_price = Product::getDiscountPrice($latest['id']);?>
								<form class="form-horizontal qtyFrm">
									<h3> Rs. {{$latest['product_price']}}</h3>
									
									@if($latest['product_discount']>=0)
										@if(isset($discounted_price) && !empty($discounted_price))
											<h4 style="text-align:centre; color:red;"><p>Discounted Price: {{ $discounted_price }}</p></h4>
										@endif
									@endif
									
									<label class="checkbox">
										<input type="checkbox"> Adds product to compare
									</label><br/>
									<div class="btn-group">
										<a href="{{url('/product/'.$latest['product_code'].'/'.$latest['id'])}}"" class="btn btn-large btn-primary"> Add to <i class=" icon-shopping-cart"></i></a>
										<a href="{{url('/product/'.$latest['product_code'].'/'.$latest['id'])}}"" class="btn btn-large"><i class="icon-zoom-in"></i></a>
									</div>
								</form>
							</div>
						</div>
						<hr class="soft"/>
						@endforeach
						

					</div>
					<div class="tab-pane active" id="blockView">
						<ul class="thumbnails">
							@foreach($latestProduct as $latest)
							<li class="span3">
								<div class="thumbnail">
									<a href="{{url('/product/'.$latest['product_code'].'/'.$latest['id'])}}"><img width="120" height="100" src="{{asset('admin_images/product_images/small/'.$latest['main_image'])}}" alt=""/></a>
									<div class="caption">
										<h5>{{$latest['product_name']}}</h5>
										<p>{{$latest['description']}}</p>
										<h4 style="text-align:center"><a class="btn" href="product_details.html"> 
											<i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> 
											<a class="btn btn-primary" href="#">{{$latest['product_price']}}</a></h4>
									</div>
								</div>
							</li>
							@endforeach
							
						</ul>
						<hr class="soft"/>
					</div>
				</div>
				<br class="clr">
			</div>
		</div>
	</div>
</div>

@endsection