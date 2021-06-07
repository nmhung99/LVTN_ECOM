function addGroup() {
		axios.post('/admin/store/group', $('#form_group_product').serialize())
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

function deleteGroup(id) {
		Swal.fire({
			title: 'Xóa nhóm sản phẩm',
			text: 'Bạn có chắc chắn muốn xóa',
			icon: 'warning',
			showCancelButton: true,
		}).then((result) => {
			if (result.value) {
				axios.post('/admin/delete/group', {id:id}, {
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
	
function updateGroup(id) {
		axios.post('/admin/groupproduct/update/'+id, $('#form_group_product').serialize())
		.then(function(response){
			Swal.fire({
				icon: 'success',
				title: 'Thông báo',
				text: response.data.message,
				// footer: '<a href>Have a nice day</a>'
			}).then((result) => {
				window.location.href = '/admin/group/product';
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
					window.location.href = '/admin/group/product';
				});
			}
		})
	}

$(document).ready(function () {
	// $('#brand_id').append('<option>Chọn Nhãn Hàng</option>');
	$('#category_id').on('change', function () {
		var catgegory_id2 = $('#category_id').val();
		// console.log(catgegory_id2);
		if (catgegory_id2) {

			axios.get('/get/brand/' + catgegory_id2)
			.then(function (response) {
				$('#brand_id').empty();
				$('#brand_id').append('<option label="Chọn Nhãn Hàng"></option>');
				
				$.each(response.data, function (key, value) {
					$('#brand_id').append('<option value="' + value.id + '">' + value.brand_name + '</option>');
				});
			})
			.catch(function (response) {

			})
			.then(function () {

			})
		} 
		else{
			$('#brand_id').empty();
			$('#brand_id').append('<option label="Chọn Nhãn Hàng"></option>');
		}
	});
});