@extends('backtemplate')
@section('content')
	<div class="col-md-10 offset-1">
		 
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Edit Recipe</h3>
			</div>
			<form action="" method="post" enctype="multipart/form-data" id="edtBtn">
					@csrf
					@method('PUT')
				<div class="card-body">


					@if ($errors->any())
				    <div class="alert alert-danger">
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				        </ul>
				    </div>
					@endif
				
				
					<input type="hidden" id="recipe_id" value="{{$recipe->id}}">
				 	<div class="row form-group">
						<div class="col-md-3 ">
							<label>Recipe Name</label>
						</div>
						<div class="col-md-8">
							<input type="text" name="recipe_name" class="form-control" value="{{$recipe->recipe_name}}" id="recipe_name">
						</div>
	
					</div>
					<div class="row form-group">
						<div class="col-md-3 ">
							<label>Preparation</label>
						</div>
						<div class="col-md-8">
							<input type="text" name="preparation" class="form-control" value="{{$recipe->preparation}}" id="preparation">
						</div>
	
					</div>

					<div class="row form-group">
						<div class="col-md-3 ">
							<label>Video</label>
						</div>
						<div class="col-md-8">
							<input type="text" name="recipe_video" class="form-control" value="{{$recipe->recipe_video}}" id="recipe_video">
						</div>
	
					</div>
					<div class="row form-group">
						<div class="col-md-3 ">
							<label>Meal</label>
						</div>
						<div class="col-md-8">
							<select name="meal" class="form-control" id="meal">
								<option>Select Meal</option>
								@foreach($meals as $meal)
								<option value="{{$meal->id}}"
									@if($meal->id == $recipe->meal_id)
									{{'selected'}}
									@endif
									>{{$meal->type->type_name}}</option>
								@endforeach
							</select>
						</div>
	
					</div>
						<div class="row form-group">
						<div class="col-md-3 ">
							<label>Category</label>
						</div>
						<div class="col-md-8">
							<select name="category" class="form-control" id="category">
								<option>Select Category</option>
								@foreach($categories as $category)

								<option value="{{$category->id}}" 
									@if($recipe->category_id == $category->id)
									{{'selected'}}
									@endif
									>{{$category->category_name}}</option>
								@endforeach
							</select>
						</div>
	
					</div>
					<div class="row form-group">
						<div class="col-md-3 ">
							<label>Recipe Image</label>
						</div>
						<div class="col-md-4">
							<input type="file" name="recipe_image" class="form-control" id="recipe_image">
						</div>
						<div class="col-md-5">
							<img src="{{$recipe->recipe_image}}" width="150" height="150">
							<input type="hidden" name="old_image" value=" {{$recipe->recipe_image}}">
						</div>
	
					</div>	
					<div class="row form-group">
						<div class="col-md-3">
							 
							<label>Ingredient </label>
							<select class ="ingredient form-control">
								<option>Select Ingredient....</option>
								@foreach($ingredients as $ingredient)
									<option value="{{$ingredient->id}}">{{$ingredient->ingredient_name}}</option>	
								@endforeach	
							</select>
								
							 
						</div>
						<div class="col-md-3">
						 
							 <label>Measurement Unit</label>
						 	 
							<select id="measurement_unit" class="form-control">
								<option>Select Unit</option>
								@foreach($meal_units as $unit)
								<option value="{{$unit->id}}">{{$unit->measurement_unit}}</option>	
							@endforeach	
							</select>
						</div>
						<div class="col-md-3">
							 
								 <label>Measurement Quantity</label>
							 
						 
								<select id="measurement_qty" class="form-control">
									<option>Select Quantity</option>
									@foreach($meal_qtys as $qty)
									<option value="{{$qty->id}}">{{$qty->measurement_qty}}</option>	
								@endforeach	
								</select>
	 
						</div>
						<div class="col-md-2 " style="margin-top: 37px">
							<a href="javascript:void(0)" class="btn btn-dark btn-sm " id="ing">Add ingredient</a>
						</div>
						
					</div>
					<div class="row form-group showIngredient">
						<div class="table-responsive mt-3 col-md-12  " >
		                    <table class="table table-bordered">
		                            <thead class="thead-light">
		                              <tr>
		                                <th>No</th>
		                                <th>Ingredient</th>
		                                <th>Unit</th>
		                                <th>Qty</th>
		                                
		                                <th>Action</th>
		                              </tr>
		                            </thead>
		                            <tbody id="showingredientbody">
		                            </tbody>
		                    </table>
                  		</div>
						
					</div>	

					<input type="submit" value="ADD" class="btn btn-dark">
				</div>
			</form>	
			
		</div>	
			
		

		</div>
		 
