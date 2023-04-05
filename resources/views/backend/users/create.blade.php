<x-backend.layouts.master>
<x-slot:fav>Users-create</x-slot:fav>
    <x-slot:title>Users-create</x-slot:title>


<div class="container">
<div class="card">

<div class="card-header"><a href="{{ route('users.index') }}" class="btn btn-success btn-sm float-end">Back</a></div>
<div class="card-body">
         
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
     


<div class="container">
  <div class="row">
    <div class="col-md-6">
    <form action="{{ route('users.store') }}" method="POST">
    @csrf
        <h3></h3>
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" class="form-control" id="name" name="name" value="{{ old('name')}}" required>
        </div>
        <div class="form-group">
          <label for="email">Email address:</label>
          <input type="email" class="form-control" id="email" value="{{ old('email')}}" name="email" required>
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
          <label for="confirm-password">Confirm Password:</label>
          <input type="password" class="form-control" id="confirm-password" name="confirm-password" required>
        </div>
        <div class="form-group">
          <label for="select-option">Role:</label>
          <select class="form-control" id="roles" name="roles">
            <option value="" disabled selected>Select an option</option>
            @foreach($roles as $role)
            <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
          </select>
        </div>
      
    </div>
    <div class="col-md-6">
      <div class="text-center">
        <img src="https://png.pngtree.com/png-vector/20191208/ourmid/pngtree-beautiful-create-user-glyph-vector-icon-png-image_2084391.jpg" alt="Random image">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 text-center">
      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
  </form>
</div>



</div>
</div>
</div>

</x-backend.layouts.master>