@extends('layouts.admin')
@section('title','Tài khoản')
@section('links','Tài khoản')
@section('main')
<div class="panel panel-info">
	<!-- Default panel contents -->
	<div class="panel-heading">
		
	</div>
	<div class="panel-body">
	<div class="row">
		<div class="col-md-2">
			<div class="avatar_info text-center">
				<img width="100%" src="{{url('uploads/admin')}}/{{Auth::user()->avatar}}" alt="Avatar admin">
				<p class="label label-primary">Cấp độ: {{Auth::user()->group->title}}</p>
				<div class="clearfix"></div>
				<span class="label label-info">5 <i class="fa fa-edit"></i></span>
			</div>
		</div>
		<div class="col-md-10">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h2 class="panel-title text-center">Thông tin tài khoản</h2>
				</div>
				<div class="panel-body">
					<table class="table table-hover">
						<thead>
							<tr>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	</div>
</div>
@stop()