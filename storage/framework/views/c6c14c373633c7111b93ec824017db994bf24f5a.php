<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Report List</div>

                <div class="panel-body">
                    <!-- Display Success Messages -->
                    <?php echo $__env->make('common.success', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <!-- Display Validation Errors -->
                    <?php echo $__env->make('common.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <div class="clearfix" style="margin-bottom: 10px;">
                    <a href="<?php echo e(route('report-create')); ?>" class="btn btn-primary pull-right" role="button">
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
                            <?php if(count($reports)): ?>
                            <?php foreach($reports as $report): ?>
                                <tr>
                                    <td><?php echo e($i); ?></td>
                                    <td><?php echo e($report->document_title); ?> : <?php echo e($report->version); ?> <br> by <i><?php echo e($report->author->name); ?></i> <a title="Issue" href="<?php echo e(route('issue-list', ['report' => $report->id])); ?>">(<?php echo e(count($report->issues) ? count($report->issues) : 'New'); ?>)</a></td>
                                    <td><?php echo e($report->project->name); ?></td>
                                    <td title="<?php echo e($report->description); ?>"><?php echo e(str_limit($report->description, 25)); ?></td>
                                    <td><?php echo e(DateHelper::formatDate($report->submission_date)); ?></td>
                                    <td>
                                        <form action="<?php echo e(route('report-del', ['id' => $report->id])); ?>" method="POST">
                                                <?php echo e(csrf_field()); ?>

                                                <?php echo e(method_field('DELETE')); ?>

                                        <a href="<?php echo e(route('report-edit', ['id' => $report->id])); ?>" class="btn btn-default" role="button">
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
                                <tr><td colspan="6"><i>No rows found</i></td></tr>
                            <?php endif; ?>
                        </tbody>
                        
                    </table>
                    <?php echo e($reports->links()); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>