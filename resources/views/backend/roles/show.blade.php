<x-backend.layouts.master>

<x-slot:fav>roles-Show</x-slot:fav>
    <x-slot:title>roles-Show</x-slot:title>



<div class="container">
<div class="card">

<div class="card-header"><a href="{{ route('roles.index') }}" class="btn btn-success btn-sm float-end">Back</a></div>
<div class="card-body">
         




<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <strong>Name:</strong>
      {{ $role->name }}
    </div>
    <div class="form-group">
      <strong>Permissions:</strong>
      <ul>
        @if(!empty($rolePermissions))
          @foreach($rolePermissions as $v)
            <li>{{ $v->name }}</li>
          @endforeach
        @else
          <li>No permissions assigned.</li>
        @endif
      </ul>
    </div>
  </div>
  <div class="col-md-6">
    <div class="image-box" style="width: 400px; height: 400px;">
      <img src="https://as2.ftcdn.net/v2/jpg/03/07/47/79/1000_F_307477935_TgRybpcXe0lyyhLYXs898EDNFbYGlti5.jpg" alt="Random image" style="max-width: 100%; max-height: 100%;">
    </div>
  </div>
</div>





</div>
</div>
</div>


</x-backend.layouts.master>