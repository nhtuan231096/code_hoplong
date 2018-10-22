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
        rows = rows + '<button data-toggle="modal" data-target="#edit-item" class="edit-item btn btn-info fa fa-edit"></button> ';
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
    var short_description = $("#create-item").find("input[name='short_description']").val();
    var dimension = $("#create-item").find("input[name='dimension']").val();
    var feature = $("#create-item").find("textarea[name='feature']").val();
    var specifications = $("#create-item").find("textarea[name='specifications']").val();
    var catalog = $("#create-item").find("input[name='catalog']").val();
    var sorder = $("#create-item").find("input[name='sorder']").val();
    var promotion = $("#create-item").find("input[name='promotion']").val();
    var product_code = $("#create-item").find("input[name='product_code']").val();
    var download_id = $("#create-item").find("input[name='download_id']").val();
    var created_by = $("#create-item").find("input[name='created_by']").val();
    var status = $("#create-item").find("input[name='status']").val();
    var price = $("#create-item").find("input[name='price']").val();
    var warranty = $("#create-item").find("input[name='warranty']").val();
    var category_id = $("#create-item").find("select[name='category_id']").val();
    var meta_title = $("#create-item").find("input[name='meta_title']").val();
    var meta_description = $("#create-item").find("input[name='meta_description']").val();
    var meta_keywords = $("#create-item").find("input[name='meta_keywords']").val();
    $.ajax({
        dataType: 'json',
        type:'POST',
        url: form_action,
        data:{
            title:title,status:status,slug:slug,short_description:short_description,dimension:dimension,
            feature:feature,specifications:specifications,
            catalog:catalog,created_by:created_by,price:price,
            warranty:warranty,category_id:category_id,
            meta_title:meta_title,meta_description:meta_description,
            meta_keywords:meta_keywords
        }
    }).done(function(data){
            if($.isEmptyObject(data.error)){
                getPageData();
                    $(".modal").modal('hide');
                    toastr.success('Thêm mới thành công.', 'Success', {timeOut: 5000});
            }else{
                toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                if(data.errors.title) 
                {
                    $('.errorTitle').removeClass('hidden');
                    $('.errorTitle').text(data.error.title);
                }
                if(data.errors.slug)
                {
                    $('.errorSlug').removeClass('hidden');
                    $('.errorSlug').text(data.error.slug);
                }
                printErrorMsg(data.error);
            }
            // if ((data.error)) {
            //     setTimeout(function () {
            //         $('#addModal').modal('show');
            //         toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
            //     }, 500);


            // if((data.errors.title)) 
            // {
            //     $('.errorTitle').removeClass('hidden');
            //     $('.errorTitle').text(data.errors.title);
            // }
            // if((data.errors.slug)) 
            // {
            //     $('.errorSlug').removeClass('hidden');
            //     $('.errorSlug').text(data.errors.slug);
            // }
        // }
        // else{
        // getPageData();
        // $(".modal").modal('hide');
        // toastr.success('Thêm mới thành công.', 'Success', {timeOut: 5000});
        // }
        function printErrorMsg (msg) {
            $(".errorTitle").find("ul").html('');
            $(".errorTitle").css('display','block');
            $.each( msg, function( key, value ) {
                $(".errorTitle").find("ul").append('<li>'+value+'</li>');
            });
        }
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
    var slug = $(this).parent("td").prev("td").prev("td").text();
    var status = $(this).parent("td").prev("td").text();
    var feature = $(this).parent("td").prev("td").prev("td").text();
    var specifications = $(this).parent("td").prev("td").prev("td").text();
    var catalog = $(this).parent("td").prev("td").prev("td").text();
    var created_by = $(this).parent("td").prev("td").prev("td").text();
    var price = $(this).parent("td").prev("td").prev("td").text();
    var warranty = $(this).parent("td").prev("td").prev("td").text();
    var category_id = $(this).parent("td").prev("td").prev("td").text();
    var meta_title = $(this).parent("td").prev("td").prev("td").text();
    var meta_description = $(this).parent("td").prev("td").prev("td").text();
    var meta_keywords = $(this).parent("td").prev("td").prev("td").text();
    $("#edit-item").find("input[name='title']").val(title);
    $("#edit-item").find("input[name='status']").val(status);
    $("#edit-item").find("input[name='slug']").val(slug);
    $("#edit-item").find("input[name='feature']").val(feature);
    $("#edit-item").find("input[name='specifications']").val(specifications);
    $("#edit-item").find("input[name='catalog']").val(catalog);
    $("#edit-item").find("input[name='price']").val(price);
    $("#edit-item").find("input[name='warranty']").val(warranty);
    $("#edit-item").find("select[name='category_id']").val(category_id);
    $("#edit-item").find("input[name='meta_title']").val(meta_title);
    $("#edit-item").find("input[name='meta_description']").val(meta_description);
    $("#edit-item").find("input[name='meta_keywords']").val(meta_keywords);
    $("#edit-item").find("form").attr("action",url + '/' + id);
});

/* Updated new Post */
$(".crud-submit-edit").click(function(e) {
    e.preventDefault();
    var form_action = $("#edit-item").find("form").attr("action");
    var title = $("#edit-item").find("input[name='title']").val();
    var slug = $("#edit-item").find("input[name='slug']").val();
    var feature = $("#edit-item").find("input[name='feature']").val();
    var specifications = $("#edit-item").find("input[name='specifications']").val();
    var catalog = $("#edit-item").find("input[name='catalog']").val();
    var created_by = $("#edit-item").find("input[name='created_by']").val();
    var price = $("#edit-item").find("input[name='price']").val();
    var warranty = $("#edit-item").find("input[name='warranty']").val();
    var create_by = $("#edit-item").find("input[name='create_by']").val();
    var category_id = $("#edit-item").find("input[name='category_id']").val();
    var meta_title = $("#edit-item").find("input[name='meta_title']").val();
    var meta_description = $("#edit-item").find("input[name='meta_description']").val();
    var meta_keywords = $("#edit-item").find("input[name='meta_keywords']").val();
    var status = $("#edit-item").find("input[name='status']").val();
    $.ajax({
        dataType: 'json',
        type:'PUT',
        url: form_action,
        data:{
            title:title,status:status,slug:slug,
            feature:feature,specifications:specifications,
            catalog:catalog,created_by:created_by,price:price,
            warranty:warranty,category_id:category_id,
            meta_title:meta_title,meta_description:meta_description,
            meta_keywords:meta_keywords
        }
    }).done(function(data){
        getPageData();
        $(".modal").modal('hide');
        toastr.success('Post Updated Successfully.', 'Success Alert', {timeOut: 5000});
    });
});