
// function readURL(input) {
//   if (input.files && input.files[0]) {
//     var reader = new FileReader();
    
//     reader.onload = function(e) {
//       $('.imgUp').find('.imagePreview').html('<img src="'+e.target.result+'" width="100%" >');
//     }
    
//     reader.readAsDataURL(input.files[0]); // convert to base64 string
//   }
// }

// $(".uploadFile").change(function() {
//   readURL(this);
// });

$(document).ready(function() {
	// $(".upload-button").on('click', function() {
	// 	$(".file-upload").click();
	// });

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
		axios.post('/admin/blogpost/upimg', formData, 
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

function addPost() {
	axios.post('/admin/store/blogpost', $('#form_post').serialize())
	.then(function(response){
		Swal.fire({
			icon: 'success',
			title: 'Thông báo',
			text: response.data.messages,
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
// function removeMessageImage(){
// 	parent.closest('.imgUp').find('#image_error').text('');
// 	// var input_name = obj.attr('name');
// 	// $('#'+input_name+'_error').text('');
// }
function updatePost(id) {
	axios.post('/admin/blogpost/update/'+id, $('#form_post').serialize())
	.then(function(response){
		Swal.fire({
			icon: 'success',
			title: 'Thông báo',
			text: response.data.message,
		}).then((result) => {
			window.location.href = '/admin/blog/post';
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
				window.location.href = '/admin/blog/post';
			});
		}
	})
}