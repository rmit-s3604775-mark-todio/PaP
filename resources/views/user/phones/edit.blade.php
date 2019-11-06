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
								<div class="row">
									<div class="col-md-5">
										<h3>Edit Phone</h3>
									</div>
								</div>
								<form action="{{ route('phones.update', [$item]) }}" method="post" enctype="multipart/form-data">
									@csrf
									@method('POST')

									<div class="form-group row">
										<label for="product_name" class="col-md-4 col-form-label text-md-right">Phone Name</label>

										<div class="col-md-5">
											@if ($errors->any())
											<input type="text" name="product_name" id="product_name" class="form-control @error('product_name') is-invalid @enderror" value="{{ old('product_name') }}" required/>
											@else
											<input type="text" name="product_name" id="product_name" class="form-control @error('product_name') is-invalid @enderror" value="{{$item->product_name}}" required/>
											@endif
										</div>
										@error('product_name')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>

									<div class="form-group row">
										<label for="brand" class="col-md-4 col-form-label text-md-right">Brand</label>

										<div class="col-md-5">
											<select name="brand" id="brand" class="form-control @error('brand') is-invalid @enderror" required>
                                                @if ($errors->any())
                                                    @foreach ($brands as $brand)
                                                        @if (old("brand") == $brand->brand)
                                                            <option value="{{ $brand->brand }}" selected>{{ $brand->brand }}</option>
                                                        @else
                                                            <option value="{{ $brand->brand }}">{{ $brand->brand }}</option>
                                                        @endif
                                                    @endforeach
												@else
                                                    @foreach ($brands as $brand)
                                                        @if ($brand->brand == $item->brand)
                                                            <option value="{{ $brand->brand }}" selected>{{ $brand->brand }}</option>
                                                        @else
                                                            <option value="{{ $brand->brand }}">{{ $brand->brand }}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
											</select>
										</div>
										@error('brand')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>

									<div class="form-group row">
										<label for="condition" class="col-md-4 col-form-label text-md-right">Condition</label>

										<div class="col-md-5">
											<select name="condition" id="condition" class="form-control @error('condition') is-invalid @enderror" required>
                                                @if ($errors->any())
                                                    @foreach ($conditions as $condition)
                                                        @if (old("condition") == $condition->condition)
                                                            <option value="{{ $condition->condition }}" selected>{{ $condition->condition }}</option>
                                                        @else
                                                            <option value="{{ $condition->condition }}">{{ $condition->condition }}</option>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    @foreach ($conditions as $condition)
                                                        @if ($condition->condition == $item->condition)
                                                            <option value="{{ $condition->condition }}" selected>{{ $condition->condition }}</option>
                                                        @else
                                                            <option value="{{ $condition->condition }}">{{ $condition->condition }}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
										</div>
										@error('condition')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
									</div>

									<div class="form-group row">
										<label for="quantity" class="col-md-4 col-form-label text-md-right">Quantity</label>

										<div class="col-md-5">
											@if ($errors->any())
												<input type="number" min="1" name="quantity" id="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity') }}" required/>
											@else
												<input type="number" min="1" name="quantity" id="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{$item->quantity}}" required/>
											@endif
										</div>
										@error('quantity')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>

									<div class="form-group row">
										<label for="price" class="col-md-4 col-form-label text-md-right">Price</label>

										<div class="col-md-5">
											@if ($errors->any())
												<input type="number" step="any" min="0" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" required/>
											@else
												<input type="number" step="any" min="0" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{$item->price}}" required/>
											@endif
										</div>
										@error('price')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>

									<div class="form-group row">
										<label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

										<div class="col-md-5">
											@if ($errors->any())
												<textarea rows="6" name="description" class="form-control @error('description') is-invalid @enderror" required>{{old('description')}}</textarea>
											@else
												<textarea rows="6" name="description" class="form-control @error('description') is-invalid @enderror" required>{{$item->description}}</textarea>
											@endif
										</div>
										@error('description')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>

									<div class="form-group row">
										<div class="col-md-5 offset-md-4">
											<!-- Button trigger modal -->
											<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteModel">
												Delete Images
											</button>
											<ul id="showDeletedFiles"></ul>
											<input type="string[]" id="imagesDelete" name="imagesDelete" hidden/>
										</div>
									</div>

									<div class="form-group row">
										<label for="images" class="col-md-4 col-form-label text-md-right">Add New Images</label>

										<div class="col-md-5">
											<input type="file" name="images[]" class="form-control" multiple/>
											<ul id="showUploadedFiles"></ul>
										</div>
									</div>

									<div class="form-group row">
										<div class="col-md-5 offset-md-4">
											<button type="submit" class="btn btn-primary">
                                                {{ __('Submit') }}
                                            </button>
										</div>
									</div>

									<fieldset>
										
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

