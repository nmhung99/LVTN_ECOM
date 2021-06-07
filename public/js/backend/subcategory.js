function addSubCategory() {
		axios.post('/admin/store/subcategory', $('#form_sub_category').serialize())
		.then(function(response){
			Swal.fire({
				icon: 'success',
				title: 'Thông báo',
				text: response.data.message,
				// footer: '<a href>Have a nice day</a>'
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

function deletesubCategory(id) {
		Swal.fire({
			title: 'Xóa danh mục con',
			text: 'Bạn có chắc chắn muốn xóa',
			icon: 'warning',
			showCancelButton: true,
		}).then((result) => {
			if (result.value) {
				axios.post('/admin/delete/subcategory', {id:id}, {
					headers: {
						'X-CSRF-Token': $('input[name="_token"]').val()
					}
				}).then(function(response){
			Swal.fire({
				icon: 'success',
				title: 'Thông báo',
				text: response.data.message,
				// footer: '<a href>Have a nice day</a>'
			}).then((result) => {
				location.reload();
			});
		})
			}
		});
	}
function updatesubCategory(id) {
		axios.post('/admin/subcategory/update/'+id, $('#form_sub_category').serialize())
		.then(function(response){
			Swal.fire({
				icon: 'success',
				title: 'Thông báo',
				text: response.data.message,
				// footer: '<a href>Have a nice day</a>'
			}).then((result) => {
				window.location.href = '/admin/sup/category';
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
					window.location.href = '/admin/sup/category';
				});
			}
		})
	}