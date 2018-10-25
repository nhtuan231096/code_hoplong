@extends('layouts.admin')
@section('title','Danh mục sản phẩm')
@section('links','Danh mục')
@section('main')
<div class="panel panel-info">
	<!-- Default panel contents -->
	<div class="panel-heading">
		<div class="row">
			<div class="col-md-2">
				<!-- Button trigger modal -->
			<button type="button" class="btn btn-info" data-toggle="modal" data-target="#addCategory">
			  	Thêm danh mục
			</button>

			<!-- Modal -->
			<div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h2 class="modal-title" id="exampleModalLabel">Thêm mới danh mục</h2>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        <form action="" method="POST" role="form" enctype="multipart/form-data">
			        	<div class="form-group">
			        		<label for="">Tên danh mục *</label>
			        		<input type="text" name="title" class="form-control" id="name" placeholder="Tên danh mục" required>
			        		@if($errors->has('title'))
								<div class="help-block">
									{{$errors->first('title')}}
								</div>
			        		@endif
			        	</div>
			        	<div class="form-group">
			        		<label for="">Đường dẫn tĩnh *</label>
			        		<input type="text" name="slug" class="form-control" id="slug" placeholder="Đường dẫn tĩnh" required>
			        	</div>
			        	<div class="form-group">
			        		<label for="">Danh mục cha</label>
			        		<select name="parent_id" id="inputParent_id" class="form-control">
			        			<option value="#">Chọn danh mục cha *</option>
			        			@foreach($parent as $cate)
			        				<option value="{{$cate->id}}">{{$cate->title}}</option>
			        			@endforeach
			        		</select>
			        	</div>
			        	
			        	<div class="form-group">
			        		<label for="">Ảnh *</label>
			        		<input type="file" name="upload_file" class="form-control" id="upload_file" placeholder="" required>
			        		<input type="hidden" name="created_by" value="{{Auth::user()->username}}">
			        	</div>
			        	@csrf
				       <div class="modal-footer">
				         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				         <button type="submit" class="btn btn-primary">Save changes</button>
				       </div>
			        	<!-- <button type="submit" class="btn btn-primary">Submit</button> -->
			        </form>
			      </div>
			    </div>
			  </div>
			</div>
			</div>
			<div class="col-md-10">
				<form action="" method="GET" class="form-inline" role="form">
				
					<div class="form-group">
						<input type="" class="form-control" name="search" id="" placeholder="Tên danh mục cần tìm..">
					</div>
					<!-- <div class="form-group">
						<select name="created_by" id="inputCreared_by" class="form-control">
							<option value="">Người tạo</option>
							@foreach($users as $user)
							<option value="{{$user->id}}">{{$user->username}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<select name="status" id="inputStatus" class="form-control">
							<option value="">Trạng thái</option>
							<option value="enable">Enable</option>
							<option value="disable">Disable</option>
						</select>
					</div> -->
					@csrf
				
					<button type="submit" class="btn btn-info">Tìm kiếm</button>
				</form>
			</div>	
		</div>	
	</div>
		@if(Session::has('success'))
			<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>{{Session::get('success')}}</strong>
			</div>
		@endif	
	<div class="modal" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Modal title</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <p>Modal body text goes here.</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary">Save changes</button>
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>
	<div class="panel-body">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>ID</th>
					<th>Tên danh mục</th>
					<th>Slug</th>
					<th>Người tạo</th>
					<th>Ảnh</th>
					<th>Danh mục cha</th>
					<!-- <th>Mô tả</th> -->
					<th>Trạng thái</th>
					<th>Ngày tạo</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($cates as $cate)
				<tr>
					<td>{{$cate->id}}</td>
					<td>{{$cate->title}}</td>
					<td>{{$cate->slug}}</td>
					<td>{{$cate->created_by}}</td>
					<td>
						<img width="50px" src="{{url('uploads/category')}}/{{$cate->cover_image}}" alt="">
					</td>
					<td>{{$cate->parent_id}}</td>
					<!-- <td>{{$cate->description}}</td> -->
					@if($cate->status=='enable')
					<td><div class="label label-primary">{{$cate->status}}</div></td>
					@else
					<td><div class="label label-danger">{{$cate->status}}</div></td>
					@endif
					<td>{{$cate->created_at}}</td>
					<td>
						<a class="btn btn-xs btn-primary" href="{{route('editCategory',['id'=>$cate->id])}}">Sửa</a>
						<a class="btn btn-xs btn-danger" onclick="return confirm('Bạn chắc chắn chứ?')" href="{{route('deleteCategory',['id'=>$cate->id])}}">Xóa</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	{{$cates->links()}}
	</div>
</div>
@stop()