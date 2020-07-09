@extends('backtemplate')
@section('content')
	<div class="col-md-10 offset-1">
		 
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Measurement Quantity</h3>
			</div>
			<form action="{{route('set_qty')}}" method="post" enctype="multipart/form-data">
					@csrf
				<div class="card-body">
				
				
				 
					<div class="row form-group">
						<div class="col-md-3 ">
							<label>Measurement Quantity</label>
						</div>
						<div class="col-md-8">
							<input type="text" name="measurement_qty" class="form-control">
						</div>
	
					</div>
					
					<input type="submit" value="ADD" class="btn btn-dark">
				</div>
			</form>	
			
		</div>	
			
		

		</div>
		<div class="col-md-12 mt-5">
			<h3>Car list</h3>
			<table class="table table-active justify-content-center">
				<thead>
					<th>NO.</th>
					<th >Measurement Quantity</th>
				 
					<th>Action</th>
				</thead>
				@php $i = 1 @endphp
					@foreach($measurement_qtys as $measurement_qty)
				<tbody>
					
						<td>{{$i++}}</td>
						<td>{{$measurement_qty->measurement_qty}}</td>
						<td> 
							
							<form action="{{url('delete_qty',$measurement_qty->id)}}" method="post">
			                  @method('Delete')
			                  @csrf
			                  <input type="submit" name="btnsubmit" value="Delete" class="btn btn-danger">
                			</form>

                		</td>	
					 
						 
						<!--  -->
				</tbody>
					@endforeach
			</table>
		</div>
</div>	
@endsection