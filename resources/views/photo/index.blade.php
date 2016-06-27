@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-sm-offset-2 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                Photo-Action
            </div>

            <div class="panel-body">
                <strong>{{ $photo_action }}</strong>
            </div>
        </div>
    </div>
</div>
@endsection
