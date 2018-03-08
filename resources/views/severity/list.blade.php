@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Severity List</div>

                <div class="panel-body">
                    <!-- Display Success Messages -->
                    @include('common.success')
                    <!-- Display Validation Errors -->
                    @include('common.errors')
                    <div class="clearfix" style="margin-bottom: 10px;">
                    <a href="{{route('severity-create')}}" class="btn btn-primary pull-right" role="button">
                        <span class="fa fa-btn fa-plus" aria-hidden="true"> Create</span>
                    </a>
                    </div>
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Level</th>
                                <th>Color-Code</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($severity))
                            @foreach ($severity as $level)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $level->level }}</td>
                                    <td style="background-color: {{ $level->color_code }}">{{ $level->color_code }}</td>
                                    <td title="{{ $level->description }}">{{ str_limit($level->description, 25) }}</td>
                                    <td>
                                        <form action="{{route('severity-del', ['id' => $level->id])}}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                        <a href="{{route('severity-edit', ['id' => $level->id])}}" class="btn btn-default" role="button">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>                                        
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to remove it?')">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                        </button>
                                        </form>
                                    </td>
                                </tr>
                                @php ($i++)
                            @endforeach
                            @else
                                <tr><td colspan="6"><i>No rows found</i></td></tr>
                            @endif
                        </tbody>
                        
                    </table>
                    {{ $severity->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
