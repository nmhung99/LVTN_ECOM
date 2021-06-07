// function changeTitle() {
// 	var parent = $(this);
// 	console.log(parent.text());
// }

$(document).ready(function () {
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
	})
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
    $('.cart-plus-minus-box').val('1')
});
function productview(id) {
	axios.get('/product/cart/view/'+id)
			.then(function(response){


				$('.idproduct').attr('data-id',response.data.product.id);
				$('#productname').text(response.data.product.product_name);
				$('#codeproduct').text(response.data.product.product_code);
				$('#cate').text(response.data.product.category_name);
				// var cate 	= response.data.product.category_name;
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
				var data = error.response.data;
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

var timeout;
var formatter = new Intl.NumberFormat('vi-VN', {
  style: 'currency',
  currency: 'VND',

  // These options are needed to round to whole numbers if that's what you want.
  //minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
  //maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
})
$("#search1").on('keyup', function(){
		$('#resultlive').show();
        $value = $(this).val();
        if(timeout) {
        	clearTimeout(timeout);
        }
        timeout = setTimeout(function() {
        $.ajax({
            type: 'get',
            url: '/product/search',
            dataType: 'json',
            data: {
                'search': $value
            },
            success:function(data){
                // let dataproduct = data.products
                console.log(data.status);
                // $('#resultlive').find('li').remove();
                if (data.status == 'invalid') {
                	$('#resultlive').find('li').remove();
                } else{
                	$('#resultlive').find('li').remove();
                	$.each(data.products, function (key, value) {
                		// $('#resultlive').append('<li>'+value.product_name+'</li>');
                		if (value.discount_price != null) {
                			var discount = formatter.format(value.discount_price);
                			var sellprice = formatter.format(value.selling_price);
                		} else{
                			var discount = formatter.format(value.selling_price);
                			var sellprice = '';
                		}
                		var link = "/product/details/"+value.id+'/'+value.product_name;
                		var imag = JSON.parse(value.image);
                		$('#resultlive').append("<li class='col-lg-12 p-4' ><div class='col-lg-4' ><a href='"+link+"'><img width='60%' height='auto' src='"+imag[0]+"' alt=''></a></div><div class='col-lg-8 ml-4' ><h5><a href='"+link+"'>"+value.product_name+"</a></h5><h5 class='mt-4'><span class='pricesell'>"+discount+"</span> <span class='ml-3 discountprice' id='pricesale3333'>"+sellprice+"</span></h5></div></li>");
                		console.log(value.discount_price);
                		// if (value.discount_price) {
                		// 	$("#pricesale").css("text-decoration", "line-through");
                		// };
                		// if (value.discount_price != null ) {
                		// 	$("#pricesale3333").css("text-decoration", "none");
                		// } else{
                		// 	$("#pricesale3333").css("text-decoration", "line-through");
                		// }
                	});
                	// $('#resultlive').append('<li>Không tìm thấy</li>');
                }
                if (!$value) {
                	$('#resultlive').find('li').remove();
                }
            }
        });
    }, 500);
    })
// $(document).on('click', function(){
//     $('#resultlive').hide();
// });
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
