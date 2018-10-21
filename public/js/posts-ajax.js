var page = 1;
var current_page = 1;
var total_page = 0;
var is_ajax_fire = 0;

manageData();

/* manage data list */
function manageData() {
    $.ajax({
        dataType: 'json',
        url: url,
        data: {page:page}
    }).done(function(data) {
    	total_page = data.last_page;
    	current_page = data.current_page;
    	$('#pagination').twbsPagination({
	        totalPages: total_page,
	        visiblePages: current_page,
	        onPageClick: function (event, pageL) {
	        	page = pageL;
                if(is_ajax_fire != 0){
	        	  getPageData();
                }
	        }
	    });
    	manageRow(data.data);
        is_ajax_fire = 1;
    });
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

/* Get Page Data*/
function getPageData() {
	$.ajax({
    	dataType: 'json',
    	url: url,
    	data: {page:page}
	}).done(function(data) {
		manageRow(data.data);
	});
}

/* Add new Post table row */
function manageRow(data) {
	var	rows = '';
	$.each( data, function( key, value ) {
	  	rows = rows + '<tr>';
	  	rows = rows + '<td>'+value.title+'</td>';
        rows = rows + '<td>'+value.slug+'</td>';
        rows = rows + '<td>'+value.category_id+'</td>';
        rows = rows + '<td>'+value.created_by+'</td>';
        rows = rows + '<td>'+value.status+'</td>';
        rows = rows + '<td>'+value.created_at+'</td>';
        rows = rows + '<td data-id="'+value.id+'">';
        rows = rows + '<button data-toggle="modal" data-target="#edit-item" class="btn btn-info fa fa-edit edit-item"></button> ';
        rows = rows + '<button class="btn btn-danger fa fa-trash remove-item"></button>';
        rows = rows + '</td>';
	  	rows = rows + '</tr>';
	});
	$("tbody").html(rows);
}

/* Create new Post */
$(".crud-submit").click(function(e) {
    e.preventDefault();
    var form_action = $("#create-item").find("form").attr("action");
    var title = $("#create-item").find("input[name='title']").val();
    var slug = $("#create-item").find("input[name='slug']").val();
    var feature = $("#create-item").find("input[name='feature']").val();
    var specifications = $("#create-item").find("input[name='specifications']").val();
    var catalog = $("#create-item").find("input[name='catalog']").val();
    var created_by = $("#create-item").find("input[name='created_by']").val();
    var price = $("#create-item").find("input[name='price']").val();
    var warranty = $("#create-item").find("input[name='warranty']").val();
    var category_id = $("#create-item").find("input[name='category_id']").val();
    var meta_title = $("#create-item").find("input[name='meta_title']").val();
    var meta_description = $("#create-item").find("input[name='meta_description']").val();
    var meta_keywords = $("#create-item").find("input[name='meta_keywords']").val();
    var status = $("#create-item").find("textarea[name='status']").val();
    $.ajax({
        dataType: 'json',
        type:'POST',
        url: form_action,
        data:{title:title,status:status,slug:slug,feature:feature,specifications:specifications,
            catalog:catalog,created_by:created_by,price:price,warranty:warranty,category_id:category_id,meta_title:meta_title,
            meta_description:meta_description,meta_keywords:meta_keywords}
    }).done(function(data){
        // if(data.error == true){
        //     $('.error').hide();
        //     if(data.message.title != undefined){
        //         $(.errorTitle).show().text(data.message.title[0]);
        //     }
        //     if(data.message.slug != undefined){
        //         $(.errorSlug).show().text(data.message.slug[0]);
        //     }
        // }
        getPageData();
        $(".modal").modal('hide');
        toastr.success('Post Created Successfully.', 'Success Alert', {timeOut: 5000});
    });
});

/* Remove Post */
$("body").on("click",".remove-item",function() {
    var id = $(this).parent("td").data('id');
    var c_obj = $(this).parents("tr");
    $.ajax({
        dataType: 'json',
        type:'delete',
        url: url + '/' + id,
    }).done(function(data) {
        c_obj.remove();
        toastr.success('Post Deleted Successfully.', 'Success Alert', {timeOut: 5000});
        getPageData();
    });
});

/* Edit Post */
$("body").on("click",".edit-item",function() {
    var id = $(this).parent("td").data('id');
    var title = $(this).parent("td").prev("td").prev("td").text();
    var status = $(this).parent("td").prev("td").text();
    var slug = $(this).parent("td").prev("td").prev("td").text();
    var feature = $(this).parent("td").prev("td").prev("td").text();
    var catalog = $(this).parent("td").prev("td").prev("td").text();
    var created_by = $(this).parent("td").prev("td").prev("td").text();
    var price = $(this).parent("td").prev("td").prev("td").text();
    var warranty = $(this).parent("td").prev("td").prev("td").text();
    var category_id = $(this).parent("td").prev("td").prev("td").text();
    var meta_title = $(this).parent("td").prev("td").prev("td").text();
    var meta_description = $(this).parent("td").prev("td").prev("td").text();
    var meta_keywords = $(this).parent("td").prev("td").prev("td").text();
    $("#edit-item").find("input[name='title']").val(title);
    $("#edit-item").find("textarea[name='status']").val(status);
    $("#edit-item").find("textarea[name='slug']").val(slug);
    $("#edit-item").find("textarea[name='feature']").val(feature);
    $("#edit-item").find("textarea[name='catalog']").val(catalog);
    $("#edit-item").find("textarea[name='created_by']").val(created_by);
    $("#edit-item").find("textarea[name='price']").val(price);
    $("#edit-item").find("textarea[name='warranty']").val(warranty);
    $("#edit-item").find("textarea[name='category_id']").val(category_id);
    $("#edit-item").find("textarea[name='meta_title']").val(meta_title);
    $("#edit-item").find("textarea[name='meta_description']").val(meta_description);
    $("#edit-item").find("textarea[name='meta_keywords']").val(meta_keywords);
    $("#edit-item").find("form").attr("action",url + '/' + id);
});

/* Updated new Post */
$(".crud-submit-edit").click(function(e) {
    e.preventDefault();
    var form_action = $("#edit-item").find("form").attr("action");
    var title = $("#edit-item").find("input[name='title']").val();
    var details = $("#edit-item").find("textarea[name='details']").val();
    $.ajax({
        dataType: 'json',
        type:'PUT',
        url: form_action,
        data:{title:title, details:details}
    }).done(function(data){
        getPageData();
        $(".modal").modal('hide');
        toastr.success('Post Updated Successfully.', 'Success Alert', {timeOut: 5000});
    });
});