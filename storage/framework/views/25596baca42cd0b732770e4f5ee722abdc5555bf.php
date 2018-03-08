<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo e($report->project->name.':'.$report->document_title.':'.$report->version); ?> - Issue Form</div>

                <div class="panel-body">
                    <!-- Display Success Messages -->
                    <?php echo $__env->make('common.success', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <!-- Display Validation Errors -->
                    <?php echo $__env->make('common.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    
                    <!-- Vulnerability Form -->
                    <form onsubmit="save.disabled = true; return true;" action="<?php echo e($action == 'edit' ? route('issue-edit', ['report' => $report->id, 'id' => $id]) : route('issue-create', ['report' => $report->id])); ?>" method="POST" class="form-horizontal">
                        <?php echo e(csrf_field()); ?>


                        <!-- Name -->
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">Name</label>

                            <div class="col-sm-6">
                                <input type="text" required="" name="name" id="name" class="form-control" value="<?php echo e(old('name', (isset($issue) && isset($issue->name)) ? $issue->name : null)); ?>" placeholder="name">
                            </div>
                        </div>
                        
                        <!-- Vulnerability -->
                        <div class="form-group">
                            <label for="vulnerability" class="col-sm-3 control-label">Vulnerability</label>

                            <div class="col-sm-6">
                                <select class="form-control" name="vulnerability" id="vulnerability" required="" onchange="return issueChanged(this);">
                                    <option value="">Select Vulnerability</option>
                                    <?php if($vulnerabilities && count($vulnerabilities)): ?>
                                        <?php foreach($vulnerabilities as $vulnerability): ?>
                                            <option data-recomm="<?php echo e($vulnerability->recommendation); ?>" data-desc="<?php echo e($vulnerability->description); ?>" data-txt="<?php echo e($vulnerability->name); ?>" data-severity="<?php echo e($vulnerability->severity_id); ?>" value="<?php echo e($vulnerability->id); ?>" <?php echo e($vulnerability->id == old('vulnerability') ? 'selected' : (isset($issue) && isset($issue->vulnerability_id) && $vulnerability->id == $issue->vulnerability_id ? 'selected' : null)); ?> ><?php echo e($vulnerability->name); ?> [<?php echo e($vulnerability->code); ?>]</option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Severity -->
                        <div class="form-group">
                            <label for="severity" class="col-sm-3 control-label">Severity</label>

                            <div class="col-sm-6">
                                <select class="form-control" name="severity" id="severity" required="">
                                    <option value="">Select Severity</option>
                                    <?php if($severity && count($severity)): ?>
                                        <?php foreach($severity as $level): ?>
                                            <option value="<?php echo e($level->id); ?>" <?php echo e($level->id == old('severity') ? 'selected' : (isset($issue) && isset($issue->severity_id) && $level->id == $issue->severity_id ? 'selected' : null)); ?> ><?php echo e($level->level); ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Affected URL -->
                        <div class="form-group">
                            <label for="url" class="col-sm-3 control-label">Affected URL</label>

                            <div class="col-sm-6">
                                <input type="url" required="" name="url" id="url" class="form-control" value="<?php echo e(old('url', (isset($issue) && isset($issue->affected_url)) ? $issue->affected_url : null)); ?>" placeholder="affected url">
                            </div>
                        </div>
                        
                        <!-- Affected Param -->
                        <div class="form-group">
                            <label for="param" class="col-sm-3 control-label">Affected Parameters</label>

                            <div class="col-sm-6">
                                <textarea name="param" required="" id="param" class="form-control" placeholder="affected parameters"><?php echo e(old('param', (isset($issue) && isset($issue->affected_params)) ? $issue->affected_params : null)); ?></textarea>
                            </div>
                        </div>
                                                
                        <!-- Description -->
                        <div class="form-group">
                            <label for="description" class="col-sm-3 control-label">Description</label>

                            <div class="col-sm-6">
                                <textarea rows="10" name="description" required="" id="description" class="form-control" placeholder="description"><?php echo e(old('description', (isset($issue) && isset($issue->description)) ? $issue->description : null)); ?></textarea>
                            </div>
                        </div>
                        
                        <!-- Recommendation -->
                        <div class="form-group">
                            <label for="recommendation" class="col-sm-3 control-label">Recommendation</label>

                            <div class="col-sm-6">
                                <textarea rows="10" name="recommendation" required="" id="recommendation" class="form-control" placeholder="recommendation"><?php echo e(old('recommendation', (isset($issue) && isset($issue->recommendation)) ? $issue->recommendation : null)); ?></textarea>
                            </div>
                        </div>

                        <!-- Add/Update Issue Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-primary" name="save">
                                    <i class="fa fa-btn fa-plus"></i><?php echo e($button_text); ?> Issue
                                </button>
                                <a href="<?php echo e(route('issue-list', ['report' => $report->id])); ?>" role="button" class="btn btn-default">
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>