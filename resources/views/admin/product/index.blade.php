@extends('layouts.admin')
@section('title','Quản lý sản phẩm')
@section('links','Sản phẩm')
@section('main')
<div class="panel panel-info">
	@if(Session::has('success'))
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>{{Session::get('success')}}</strong>
	</div>
	@endif	
	<div class="panel-body">
		<div id="addModal" class="col-md-4">

			<div class="panel-heading">
				<h4 class="panel text-center modal-title">Tạo mới sản phẩm</h4>
			</div>
			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#home">Basic Infomation</a></li>
				<li class=""><a data-toggle="tab" href="#menu1">Meta Infomation</a></li>
			</ul>

			<form class="form-horizontal" action="" method="POST" role="form">
				<div class="tab-content">
					<div id="home" class="tab-pane fade in active">
						<br>
						<div class="form-group">
							<span>Tên sản phẩm</span>
							<input type="text" class="form-control" name="title" id="title_add" placeholder="Nhập tên sản phẩm">
						</div>
						<div class="form-group">
							<span>Đường dẫn tĩnh</span>
							<input type="text" class="form-control" name="slug" id="slug_add" placeholder="Nhập đường dẫn tĩnh">
						</div>
						<div class="form-group">
							<span>Mô tả ngắn</span>
							<input type="text" class="form-control" name="short_description" id="short_description_add" placeholder="Nhập mô tả">
						</div>
						<div class="form-group">
							<span>Thông số kỹ thuật</span>
							<input type="text" class="form-control" name="specifications" id="specifications_add" placeholder="Thông số kỹ thuật">
						</div>
						<div class="form-group">
							<span>Đặc tính</span>
							<input type="text" class="form-control" name="feature" id="feature_add" placeholder="Đặc tính sản phẩm">
						</div>
						<div class="form-group">
							<span>Giá</span>
							<input type="text" class="form-control" name="price" id="price_add" placeholder="Nhập giá">
						</div>
						<div class="form-group">
							<span>Bảo hành</span>
							<input type="text" class="form-control" name="warranty" id="warranty_add" placeholder="Thời gian bảo hành">
						</div>
						<input type="hidden" name="created_by" value="{{Auth::user()->username}}">
						<div class="form-group hidden">
                            <label class="control-label col-sm-2" for="content">Content:</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="content" id="content_add" value="content"></input>
                                <p class="errorContent text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
						<div class="form-group">
							<span>Danh mục</span>
							<select name="category_id" id="category_id_add" class="form-control">
								<option value="">Chọn danh mục</option>
								@foreach($categorys as $category)
								<option value="{{$category->id}}">{{$category->title}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div id="menu1" class="tab-pane fade">
						<br>
						<div class="form-group">
							<span>Ảnh</span>
							<input type="file" class="form-control" id="cover_image_add" name="cover_image">
						</div>
						<div class="form-group">
							<span>Meta title</span>
							<input type="text" class="form-control" name="meta_title" id="meta_title_add" placeholder="Meta title">
						</div>
						<div class="form-group">
							<span>Meta description</span>
							<input type="text" class="form-control" name="meta_description" id="meta_description_add" placeholder="Meta description">
						</div>
						<div class="form-group">
							<span>Meta keywords</span>
							<input type="text" class="form-control" name="meta_keywords" id="meta_keywords_add" placeholder="Meta keywords">
						</div>
						@csrf
					</div>
				</div>
				<div class="modal-footer">
				<button type="button" class="btn btn-primary add" data-dismiss="modal" id="btn-save" value="add">Lưu</button>
				<input class="btn btn-md btn-info" type="reset" value="Reset">
				</div>
			</form>
		</div>
		<div class="col-md-8">
			<div class="panel panel-info">
				<form action="" method="POST" class="form-inline" role="form">
					<div class="form-group">
						<label class="sr-only" for="">label</label>
						<input type="email" class="form-control" id="" placeholder="Nhập sản phẩm cần tìm">
					</div>
					<div class="form-group">
						<label class="sr-only" for="">label</label>
						<select name="" id="input" class="form-control" required="required">
							<option value="">Danh mục sản phẩm</option>
							@foreach($categorys as $category)
							<option value="{{$category->id}}">{{$category->title}}</option>
							@endforeach
						</select>
						<select name="" id="input" class="form-control" required="required">
							<option value="">Người tạo</option>
							@foreach($users as $user)
							<option value="{{$user->id}}">{{$user->username}}</option>
							@endforeach
						</select>
						<select name="" id="input" class="form-control" required="required">
							<option value="">Trạng thái</option>
							<option value="enable">enable</option>
							<option value="disable">disable</option>
						</select>
					</div>
					<button type="submit" class="btn btn-md btn-primary fa fa-search"></button>
				</form>
				<div class="panel-heading">
					<h4 class="text-center">Danh sách sản phẩm</h4>
				</div>

				<table class="table table-hover" id="postTable">
					<thead>
						<tr>
							<th>ID</th>
							<th>Tên sản phẩm</th>
							<th>Người tạo</th>
							<th>Ảnh</th>
							<th>Danh mục</th>
							<!-- <th>Meta title</th>
							<th>Meta description</th>
							<th>Meta keywords</th> -->
							<th>Giá</th>
							<th>Bảo hành</th>
							<th>Trạng thái</th>
							<th>Ngày tạo</th>
							<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($posts as $post)
					<tr>
						<td>{{$post->id}}</td>
						<td>{{$post->title}}</td>
						<td>{{$post->created_by}}</td>
						<td>
							<img width="50px" src="{{url('uploads/post')}}/admin_akn-16d-4p.jpg" alt="{{$post->cover_image}}">
						</td>
						<td>{{$post->category->title}}</td>
						<!-- <td>{{$post->meta_title}}</td>
						<td>{{$post->meta_description}}</td>
						<td>{{$post->meta_keywords}}</td> -->
						<td>{{$post->price}}</td>
						<td>{{$post->warranty}}</td>
						@if($post->status=='active')
						<td><div class="label label-primary">{{$post->status}}</div></td>
						@else
						<td><div class="label label-danger">{{$post->status}}</div></td>
						@endif
						<td>{{$post->created_at}}</td>
						<td>
							<a class="btn btn-xs btn-info fa fa-edit delete-modal"  data-id="{{$post->id}}" data-title="{{$post->title}}" data-content="{{$post->content}}" href=""></a>
							<a class="btn btn-xs btn-danger fa fa-trash" onclick="return confirm('Bạn chắc chắn chứ?')" href="{{route('deleteCategory',['id'=>$post->id])}}"></a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		{{$posts->links()}}
		</div>
	</div>
</div>
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
<script>
    $(window).load(function(){
        $('#postTable').removeAttr('style');
    })
</script>

<script>
    $(document).ready(function(){
        // $('.published').iCheck({
        //     checkboxClass: 'icheckbox_square-yellow',
        //     radioClass: 'iradio_square-yellow',
        //     increaseArea: '20%'
        // });
        $('.published').on('ifClicked', function(event){
            id = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: "{{ URL::route('changeStatus') }}",
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': id
                },
                success: function(data) {
                    // empty
                },
            });
        });
        $('.published').on('ifToggled', function(event) {
            $(this).closest('tr').toggleClass('warning');
        });
    });
    
