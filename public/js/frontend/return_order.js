function returnOrder(id) {
		Swal.fire({
			title: 'Hoàn Trả Đơn Hàng',
			text: 'Bạn có chắc chắn muốn hoàn trả lại đơn hàng này',
			icon: 'warning',
			showCancelButton: true,
		}).then((result) => {
			if (result.value) {
				axios.get('/request/return/order/'+id, {
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