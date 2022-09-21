@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 9 CRUD Example Tutorial</h2>
            </div>
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('categories.create') }}"> Create Company</a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Company Name</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $company)
            <tr>
                <td>{{ $company->id }}</td>
                <td>{{ $company->name }}</td>
                <td>
                    <form action="{{ route('categories.destroy',$company->id) }}" method="Post">
                        <a class="btn btn-primary" href="{{ route('categories.edit',$company->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $categories->links() !!}
</div>
@endsection