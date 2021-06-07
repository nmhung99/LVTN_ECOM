function registerUser(){
	$.LoadingOverlay("show", {
		maxSize:50
	});
	axios.post('/user/post/register', $('#form_register').serialize())
	.then(function(response){
		Swal.fire({
			icon: 'success',
			title: 'Thông báo',
			text: response.data.message,
				// footer: '<a href>Have a nice day</a>'
			}).then((result) => {
				window.location.href = '/register/success';
			});
	}).catch(function(error){
		var data = error.response.data;
		var messages = data.messages;
		Object.keys(messages).forEach(key => {
			$('#'+key+'_error').text(messages[key][0]);
		});
	}).then(function(){
		$.LoadingOverlay("Hide")
	});
}

function loginUser(){
	$.LoadingOverlay("show", {
		maxSize:50
	});
	axios.post('/user/post/login', $('#form_login').serialize())
	.then(function(response){
		window.location.href = '/';
	}).catch(function(error){
		var data = error.response.data;
		if (data.status == 'validator_fail') {
			var messages = data.messages;
			Object.keys(messages).forEach(key => {
				$('#'+key+'_error').text(messages[key][0]);
			});
		} else if(data.status == 'veri_fail'){
			$('#veri_fail').text(data.messages);
		}
		else if(data.status == 'auth_fail'){
			$('#message_error').text(data.messages);
		}
	}).then(function(){
		$.LoadingOverlay("Hide");
	});
}

function removeMessage(obj){
	var input_name = obj.attr('name');
	$('#'+input_name+'_error').text('');
}