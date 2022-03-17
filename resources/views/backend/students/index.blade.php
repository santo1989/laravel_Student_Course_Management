<x-backend.layouts.master>

    <div>
    </div>
    <x-slot name="pageTitle">
      Students
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
                <a class="btn btn-primary" href={{ route("students.create") }}>Create</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  {{-- student Table goes here --}}
  
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Sl#</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Student ID</th>
                        <th>Class</th>
                        <th>Grade</th>
                        <th>Actions</th>
                      
                    </tr>
                    </thead>
                    <tbody>
                      @php $sl=0 @endphp
                      {{-- @foreach () --}}
                      @forelse ($students as $student )
                        
                     
                        <tr>
                            <td>{{ ++$sl }}</td>
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->student_id }}</td>
                            <td>{{ $student->class }}</td>
                            <td>{{ $student->grade }}</td>
                            <td>
                              <a class="btn btn-primary" href={{ route("students.edit", ['student'=>$student->id]) }}>Edit</a>
                              <form action={{ route("students.destroy", $student->id) }} method="POST" class="d-inline">
                                @csrf
                                @method("DELETE")
                                <button class="btn btn-danger" type="submit">Delete</button>
                              </form>
                            </td>
                             @empty
                        <h4 class="text-warnning">No Data Found </h4>
                        </tr>
                    {{-- @endforeach --}}
                   
                    @endforelse
                    
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
