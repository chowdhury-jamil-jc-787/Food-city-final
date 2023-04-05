<x-backend.layouts.master>

<x-slot:fav>Image_slider-Show</x-slot:fav>
    <x-slot:title>Image_slider-Show</x-slot:title>

    @push('css')
    <style>

    </style>
    @endpush


         






@if (session('message'))
<div class="alert alert-primary" role="alert">
  {{ session('message')}}
</div>
@endif
                            <div class="card-header">
                                <!-- <i class="fas fa-table me-1"></i> -->
                                <div class="card-header"><a href="{{ route('imageslider.list') }}" class="btn btn-success btn-sm float-end">Back</a></div>
                            <x-slot:title>
                                Image_slider Show
                            </x-slot>
                            </div>
                            <div class="card-body">
                            <h2>Title:{{ $image_slider->title }}</h2>
                            <p>Description: {{ $image_slider->description }}</p>
                            
                            <p>Image: <img src="{{ asset('storage/Image_slider/').'/'.$image_slider->image }}" alt="" height="150" width="200"> </p>
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