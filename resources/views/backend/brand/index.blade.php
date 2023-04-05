<x-backend.layouts.master>
<x-slot:fav>Categories</x-slot:fav>
    <x-slot:title>Categories</x-slot:title>
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
                <a href="{{ route('categories.create') }}" class="btn btn-success">Add Category</a>
                <a href="{{ route('categories.trashed') }}" class="btn btn-warning">Trashed</a>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                      <tr>
                      <th>No</th>
                      <th>Image</th>
                      <th>Title</th>
                      <th>Description</th>
                      <th>Status</th>
                      <th class="text-nowrap">Created at</th>
                      <th width="280px">Action</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                      <th>No</th>
                      <th>Image</th>
                      <th>Title</th>
                      <th>Description</th>
                      <th>Status</th>
                      <th class="text-nowrap">Created at</th>
                      <th width="280px">Action</th>
                      </tr>
                    </tfoot>
                    <tbody>

                    @foreach ($categories as $category)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td><img src="{{ asset('storage/products/').'/'.$category->image }}" width="100px" style="  width: 100px; height: 100px; overflow: hidden;"></td>
            <td>{{ $category->title }}</td>
            <td>{{ $category->description }}</td>
            <td>
            @if($category->is_active == 1)
            Active
            @else
            InActive
            @endif
              </td>
              <td class="text-nowrap">{{ $category->created_at->diffForHumans() }}</td>
            <td class="text-nowrap">
                <form action="{{ route('categories.destroy',$category->id) }}" method="POST">
     
                    <a class="btn btn-info" href="{{ route('categories.show',$category->id) }}">Show</a>
      
                    <a class="btn btn-primary" href="{{ route('categories.edit',$category->id) }}">Edit</a>
     
                    @csrf
                    @method('DELETE')
        
                    <button type="submit" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this post?')){ this.closest('form').submit(); }" class="btn btn-danger">Delete</button>
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