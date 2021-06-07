function login(){
	$.LoadingOverlay("show", {
		maxSize:50
	});
	axios.post('/admin/post-login', $('#form_login').serialize())
	.then(function(response){
		window.location.href = '/admin/home';
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
	}).then(function(){
		$.LoadingOverlay("Hide");
	});
}
function removeMessage(obj){
	var input_name = obj.attr('name');
	$('#'+input_name+'_error').text('');
}