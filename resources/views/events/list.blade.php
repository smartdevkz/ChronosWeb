@extends('layouts.app')

@section('header')
<script>
    function onCategoryChanged() {
        var categoryId = document.getElementById("selectCategory").value;
        var url = window.location.href;
        window.location.href = url + (url.includes('?') ? '&' : '?') + 'categoryId=' + categoryId;
        //const url = "url?id1=value1&id2=value2";
        //window.location.href = url;
    }
</script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Events comparison</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Country:</strong>
                <select class="browser-default custom-select form-control col-md-2" name="country_id">
                    <option selected>Not Selected</option>
                    @foreach ($viewData["countries"] as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Category:</strong>
                <select id="selectCategory" class="form-control col-md-2" onclick="onCategoryChanged()">
                    <option selected>Select category</option>
                    @foreach ($viewData["categories"] as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Tags:</strong>
                <input type="text" class="form-control" name="tags" />
            </div>
        </div>
    </div>
    <br />
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Category</th>
                <th>Country</th>
                <th>Description</th>
                <th>Tags</th>
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
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $events->links() !!}
</div>
@endsection