</script>

<!-- AJAX CRUD operations -->
<script type="text/javascript">
    // add a new post
    $(document).on('click', '.add-modal', function() {
        $('.modal-title').text('Add');
        $('#addModal').modal('show');
    });
    $('.modal-footer').on('click', '.add', function() {
        $.ajax({
            url: 'posts',
            type: 'POST',
            data: {
                '_token': $('input[name=_token]').val(),
                'title': $('#title_add').val(),
                'slug': $('#slug_add').val(),
                'short_description': $('#short_description_add').val(),
                'feature': $('#feature_add').val(),
                'specifications': $('#specifications_add').val(),
                'price': $('#price_add').val(),
                'warranty': $('#warranty_add').val(),
                'category_id': $('#category_id_add').val(),
                'cover_image': $('#cover_image_add').val(),
                'created_by': $('#created_by_add').val(),
                'meta_title': $('#meta_title_add').val(),
                'meta_description': $('#meta_description_add').val(),
                'meta_keywords': $('#meta_keywords_add').val()
            },
            success: function(data) {
                
                   toastr.success('Successfully added Post!', 'Success Alert', {timeOut: 5000});
                        $('#postTable').prepend("<tr class='item" + data.id + "'><td class='col1'>" + data.id + "</td><td>" + data.title + "</td><td>" + data.created_by + "</td><td>" + data.cover_image + "</td><td>" + data.category_id + "</td><td>" + data.price + "</td><td>" + data.warranty + "</td><td>" + data.status + "</td><td>" + data.created_at + "</td><td> <button class='edit-modal btn btn-xs btn-info' data-id='" + data.id + "' data-title='" + data.title + "' data-content='" + data.content + "'><span class='fa fa-edit'></span></button> <button class='delete-modal btn btn-xs btn-danger' data-id='" + data.id + "' data-title='" + data.title + "' data.slug='" + data.slug + "'><span class='fa fa-trash'></span></button></td></tr>");
                   
                    $('.new_published').on('ifToggled', function(event){
                        $(this).closest('tr').toggleClass('warning');
                    });
                    $('.col1').each(function (index) {
                        $(this).html(index+1);
                    });
                
            },
        });
    });

    // // Show a post
    // $(document).on('click', '.show-modal', function() {
    //     $('.modal-title').text('Show');
    //     $('#id_show').val($(this).data('id'));
    //     $('#title_show').val($(this).data('title'));
    //     $('#content_show').val($(this).data('content'));
    //     $('#showModal').modal('show');
    // });


    // Edit a post
    // $(document).on('click', '.edit-modal', function() {
    //     $('.modal-title').text('Edit');
    //     $('#id_edit').val($(this).data('id'));
    //     $('#title_edit').val($(this).data('title'));
    //     $('#content_edit').val($(this).data('content'));
    //     id = $('#id_edit').val();
    //     $('#editModal').modal('show');
    // });
    $('.modal-footer').on('click', '.edit', function() {
        $.ajax({
            type: 'PUT',
            url: 'posts/' + id,
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#id_edit").val(),
                'title': $('#title_edit').val(),
                'content': $('#content_edit').val()
            },
            success: function(data) {
                $('.errorTitle').addClass('hidden');
                $('.errorContent').addClass('hidden');

                if ((data.errors)) {
                    setTimeout(function () {
                        $('#editModal').modal('show');
                        toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                    }, 500);

                    if (data.errors.title) {
                        $('.errorTitle').removeClass('hidden');
                        $('.errorTitle').text(data.errors.title);
                    }
                    if (data.errors.content) {
                        $('.errorContent').removeClass('hidden');
                        $('.errorContent').text(data.errors.content);
                    }
                } else {
                    toastr.success('Successfully updated Post!', 'Success Alert', {timeOut: 5000});
                    $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td class='col1'>" + data.id + "</td><td>" + data.title + "</td><td>" + data.content + "</td><td class='text-center'><input type='checkbox' class='edit_published' data-id='" + data.id + "'></td><td>Right now</td><td><button class='show-modal btn btn-success' data-id='" + data.id + "' data-title='" + data.title + "' data-content='" + data.content + "'><span class='glyphicon glyphicon-eye-open'></span> Show</button> <button class='edit-modal btn btn-info' data-id='" + data.id + "' data-title='" + data.title + "' data-content='" + data.content + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-title='" + data.title + "' data-content='" + data.content + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");

                    if (data.is_published) {
                        $('.edit_published').prop('checked', true);
                        $('.edit_published').closest('tr').addClass('warning');
                    }
                    $('.edit_published').iCheck({
                        checkboxClass: 'icheckbox_square-yellow',
                        radioClass: 'iradio_square-yellow',
                        increaseArea: '20%'
                    });
                    $('.edit_published').on('ifToggled', function(event) {
                        $(this).closest('tr').toggleClass('warning');
                    });
                    $('.edit_published').on('ifChanged', function(event){
                        id = $(this).data('id');
                        $.ajax({
                            type: 'POST',
                            url: "{{ URL::route('changeStatus') }}",
                            data: {
                                '_token': $('input[name=_token]').val(),
                                'id': id
                            },
                            success: function(data) {
                                // empty
                            },
                        });
                    });
                    $('.col1').each(function (index) {
                        $(this).html(index+1);
                    });
                }
            }
        });
    });
    
    // delete a post
    $(document).on('click', '.delete-modal', function() {
        $('.modal-title').text('Delete');
        $('#id_delete').val($(this).data('id'));
        $('#title_delete').val($(this).data('title'));
        $('#deleteModal').modal('show');
        id = $('#id_delete').val();
    });
    $('.modal-footer').on('click', '.delete', function() {
        $.ajax({
            type: 'DELETE',
            url: 'posts/' + id,
            data: {
                '_token': $('input[name=_token]').val(),
            },
            success: function(data) {
                toastr.success('Successfully deleted Post!', 'Success Alert', {timeOut: 5000});
                $('.item' + data['id']).remove();
                $('.col1').each(function (index) {
                    $(this).html(index+1);
                });
            }
        });
    });
</script>
@stop()