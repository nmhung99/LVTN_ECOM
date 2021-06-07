$('.imgAdd').on('click', function() {
	$(this).closest(".row").find('.imgAdd').before('<div class="col-2 imgUp"><div class="imagePreview"><img width="100%" src="/media/default2.png"/><input type="hidden" class="url" name="url_img[]" value="/media/default2.png"/></div><label class="btn btn-primary" id="btn-upload">Upload<input type="file"  accept="image/*" class="uploadFile img"></label><span class="del"><i class="fa fa-times"></i></span></div>');
});
$(document).on('click', '.del', function () {
	$(this).parent().remove();
});

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
		axios.post('/admin/product/upimg', formData, 
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

if ($('#main_slider_insert').val() == 1) {
	$('#main_slider').prop('checked', true);
} else {
	$('#main_slider').prop('checked', false);
}

$('#main_slider').change(function () {
	if ($(this).prop('checked')) {
		$('#main_slider_insert').val(1);
	}
	else{
		$('#main_slider_insert').val(0);
	}
});
////////////
if ($('#flash_deal_insert').val() == 1) {
	$('#flash_deal').prop('checked', true);
} else {
	$('#flash_deal').prop('checked', false);
}

$('#flash_deal').change(function () {
	if ($(this).prop('checked')) {
		$('#flash_deal_insert').val(1);
	}
	else{
		$('#flash_deal_insert').val(0);
	}
});
///////////////
if ($('#hot_deal_insert').val() == 1) {
	$('#hot_deal').prop('checked', true);
} else {
	$('#hot_deal').prop('checked', false);
}

$('#hot_deal').change(function () {
	if ($(this).prop('checked')) {
		$('#hot_deal_insert').val(1);
	}
	else{
		$('#hot_deal_insert').val(0);
	}
});
///////////////////////
if ($('#best_rated_insert').val() == 1) {
	$('#best_rated').prop('checked', true);
} else {
	$('#best_rated').prop('checked', false);
}

$('#best_rated').change(function () {
	if ($(this).prop('checked')) {
		$('#best_rated_insert').val(1);
	}
	else{
		$('#best_rated_insert').val(0);
	}
});
//////////////
if ($('#trend_insert').val() == 1) {
	$('#trend').prop('checked', true);
} else {
	$('#trend').prop('checked', false);
}

$('#trend').change(function () {
	if ($(this).prop('checked')) {
		$('#trend_insert').val(1);
	}
	else{
		$('#trend_insert').val(0);
	}
});
////////////////
if ($('#hot_new_insert').val() == 1) {
	$('#hot_new').prop('checked', true);
} else {
	$('#hot_new').prop('checked', false);
}

$('#hot_new').change(function () {
	if ($(this).prop('checked')) {
		$('#hot_new_insert').val(1);
	}
	else{
		$('#hot_new_insert').val(0);
	}
});


$(document).ready(function () {
	$('#subcategory_id').append('<option>Chọn Danh Mục Con</option>');
	$('#brand_id').append('<option>Chọn Nhãn Hàng</option>');
	$('#category_id').on('change', function () {
		var catgegory_id2 = $('#category_id').val();
		// console.log(catgegory_id2);
		if (catgegory_id2) {
			axios.get('/get/subcategory/' + catgegory_id2)
			.then(function (response) {
				$('#subcategory_id').empty();
				$('#subcategory_id').append('<option label="Chọn Danh Mục Con"></option>');
				
				$.each(response.data, function (key, value) {
					$('#subcategory_id').append('<option value="' + value.id + '">' + value.subcategory_name + '</option>');
				});
			})
			.catch(function (response) {

			})
			.then(function () {

			})

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
			$('#subcategory_id').empty();
			$('#subcategory_id').append('<option label="Chọn Danh Mục Con"></option>');
		}
	});

	$('#group_product_id').append('<option label="Chọn Nhóm Sản Phẩm"></option>');
	$('#brand_id').on('change', function () {
		var brand_id2 = $(this).val();
		// console.log(brand_id2);
		if (brand_id2) {
			axios.get('/get/groupproduct/' + brand_id2)
			.then(function (response) {
				$('#group_product_id').empty();
				$('#group_product_id').append('<option label="Chọn Nhóm Sản Phẩm"></option>');
				$.each(response.data, function (key, value) {
					$('#group_product_id').append('<option value="' + value.id + '">' + value.group_name + '</option>');
				});
			})
			.catch(function (response) {

			})
			.then(function () {

			})
		} 
		else{
			$('#group_product_id').empty();
			$('#group_product_id').append('<option label="Chọn Nhóm Sản Phẩm"></option>');
		}
	});
});

function addProduct() {
	axios.post('/admin/store/product', $('#form_product').serialize())
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
// function removeMessageImage(){
// 	parent.closest('.imgUp').find('#image_error').text('');
// 	// var input_name = obj.attr('name');
// 	// $('#'+input_name+'_error').text('');
// }
function updateProduct(id) {
	axios.post('/admin/product/update/'+id, $('#form_product').serialize())
	.then(function(response){
		Swal.fire({
			icon: 'success',
			title: 'Thông báo',
			text: response.data.message,
		}).then((result) => {
			window.location.href = '/admin/product';
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
				window.location.href = '/admin/product';
			});
		}
	})
}