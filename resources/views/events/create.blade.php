@extends('layouts.app')

@section('content')

<div class="container mt-2" id="app">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-2">
                <h2>Add Event</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('events.index') }}"> Back</a>
            </div>
        </div>
    </div>
    @if(session('status'))
    <div class="alert alert-success mb-1 mt-1">
        {{ session('status') }}
    </div>
    @endif
    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Country:</strong>
                    <select class="browser-default custom-select form-control col-md-2" name="country_id">
                        <option selected>Not Selected</option>
                        @foreach ($viewData["countries"] as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <strong>Start Date:</strong>
                    <event-date id="start_date" timeunit="0"></event-date>
                </div>
                <div class="form-group">
                    <strong>End Date:</strong>
                    <event-date id="end_date" timeunit="0"></event-date>
                </div>
                <div class="form-group">
                    <strong>Category:</strong>
                    <select class="browser-default custom-select form-control col-md-2" name="category_id">
                        <option selected>Select category</option>
                        @foreach ($viewData["categories"] as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <strong>Description:</strong>
                    <textarea class="form-control" name="description"></textarea>
                    @error('description')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <strong>Tags:</strong>
                    <input type="text" class="form-control" name="tags" />
                    @error('tags')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary ml-3">Submit</button>
        </div>
    </form>
</div>
@endsection