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
                <a class="btn btn-primary" href={{ route("students.index") }}>Student Index</a>
              </div>
              <!-- /.card-header -->
              <form action="{{ route('students.update', ['student' => $student->id]) }}" method="post">
                <div class="card-body">
                   @csrf
                    <x-backend.form.input name="name" :value="$student->name" />
                    <x-backend.form.input name="student_id" :value="$student->student_id" />
                    <x-backend.form.input name="class" :value="$student->class" />
                    <x-backend.form.input name="grade" :value="$student->grade" />
                    <x-backend.form.button>Update</x-backend.form.button>

              </form>   
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
