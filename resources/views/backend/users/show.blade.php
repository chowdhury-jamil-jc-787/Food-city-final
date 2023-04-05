<x-backend.layouts.master>

<x-slot:fav>User-Show</x-slot:fav>
    <x-slot:title>User-Show</x-slot:title>



<div class="container">
<div class="card">

<div class="card-header"><a href="{{ route('users.index') }}" class="btn btn-success btn-sm float-end">Back</a></div>
<div class="card-body">
         


<div class="row">
  <div class="col-md-6">
<div class="row">
    <div class="col-12 mb-3">
        <label class="form-label"><strong>Name:</strong></label>
        <p class="form-control">{{ $user->name }}</p>
    </div>
    <div class="col-12 mb-3">
        <label class="form-label"><strong>Email:</strong></label>
        <p class="form-control">{{ $user->email }}</p>
    </div>
    <div class="col-12 mb-3">
        <label class="form-label"><strong>Roles:</strong></label>
        <div>
            @if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $v)
                    <div class="col-md-4 offset-md-4">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">{{ $v }}</h5>
        </div>
      </div>
    </div>

                @endforeach
            @endif
        </div>
    </div>
</div>
</div>
<div class="col-md-6 d-flex align-items-center justify-content-center">
    <div class="image-box">
      <img src="https://img.freepik.com/free-icon/user_318-252106.jpg" alt="Your Image">
    </div>
  </div>
</div>







</div>
</div>
</div>


</x-backend.layouts.master>