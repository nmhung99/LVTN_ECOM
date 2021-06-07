function updateSeo() {
	axios.post('/admin/seo/update', $('#form_seo').serialize())
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