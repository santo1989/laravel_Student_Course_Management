<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Roles
    </x-slot>


    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            {{ $role->name }} Users <a class="btn btn-sm btn-info" href="{{ route('roles.index') }}">List</a>
        </div>
        <div class="card-body">

            <table class="table">
                <thead>
                    <tr>
                        <th>SL#</th>
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($role->users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan='3' class="text-center">No Data Available</td>
                    </tr>
                    @endforelse
                </tbody>

            </table>

        </div>
    </div>

</x-backend.layouts.master>