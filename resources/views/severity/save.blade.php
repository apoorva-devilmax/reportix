@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Severity Form</div>

                <div class="panel-body">
                    <!-- Display Success Messages -->
                    @include('common.success')
                    <!-- Display Validation Errors -->
                    @include('common.errors')
                    
                    <!-- Vulnerability Form -->
                    <form onsubmit="save.disabled = true; return true;" action="{{ $action === 'edit' ? route('severity-edit', ['id' => $id]) : route('severity-create') }}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <!-- Level -->
                        <div class="form-group">
                            <label for="level" class="col-sm-3 control-label">Level</label>

                            <div class="col-sm-6">
                                <input type="text" required="" name="level" id="level" class="form-control" value="{{ old('level', (isset($severity) && isset($severity->level)) ? $severity->level : null) }}">
                            </div>
                        </div>
                        
                        <!-- Color Code -->
                        <div class="form-group">
                            <label for="color_code" class="col-sm-3 control-label">Color Code</label>

                            <div class="col-sm-6">
                                <input type="text" required="" name="color_code" id="color_code" class="form-control" value="{{ old('color_code', (isset($severity) && isset($severity->color_code)) ? $severity->color_code : null) }}">
                            </div>
                        </div>
                        
                        <!-- Description -->
                        <div class="form-group">
                            <label for="description" class="col-sm-3 control-label">Description</label>

                            <div class="col-sm-6">
                                <textarea name="description" required="" id="description" class="form-control">{{ old('description', (isset($severity) && isset($severity->description)) ? $severity->description : null) }}</textarea>
                            </div>
                        </div>

                        <!-- Add/Update Vulnerability Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-primary" name="save">
                                    <i class="fa fa-btn fa-plus"></i>{{$button_text}} Severity
                                </button>
                                <a href="{{ route('severity-list') }}" role="button" class="btn btn-default">
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
