function updateCart() {
	var qty = $('#quantity').val();
	const Toast = Swal.mixin({
					toast: true,
					position: 'top-end',
					showConfirmButton: false,
					timer: 1000,
					timerProgressBar: true,
					didOpen: (toast) => {
						toast.addEventListener('mouseenter', Swal.stopTimer)
						toast.addEventListener('mouseleave', Swal.resumeTimer)
					}
				})
	if (qty == 0) {
		Toast.fire({
					icon: 'error',
					title: 'Số Lượng Phải Lớn Hơn 0'
				})
	}
	else{
		axios.post('/cart/update/item', $('#form_cart_update').serialize())
		.then(function(response){
			Swal.fire({
				icon: 'success',
				title: 'Thông báo',
				text: response.data.message,
			}).then((result) => {
				location.reload();
			});
		}).catch(function(error){
		})	
	}
	
}
function removeMessage(obj){
	var input_name = obj.attr('name');
	$('#'+input_name+'_error').text('');
}
function addCoupon() {
	const Toast = Swal.mixin({
					toast: true,
					position: 'top-end',
					showConfirmButton: false,
					timer: 1000,
					timerProgressBar: true,
					didOpen: (toast) => {
						toast.addEventListener('mouseenter', Swal.stopTimer)
						toast.addEventListener('mouseleave', Swal.resumeTimer)
					}
				})
	axios.post('/user/apply/coupon', $('#form_coupon').serialize())
	.then(function(response){
		Toast.fire({
			icon: 'success',
			title: response.data.message
		}).then((result) => {
			location.reload();
		});
	}).catch(function(error){
		var data = error.response.data;
		Toast.fire({
			icon: 'error',
			title: data.message
		})
	})
}