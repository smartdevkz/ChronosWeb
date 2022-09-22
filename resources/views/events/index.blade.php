@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Events</h2>
            </div>
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('events.create') }}"> Create </a>
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
                <th>ID</th>
                <th>Category</th>
                <th>Country</th>
                <th>Description</th>
                <th>Tags</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
            <tr>
                <td>{{ $event->id }}</td>
                <td>{{ $event->category != null ? $event->category->name : '' }}</td>
                <td>{{ $event->country != null ? $event->country->name : '' }}</td>
                <td>{{ $event->description }}</td>
                <td>{{ $event->tags }}</td>
                <td>
                    <form action="{{ route('events.destroy',$event->id) }}" method="Post">
                        <a class="btn btn-primary" href="{{ route('events.edit',$event->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $events->links() !!}
</div>
@endsection