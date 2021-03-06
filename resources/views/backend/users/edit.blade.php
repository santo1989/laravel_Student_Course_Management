<x-backend.layouts.master>
  <x-elements.breadcrumb>
    <x-slot name="pageTitle">
    Edit  Roles
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
    <form action="{{ route('users.update', ['user' => $user->id]) }}" method="post">
      <div>
        @csrf
        @method('patch')
        

          <div class="row m-4">
            
            <div class="col-sm-6">
              <!-- text input -->
              <div class="form-group">
                  <label>Role</label>
                  <select name="role_id" id="role_id" class="form-select">
                    @foreach ($roles as $role)
                    <option value="{{ $role->id }}"   {{ $role->id == $user->role_id ? 'selected' : '' }} >{{ $role->name }}</option>
                    @endforeach
                </select>
              </div>
              </div>
              
          </div>
          <button type="submit" class="btn btn-primary" style="margin-left: 33px">Save</button>
      </div>
    </form>


</x-backend.layouts.master>

