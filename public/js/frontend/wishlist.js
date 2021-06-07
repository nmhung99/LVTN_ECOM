$(document).ready(function () {
	$('.addWishlist').on('click', function () {
		var id = $(this).data('id');
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
	$('.addcart').on('click', function () {
		var id = $(this).data('id');
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
				Swal.fire({
					icon: 'success',
					title: 'Thông báo',
					text: response.data.message,
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

function deleteWishlist(id) {
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
	axios.post('/user/wishlist/delete', {id:id}, {
		headers: {
			'X-CSRF-Token': $('input[name="_token"]').val()
		}
	}).then(function(response){
		Toast.fire({
			icon: 'success',
			title: response.data.message
		}).then((result) => {
			location.reload();
		});
	})
}