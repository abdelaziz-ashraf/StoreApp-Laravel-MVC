@extends('layouts.dashboard')

@section('title', 'Edit Category')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Category</li>
    <li class="breadcrumb-item active">Edit</li>

@endsection

@section('content')

<form action="{{ route('dashboard.categories.update', $category) }}" method="post" class="m-3" enctype="multipart/form-data">
    @csrf
    @method('put')

    @include('dashboard.categories._form', [
        'button_label' => 'Update'
    ])

</form>

@endsection
