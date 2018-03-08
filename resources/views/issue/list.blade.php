@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $report->project->name.' : '.$report->document_title.' : '.$report->version }} - Issue List</div>

                <div class="panel-body">
                    <!-- Display Success Messages -->
                    @include('common.success')
                    <!-- Display Validation Errors -->
                    @include('common.errors')
                    <div class="clearfix pull-right" style="margin-bottom: 10px;">
                    <a href="{{route('issue-create', ['report' => $report->id])}}" class="btn btn-primary" role="button">
                        <span class="fa fa-btn fa-plus" aria-hidden="true"> Create</span>
                    </a>
                    <a href="{{route('report-list')}}" class="btn btn-default" role="button">
                        <span class="fa fa-btn fa-undo" aria-hidden="true"> Back to Reports</span>
                    </a>
                    <a href="{{route('report-preview', ['report' => $report->id])}}" class="btn btn-success" role="button">
                        <span class="fa fa-btn fa-envelope" aria-hidden="true"> Preview Report</span>
                    </a>
                    </div>
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Vulnerability</th>
                                <th>Severity</th>
                                <th>Rejected</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($issues))
                            @foreach ($issues as $issue)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $issue->name }} <a title="Screenshots" href="{{route('screenshot-list', ['report' => $report->id, 'issue' => $issue->id])}}">({{ count($issue->screenshots) ? count($issue->screenshots) : 0 }})</a></td>
                                    <td title="{{ $issue->vulnerability->name }}">{{ $issue->vulnerability->code }}</td>
                                    <td style="background-color: {{ $issue->severity->color_code }}">{{ $issue->severity->level }}</td>
                                    <td>{{ $issue->rejected_by_id ? $issue->rejecter->name.' on '.DateHelper::formatDate($issue->rejected_at) : 'No' }}</td>
                                    <td>
                                        <form action="{{route('issue-del', ['report' => $report->id, 'issue' => $issue->id])}}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                        <a href="{{route('issue-edit', ['report' => $report->id, 'issue' => $issue->id])}}" class="btn btn-default" role="button">
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
                    {{ $issues->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
