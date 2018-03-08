@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Project List</div>

                <div class="panel-body">
                    <!-- Display Success Messages -->
                    @include('common.success')
                    <!-- Display Validation Errors -->
                    @include('common.errors')
                    <div class="clearfix" style="margin-bottom: 10px;">
                    <a href="{{route('project-create')}}" class="btn btn-primary pull-right" role="button">
                        <span class="fa fa-btn fa-plus" aria-hidden="true"> Create</span>
                    </a>
                    </div>
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Domain</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($projects))
                            @foreach ($projects as $project)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $project->name }} <br> ({{ $project->code }})</td>
                                    <td>{{ $project->domain }}</td>
                                    <td title="{{ $project->description }}">{{ str_limit($project->description, 25) }}</td>
                                    <td>
                                        <form action="{{route('project-del', ['id' => $project->id])}}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                        <a href="{{route('project-edit', ['id' => $project->id])}}" class="btn btn-default" role="button">
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
                    {{ $projects->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