</div>	
@endsection


@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
			var url =window.location.href;
			var idx = url.indexOf("/recipe");
			var idx2 = url.indexOf("/edit");
			var hash = idx != -1 ? url.substring(idx+8, idx2) : "";
			// console.log(hash);
			loadIngredient(hash);

		$('.showIngredient').hide();
		$('.container-school').hide();

		var ingredientString = '{"ingredientlist":[]}';
		var ingredientObj = JSON.parse(ingredientString);
		$('#ing').click(function(){
			let ingredient  = $('.ingredient').val();
			let unit = $('#measurement_unit').val();
			let qty = $('#measurement_qty').val();
			if (ingredient && unit && qty) {
				var recipe = {
					ingredient:ingredient,
					unit:unit,
					qty:qty
				};
				ingredientObj.ingredientlist.push(recipe);
				$('.container-ingredient').show()
				$('.added-ingredient').text('You added one ingredient');
				
				showIngredientTable(ingredientObj);
			};
			 
		});
		function loadIngredient(id)
			{
			var url = "{{ route('recipe.show',':id') }}"
          url=url.replace(':id',id);
			$.ajax({
	          url: url,
	          type: "GET",
	          dataType: 'json',
	          success: function (data) {
	          	 b_ingredient = data.ingredients;
	          	 $.each(b_ingredient,function(i,v){
	          	 		var recipe = {
					ingredient: v.pivot.ingredient_id,
					unit:v.pivot.measurement_unit_id,
					qty:v.pivot.measurement_quantity_id
				};
				ingredientObj.ingredientlist.push(recipe);	          	 })
	          	 // console.log(b_ingredient)
	          	
            	showIngredientTable(ingredientObj);
           
          	},
          error: function (error) {
          }
        })
			}


		function showIngredientTable(ingredientListObj) {
	      var html = ''
	      var j = 1
	      // console.log(ingredientListObj)
	      var ingredient_array=ingredientListObj.ingredientlist;
	      // console.log(ingrea);
	      $.each(ingredient_array,function (i,v) {
	        html += `<tr>
	                  <td>${j++}</td>
	                  <td>${v.ingredient}</td>
	                  <td>${v.unit}</td>
	                  <td>${v.qty}</td>
	                
	                  <td><button type="button" class="btn btn-sm delete-ingredient" style="background-color: #5e72e4" data-id=${i}><i class="fas fa-trash text-white" ></i></button>
	                </td></tr>`
	      })
	      $('#showingredientbody').html(html);
	      $('.showIngredient').show();
	    }

	     $('#edtBtn').submit(function (e) {
      e.preventDefault()
      // alert(hash)
      var formData = new FormData(this)
      var id = $('#recipe_id').val();
      // alert(id);
      var recipe_name =$('#recipe_name').val();
      var preparation = $('#preparation').val();
      var meal = $('#meal').val();
      var video = $('#video').val();
      var meal_image = $('#meal_image').val();
      // console.log(ingredientObj)
      // if (price == '' && keep_price == '') {
      //   $('.error-message-price').text("The price field is required")
      //   $('#price').addClass('border border-danger')
      // }
      formData.append("ingredient_array",JSON.stringify(ingredientObj))
  
      for (var pair of formData.entries())
        {
         console.log(pair[0]+ ', '+ pair[1]); 
        }

         var url =  "{{ route('recipe.update',':id') }}";
         url = url.replace(':id',id);
      $.ajax({
          data: formData,
          url:	url,
          type: "POST",
          dataType:'json',
          cache:false,
          contentType: false,
          processData: false,
          success: function (data) {
            
            window.location.href="{{route('recipe.index')}}"
          },
          error: function (error) {
            var errors=error.responseJSON.errors;
              if(errors){
               
              }
          }
      })
    })

	$('#showingredientbody').on('click','.delete-ingredient',function (argument) {
      var ingredient_id = $(this).data("id")
      // console.log(neighborhood_id)
      ingredientObj.ingredientlist.splice(ingredient_id, 1)
      showIngredientTable(ingredientObj)
    })





			
		})
	</script>

@endsection