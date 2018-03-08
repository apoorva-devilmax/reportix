@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                <div class="panel-body">
                    @if (Auth::guest())
                        You can generate security reports from here. But you need to be logged in!
                    @elseif (Auth::user() && Auth::user()->hasRole([\App\Role::ADMIN]))
                        Hurray! Now go to Reports link and do what you want. You can also manage vulnerabilities.
                    @else
                        Hurray! Now go to Reports link and do what you want.
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
