@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $report->project->name.':'.$report->document_title.':'.$report->version }} - Issue Form</div>

                <div class="panel-body">
                    <!-- Display Success Messages -->
                    @include('common.success')
                    <!-- Display Validation Errors -->
                    @include('common.errors')
                    
                    <!-- Vulnerability Form -->
                    <form onsubmit="save.disabled = true; return true;" action="{{ $action == 'edit' ? route('issue-edit', ['report' => $report->id, 'id' => $id]) : route('issue-create', ['report' => $report->id]) }}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <!-- Name -->
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">Name</label>

                            <div class="col-sm-6">
                                <input type="text" required="" name="name" id="name" class="form-control" value="{{ old('name', (isset($issue) && isset($issue->name)) ? $issue->name : null) }}" placeholder="name">
                            </div>
                        </div>
                        
                        <!-- Vulnerability -->
                        <div class="form-group">
                            <label for="vulnerability" class="col-sm-3 control-label">Vulnerability</label>

                            <div class="col-sm-6">
                                <select class="form-control" name="vulnerability" id="vulnerability" required="" onchange="return issueChanged(this);">
                                    <option value="">Select Vulnerability</option>
                                    @if($vulnerabilities && count($vulnerabilities))
                                        @foreach ($vulnerabilities as $vulnerability)
                                            <option data-recomm="{{$vulnerability->recommendation}}" data-desc="{{$vulnerability->description}}" data-txt="{{$vulnerability->name}}" data-severity="{{$vulnerability->severity_id}}" value="{{$vulnerability->id}}" {{ $vulnerability->id == old('vulnerability') ? 'selected' : (isset($issue) && isset($issue->vulnerability_id) && $vulnerability->id == $issue->vulnerability_id ? 'selected' : null) }} >{{$vulnerability->name}} [{{$vulnerability->code}}]</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        
                        <!-- Severity -->
                        <div class="form-group">
                            <label for="severity" class="col-sm-3 control-label">Severity</label>

                            <div class="col-sm-6">
                                <select class="form-control" name="severity" id="severity" required="">
                                    <option value="">Select Severity</option>
                                    @if($severity && count($severity))
                                        @foreach ($severity as $level)
                                            <option value="{{$level->id}}" {{ $level->id == old('severity') ? 'selected' : (isset($issue) && isset($issue->severity_id) && $level->id == $issue->severity_id ? 'selected' : null) }} >{{$level->level}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        
                        <!-- Affected URL -->
                        <div class="form-group">
                            <label for="url" class="col-sm-3 control-label">Affected URL</label>

                            <div class="col-sm-6">
                                <input type="url" required="" name="url" id="url" class="form-control" value="{{ old('url', (isset($issue) && isset($issue->affected_url)) ? $issue->affected_url : null) }}" placeholder="affected url">
                            </div>
                        </div>
                        
                        <!-- Affected Param -->
                        <div class="form-group">
                            <label for="param" class="col-sm-3 control-label">Affected Parameters</label>

                            <div class="col-sm-6">
                                <textarea name="param" required="" id="param" class="form-control" placeholder="affected parameters">{{ old('param', (isset($issue) && isset($issue->affected_params)) ? $issue->affected_params : null) }}</textarea>
                            </div>
                        </div>
                                                
                        <!-- Description -->
                        <div class="form-group">
                            <label for="description" class="col-sm-3 control-label">Description</label>

                            <div class="col-sm-6">
                                <textarea rows="10" name="description" required="" id="description" class="form-control" placeholder="description">{{ old('description', (isset($issue) && isset($issue->description)) ? $issue->description : null) }}</textarea>
                            </div>
                        </div>
                        
                        <!-- Recommendation -->
                        <div class="form-group">
                            <label for="recommendation" class="col-sm-3 control-label">Recommendation</label>

                            <div class="col-sm-6">
                                <textarea rows="10" name="recommendation" required="" id="recommendation" class="form-control" placeholder="recommendation">{{ old('recommendation', (isset($issue) && isset($issue->recommendation)) ? $issue->recommendation : null) }}</textarea>
                            </div>
                        </div>

                        <!-- Add/Update Issue Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-primary" name="save">
                                    <i class="fa fa-btn fa-plus"></i>{{$button_text}} Issue
                                </button>
                                <a href="{{ route('issue-list', ['report' => $report->id]) }}" role="button" class="btn btn-default">
                                    <i class="fa fa-btn fa-undo"></i>Back to Issue List
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
