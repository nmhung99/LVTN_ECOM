// function changeTitle() {
// 	var parent = $(this);
// 	console.log(parent.text());
// }

$(document).ready(function () {
	new AutoNumeric('#minprice', {
		decimalPlaces: '0',
		decimalCharacter: ',',
		digitGroupSeparator:'.'
	})
	new AutoNumeric('#maxprice', {
		decimalPlaces: '0',
		decimalCharacter: ',',
		digitGroupSeparator:'.'
	})
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
	});

	$('.sortproduct').on('click', function () {
		var sort = $('.product-sorting-wrapper').find('.input1').val();
		var value = $(this).attr('id');
		var id1 = $('.product-sorting-wrapper').find('.input2').val();
		var whatproduct = $('.product-sorting-wrapper').find('.input1').attr('id');
		var check = $('.checkrange').val();

	var min = $('.minrange').val();
	var max = $('.maxrange').val();
	console.log(min);
		if (check == 'hasrangeprice') {
			if (whatproduct == 'cat') {

				var url = '/products/cat/'+id1+'/'+min+'/'+max+'/'+value;

			} else if(whatproduct == 'subcat') {

				var url = '/products/subs/'+id1+'/'+min+'/'+max+'/'+value;

			} else {
				var url = '/products/brands/'+id1+'/'+min+'/'+max+'/'+value;
			}
		} else{
			if (whatproduct == 'cat') {

				var url = '/products/cat/'+id1+'/'+value;

			} else if(whatproduct == 'subcat') {

				var url = '/products/subs/'+id1+'/'+value;

			} else {
				var url = '/products/brands/'+id1+'/'+value;
			}
		}
		// console.log(whatproduct);
		
		// console.log(sort);
		console.log(url);
		// console.log(id1);
		$.ajax({
            type: 'get',
            url: url,
            data: {
                'id1': id1,
                'value': value,
            },
            success:function(data){
				window.location.href = url;
            }
        });
	});
})


$("#exampleModal").on("hidden.bs.modal", function () {
    // $('.imgmain').parent().siblings().removeClass('active');
    // $('#imgpre').find('.carousel-item').remove();
	$('.quickview-slide-active').slick('unslick');
    $('.quickview-slide-active').children().remove();
    $('#imgpre').find('.tab-pane').remove();
    $('#imgpremini').find('a').remove();
    $('#modalprice').children().remove();
    $('.pro-details-size-content').find('ul').children().remove();
    $('#stock').find('.badge').remove();
    $('.idproduct').attr('data-id','');
});

