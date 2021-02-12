 jQuery(document).ready( function($){
	 
	$("select#sort").on('change',function(){
		//this.form.submit();
		//var sortProducts = $("#sort option:selected").val();
		var sort = $(this).val();
		var url = $("#url").val();
		var occasion = get_filter('occasion');
		var fit = get_filter('fit');
		var pattern = get_filter('pattern');
		var sleeve = get_filter('sleeve');
		var fabric = get_filter('fabric');
		$.ajax({
            type: "GET",
            url: url,
			data:{fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occasion:occasion,sort:sort,url:url},
			success:function(response){
				$('.filter_products').html(response);
			}
        })
	});
	
	//Get febric value
	$('.fabric').on('click',function(){
		var occasion = get_filter('occasion');
		var fit = get_filter('fit');
		var pattern = get_filter('pattern');
		var sleeve = get_filter('sleeve');
		var fabric = get_filter('fabric');
		
		var sort = $("#sort option:selected").val();
		
		var url = $("#url").val();
		$.ajax({
            type: "GET",
            url: url,
			data:{fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occasion:occasion,sort:sort,url:url},
			success:function(response){
				$('.filter_products').html(response);
			}
        })
	});
	//Get sleev value
	$('.sleeve').on('click',function(){
		var occasion = get_filter('occasion');
		var fit = get_filter('fit');
		var pattern = get_filter('pattern');
		var sleeve = get_filter('sleeve');
		var fabric = get_filter('fabric');
		
		var sort = $("#sort option:selected").val();
		var url = $("#url").val();
		$.ajax({
            type: "GET",
            url: url,
			data:{fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occasion:occasion,sort:sort,url:url},
			success:function(response){
				$('.filter_products').html(response);
			}
        })
	});
	
	//Get pattern value
	$('.pattern').on('click',function(){
		var occasion = get_filter('occasion');
		var fit = get_filter('fit');
		var pattern = get_filter('pattern');
		var sleeve = get_filter('sleeve');
		var fabric = get_filter('fabric');
		
		var sort = $("#sort option:selected").val();
		var url = $("#url").val();
		$.ajax({
            type: "GET",
            url: url,
			data:{fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occasion:occasion,sort:sort,url:url},
			success:function(response){
				$('.filter_products').html(response);
			}
        })
	});
	
		//Get fit value
	$('.fit').on('click',function(){
		var occasion = get_filter('occasion');
		var fit = get_filter('fit');
		var pattern = get_filter('pattern');
		var sleeve = get_filter('sleeve');
		var fabric = get_filter('fabric');
		
		var sort = $("#sort option:selected").val();
		var url = $("#url").val();
		$.ajax({
            type: "GET",
            url: url,
			data:{fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occasion:occasion,sort:sort,url:url},
			success:function(response){
				$('.filter_products').html(response);
			}
        })
	});
	
	//Get occasion value
	$('.occasion').on('click',function(){
		var occasion = get_filter('occasion');
		var fit = get_filter('fit');
		var pattern = get_filter('pattern');
		var sleeve = get_filter('sleeve');
		var fabric = get_filter('fabric');
		
		var sort = $("#sort option:selected").val();
		var url = $("#url").val();
		$.ajax({
            type: "GET",
            url: url,
			data:{fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occasion:occasion,sort:sort,url:url},
			success:function(response){
				$('.filter_products').html(response);
			}
        })
	});
	
	//make function to get checked value 
	function get_filter(class_name){
		var filter =[];
		$('.'+class_name+':checked').each(function(){
			filter.push($(this).val());
		});
		return filter;
	}
	// change price of attribute size according
	$("#getAttribute").on('change',function(){
	var size = $(this).val();
	if(size ==""){
		alert('Please select size');
		return false;
	} 
	var mainProductId = $("#getAttribute").attr('main-product');
	var productId = $('option:selected', this).attr('product_id');
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
            type: "post",
            url: '/ecomm/public/get-attribute-price',
			data:{mainProductId:mainProductId,size:size,productId:productId},
			success:function(response){
				//alert(response.discount[0].price);
				if(response.success ==1){
					$(".attrItems").html(response.productAttribute.stock+' items in stock');
					$(".ChangeAttributePrice").html('Rs '+response.productAttribute.price);
					if(!response.discount[0].price ==""){
						$(".ChangeAttributeDiscountPrice").html('<p>Discounted Price: '+ response.discount[0].price +'</p>');
					}
				}else{
					alert(response.message);
				}
			},
			error:function(error){
				alert('ErrorException');
			}
        });
	
	});
	
	//cart items update increase and decrease
	//$(".ItemUpdate").on("click", function // it not working with response html
	$(document).on('click', '.ItemUpdate', function(){ 
		if($(this).hasClass("QuantityMinus")){
			var qwtproId = $(this).attr("qwt-proId");
			var qty = $(this).prev().val();
			if(qty<=1){
				alert('Items qwantity must be 1 or greater!');
				return false;
			}else{
				var newQwt = parseInt(qty)-1;
				$.ajax({
					type: "POST",
					url: '/ecomm/public/update-cart-items-qwt',
					 _token:"{{csrf_token()}}",
					data:{proId:qwtproId,newqwt:newQwt},
					success:function(response){
					if(response.status==false){
						alert('Your added items quentity not avaible!');
						return false;
					}
					$("#CartListData").html(response.view);
					},
					error:function(error){
						alert('ErrorException');
					}
				});
			}
		}
		if($(this).hasClass("QuantityPlus")){
			var qwtproId = $(this).attr("qwt-proId");
			var qty = $(this).prev().prev().val();
			var newQwt = parseInt(qty)+1;
				
				$.ajax({
					type:'POST',
					url:'/ecomm/public/update-cart-items-qwt',
					data: {proId:qwtproId,newqwt:newQwt},
					success:function(response){
					if(response.status == false){
						alert('Your added items quentity not avaible!');
						return false;
					}
					$("#CartListData").html(response.view);
					},
					error:function(error){
						alert('ErrorException');
					}
				});
		}
	});
	
	//delete the cart items from cart
	$(document).on('click', '.Quantitydelete', function(){ 
		var deleteproId = $(this).prev().attr("qwt-proId");
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
               type:'POST',
               url:'/ecomm/public/delete-cart-items-qwt',
			   data: {proId:deleteproId},
               success:function(data) {
                $('#addDynamic').html(data.view);
				console.log(data);
               }
        });
	});
	
	
	//validate signup form on keyup and submit
	$('#registerForm').validate({
		rules: {
			name: {
				required: true,
				minlength: 2
			},
			password: {
				required: true,
				minlength: 5
			},
			email: {
				required: true,
				email: true,
				remote: "email-check"
			},
			mobile: {
				required: true,
				minlength: 10,
				maxlength: 10
			}
		},
		messages: {
			name: {
				required: "Please enter a name",
				minlength: "Your name must consist of at least 2 characters"
			},
			password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long"
			},
			email: {
				required: "Please enter your email address.",
                email: "Please enter a valid email address.",
                remote: jQuery.validator.format("{0} is already taken.")
			},
			mobile: {
				required: "Please enter mobile no",
				minlength: "Please enter must 10 mobile no",
				maxlength: "Please enter max 10 mobile no"
			}
		}
	});
	
	//Login form validation
	$('#loginForm').validate({
		rules: {
			loginemail:{
				required: true,
				email: true
			},
			loginpassword:{
				required: true,
				minlength: 5
			}
		},
		messages: {
			loginemail: {
				required: "Please enter your email address.",
                email: "Please enter a valid email address."
			},
			loginpassword: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long"
			}
		}
	});
	
	// password change form validation
		$('#pwdForm').validate({
		rules: {
			password:{
				required: true
			},
			newpassword:{
				required: true,
				minlength: 5
			},
			confirmpassword:{
				required: true,
				minlength: 5
			}
		},
		messages: {
			password: {
				required: "Please enter your current password."
			},
			newpassword: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long"
			},
			confirmpassword: {
				required: "Please provide a confirm password",
				minlength: "Your confirm password must be same length of password"
			}
		}
	});
	
		// My account update
		$('#myaccountForm').validate({
		rules: {
			name:{
				required: true
			},
			address:{
				required: true
			},
			city:{
				required: true
			},
			state:{
				required: true
			},
			country:{
				required: true
			},
			pin:{
				required: true
			},
			mobile:{
				required: true
			}
		},
		messages: {
			name: {
				required: "Please enter your name !."
			},
			address: {
				required: "Please provide a address !"
			},
			city: {
				required: "Please provide your city !"
			},
			state:{
				required: "Please Enter your state !"
			},
			country:{
				required: "Please provide your country !"
			},
			pin:{
				required: "Please provide your pin code !"
			},
			mobile:{
				required: "Please provide your mobile !"
			}
		}
	});
	
	
});