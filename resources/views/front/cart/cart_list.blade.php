<?php
 use App\Cart;
?>
<div id="addDynamic">
	<table class="table table-bordered">
		<thead>
			<tr>
			  <th>Product</th>
			  <th colspan="2">Description</th>
			  <th>Quantity/Update</th>
			  <th>MRP</th>
			  <th>Discount</th>
			  <th>Sub Total</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		$totalPrice =0;
		$totaldiscount =0;
		?>
		@foreach($cartItems as $items)
		<tr>
			<td> <img width="60" src="{{asset('/admin_images/product_images/small/'.$items['product']['main_image'])}}" alt=""/></td>
			<td colspan="2">{{$items['product']['product_name']}} || {{$items['product']['product_code']}}<br/>Color : {{$items['product']['product_color']}}<br/>Size : {{$items['size']}}</td>
			<td>
			<div class="input-append" id="demoCustom">
				<input class="span1" name="quantity" style="max-width:34px" placeholder="1" id="appendedInputButtons" size="16" type="text" value="{{$items['quantity']}}">
				<button class="btn ItemUpdate QuantityMinus" type="button" qwt-proId="{{$items['id']}}"><i class="icon-minus"></i></button>
				<button class="btn ItemUpdate QuantityPlus" type="button" qwt-proId="{{$items['id']}}"><i class="icon-plus"></i></button>
				<button class="btn btn-danger Quantitydelete" type="button"><i class="icon-remove icon-white"></i></button>
			</div>
			</td>
			<?php $productsattrPrice = Cart::ProductsAttrPrice($items['product_id'], $items['size']);?>
			<td>Rs.{{ $productsattrPrice['price']}}</td>
			<!-- <td>Rs.{{ $items['product']['product_discount']}}</td> -->
			<td>Rs.{{ $productsattrPrice['price']* $items['quantity'] * $items['product']['product_discount']/100}}</td>
			<?php $totaldiscount = $totaldiscount + ($productsattrPrice['price']* $items['quantity'] * $items['product']['product_discount']/100); ?>
			<td>Rs. {{$productsattrPrice['price']* $items['quantity']}}</td>
			<?php $totalPrice = $totalPrice + ($productsattrPrice['price']* $items['quantity']);?>
		</tr>
		@endforeach
		<tr>
		  <td colspan="6" style="text-align:right">Total Price:	</td>
		  <td> Rs.{{$totalPrice}}</td>
		</tr>
		<tr>
		  <td colspan="6" style="text-align:right">Total Discount:	</td>
		  <td> Rs.0.00</td>
		</tr>
		<tr>
		  <td colspan="6" style="text-align:right"><strong>TOTAL (Rs.{{$totalPrice}} - Rs.{{$totaldiscount}}) =</strong></td>
		  <td class="label label-important" style="display:block"> <strong> Rs. {{$totalPrice - $totaldiscount}} </strong></td>
		</tr>
		</tbody>
	</table>
</div>