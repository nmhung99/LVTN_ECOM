$(document).ready(function() {
	$('#extra1').show();
	$('#locationextra').change(function(){
		if ($(this).val() == 1) {
			$('#extra1').find('.title').text('Ảnh Banner Phụ 1 (370x190)');
		} else{
			$('#extra1').find('.title').text('Ảnh Banner Phụ 2 (370x190)');
		}
			
    });

	$(document).on('change', '.uploadFile', function(){
		// console.log($('#avatar'));

		var parent = $(this);
		// if (parent.closest('.imgUp').find('.imagePreview').has("img")) {
		// 	var link1 = $('.imagePreview img').attr('src');
		// 	console.log(link1);
		// 	$.ajax({
		// 		url: '/unlink/img',
		// 		type: 'POST',
		// 		data: 'string1=' + link1,
		// 		error: function (e) {
		// 			console.log(e.message);
		// 		}
		// 	});
			// axios.post('/unlink/img/'+link1)
			// .then(function (response) {
			// 	$('.imagePreview img').attr('src','');
			// })
			// .catch(function (response) {

			// })
			// .then(function () {

			// })
		// }
		var file = $(this)[0].files;
		var formData = new FormData();
		// console.log(file);
		formData.append('file', file[0]);
		axios.post('/admin/slider/upimg', formData, 
		{
			headers: {
				'Content-Type': 'multipart/form-data',
				'X-CSRF-Token': $('form input[name="_token"]').val()
			}
		} 
		)
		.then(function (response) {
			var data = response.data;
			parent.closest('.imgUp').find('.imagePreview img').attr('src', data.path)
			parent.closest('.imgUp').find('.url').attr('value', data.path)
			// parent.closest('.imgUp').find('.imagePreview').html('<img width="100%" src="'+data.path+'"/><input type="hidden" name="url_img[]" value="'+data.path+'"/>')
			// console.log(response.data.path);
			// $('.product-pic').attr('src', response.data.path);
			// $('#url_image').val(response.data.path);
		})
		.catch(function (response) {

		})
		.then(function () {
			
		})
	});

});

function addBanner() {
	axios.post('/admin/store/slider', $('#form_slider').serialize())
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
		} 
	})
}

function addBannerExtra() {
	axios.post('/admin/store/extra/slider', $('#form_extra_slider').serialize())
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
		} 
	})
}

function removeMessage(obj){
	var input_name = obj.attr('name');
	$('#'+input_name+'_error').text('');
}

function active(id) {
	axios.post('/admin/active/slider', {id:id}, {
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
	axios.post('/admin/inactive/slider', {id:id}, {
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

function deleteSlider(id) {
	Swal.fire({
		title: 'Xóa Slider Này',
		text: 'Bạn có chắc chắn muốn xóa',
		icon: 'warning',
		showCancelButton: true,
	}).then((result) => {
		if (result.value) {
			axios.post('/admin/delete/slider', {id:id}, {
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

function updateBanner(id) {
	axios.post('/admin/slider/update/'+id, $('#form_update_slider').serialize())
	.then(function(response){
		Swal.fire({
			icon: 'success',
			title: 'Thông báo',
			text: response.data.message,
		}).then((result) => {
			window.location.href = '/admin/all/slider';
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
				window.location.href = '/admin/all/slider';
			});
		}
	})
}

function updateBannerExtra(id) {
	axios.post('/admin/slider/extra/update/'+id, $('#form_update_slider_extra').serialize())
	.then(function(response){
		Swal.fire({
			icon: 'success',
			title: 'Thông báo',
			text: response.data.message,
		}).then((result) => {
			window.location.href = '/admin/all/slider';
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
				window.location.href = '/admin/all/slider';
			});
		}
	})
}