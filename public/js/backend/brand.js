$(document).ready(function() {
    $(".upload-button").on('click', function() {
        $(".file-upload").click();
    });
    $(".file-upload").on('change', function(){
        var file = $('#logo')[0].files;
        var formData = new FormData();
        formData.append('file', file[0]);
        axios.post('/admin/brands/uplogo', formData, 
        {
            headers: {
                'Content-Type': 'multipart/form-data',
                'X-CSRF-Token': $('form input[name="_token"]').val()
            }
        } 
        )
        .then(function (response) {
            console.log(response.data.path);
            $('.logo-pic').attr('src', response.data.path);
            $('#url_logo').val(response.data.path);
        })
        .catch(function (response) {

        })
        .then(function () {

        })
    });
});

function addBrand() {
    axios.post('/admin/store/brands', $('#form_brand').serialize())
    .then(function(response){
        Swal.fire({
            icon: 'success',
            title: 'Thông báo',
            text: response.data.message,
                // footer: '<a href>Have a nice day</a>'
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
            } 
        })
    }

function deleteBrand(id) {
        Swal.fire({
            title: 'Xóa nhãn hàng',
            text: 'Bạn có chắc chắn muốn xóa',
            icon: 'warning',
            showCancelButton: true,
        }).then((result) => {
            if (result.value) {
                axios.post('/admin/delete/brands', {id:id}, {
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
function updateBrand(id) {
        axios.post('/admin/brands/update/'+id, $('#form_brand').serialize())
        .then(function(response){
            Swal.fire({
                icon: 'success',
                title: 'Thông báo',
                text: response.data.message,
                // footer: '<a href>Have a nice day</a>'
            }).then((result) => {
                window.location.href = '/admin/brands';
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
                    window.location.href = '/admin/brands';
                });
            }
        })
    }