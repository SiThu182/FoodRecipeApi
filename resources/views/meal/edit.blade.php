@extends('backtemplate')
@section('content')
	<div class="col-md-10 offset-1">
		 
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Meal</h3>
			</div>
			<form action="{{route('meal.update',$meal->id)}}" method="post" enctype="multipart/form-data">
					@csrf
					@method('PUT')
				<div class="card-body">
					<div class="row form-group">
						<div class="col-md-3 ">
							<label>Meal Name</label>
						</div>
						<div class="col-md-8">
							<input type="text" name="meal_name" class="form-control" id="meal_name" value="{{$meal->meal_name}}">
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
								<option value="{{$type->id}}"
									@if($meal->type_id == $type->id)
									{{'selected'}}
									@endif
									>{{$type->type_name}}</option>
								@endforeach
							</select>
						</div>
	
					</div>
					<div class="row form-group">
						<div class="col-md-3 ">
							<label>Meal Image</label>
						</div>
						<div class="col-md-4">
							<input type="file" name="meal_image" class="form-control">
						</div>
						<div class="col-md-5">
							<input type="hidden" name="old_meal_image" value="{{$meal->meal_image}}">
							<img src="{{$meal->meal_image}}" width="200" height="200">
						</div>
	
					</div>	
					<input type="submit" value="Update" class="btn btn-dark">
				</div>
			</form>	
			
		</div>	
			
		

		</div>
	
</div>	
@endsection