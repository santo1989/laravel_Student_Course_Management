<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Categories
    </x-slot>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Categories <a class="btn btn-sm btn-info" href="{{ route('categories.index') }}">List</a>
        </div>
        <div class="card-body">

            @if (session('message'))
            <div class="alert alert-success">
                <span class="close" data-dismiss="alert">&times;</span>
                <strong>{{ session('message') }}.</strong>
            </div>
            @endif

            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Sl#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $sl=0 @endphp
                    @foreach ($categories as $category)
                    <tr>
                        <td>{{ ++$sl }}</td>
                        <td>{{ $category->title }}</td>
                        <td>{{ $category->description }}</td>
                        <td>
                        
                            <a class="btn btn-warning btn-sm" href="{{ route('categories.restore', ['category' => $category->id]) }}" >Restore</a>

                            <form style="display:inline" action="{{ route('categories.delete', ['category' => $category->id]) }}" method="post">
                                @csrf
                                @method('delete')
                                
                                <button onclick="return confirm('Are you sure want to delete permanently?')" class="btn btn-sm btn-danger" type="submit">Permanent Delete</button>
                            </form>

                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

</x-backend.layouts.master>