@extends('backtemplate')
@section('content')
	<div class="col-md-10 offset-1">
		 
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Category</h3>
			</div>
			<form action="{{route('category.store')}}" method="post" enctype="multipart/form-data">
					@csrf
				<div class="card-body">
				
				
				 
					<div class="row form-group">
						<div class="col-md-3 ">
							<label>Category Name</label>
						</div>
						<div class="col-md-8">
							<input type="text" name="category_name" class="form-control">
						</div>
	
					</div>
					<div class="row form-group">
						<div class="col-md-3 ">
							<label>Category Image</label>
						</div>
						<div class="col-md-8">
							<input type="file" name="category_image" class="form-control">
						</div>
	
					</div>	
					<input type="submit" value="ADD" class="btn btn-dark">
				</div>
			</form>	
			
		</div>	
			
		

		</div>
		<div class="col-md-12 mt-5">
			<h3>Car list</h3>
			<table class="table table-active">
				<thead>
					<th>NO.</th>
					<th>Category Name</th>
					<th>Image</th>
				 
					<th>Action</th>
				</thead>
				@php $i = 1 @endphp
					@foreach($categories as $category)
				<tbody>
					
						<td>{{$i++}}</td>
						<td>{{$category->category_name}}</td>
						<td><img src="{{ $category->category_image}}" width="300" height="300"></td>
					 
						 
						<td> 
							<a href="{{route('category.edit',$category->id)}}" class="btn btn-primary float-left mr-3">Edit </a>
							<form action="{{route('category.destroy',$category->id)}}" method="post">
			                  @method('Delete')
			                  @csrf
			                  <input type="submit" name="btnsubmit" value="Delete" class="btn btn-danger">
                			</form>

                		</td>		
				
				</tbody>
					@endforeach
			</table>
		</div>
</div>	
@endsection