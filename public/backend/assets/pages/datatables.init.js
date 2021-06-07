/*
 Template Name: Zegva - Responsive Bootstrap 4 Admin Dashboard
 Author: Themesdesign
 Website: www.themesdesign.in
 File: Datatable js
 */

$(document).ready(function() {
	$('#datatable').DataTable({
		responsive: true,
		"language": {
			"info": "Hiện _START_ tới _END_ của _TOTAL_ danh mục",
			"infoEmpty":      "Hiện 0 tới 0 của 0 danh mục",
    		"infoFiltered":   "(được lọc từ tổng số _MAX_ danh mục)",
    		"zeroRecords":    "Không tìm thấy",
			"paginate": {
				"first":      "Đầu tiên",
				"last":       "Cuối Cùng",
				"next":       "Tiếp theo",
				"previous":   "Trước"
			},
			"search": "Tìm kiếm:",
			"lengthMenu":     "Hiện _MENU_ danh mục",
		}
		// dom: 'Blfrtip',
		// buttons: [
		// 'excel',
		// 'print'
		// ]
    });

    //Buttons examples
    var table = $('#datatable-buttons').DataTable({
        lengthChange: true,
        buttons: ['excel', 'pdf'],
        responsive: true,
		"language": {
			"info": "Hiện _START_ tới _END_ của _TOTAL_ danh mục",
			"infoEmpty":      "Hiện 0 tới 0 của 0 danh mục",
    		"infoFiltered":   "(được lọc từ tổng số _MAX_ danh mục)",
    		"zeroRecords":    "Không tìm thấy",
			"paginate": {
				"first":      "Đầu tiên",
				"last":       "Cuối Cùng",
				"next":       "Tiếp theo",
				"previous":   "Trước"
			},
			"search": "Tìm kiếm:",
			"lengthMenu":     "Hiện _MENU_ danh mục",
		}
    });

    table.buttons().container()
        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
} );