@extends('layouts.dashboard')

@section('title', 'Categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
@endsection

@section('content')

<div class="mb-5 ml-1">
    <a href="{{route('dashboard.categories.create')}}" class="btn btn-sm btn-outline-primary">Create New Category</a>
</div>

@if (session()->has('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<table class="table">

    <thead>
        <th></th>
        <th>ID</th>
        <th>Name</th>
        <th>Parent</th>
        <th>Created At</th>
        <th colspan="2"></th>
    </thead>

    <tbody>
        @forelse ($categories as $category)
            <tr>
                <td><img src="{{ asset('storage/'. $category->image) }}" alt="" height="50"></td>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->parent_id }}</td>
                <td>{{ $category->created_at }}</td>
                <td>
                    <a href="{{route('dashboard.categories.edit', $category)}}" class="btn btn-sm btn-outline-success">Edit</a>
                </td>
                <td>
                    <form action="{{route('dashboard.categories.destroy', $category)}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7">No Categories Yet</td>
            </tr>
        @endforelse
    </tbody>

</table>

@endsection
