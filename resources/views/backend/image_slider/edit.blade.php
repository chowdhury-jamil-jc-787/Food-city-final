<x-backend.layouts.master>
<x-slot:fav>Image_slider-Edit</x-slot:fav>
    <x-slot:title>Image_slider-Edit</x-slot:title>

    @push('css')
    <style>


    </style>
    @endpush

<div class="container">
<div class="card">

<div class="card-header"><a href="{{ route('imageslider.list') }}" class="btn btn-success btn-sm float-end">Back</a></div>
<div class="card-body">
         
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                        <li>{{ $error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
     

<div class="container">
  <div class="row">
    <div class="col-md-6">
      
    <form action="{{ route('imagesliders.update',['image_slider'=> $image_slider->id])}}" method="Post" enctype="multipart/form-data">
                                    @method('patch')
                                @csrf
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" value="{{ old('title',$image_slider->title)}}" id="title" name="title">    
                                </div>
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                             
                                @error('category')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="mb-3">
                                    <label for="description" class="form-label">Discription</label>
                                   <textarea name="description" id="description" cols="40" rows="5">
                                  {{ old('description',$image_slider->description)}}
                                   </textarea>
                                </div>
                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <img src="{{ asset('storage/Image_slider/').'/'.$image_slider->image }} " alt="" height="100" width="150" >
                                    <input type="file" value="{{$image_slider->image}}" class="form-control" id="image" name="image">    
                                </div>
                               
                             

                                <button type="submit" class="btn btn-primary">Update</button>
                        </form>
    
    </div>
    <div class="col-md-6">
      
      <br>
      <div id="new-image-preview-box"></div>
    </div>
  </div>
</div>










</div>
</div>
</div>
@push('js')
<script>

</script>
@endpush
</x-backend.layouts.master>