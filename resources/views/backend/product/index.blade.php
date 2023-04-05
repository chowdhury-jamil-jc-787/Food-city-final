<x-backend.layouts.master>
<x-slot:fav>Products</x-slot:fav>
    <x-slot:title>Products</x-slot:title>
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
                @can('product-create')
                <a href="{{ route('products.create') }}" class="btn btn-success">Add Product</a>
                @endcan
                @can('product-trashed')
                <a href="{{ route('products.trashed') }}" class="btn btn-warning">Trashed</a>
                @endcan
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTable">
                  <thead class="thead-light">
                      <tr>
                      <th>No</th>
                      <th>Image</th>
                      <th>Name</th>
                      <th>Description</th>
                      <th>Cat.Name</th>
                      <th>Price</th>
                      <th>Size</th>
                      <th>Action</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                      <th>No</th>
                      <th>Image</th>
                      <th>Name</th>
                      <th>Description</th>
                      <th>Cat.Name</th>
                      <th>Price</th>
                      <th>Size</th>
                      <th>Action</th>
                      </tr>
                    </tfoot>
                    <tbody>
                    @foreach ($products as $product)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td><img src="{{ asset('storage/products/').'/'.$product->image }}" width="100px"></td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->description }}</td>
            <td>{{ $product->category->title }} </td>
            <td>{{ $product->price }}</td>
            <td>
            @if (in_array(1, array_map('intval', explode(',', $product->size))))
        <span class="badge bg-info text-white">Small</span>
    @endif
@if (in_array(2, array_map('intval', explode(',', $product->size))))
<span class="badge bg-info text-white">Medium</span>
    @endif
@if (in_array(3, array_map('intval', explode(',', $product->size))))
<span class="badge bg-info text-white">Family</span>
@endif
            </td>
            <td class="text-nowrap">
                <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                @can('product-show')
                    <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Show</a>
                   @endcan
                   @can('product-edit')
                    <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>
                   @endcan
                    @csrf
                    @method('DELETE')
                    @can('product-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
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