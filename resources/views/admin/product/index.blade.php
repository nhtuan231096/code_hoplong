@extends('layouts.admin')
@section('title','Danh sách sản phẩm')
@section('links','Sản phẩm')
@section('main')
<div class="panel panel-info">
	<!-- Default panel contents -->
	<div class="panel-heading">

	</div>
		@if(Session::has('success'))
			<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>{{Session::get('success')}}</strong>
			</div>
		@endif	
	<div class="panel-body">
		<table class="table table-hover">
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
				@foreach($products as $product)
				<tr>
					<td>{{$product->id}}</td>
					<td>{{$product->title}}</td>
					<td>{{$product->created_by}}</td>
					<td>
						<img width="50px" src="{{url('uploads/product')}}/{{$product->cover_image}}" alt="{{$product->cover_image}}">
					</td>
					<td>{{$product->category->title}}</td>
					<!-- <td>{{$product->meta_title}}</td>
					<td>{{$product->meta_description}}</td>
					<td>{{$product->meta_keywords}}</td> -->
					<td>{{$product->price}}</td>
					<td>{{$product->warranty}}</td>
					@if($product->status=='active')
					<td><div class="label label-primary">{{$product->status}}</div></td>
					@else
					<td><div class="label label-danger">{{$product->status}}</div></td>
					@endif
					<td>{{$product->created_at}}</td>
					<td>
						<a class="btn btn-xs btn-primary fa fa-edit" href="{{route('editCategory',['id'=>$product->id])}}"></a>
						<a class="btn btn-xs btn-danger fa fa-trash" onclick="return confirm('Bạn chắc chắn chứ?')" href="{{route('deleteCategory',['id'=>$product->id])}}"></a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{$products->links()}}
	</div>
</div>
@stop()