@extends('layouts.admin')
@section('title','Quản lý tài khoản')
@section('links','Tài khoản')
@section('main')
<div class="panel panel-info">
	<!-- Default panel contents -->
	<div class="panel-heading">
		<a class="btn btn-primary" data-toggle="modal" href='#modal-id'>Tạo tài khoản</a>
		<div class="modal fade" id="modal-id">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Tạo tài khoản admin</h4>
					</div>
					<div class="modal-body">
						<form action="{{route('addAccount')}}" method="POST" role="form" enctype="multipart/form-data">
							<div class="form-group">
								<label for="">Tên tài khoản</label>
								<input type="text" class="form-control" name="username" id="" placeholder="Nhập tên tài khoản" required>
							</div>
							<div class="form-group">
								<label for="">Họ tên</label>
								<input type="text" class="form-control" name="fullname" id="" placeholder="Nhập họ tên" required>
							</div>
							<div class="form-group">
								<label for="">Email</label>
								<input type="" class="form-control" name="email" id="" placeholder="Nhập Email" required>
							</div>
							<div class="form-group">
								<label for="">Mật khẩu</label>
								<input type="password" class="form-control" name="password" id="" placeholder="Nhập họ tên" required>
							</div>
							<!-- <div class="form-group">
								<label for="">Nhập lại mật khẩu</label>
								<input type="password" class="form-control" name="confirmPassword" id="" placeholder="Nhập lại mật khẩu" required>
							</div> -->
							<div class="form-group">
								<label for="">Ảnh đại diện</label>
								<input type="file" class="form-control" name="upload_file" id="" required>
								<input type="hidden" name="status" value="enable">
							</div>
							<div class="form-group">
								<label for="">Quyền admin</label>
								<select name="group_id" id="inputGroup_id" class="form-control" required="required">
									@if(Auth::user()->group_id==1)
										@foreach($groups as $group)
										<option value="{{$group->id}}">{{$group->title}}</option>
										@endforeach
									@elseif(Auth::user()->group_id==2)
										<option value="3">Mod</option>
									@endif
								</select>
							</div>
							@csrf
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
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
					<th>Tên tài khoản</th>
					<th>Ảnh đại diện</th>
					<th>Email</th>
					<th>Họ tên</th>
					<th>Quyền admin</th>
					<th>Trạng thái</th>
					<th>Ngày tạo</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			@foreach($accounts as $account)
				<tr>
					<td>{{$account->id}}</td>
					<td>{{$account->username}}</td>
					<td>
						<img width="50px;" src="{{url('uploads/admin')}}/{{$account->avatar}}" alt="{{$account->avatar}}">
					</td>
					<td>{{$account->email}}</td>
					<td>{{$account->fullname}}</td>
					<td>{{$account->group->title}}</td>
					@if($account->status=='enable')
					<td><span class="label label-info">{{$account->status}}</span></td>
					@else
					<td><span class="label label-danger">{{$account->status}}</span></td>
					@endif
					<td>{{$account->created_at}}</td>
					<td class="text-right">
						<a class="btn btn-xs btn-info fa fa-edit" href="{{route('editAccount',['id'=>$account->id])}}"></a>
						<a class="btn btn-xs btn-danger fa fa-trash" onclick="return confirm('Bạn có muốn tài khoản {{$account->username}} không ???');" href="{{route('deleteAccount',['id'=>$account->id])}}"></a>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
		{{$accounts->links()}}
	</div>
</div>
@stop()