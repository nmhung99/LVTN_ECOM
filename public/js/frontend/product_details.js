$(document).ready(function () {
	$('.addWishlist').on('click', function () {
		var id = $(this).data('id');
		const Toast = Swal.mixin({
					toast: true,
					position: 'top-end',
					showConfirmButton: false,
					timer: 3000,
					timerProgressBar: true,
					didOpen: (toast) => {
						toast.addEventListener('mouseenter', Swal.stopTimer)
						toast.addEventListener('mouseleave', Swal.resumeTimer)
					}
				})
		if (id) {
			axios.get('/add/wishlist/'+id)
			.then(function(response){
				// const Toast = Swal.mixin({
				// 	toast: true,
				// 	position: 'top-end',
				// 	showConfirmButton: false,
				// 	timer: 3000,
				// 	timerProgressBar: true,
				// 	didOpen: (toast) => {
				// 		toast.addEventListener('mouseenter', Swal.stopTimer)
				// 		toast.addEventListener('mouseleave', Swal.resumeTimer)
				// 	}
				// })
					Toast.fire({
						icon: 'success',
						title: response.data.message
					})
				
			}).catch(function(error){
				var data = error.response.data;
				Toast.fire({
					icon: 'error',
					title: data.message
				})	
			})
		} else{
			alert('danger');
		}
	})
	$('.addcart').on('click', function () {
		var id = $(this).data('id');
		const Toast = Swal.mixin({
					toast: true,
					position: 'top-end',
					showConfirmButton: false,
					timer: 3000,
					timerProgressBar: true,
					didOpen: (toast) => {
						toast.addEventListener('mouseenter', Swal.stopTimer)
						toast.addEventListener('mouseleave', Swal.resumeTimer)
					}
				})
		if (id) {
			axios.get('/add/to/cart/'+id)
			.then(function(response){
				// const Toast = Swal.mixin({
				// 	toast: true,
				// 	position: 'top-end',
				// 	showConfirmButton: false,
				// 	timer: 3000,
				// 	timerProgressBar: true,
				// 	didOpen: (toast) => {
				// 		toast.addEventListener('mouseenter', Swal.stopTimer)
				// 		toast.addEventListener('mouseleave', Swal.resumeTimer)
				// 	}
				// })
					Toast.fire({
						icon: 'success',
						title: response.data.message
					}).then((result) => {
					window.location.reload();
				});
				
			}).catch(function(error){
				var data = error.response.data;
				Toast.fire({
					icon: 'error',
					title: data.message
				})	
			})
		} else{
			alert('danger');
		}
	})
})

function addProductCart(id) {
	var color = $('.pro-details-size-content').find('a').hasClass('active');
	var qty = $('#quantity').val();
	const Toast = Swal.mixin({
					toast: true,
					position: 'top-end',
					showConfirmButton: false,
					timer: 3000,
					timerProgressBar: true,
					didOpen: (toast) => {
						toast.addEventListener('mouseenter', Swal.stopTimer)
						toast.addEventListener('mouseleave', Swal.resumeTimer)
					}
				})
	if (color) {
		if (qty != 0) {
			axios.post('/product/add/cart/'+id, $('#form_cart').serialize())
			.then(function(response){
				Swal.fire({
					icon: 'success',
					title: 'Thông báo',
					text: response.data.message,
				}).then((result) => {
					window.location.reload();
				});
			}).catch(function(error){
				var data = error.response.data;
				if (data.status == 'validator_fail') {
					var messages = data.messages;
					Object.keys(messages).forEach(key => {
						$('#'+key+'_error').text(messages[key][0]);
					});
				} else{
					$('#message_error').text(data.messages);
				} 
			})
		} else{
			Toast.fire({
				icon: 'warning',
				title: 'Bạn Phải Chọn Số Lượng Lớn Hơn 0'
			})
		}
	} else{
		Toast.fire({
			icon: 'warning',
			title: 'Hãy Chọn Màu Sắc Của Sản Phẩm'
		})
	}
}

function postRate() {
	axios.post('/user/rating/product', $('#form_rating').serialize())
	.then(function(response){
		Swal.fire({
			icon: 'success',
			title: 'Thông báo',
			text: response.data.messages,
		}).then((result) => {
			location.reload();
		});
	}).catch(function(error){
		var data = error.response.data;
		if (data.status == 'validator_fail') {
			var messages = data.messages;
			Object.keys(messages).forEach(key => {
				$('#'+key+'_error').text(messages[key][0]);
			});
		} else{
			Swal.fire({
				icon: 'warning',
				title: 'Thông báo',
				text: data.messages,
			}).then((result) => {
				window.location.href = '/home';
			});
		}
	})
}

function removeMessage(obj){
	var input_name = obj.attr('name');
	$('#'+input_name+'_error').text('');
}