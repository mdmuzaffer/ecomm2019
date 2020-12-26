  jQuery(document).ready(function(){
    //alert("ready!");
});
//change password of admin
function changePwdFunction(){
    //alert("password change");
	var newPwd = $('#NewPassword').val();
	var username = $('#username').val();
	var email = $('#email').val();
	var settingUrl = $('#passswordUrl').val();
	var CurrentPwd = $('#CurrentPassword').val();
	var confirmPwd = $('#ConfirmPassword').val();
	//alert( newPwd +','+ CurrentPwd +','+ confirmPwd +','+ email);
	if(CurrentPwd=="" || email=="" || newPwd=="" || confirmPwd==""){
		$('.adminMessage').html('<span>All fields must be required !</span>');
		return false;
	}else{
		if(newPwd !== confirmPwd){
			$('.adminMessage').html('<span>New password and confirm password not match </span>');
			return false;
		}else{
			
			$.ajax({
				type: "POST",
				url: settingUrl,
				data: {currentPassword:CurrentPwd,password:newPwd,name:username}, 
				success: function( msg ) {
					//alert(msg);
					$('.adminMessage').html('<span>'+ msg +'</span>');
				}
			});
		}
		
	}
}
// change section status
$('.sectionUpdateStatus').click(function(e){
	var status = $(this).text();
	var sectionId = $(this).attr('id');
	var id = $(this).attr('status-id');
	var status = $(this).attr('status');
	$.ajax({
			type: "POST",
			url: 'http://localhost/ecomm/public/admin/section/status',
			data: {id:id, status:status}, 
			success: function( msg ) {
				if(status ==1){
				$('a#'+sectionId).text('Inactive');
				}else{
				$('a#'+sectionId).text('Active');
				}
			}
		});
});

// change category value on change section value
 $("select#section").change(function(){
	var sectionValue = $(this).val();
	var sectionText = $('option:selected', this).attr('myVal');
		$.ajax({
			type: "POST",
			url: 'http://localhost/ecomm/public/admin/change-category',
			data: {id:sectionValue}, 
			success: function(msg) {
				$(".appendCategory").html(msg);
			}
		});
});

//change product status
$('.productUpdateStatus').click(function(e){
	var status = $(this).text();
	var productId = $(this).attr('id');
	var id = $(this).attr('status-id');
	var status = $(this).attr('status');
		$.ajax({
			type: "POST",
			url: 'http://localhost/ecomm/public/admin/product/status',
			data: {id:id, status:status}, 
			success: function( msg ) {
				if(status ==1){
				$('a#'+productId).text('Inactive');
				}else{
				$('a#'+productId).text('Active');
				}
			}
		});
});