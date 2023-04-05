<x-backend.layouts.master>
<x-slot:fav>Roles-Edit</x-slot:fav>
    <x-slot:title>Roles-Edit</x-slot:title>


<div class="container">
<div class="card">

<div class="card-header"><a href="{{ route('roles.index') }}" class="btn btn-success btn-sm float-end">Back</a></div>
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
     

<form action="{{ route('roles.update', $role->id) }}" method="POST">
    @csrf
    @method('PATCH')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $role->name }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="permission">Permission:</label>
                <br/>
                @foreach($permissions as $permission)
                    <label>
                        <input type="checkbox" name="permission[]" value="{{ $permission->id }}" 
                            {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                        {{ $permission->name }}
                    </label>
                    <br/>
                @endforeach
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>










</div>
</div>
</div>

</x-backend.layouts.master>