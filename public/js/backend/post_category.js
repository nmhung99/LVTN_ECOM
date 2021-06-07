function addBlogCategory() {
	axios.post('/admin/store/blogcategory', $('#form_blog_category').serialize())
	.then(function(response){
		Swal.fire({
			icon: 'success',
			title: 'Thông báo',
			text: response.data.message,
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
		} 
	})
}

function removeMessage(obj){
	var input_name = obj.attr('name');
	$('#'+input_name+'_error').text('');
}

function deleteBlogCategory(id) {
	Swal.fire({
		title: 'Xóa danh mục',
		text: 'Bạn có chắc chắn muốn xóa',
		icon: 'warning',
		showCancelButton: true,
	}).then((result) => {
		if (result.value) {
			axios.post('/admin/delete/blogcategory', {id:id}, {
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

function updateCategory(id) {
	axios.post('/admin/blogcategory/update/'+id, $('#form_blog_category').serialize())
	.then(function(response){
		Swal.fire({
			icon: 'success',
			title: 'Thông báo',
			text: response.data.message,
		}).then((result) => {
			window.location.href = '/admin/blog/category';
		});
	}).catch(function(error){
		var data = error.response.data;
		if (data.status == 'validator_fail') {
			var messages = data.messages;
			Object.keys(messages).forEach(key => {
				$('#'+key+'_error').text(messages[key][0]);
			});
		} else {
			Swal.fire({
				title: 'Cập nhật',
				text: 'Không có gì để cập nhật',
				icon: 'warning',
			}).then((result) => {
				window.location.href = '/admin/blog/category';
			});
		}
	})
}