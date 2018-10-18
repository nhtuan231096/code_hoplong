@extends('layouts.admin')
@section('title','Nhóm tài khoản')
@section('links','Tài khoản')
@section('main')
<div class="panel panel-info">
	<!-- Default panel contents -->
	<div class="panel-heading">
		<a class="btn btn-primary" data-toggle="modal" href='#modal-id'>Tạo nhóm</a>
		<div class="modal fade" id="modal-id">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Tạo nhóm tài khoản</h4>
					</div>
					<div class="modal-body">
						<form action="{{route('addUserGroup')}}" method="POST" role="form">
							<div class="form-group">
								<label for="">Tên nhóm</label>
								<input type="text" class="form-control" name="title" id="" placeholder="Nhập tên nhóm" required>
								<input type="hidden" class="form-control" name="status" id="" value="enable">
							</div>	
							@csrf									
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary">Lưu</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="panel-body">
	@if(Session::has('success'))
		<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>{{Session::get('success')}}</strong>
	</div>
	@endif
	@if(Session::has('error'))
		<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>{{Session::get('error')}}</strong>
	</div>
	@endif
		<table class="table table-hover">
			<thead>
				<tr>
					<th>ID</th>
					<th>Nhóm tài khoản</th>
					<th>Trạng thái</th>
					<th>Ngày tạo</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			@foreach($user_group as $user)
				<tr>
					<td>{{$user->id}}</td>
					<td>{{$user->title}}</td>
					<td><span class="label label-info">{{$user->status}}</span></td>
					<td>{{$user->created_at}}</td>
					<td class="text-right">
						<a class="btn btn-xs btn-info fa fa-edit" href="{{route('editGroup',['id'=>$user->id])}}"></a>
						<a class="btn btn-xs btn-danger fa fa-trash" onclick="return confirm('Bạn có muốn xóa nhóm {{$user->title}} không ???');" href="{{route('deleteGroup',['id'=>$user->id])}}"></a>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
</div>
@stop()