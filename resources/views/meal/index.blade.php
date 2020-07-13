@extends('backtemplate')
@section('content')
	<div class="col-md-10 offset-1">
		 
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Meal</h3>
			</div>
			<form action="{{route('meal.store')}}" method="post" enctype="multipart/form-data">
					@csrf
				<div class="card-body">
					<div class="row form-group">
						<div class="col-md-3 ">
							<label>Meal Name</label>
						</div>
						<div class="col-md-8">
							<input type="text" name="meal_name" class="form-control">
						</div>
	
					</div>	
				

					<div class="row form-group">
						<div class="col-md-3 ">
							<label>Type</label>
						</div>
						<div class="col-md-8">
							<select name="type" class="form-control">
								<option>Select Type</option>
								@foreach($types as $type)
								<option value="{{$type->id}}">{{$type->type_name}}</option>
								@endforeach
							</select>
						</div>
	
					</div>
					<div class="row form-group">
						<div class="col-md-3 ">
							<label>Meal Image</label>
						</div>
						<div class="col-md-8">
							<input type="file" name="meal_image" class="form-control">
						</div>
	
					</div>	
					<input type="submit" value="ADD" class="btn btn-dark ">
				</div>
			</form>	
			
		</div>	
			
		

		</div>
		<div class="col-md-12 mt-5">
			<h3>Car list</h3>
			<table class="table table-active">
				<thead>
					<th>NO.</th>
					<th>Meal Name</th>
					<th>Type Name</th>
					<th>Image</th>
				 
					<th>Action</th>
				</thead>
				@php $i = 1 @endphp
					@foreach($meals as $meal)
				<tbody>
					
						<td>{{$i++}}</td>
						<td>{{$meal->meal_name}}</td>
						<td>{{$meal->type->type_name}}</td>
						<td><img src="{{ $meal->meal_image}}" width="300" height="300"></td>
					 
						 
						<td> 
							<a href="{{route('meal.edit',$meal->id)}}" class="btn btn-primary float-left mr-3">Edit </a>
							<form action="{{route('meal.destroy',$meal->id)}}" method="post">
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