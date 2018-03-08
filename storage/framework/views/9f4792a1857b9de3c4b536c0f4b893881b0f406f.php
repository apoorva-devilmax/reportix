<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Report Form</div>

                <div class="panel-body">
                    <!-- Display Success Messages -->
                    <?php echo $__env->make('common.success', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <!-- Display Validation Errors -->
                    <?php echo $__env->make('common.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    
                    <!-- Vulnerability Form -->
                    <form onsubmit="save.disabled = true; return true;" action="<?php echo e($action == 'edit' ? route('report-edit', ['id' => $id]) : route('report-create')); ?>" method="POST" class="form-horizontal">
                        <?php echo e(csrf_field()); ?>


                        <!-- Name -->
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">Name</label>

                            <div class="col-sm-6">
                                <input type="text" required="" name="name" id="name" class="form-control" value="<?php echo e(old('name', (isset($report) && isset($report->document_title)) ? $report->document_title : null)); ?>" placeholder="document title">
                            </div>
                        </div>
                        
                        <!-- Version -->
                        <div class="form-group">
                            <label for="version" class="col-sm-3 control-label">Version</label>

                            <div class="col-sm-6">
                                <input type="text" required="" name="version" id="version" class="form-control" value="<?php echo e(old('version', (isset($report) && isset($report->version)) ? $report->version : null)); ?>" placeholder="version">
                            </div>
                        </div>
                        
                        <!-- Project -->
                        <div class="form-group">
                            <label for="project" class="col-sm-3 control-label">Project</label>

                            <div class="col-sm-6">
                                <select class="form-control" name="project" id="project" required="">
                                    <option value="">Select Project</option>
                                    <?php if($projects && count($projects)): ?>
                                        <?php foreach($projects as $project): ?>
                                            <option value="<?php echo e($project->id); ?>" <?php echo e($project->id == old('project') ? 'selected' : (isset($report) && isset($report->project_id) && $project->id == $report->project_id ? 'selected' : null)); ?> ><?php echo e($project->name); ?> [<?php echo e($project->code); ?>]</option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Domain -->
                        <div class="form-group">
                            <label for="domain" class="col-sm-3 control-label">Domain</label>

                            <div class="col-sm-6">
                                <input type="url" required="" name="domain" id="domain" class="form-control" value="<?php echo e(old('domain', (isset($report) && isset($report->tested_domain)) ? $report->tested_domain : null)); ?>" placeholder="tested domain">
                            </div>
                        </div>
                                                
                        <!-- Description -->
                        <div class="form-group">
                            <label for="description" class="col-sm-3 control-label">Description</label>

                            <div class="col-sm-6">
                                <textarea name="description" required="" id="description" class="form-control" placeholder="description"><?php echo e(old('description', (isset($report) && isset($report->description)) ? $report->description : null)); ?></textarea>
                            </div>
                        </div>
                        
                        <!-- Submission -->
                        <div class="form-group">
                            <label for="submission" class="col-sm-3 control-label">Submission</label>

                            <div class="col-sm-6">
                                <input type="date" required="" name="submission" id="submission" class="form-control" value="<?php echo e(old('submission', (isset($report) && isset($report->submission_date)) ? $report->submission_date : null)); ?>">
                            </div>
                        </div>

                        <!-- Add/Update Report Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-primary" name="save">
                                    <i class="fa fa-btn fa-plus"></i><?php echo e($button_text); ?> Report
                                </button>
                                <a href="<?php echo e(route('report-list')); ?>" role="button" class="btn btn-default">
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>