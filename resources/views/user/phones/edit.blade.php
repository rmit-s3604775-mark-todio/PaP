{{-- this is a comment --}}
{{-- navigation bar --}}
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="container">
                        <div class="row justify-content-center">
                            <span class="col-6 text-left">
                                Dashboard
                            </span>
                            <span class="col-6 text-right">
                                Welcome {{ Auth::user()->name }}
                            </span>
                        </div> 
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-3 nav-menu justify-content-center">
                            @component('components.user-menu')
                            @endcomponent
                        </div>
                        <div class="col-9">
                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

								{{-- insert code here --}}
								<h1 class="text-center">Edit {{$item->product_name}}</h1>
								<form action="{{ route('phones.update', [$item]) }}" method="post" enctype="multipart/form-data">
									{{csrf_field()}}
									{{method_field('PUT')}}

									<fieldset>
										<div class="form-group">
												<label for="product_name">Phone name</label>
												<input type="text" name="product_name" class="form-control" value="{!! $item->product_name !!}">
										</div> 
									
										<div class="form-group">
												<label for="price">Price</label>
												<input type="number" name="price" class="form-control" value={{$item->price}}>
										</div> 

										<div class="form-group">
												<label for="quantity">Quantity</label>
												<input type="number" name="quantity" class="form-control" value={{$item->quantity}}>
										</div> 

										<div class="form-group">
											<label for="brand">Brand</label>
											<select name="brand" id="brand">
												<option value="{{ $item->brand }}" selected hidden>{{ $item->brand }}</option>
												@foreach ($brands as $brand)
												<option value="{{ $brand->brand }}">{{ $brand->brand }}</option>
												@endforeach
											</select>
										</div>

										<div class="form-group">
											<label for="condition">Condition</label>
											<select name="condition" id="condition">
												<option value="{{ $item->condition }}" selected hidden>{{ $item->condition }}</option>
												@foreach ($conditions as $condition)
												<option value="{{ $condition->condition }}">{{ $condition->condition }}</option>
												@endforeach
											</select>
										</div>

										<div class="form-group">
											<label for="description">Description</label>
										<textarea rows="4" name="description" class="form-control">{{$item->description}}</textarea>
										</div>

										


										<!-- Button trigger modal -->
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteModel">
											Delete Images
										</button>
										
										<!-- Modal -->
										<div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">{!! $item->product_name!!} images</h5>
														<button type="button" class="close" data-dismiss="modal" onclick="dismissSelected()" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>


													<div class="modal-body">
														{{-- gallery --}}
														<div class="row">
																<div class="col-md-12">
																			<div class="mdb-lightbox">
																				

																				@foreach (json_decode($item->images) as $image)
																					@if($loop->index % 3 == 0 )
																					@if($loop->index % 3 == 0 & $loop->index != 0)
																						</div>
																					@endif
																					<div class="row justify-content-center">
																						<figure class="col-md-3 ml-1 mr-1" style="border: 1px black solid;" value="{{ $image }}" id="image_{{$loop->iteration}}" onclick="selectedImage({{$loop->iteration}})">
																								<img alt="picture" src="/uploads/products/{{ $image }}" class="img-fluid">
																						</figure>

																						@else
																						<figure class="col-md-3 ml-1 mr-1" style="border: 1px black solid;" value="{{ $image }}" id="image_{{$loop->iteration}}" onclick="selectedImage({{$loop->iteration}})">
																					
																								<img alt="picture" src="/uploads/products/{{ $image }}" class="img-fluid">
																								
																						</figure>
																					@endif

																					@if($loop->last)
																						</div>
																					@endif
																					
																				@endforeach

																					

																			</div>


																		
																</div>
														</div>

													</div>

													<div class="modal-footer">
														<button type="button" class="btn btn-secondary" onclick="dismissSelected()" data-dismiss="modal">Close</button>
														<button type="button" class="btn btn-primary" onclick="saveChanges()" data-dismiss="modal">Save changes</button>
													</div>
												</div>
											</div>
										</div>

										<ul id="showDeletedFiles"></ul>

										<input type="string[]" id="imagesDelete" name="imagesDelete" hidden/>

										{{-- adding new images here --}}
										<div class="form-group">
											<label for="images">Add new Images</label>
											<input type="file" name="images[]" class="form-control" multiple/>
										</div>

										<ul id="showUploadedFiles"></ul>
										



										<div class="col text-center">
											<button type="submit" class="btn btn-success mx-auto">Submit</button>
										</div>
												
									
									</fieldset> 
									
									
								
								
								
								</form>
								
								@if (count($errors)>0)
								<div class="alert alert-danger">
								@foreach($errors->all() as $error)
									<pre>{{$error}}</pre>
								@endforeach
								</div>
								@endif

								
						
									  
									</div>
								  </div>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

	var dict = {};
	var num = 0;
	@foreach (json_decode($item->images) as $image)
		num++;
		dict["image_".concat(num.toString())] = "not_selected";
	@endforeach

	function selectedImage(idnumber) {
        var image = document.getElementById("image_".concat(idnumber));
		
		if(image.style.borderColor === "black"){
			image.style.borderColor = "red";
			dict["image_".concat(idnumber)] = "selected";
		}else{
			image.style.borderColor = "black";
			dict["image_".concat(idnumber)] = "not_selected";
		}
    }

	function undoSelected() 
	{
		for(var key in dict){
			var image = document.getElementById(key);
			image.style.borderColor = "black";

			if(dict[key] == "selected"){
				dict[key] = "not_selected";
			}
		}
	}

	function dismissSelected(){
		for(var key in dict){
			if(dict[key] == "selected"){
				undoSelected();
				break;
			}
		}		
	}

	function saveChanges(){
		var imagesarray = [];

		for(var key in dict){
			if(dict[key] == "selected"){
				imagesarray.push(document.getElementById(key).getAttribute("value"));
			}
		}
		document.getElementById("imagesDelete").value = imagesarray;


		// make it display
		var ul = document.getElementById("showDeletedFiles");
		ul.innerHTML = "";

		for(var i = 0; i < imagesarray.length; i++){
			var imageName = imagesarray[i];
			var li = document.createElement("li");
			li.appendChild(document.createTextNode(imageName));
			ul.appendChild(li);
		}
	}




	
</script>

@endsection

