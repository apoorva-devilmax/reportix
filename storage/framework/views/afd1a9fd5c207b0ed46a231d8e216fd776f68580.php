<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo e($issue->report->project->code.' : '.$issue->report->document_title.' : '.$issue->report->version.' : '.$issue->name); ?> - Screenshots</div>

                <div class="panel-body">
                    <!-- Display Success Messages -->
                    <?php echo $__env->make('common.success', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <!-- Display Validation Errors -->
                    <?php echo $__env->make('common.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <div class="clearfix pull-right" style="margin-bottom: 10px;">
                    <a href="<?php echo e(route('screenshot-create', ['report' => $issue->report->id, 'issue' => $issue->id])); ?>" class="btn btn-primary" role="button">
                        <span class="fa fa-btn fa-plus" aria-hidden="true"> Create</span>
                    </a>
                    <a href="<?php echo e(route('issue-list', ['report' => $issue->report->id])); ?>" class="btn btn-default" role="button">
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
                            <?php if(count($screenshots)): ?>
                            <?php foreach($screenshots as $screenshot): ?>
                                <tr>
                                    <td><?php echo e($i); ?></td>
                                    <td style="width: 50%;"><img width="60%" height="auto" src="<?php echo e(ImageHelper::getSecureImageURL($screenshot->img_path, $screenshot->img_name)); ?>" /></td>
                                    <td title="<?php echo e($screenshot->img_description); ?>"><?php echo e(str_limit($screenshot->img_description, 25)); ?></td>
                                    <td>
                                        <form action="<?php echo e(route('screenshot-del', ['report' => $issue->report->id, 'issue' => $issue->id, 'id' => $screenshot->id])); ?>" method="POST">
                                                <?php echo e(csrf_field()); ?>

                                                <?php echo e(method_field('DELETE')); ?>

                                        <a href="<?php echo e(route('screenshot-edit', ['report' => $issue->report->id, 'issue' => $issue->id, 'id' => $screenshot->id])); ?>" class="btn btn-default" role="button">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>                                        
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to remove it?')">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                        </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php ($i++); ?>
                            <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="4"><i>No rows found</i></td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>