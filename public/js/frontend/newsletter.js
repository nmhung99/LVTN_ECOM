function addNewsletter() {
		axios.post('/store/newsletter', $('#form_subscribe').serialize())
		.then(function(response){
			Swal.fire({
				icon: 'success',
				title: 'Thông báo',
				text: response.data.message,
				footer: 'Cảm ơn quý khách đã đăng ký nhận tin'
			}).then((result) => {
				window.location.href = '/';
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