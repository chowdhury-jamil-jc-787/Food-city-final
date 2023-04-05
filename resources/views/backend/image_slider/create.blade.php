<x-backend.layouts.master>
<x-slot:fav>Image_slider-Create</x-slot:fav>
    <x-slot:title>Image_slider-create</x-slot:title>


<div class="container">
<div class="card">

<div class="card-header"><a href="{{ route('imageslider.list') }}" class="btn btn-success btn-sm float-end">Back</a></div>
<div class="card mb-4">
                            
                            <x-slot:title>
                            Image_slider
                            </x-slot>

                            </div>
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
 
                   <form action="{{ route('imageslider.store')}}" method="Post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" value="{{ old('title')}}" id="title" name="title">    
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
                                  {{ old('description')}}
                                   </textarea>
                                </div>
                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="active">
                                    <label class="form-check-label" for="active" value="1" name="is_active">Active</label>
                                </div>
                                @error('price')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" class="form-control" value="{{ old('image')}}" id="image" name="image">    
                                </div>
                                @error('price')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
    </div>
    <div class="col-md-6">
      <div class="preview-box">
        <img id="preview" src="">
      </div>
    </div>
  </div>
</div>











</div>
</div>
</div>
@push('js')
<script>
$(document).ready(function() {
  $("#image").change(function() {
    readURL(this);
  });
});

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#preview').attr('src', e.target.result);
      $('.preview-box').show();
    }

    reader.readAsDataURL(input.files[0]);
  }
}

</script>
@endpush
</x-backend.layouts.master>