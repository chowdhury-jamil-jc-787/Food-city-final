<x-backend.layouts.master>
<x-slot:fav>Image_slider-trashed</x-slot:fav>
    <x-slot:title>Image_slider-trashed</x-slot:title>
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
                <a href="{{ route('imageslider.list') }}" class="btn btn-success">Back</a>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                    <th>No</th>
                      <th>Image</th>
                      <th>Title</th>
                      <th>Description</th>
                      <th>Status</th>
                      <!-- <th class="text-nowrap">Created at</th> -->
                      <th width="280px">Action</th>
                      </tr>
                    </thead>

                    <tbody>
                                        @foreach($trashed as $image_slider)
                                        <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td><img src="{{ asset('storage/Image_slider/').'/'.$image_slider->image }}" alt="" height="100" width="150" ></td> 
                                                                         
                                            <td>{{$image_slider->title}}</td>
                                            <td>{{$image_slider->description}} </td>
                                            <td>{{$image_slider->status}} </td>
                                          
                                            <td>
                                  
                                                <a href="{{ route('image_slider.restore', ['image_slider'=> $image_slider->id])}}" class="btn btn-warning">Restore</a>
                                             
                                             <form onclick= "alert('Are you sure you want to Delet this forever')" style="display:inline;" action="{{ route('image_slider.delete', ['image_slider'=> $image_slider->id])}}" method="POST">

                                             

                                              @csrf 
                                              @method('delete')
                                              <button type="submit" class="btn btn-danger">Permanently Delete</button>

                                              </form> 
                                            </td>
                                            @endforeach
                                            
                                        </tr>
                                        
                                    </tbody>

                    <tfoot>
                      <tr>
                      <th>No</th>
                      <th>Image</th>
                      <th>Title</th>
                      <th>Description</th>
                      <th>Status</th>
                      <!-- <th class="text-nowrap">Created at</th> -->
                      <th width="280px">Action</th>
                      </tr>
                    </tfoot>
                
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