<x-backend.layouts.master>

  <div>
  </div>
  <x-slot name="pageTitle">
    Teachers
</x-slot>

<section class="content">
    <div class="container-fluid">

@if (session('message'))
  <div class="alert alert-success">
      <span class="close" data-dismiss="alert">&times;</span>
      <strong>{{ session('message') }}.</strong>
  </div>
  @endif

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <a class="btn btn-primary" href={{ route("teachers.create") }}>Create</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                {{-- teacher Table goes here --}}

                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                      <th>Sl#</th>
                      <th>Teacher ID</th>
                      <th>Name</th>
                      <th>E-mail</th>
                      <th>Phone</th>
                      <th>Address</th>
                      <th>Image</th>
                      <th>Actions</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                    @php $sl=0 @endphp
                    @foreach ($teachers as $teacher)
                      <tr>
                          <td>{{ ++$sl }}</td>
                          <td>{{ $teacher->teacher_id }}</td>
                          <td>{{ $teacher->name }}</td>
                          <td>{{ $teacher->email }}</td>
                          <td>{{ $teacher->phone }}</td>
                          <td>{{ $teacher->address }}</td>
                          <td>{{ $teacher->image }}</td>
                          <td>
                            <a class="btn btn-primary" href={{ route("teachers.edit", ['teacher'=>$teacher->id]) }}>Edit</a>
                            <form action={{ route("teachers.destroy", $teacher->id) }} method="POST" class="d-inline">
                              @csrf
                              @method("DELETE")
                              <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                          </td>
                      </tr>
                  @endforeach
                  
                  </tbody>
                </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
</x-backend.layouts.master>
