<x-backend.layouts.master>
    <x-slot name="pageTitle">
      Roles
  </x-slot>


  @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
  @endif
  {{-- <form action="{{ route('roles.update') }}" method="post"> --}}
    <form action="{{ route('roles.update', ['role' => $role->id]) }}" method="post">
      <div>
        @csrf
        @method('patch')
        

          <div class="row m-4">
              <div class="col-sm-6">
              <!-- text input -->
              <div class="form-group">
                  <label>role Name</label>
                  <input type="text" class="form-control" placeholder="Enter role Name" name="name" value="{{ old('name', $role->name ) }}">
              </div>
              </div>
              
          </div>
          <button type="submit" class="btn btn-primary" style="margin-left: 33px">Save</button>
      </div>
    </form>


</x-backend.layouts.master>