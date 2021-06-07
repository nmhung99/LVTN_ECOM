function active(id) {
	axios.post('/admin/active/product', {id:id}, {
		headers: {
			'X-CSRF-Token': $('input[name="_token"]').val()
		}
	}).then(function(response){
		Swal.fire({
			icon: 'success',
			title: 'Thông báo',
			text: response.data.message,
		}).then((result) => {
			location.reload();
		});
	})
}

function inactive(id) {
	axios.post('/admin/inactive/product', {id:id}, {
		headers: {
			'X-CSRF-Token': $('input[name="_token"]').val()
		}
	}).then(function(response){
		Swal.fire({
			icon: 'success',
			title: 'Thông báo',
			text: response.data.message,
		}).then((result) => {
			location.reload();
		});
	})
}

function deleteProduct(id) {
	Swal.fire({
		title: 'Xóa sản phẩm',
		text: 'Bạn có chắc chắn muốn xóa',
		icon: 'warning',
		showCancelButton: true,
	}).then((result) => {
		if (result.value) {
			axios.post('/admin/delete/product', {id:id}, {
				headers: {
					'X-CSRF-Token': $('input[name="_token"]').val()
				}
			}).then(function(response){
				Swal.fire({
					icon: 'success',
					title: 'Thông báo',
					text: response.data.message,
				}).then((result) => {
					location.reload();
				});
			})
		}
	});
}