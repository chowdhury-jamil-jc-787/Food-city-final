<x-backend.layouts.master>
<x-slot:fav>Roles</x-slot:fav>
    <x-slot:title>Roles</x-slot:title>
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

                @can('role-create')
                <a href="{{ route('roles.create') }}" class="btn btn-success">Add Role</a>
                @endcan
                @can('role-trashed')
                <a href="{{ route('roles.trashed') }}" class="btn btn-warning">Trashed</a>
                @endcan
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                      <tr>
                      <th>No</th>
                      <th>Name</th>
                      <th width="280px">Action</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                      <th>No</th>
                      <th>Name</th>
                      <th width="280px">Action</th>
                      </tr>
                    </tfoot>
                    <tbody>

        @foreach ($roles as $key => $role)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $role->name }}</td>
            <td class="text-nowrap">
                <form action="{{ route('roles.destroy',$role->id) }}" method="POST">
                @can('role-show')
                    <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Show</a>
                @endcan
                @can('role-edit')
                    <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                @endcan
                    @csrf
                    @method('DELETE')
                    @can('role-delete')
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