@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Events comparison</h2>
            </div>
        </div>
    </div>
    <event-list></event-list>
</div>
@endsection