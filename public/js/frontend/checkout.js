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

function payment() {
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
	axios.post('/user/payment/process', $('#form_payment').serialize())
	.then(function(response){
		// Toast.fire({
		// 	icon: 'success',
		// 	title: response.data.message
		// }).then((result) => {
		// 	// location.reload();
		// });
		if (response.data.payment == 'stripe') {
			window.location.href = '/process/payment';
		// $('.phone').val(response.data.phone);
		}
		$(window).scrollTop(0);
		// $('.main-wrapper').html(response.data.view);
	}).catch(function(error){
		// var data = error.response.data;
		// Toast.fire({
		// 	icon: 'error',
		// 	title: data.message
		// })
		var data = error.response.data;
		if (data.status == 'validator_fail') {
			var messages = data.messages;
			Object.keys(messages).forEach(key => {
				$('#'+key+'_error').text(messages[key][0]);
			});
		} 
	})
}

function removeMessage(obj){
	var input_name = obj.attr('name');
	$('#'+input_name+'_error').text('');
}

