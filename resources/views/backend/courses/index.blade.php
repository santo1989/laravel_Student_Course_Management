<x-backend.layouts.master>

    <div>
    </div>
    <x-slot name="pageTitle">
        Courses
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
                <a class="btn btn-primary" href={{ route("courses.create") }}>Create</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  {{-- course Table goes here --}}
  
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Sl#</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Course Code</th>
                        <th>Course Type</th>
                        <th>Course Duration</th>
                        <th>Course Fee</th>
                        <th>Actions</th>
                      
                    </tr>
                    </thead>
                    <tbody>
                      @php $sl=0 @endphp
                      @foreach ($courses as $course)
                        <tr>
                            <td>{{ ++$sl }}</td>
                            <td>{{ $course->id }}</td>
                            <td>{{ $course->name }}</td>
                            <td>{{ $course->course_code }}</td>
                            <td>{{ $course->course_type }}</td>
                            <td>{{ $course->course_duration }}</td>
                            <td>{{ $course->course_fee }}</td>
                            <td>
                              <a class="btn btn-primary" href={{ route("courses.edit", ['course'=>$course->id]) }}>Edit</a>
                              <form action={{ route("courses.destroy", $course->id) }} method="POST" class="d-inline">
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
