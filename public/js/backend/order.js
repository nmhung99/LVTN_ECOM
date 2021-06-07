function accept(id) {
    axios.get('/admin/payment/accept/'+id)
    .then(function(response){
        Swal.fire({
            icon: 'success',
            title: 'Thông báo',
            text: response.data.message,
                // footer: '<a href>Have a nice day</a>'
            }).then((result) => {
                window.location.href = '/admin/pading/order';
            });
        })
}

function cancel(id) {
    axios.get('/admin/payment/cancel/'+id)
    .then(function(response){
        Swal.fire({
            icon: 'warning',
            title: 'Thông báo',
            text: response.data.message,
            }).then((result) => {
                window.location.href = '/admin/pading/order';
            });
        })
}

function delivery(id) {
    axios.get('/admin/delivery/process/'+id)
    .then(function(response){
        Swal.fire({
            icon: 'success',
            title: 'Thông báo',
            text: response.data.message,
            }).then((result) => {
                window.location.href = '/admin/accept/payment';
            });
        })
}

function deliverydone(id) {
    axios.get('/admin/delivery/done/'+id)
    .then(function(response){
        Swal.fire({
            icon: 'success',
            title: 'Thông báo',
            text: response.data.message,
            }).then((result) => {
                window.location.href = '/admin/success/payment';
            });
        })
}