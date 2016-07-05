@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-sm-offset-2 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                Create event
            </div>

            <div class="panel-body">
                <h3>OK</h3>
                <strong>Event to add a task to the user created</strong>
            </div>
        </div>
    </div>
</div>
<!-- JavaScripts -->
<script src="https://js.pusher.com/3.1/pusher.min.js"></script>
<script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('1caae88865252062e851', {
        encrypted: true
    });

    var channel = pusher.subscribe('user1');
    channel.bind('app.add-task', function (data) {
        alert(data.message);
    });
</script>
@endsection
