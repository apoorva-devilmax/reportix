@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Project Form</div>

                <div class="panel-body">
                    <!-- Display Success Messages -->
                    @include('common.success')
                    <!-- Display Validation Errors -->
                    @include('common.errors')
                    
                    <!-- Vulnerability Form -->
                    <form onsubmit="save.disabled = true; return true;" action="{{ $action === 'edit' ? route('project-edit', ['id' => $id]) : route('project-create') }}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <!-- Name -->
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">Name</label>

                            <div class="col-sm-6">
                                <input type="text" required="" name="name" id="name" class="form-control" value="{{ old('name', (isset($project) && isset($project->name)) ? $project->name : null) }}">
                            </div>
                        </div>
                        
                        <!-- Code -->
                        <div class="form-group">
                            <label for="code" class="col-sm-3 control-label">Code</label>

                            <div class="col-sm-6">
                                @if($action === 'add')
                                <input type="text" required="" name="code" id="code" class="form-control" value="{{ old('code') }}">
                                @else
                                <input type="text" readonly="" class="form-control" value="{{ $project->code }}">
                                @endif
                            </div>
                        </div>
                        
                        <!-- Domain -->
                        <div class="form-group">
                            <label for="domain" class="col-sm-3 control-label">Domain</label>

                            <div class="col-sm-6">
                                <input type="text" required="" name="domain" id="domain" class="form-control" value="{{ old('domain', (isset($project) && isset($project->domain)) ? $project->domain : null) }}">
                            </div>
                        </div>
                        
                        <!-- Description -->
                        <div class="form-group">
                            <label for="description" class="col-sm-3 control-label">Description</label>

                            <div class="col-sm-6">
                                <textarea name="description" required="" id="description" class="form-control">{{ old('description', (isset($project) && isset($project->description)) ? $project->description : null) }}</textarea>
                            </div>
                        </div>

                        <!-- Add/Update Vulnerability Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-primary" name="save">
                                    <i class="fa fa-btn fa-plus"></i>{{$button_text}} Project
                                </button>
                                <a href="{{ route('project-list') }}" role="button" class="btn btn-default">
                                    <i class="fa fa-btn fa-undo"></i>Back to List
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
