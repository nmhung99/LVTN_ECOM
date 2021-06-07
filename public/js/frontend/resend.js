function resendMail() {
	axios.post('/resend/email/verify', $('#form_resend').serialize())
	.then(function(response){
		Swal.fire({
			icon: 'success',
			title: 'Thông báo',
			text: response.data.message,
		}).then((result) => {
			window.location.href = '/home';
		});
	}).catch(function(error){
		var data = error.response.data;
		// if (data.status == 'validator_fail') {
			// var messages = data.messages;
		// 	Object.keys(messages).forEach(key => {
		// 		$('#'+key+'_error').text(messages[key][0]);
		// 	});
		// } else{
			$('#message_error').text(data.message);
		// } 
	})
}