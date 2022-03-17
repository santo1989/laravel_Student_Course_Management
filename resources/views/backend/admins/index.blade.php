<x-backend.layouts.master>

    <div>
    </div>
    <x-slot name="pageTitle">
      Admin
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
                <a class="btn btn-primary" href={{ route("admins.create") }}>Create</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  {{-- admin Table goes here --}}
  
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Sl#</th>
                        <th>Name</th>
                      <th>Actions</th>
                      
                    </tr>
                    </thead>
                    <tbody>
                      @php $sl=0 @endphp
                      @foreach ($admins as $admin)
                        <tr>
                            <td>{{ ++$sl }}</td>
                            <td>{{ $admin->name }}</td>
                          <td>
                            <a class="btn btn-primary" href={{ route("admins.edit", ['admin'=>$admin->id]) }}>Edit</a>
                            <form action={{ route("admins.destroy", $admin->id) }} method="POST" class="d-inline">
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