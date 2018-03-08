@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $issue->report->project->code.':'.$issue->name }} - Screenshot Form</div>

                <div class="panel-body">
                    <!-- Display Success Messages -->
                    @include('common.success')
                    <!-- Display Validation Errors -->
                    @include('common.errors')
                    
                    <!-- Screenshot Form -->
                    <form enctype="multipart/form-data" onsubmit="save.disabled = true; return true;" action="{{ $action === 'edit' ? route('screenshot-edit', ['report' => $issue->report->id, 'issue' => $issue->id, 'id' => $id]) : route('screenshot-create', ['report' => $issue->report->id, 'issue' => $issue->id]) }}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}
                        
                        @if($action === 'edit' && isset($screenshot) && isset($screenshot->img_name))
                        <!-- File -->
                        <div class="form-group">
                            <label for="image" class="col-sm-3 control-label">Image</label>

                            <div class="col-sm-6">
                                <img style="max-width: 100%" id="image" src="{{ ImageHelper::getSecureImageURL($screenshot->img_path, $screenshot->img_name) }}" />
                            </div>
                        </div>
                        @endif
                        
                        <!-- File -->
                        <div class="form-group">
                            <label for="screen" class="col-sm-3 control-label">Screenshot</label>

                            <div class="col-sm-6">
                                <input type="file" @if($action !== 'edit') required="" @endif name="screen" id="screen" class="" aria-describedby="helpBlock">
                                <span id="helpBlock" class="help-block">only image allowed @if($action === 'edit') (select file only if you want to replace above) @endif</span>
                            </div>
                        </div>
                                                
                        <!-- Description -->
                        <div class="form-group">
                            <label for="description" class="col-sm-3 control-label">Description</label>

                            <div class="col-sm-6">
                                <textarea rows="10" name="description" required="" id="description" class="form-control" placeholder="description">{{ old('description', (isset($screenshot) && isset($screenshot->img_description)) ? $screenshot->img_description : null) }}</textarea>
                            </div>
                        </div>

                        <!-- Add/Update Issue Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-primary" name="save">
                                    <i class="fa fa-btn fa-plus"></i>{{$button_text}} Screenshot
                                </button>
                                <a href="{{ route('screenshot-list', ['report' => $issue->report->id, 'issue' => $issue->id]) }}" role="button" class="btn btn-default">
                                    <i class="fa fa-btn fa-undo"></i>Back to Screenshots
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
