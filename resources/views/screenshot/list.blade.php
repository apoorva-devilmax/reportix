@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $issue->report->project->code.' : '.$issue->report->document_title.' : '.$issue->report->version.' : '.$issue->name }} - Screenshots</div>

                <div class="panel-body">
                    <!-- Display Success Messages -->
                    @include('common.success')
                    <!-- Display Validation Errors -->
                    @include('common.errors')
                    <div class="clearfix pull-right" style="margin-bottom: 10px;">
                    <a href="{{route('screenshot-create', ['report' => $issue->report->id, 'issue' => $issue->id])}}" class="btn btn-primary" role="button">
                        <span class="fa fa-btn fa-plus" aria-hidden="true"> Create</span>
                    </a>
                    <a href="{{route('issue-list', ['report' => $issue->report->id])}}" class="btn btn-default" role="button">
                        <span class="fa fa-btn fa-undo" aria-hidden="true"> Back to Issues</span>
                    </a>
                    </div>
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($screenshots))
                            @foreach ($screenshots as $screenshot)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td style="width: 50%;"><img width="60%" height="auto" src="{{ ImageHelper::getSecureImageURL($screenshot->img_path, $screenshot->img_name) }}" /></td>
                                    <td title="{{ $screenshot->img_description }}">{{ str_limit($screenshot->img_description, 25) }}</td>
                                    <td>
                                        <form action="{{route('screenshot-del', ['report' => $issue->report->id, 'issue' => $issue->id, 'id' => $screenshot->id])}}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                        <a href="{{route('screenshot-edit', ['report' => $issue->report->id, 'issue' => $issue->id, 'id' => $screenshot->id])}}" class="btn btn-default" role="button">
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
                                <tr><td colspan="4"><i>No rows found</i></td></tr>
                            @endif
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
