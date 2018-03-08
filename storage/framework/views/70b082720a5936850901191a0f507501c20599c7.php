<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Vulnerability Form</div>

                <div class="panel-body">
                    <!-- Display Success Messages -->
                    <?php echo $__env->make('common.success', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <!-- Display Validation Errors -->
                    <?php echo $__env->make('common.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    
                    <!-- Vulnerability Form -->
                    <form onsubmit="save.disabled = true; return true;" action="<?php echo e($action === 'edit' ? route('vulnerability-edit', ['id' => $id]) : route('vulnerability-create')); ?>" method="POST" class="form-horizontal">
                        <?php echo e(csrf_field()); ?>


                        <!-- Name -->
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">Name</label>

                            <div class="col-sm-6">
                                <input type="text" required="" name="name" id="name" class="form-control" value="<?php echo e(old('name', (isset($vulnerability) && isset($vulnerability->name)) ? $vulnerability->name : null)); ?>">
                            </div>
                        </div>
                        
                        <!-- Code -->
                        <div class="form-group">
                            <label for="code" class="col-sm-3 control-label">Code</label>

                            <div class="col-sm-6">
                                <?php if($action === 'add'): ?>
                                <input type="text" required="" name="code" id="code" class="form-control" value="<?php echo e(old('code')); ?>">
                                <?php else: ?>
                                <input type="text" readonly="" class="form-control" value="<?php echo e($vulnerability->code); ?>">
                                <?php endif; ?>
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
                                            <option value="<?php echo e($level->id); ?>" <?php echo e($level->id == old('severity') ? 'selected' : (isset($vulnerability) && isset($vulnerability->severity_id) && $level->id == $vulnerability->severity_id ? 'selected' : null)); ?> ><?php echo e($level->level); ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Description -->
                        <div class="form-group">
                            <label for="description" class="col-sm-3 control-label">Description</label>

                            <div class="col-sm-6">
                                <textarea name="description" required="" id="description" class="form-control"><?php echo e(old('description', (isset($vulnerability) && isset($vulnerability->description)) ? $vulnerability->description : null)); ?></textarea>
                            </div>
                        </div>
                        
                        <!-- Recommendation -->
                        <div class="form-group">
                            <label for="recommendation" class="col-sm-3 control-label">Recommendation</label>

                            <div class="col-sm-6">
                                <textarea name="recommendation" required="" id="recommendation" class="form-control"><?php echo e(old('recommendation', (isset($vulnerability) && isset($vulnerability->recommendation)) ? $vulnerability->recommendation : null)); ?></textarea>
                            </div>
                        </div>

                        <!-- Add/Update Vulnerability Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-primary" name="save">
                                    <i class="fa fa-btn fa-plus"></i><?php echo e($button_text); ?> Vulnerability
                                </button>
                                <a href="<?php echo e(route('vulnerability-list')); ?>" role="button" class="btn btn-default">
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