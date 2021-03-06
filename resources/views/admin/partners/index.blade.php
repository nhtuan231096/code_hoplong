@extends('layouts.admin')
@section('title','Danh sách hãng sản phẩm')
@section('links','hãng sản phẩm')
@section('main')
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title"><a class="btn btn-md btn-default" href="{{route('addPartner')}}">Thêm mới hãng sản phẩm</a></h3>
	</div>
	<div class="panel-body">
	@if(Session::has('success'))
	<div class="alert alert-info">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>{{Session::get('success')}}</strong>
	</div>
	@endif
	@if(Session::has('errors'))
	<div class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>{{Session::get('errors')}}</strong>
	</div>
	@endif
		<table class="table table-hover">
			<thead>
				<tr>
					<th>ID</th>
					<th>Tên đối tác</th>
					<th>Đường dẫn tĩnh</th>
					<th>Ảnh đại diện</th>
					<th>Đường dẫn liên kết</th>
					<th>Người tạo</th>
					<th>Ngày tạo tạo</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($partners as $partner)
				<tr>
					<td>{{$partner->id}}</td>
					<td>{{$partner->title}}</td>
					<td>{{$partner->slug}}</td>
					<td>
						<img width="50px" src="{{url('uploads/partner')}}/{{$partner->cover_image}}" alt="">
					</td>
					<td>{{$partner->link}}</td>
					<td>{{$partner->created_by}}</td>
					<td>{{$partner->created_at}}</td>
					<td>
						<a class="btn btn-xs btn-info fa fa-edit" href="{{route('editPartner',['id'=>$partner->id])}}"></a>
						<a onclick="return confirm('Bạn chắc chắn chứ?')" class="btn btn-xs btn-danger fa fa-trash" href="{{route('deletePartner',['id'=>$partner->id])}}"></a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{$partners->links()}}
	</div>
</div>
@stop()