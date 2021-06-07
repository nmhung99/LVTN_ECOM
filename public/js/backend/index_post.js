function deletePost(id) {
	Swal.fire({
		title: 'Xóa bài viết',
		text: 'Bạn có chắc chắn muốn xóa',
		icon: 'warning',
		showCancelButton: true,
	}).then((result) => {
		if (result.value) {
			axios.post('/admin/delete/blogpost', {id:id}, {
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