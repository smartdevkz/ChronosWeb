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
    <div class="container row row-cols-2">
        <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mt-3">
                <div class="row row-cols-2 col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group col">
                        <strong>Country:</strong>
                        <select class="browser-default form-select custom-select form-control col-md-2" name="country_id" style="width: auto;">
                            <option selected>Not Selected</option>
                            @foreach ($viewData["countries"] as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <strong>Category:</strong>
                        <select class="browser-default form-select custom-select form-control col-md-2" name="category_id" style="width:auto;">
                            <option selected>Select category</option>
                            @foreach ($viewData["categories"] as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col mt-2">
                        <strong>Start Date:</strong>
                            <event-date id="start_date" timeunit="0"></event-date>
                    </div>
                    <div class="form-group col mt-2">
                        <strong>End Date:</strong>
                        <event-date id="end_date" timeunit="0"></event-date>
                    </div>
                    
                    <div class="form-group col-md-10 mt-2">
                        <strong>Description:</strong>
                        <textarea class="form-control" name="description" style="width:aligned;"></textarea>
                        @error('description')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-10 mt-2">
                        <strong>Tags:</strong>
                        <input type="text" class="form-control" name="tags" style="width: aligned;"/>
                        @error('tags')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary pl-4 mt-3" style="width: auto;">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection