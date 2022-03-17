<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Edit Form
    </x-slot>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Edit User <a class="btn btn-sm btn-info" href="{{ route('users.index') }}">List</a>
        </div>
        <div class="card-body">

            <x-backend.layouts.elements.errors :errors="$errors" />

            <form action="{{ route('users.update', ['user' => $user->id]) }}" method="post">
                @csrf
                @method('patch')

                <x-backend.form.input name="name" :value="$user->name" />

                <x-backend.form.field>
                    <select name="role_id" id="role_id" class="form-select">
                        @foreach ($roles as $role)
                        <option value="{{ $role->id }}"   {{ $role->id == $user->role_id ? 'selected' : '' }} >{{ $role->name }}</option>
                        @endforeach
                    </select>

                </x-backend.form.field>

                <x-backend.form.button>Update</x-backend.form.button>

            </form>
        </div>
    </div>


</x-backend.layouts.master>