function sortPriceRange() {
	var min = $('#minprice').val();
	var max = $('#maxprice').val();
	var value = $('.sortproduct').attr('id');
	var id1 = $('.product-sorting-wrapper').find('.input2').val();
	var whatproduct = $('.product-sorting-wrapper').find('.input1').attr('id');
	console.log(min);

		if (whatproduct == 'cat') {

			var url = '/products/cat/'+id1+'/'+min+'/'+max;

		} else if(whatproduct == 'subcat') {

			var url = '/products/subs/'+id1+'/'+min+'/'+max;

		} else {
			var url = '/products/brands/'+id1+'/'+min+'/'+max;
		}
	$.ajax({
            type: 'get',
            url: url,
            data: {
                'id1': id1,
            },
            success:function(data){
				window.location.href = url;
            }
        });
}
function productview(id) {
	axios.get('/product/cart/view/'+id)
			.then(function(response){
				console.log(response.data.product.id);
				$('.idproduct').attr('data-id',response.data.product.id);
				$('#productname').text(response.data.product.product_name);
				$('#codeproduct').text(response.data.product.product_code);
				$('#cate').text(response.data.product.category_name);
				// // var cate 	= response.data.product.category_name;
				var subcate = response.data.product.subcategory_name;
				if (subcate == null) {
					$('#subcate').text('');
				} else{
					$('#subcate').text(' > '+response.data.product.subcategory_name);
				}
				var discout = response.data.product.discount_price;
				if (discout != null) {
					var discproduct = discout.toLocaleString();
					var price = response.data.product.selling_price;
					var priceproduct = price.toString();
					$('#modalprice').append('<span class="new-price" id="newprice"></span><span class="new-price"> ₫</span>');
					$('#newprice').text(discproduct);
					$('#modalprice').append('<span class="ml-2 mr-1" style="font-weight:500; font-size:14px;">Giá niêm yết: </span><span class="old-price m-0" id="oldprice"></span><span class="old-price m-0">₫</span>');
					$('#oldprice').text(priceproduct);

					new AutoNumeric('#newprice', {
						decimalPlaces: '0',
						decimalCharacter: ',',
						digitGroupSeparator:'.'
					})
					new AutoNumeric('#oldprice', {
						decimalPlaces: '0',
						decimalCharacter: ',',
						digitGroupSeparator:'.'
					})
				} else{
					var price = response.data.product.selling_price;
					var priceproduct = price.toLocaleString();
					$('#modalprice').append('<span class="new-price" id="newprice"></span><span class="new-price"> ₫</span>');
					$('#newprice').text(priceproduct);
					new AutoNumeric('#newprice', {
						decimalPlaces: '0',
						decimalCharacter: ',',
						digitGroupSeparator:'.'
					})
				}
				var imagepre = JSON.parse(response.data.product.image);
				$.each(imagepre, function (key, value) {
						// $('#imgpre').append('<div class="carousel-item"><img class="d-block w-100 imgmain" src="'+value+'"></div>');
						$('#imgpre').append('<div id="pro-'+key+'" class="tab-pane fade"><img src="'+value+'" alt=""></div>');
						$('#imgpremini').append('<a data-toggle="tab" href="#pro-'+key+'"><img src="'+value+'" alt=""></a>');


				});
				$('#imgpre div').first().addClass('show');
				$('#imgpre div').first().addClass('active');
				$('#imgpremini a').first().addClass('active');

				$.each(response.data.color, function (key, value) {
					console.log(value);
					$('.pro-details-size-content').find('ul').append('<li><a style="text-transform: capitalize;">'+value+'</a><input type="hidden" value="'+value+'"></li>');
				});
				if (response.data.product.product_quantity == 0) {
					$('#stock').append('<span class="badge badge-danger">Hết Hàng</span>')
				}else{
					$('#stock').append('<span class="badge badge-success" style="font-size: 14px">Có Sẵn</span>')
				}
					// console.log(response.data.product.product_quantity);
				$('#productid').val(response.data.product.id)
				
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
				// Swal.fire({
				// 	icon: 'success',
				// 	title: 'Thông báo',
				// 	text: response.data.message,
				// }).then((result) => {
				// 	// window.location.reload();
				// });
				
			}).catch(function(error){
				let data = error.response.data;
				const Toast = Swal.mixin({
					toast: true,
					position: 'top-end',
					showConfirmButton: false,
					timer: 3000,
					timerProgressBar: true,
					didOpen: (toast) => {
						toast.addEventListener('mouseenter', Swal.stopTimer)
						toast.addEventListener('mouseleave', Swal.resumeTimer)
					}
				})
				Toast.fire({
					icon: 'error',
					title: data.message
				})
			})
}

$('.product-click').on('click', function () {
		var catgegory_id2 = $('.product-click').text();
		$('.title-product').text(catgegory_id2);
	});
$('.product-click1').on('click', function () {
		var catgegory_id2 = $('.product-click1').text();
		$('.title-product').text(catgegory_id2);
	});

function insertCart() {
	var color = $('.pro-details-size-content').find('a').hasClass('active');
	var qty = $('#quantity').val();
	const Toast = Swal.mixin({
					toast: true,
					position: 'top-end',
					showConfirmButton: false,
					timer: 3000,
					timerProgressBar: true,
					didOpen: (toast) => {
						toast.addEventListener('mouseenter', Swal.stopTimer)
						toast.addEventListener('mouseleave', Swal.resumeTimer)
					}
				})
	if (color) {
		if (qty != 0) {
			axios.post('/cart/insert/item', $('#form_quick_cart').serialize())
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
				} else{
					$('#message_error').text(data.messages);
				} 
			})
		} else{
			Toast.fire({
				icon: 'warning',
				title: 'Bạn Phải Chọn Số Lượng Lớn Hơn 0'
			})
		}
	} else{
		Toast.fire({
			icon: 'warning',
			title: 'Hãy Chọn Màu Sắc Của Sản Phẩm'
		})
	}
}