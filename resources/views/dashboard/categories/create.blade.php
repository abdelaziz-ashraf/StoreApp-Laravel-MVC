@extends('layouts.dashboard')

@section('title', 'Create Category')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"> Category</li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')

<form action="{{ route('dashboard.categories.store') }}" method="post" class="m-3" enctype="multipart/form-data">
    @csrf

    @include('dashboard.categories._form', [
        'button_label' => 'Create'
    ])

</form>

@endsection
