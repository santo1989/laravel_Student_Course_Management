<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Details
    </x-slot>


    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
           Category Details <a class="btn btn-sm btn-info" href="{{ route('categories.index') }}">List</a>
        </div>
        <div class="card-body">
            <h3>Title: {{ $category->title }}</h3>
            <p>Description: {{ $category->description }}</p>
            <img src="{{ asset('storage/images/'.$category->image) }}" />
        </div>
    </div>

</x-backend.layouts.master>