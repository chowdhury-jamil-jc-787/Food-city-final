<x-backend.layouts.master>
<x-slot:fav>Users</x-slot:fav>
    <x-slot:title>Users</x-slot:title>
    @push('css')
    <link href="{{ asset('ui/backend/admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    @endpush

     <!-- Datatables -->
     <div class="col-lg-12">
            @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
              <div class="card mb-4">
                <div class="card-header py-3  flex-row align-items-center justify-content-between">
                @can('user-create')
                <a href="{{ route('users.create') }}" class="btn btn-success">Add User</a>
                @endcan
                @can('user-trashed')
                <a href="{{ route('users.trashed') }}" class="btn btn-warning">Trashed</a>
                @endcan
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                      <tr>
                      <th>No</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Roles</th>
                      <th width="280px">Action</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                      <th>No</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Roles</th>
                      <th width="280px">Action</th>
                      </tr>
                    </tfoot>
                    <tbody>

         @foreach ($data as $key => $user)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                @if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $v)
                <label class="badge badge-success">{{ $v }}</label>
                @endforeach
                @endif
            </td>
            <td class="text-nowrap">
                <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                    @can('user-show')
                    <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
                    @endcan
                    @can('user-edit')
                    <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
                    @endcan
                    @csrf
                    @method('DELETE')
                    @can('user-delete')
                    <button type="submit" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this post?')){ this.closest('form').submit(); }" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
            </td>
        </tr>
        @endforeach
                    
                     
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- DataTable with Hover -->

            @push('js')
          <script src="{{ asset('ui/backend/admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
          <script src="{{ asset('ui/backend/admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

          <!-- Page level custom scripts -->
          <script>
          $(document).ready(function () {
          $('#dataTable').DataTable(); // ID From dataTable 
          $('#dataTableHover').DataTable(); // ID From dataTable with Hover
          });
          </script>  
          @endpush

</x-backend.layouts.master>    