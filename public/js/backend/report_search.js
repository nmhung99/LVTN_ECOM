// $(document).ready( function() {
//     $('#datepicker').val(new Date().toDateInputValue());
// });​

// Date.prototype.toDateInputValue = (function() {
//     var local = new Date(this);
//     local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
//     return local.toJSON().slice(0,10);
// });
// $("#datepi").val($.datepicker.formatDate('dd M yy', new Date()));
// var de = new Date();
// formatDate('dd M yy', new Date())

// var formattedDate = new Date();
// var d = formattedDate.getDate();
// var m =  '0'+formattedDate.getMonth();
// m += 1;  // JavaScript months are 0-11
// var y = formattedDate.getFullYear();

// // $("#datepi").val("0"+d + "/" +"0"+ m + "/" + y);
// // $("#datepi").val(y +"/"+ 0+m + "/"+0+d );
let d = new Date();
let ye = new Intl.DateTimeFormat('en', { year: 'numeric' }).format(d);
let mo = new Intl.DateTimeFormat('en', { month: '2-digit' }).format(d);
let da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d);
$("#datepi").val(`${ye}-${mo}-${da}`);
// console.log(`${ye}/${mo}/${da}`);
// console.log(m);