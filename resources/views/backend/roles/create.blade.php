<x-backend.layouts.master>
<div>
</div>

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
  <form action="{{ route('roles.store') }}"  method="post">
      <div>
         @csrf
          <div class="row m-4">
              <div class="col-sm-6">
              <!-- text input -->
              <div class="form-group">
                  <label>Role Name</label>
                  <input type="text" class="form-control" placeholder="Enter role Name" name="name">
              </div>
              </div>
          </div>
          <button type="submit" class="btn btn-primary" style="margin-left: 33px">Save</button>
      </div>
    </form>


</x-backend.layouts.master>
