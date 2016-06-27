@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-sm-offset-2 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                DataBase operations
            </div>

            <div class="panel-body">
                <h3>Users data</h3>
                <strong><pre>{{ dump($users) }}</pre></strong>
                <br />
                <h3>Tasks data</h3>
                <strong><pre>{{ dump($tasks) }}</pre></strong>
            </div>
        </div>
    </div>
</div>
@endsection
