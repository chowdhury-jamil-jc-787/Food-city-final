<x-backend.layouts.master>
<x-slot:fav>Users-Edit</x-slot:fav>
    <x-slot:title>Users-Edit</x-slot:title>


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
     



<div style="display: flex; justify-content: center;">
  <form method="POST" action="{{ route('users.update', $user->id) }}" style="width: 50%;">
    @csrf
    @method('PATCH')
    <div style="display: flex; flex-direction: row; justify-content: space-between; align-items: center; margin-bottom: 10px;">
      <label for="name">Name:</label>
      <input type="text" name="name" value="{{ $user->name }}" placeholder="Name" style="margin-left: 10px;">
    </div>
    <div style="display: flex; flex-direction: row; justify-content: space-between; align-items: center; margin-bottom: 10px;">
      <label for="email">Email:</label>
      <input type="email" name="email" value="{{ $user->email }}" placeholder="Email" style="margin-left: 10px;">
    </div>
    <div style="display: flex; flex-direction: row; justify-content: space-between; align-items: center; margin-bottom: 10px;">
      <label for="password">Password:</label>
      <input type="password" name="password" placeholder="Password" style="margin-left: 10px;">
    </div>
    <div style="display: flex; flex-direction: row; justify-content: space-between; align-items: center; margin-bottom: 10px;">
      <label for="confirm-password">Confirm Password:</label>
      <input type="password" name="confirm-password" placeholder="Confirm Password" style="margin-left: 10px;">
    </div>
    <div style="display: flex; flex-direction: row; justify-content: space-between; align-items: center; margin-bottom: 10px;">
      <label for="role">Role:</label>
      <select name="roles[]" id="roles" class="form-control" style="margin-left: 10px;">
          @foreach($roles as $role)
              <option value="{{ $role }}" @if(in_array($role, $userRole)) selected @endif>{{ $role }}</option>
          @endforeach
      </select>
    </div>
    <div style="display: flex; justify-content: center;">
      <button type="submit" style="margin-top: 10px;">Submit</button>
    </div>
  </form>
  <div style="width: 50%; display: flex; justify-content: center; align-items: center;">
    <img src="https://d1nhio0ox7pgb.cloudfront.net/_img/v_collection_png/512x512/shadow/security_agent_edit.png" width="200px" alt="Random Image">
  </div>
</div>




</div>
</div>
</div>

</x-backend.layouts.master>