function updatePass() {
		axios.post('/admin/password/update', $('#form_change_pass').serialize())
		.then(function(response){
			Swal.fire({
				icon: 'success',
				title: 'Thông báo',
				text: response.data.message,
				footer: '<a href>Have a nice day</a>'
			}).then((result) => {
				window.location.href = '/admin';
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
	}
function removeMessage(obj){
	var input_name = obj.attr('name');
	$('#'+input_name+'_error').text('');
}