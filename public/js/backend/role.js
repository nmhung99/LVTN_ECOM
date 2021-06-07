$(document).ready(function() {

	// var nameinput = $('#role').find('input').attr('name');
	// console.log(nameinput);
	$('input[type="checkbox"]').each(function() {
		var inputname = $(this).attr('id');
		console.log(inputname);
		if ($('#'+inputname+'_insert').val() == 1) {
			$('#'+inputname).prop('checked', true);
		} else {
			$('#'+inputname).prop('checked', false);
		}

		$('#'+inputname).change(function () {
			if ($(this).prop('checked')) {
				$('#'+inputname+'_insert').val(1);
			}
			else{
				$('#'+inputname+'_insert').val(0);
			}
		});
	});

});


function addUser() {
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
	axios.post('/admin/store/admin', $('#form_add_admin').serialize())
	.then(function(response){
		Swal.fire({
			icon: 'success',
			title: 'Thông báo',
			text: response.data.message,
			// footer: '<a href>Have a nice day</a>'
		}).then((result) => {
			location.reload();
			$(window).scrollTop(0);
		});
	}).catch(function(error){
		var data = error.response.data;
		if (data.status == 'validator_fail') {
			var messages = data.messages;
			Object.keys(messages).forEach(key => {
				$('#'+key+'_error').text(messages[key][0]);
			});
		} else {
			Toast.fire({
				icon: 'error',
				title: data.message
			})
		}
	})
}

function removeMessage(obj){
	var input_name = obj.attr('name');
	$('#'+input_name+'_error').text('');
}

function deleteAdmin(id) {
	Swal.fire({
		title: 'Xóa người dùng',
		text: 'Bạn có chắc chắn muốn xóa',
		icon: 'warning',
		showCancelButton: true,
	}).then((result) => {
		if (result.value) {
			axios.post('/admin/delete/admin', {id:id}, {
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

function updateAdmin() {
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
	axios.post('/admin/update/admin', $('#form_update_admin').serialize())
	.then(function(response){
		Swal.fire({
			icon: 'success',
			title: 'Thông báo',
			text: response.data.message,
		}).then((result) => {
			window.location.href = '/admin/all/user';
		});
	}).catch(function(error){
		var data = error.response.data;
		if (data.status == 'validator_fail') {
			var messages = data.messages;
			Object.keys(messages).forEach(key => {
				$('#'+key+'_error').text(messages[key][0]);
			});
		} else {
			Toast.fire({
				icon: 'error',
				title: data.message
			})
		}
	})
}