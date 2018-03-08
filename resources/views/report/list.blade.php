@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Report List</div>

                <div class="panel-body">
                    <!-- Display Success Messages -->
                    @include('common.success')
                    <!-- Display Validation Errors -->
                    @include('common.errors')
                    <div class="clearfix" style="margin-bottom: 10px;">
                    <a href="{{route('report-create')}}" class="btn btn-primary pull-right" role="button">
                        <span class="fa fa-btn fa-plus" aria-hidden="true"> Create</span>
                    </a>
                    </div>
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Project</th>
                                <th>Description</th>
                                <th>Submission Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($reports))
                            @foreach ($reports as $report)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $report->document_title }} : {{ $report->version }} <br> by <i>{{ $report->author->name }}</i> <a title="Issue" href="{{route('issue-list', ['report' => $report->id])}}">({{ count($report->issues) ? count($report->issues) : 'New' }})</a></td>
                                    <td>{{ $report->project->name }}</td>
                                    <td title="{{ $report->description }}">{{ str_limit($report->description, 25) }}</td>
                                    <td>{{ DateHelper::formatDate($report->submission_date) }}</td>
                                    <td>
                                        <form action="{{route('report-del', ['id' => $report->id])}}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                        <a href="{{route('report-edit', ['id' => $report->id])}}" class="btn btn-default" role="button">
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
                    {{ $reports->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
