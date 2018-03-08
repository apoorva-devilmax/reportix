<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo e($report->project->name.' : '.$report->document_title.' : '.$report->version); ?> - Issue List</div>

                <div class="panel-body">
                    <!-- Display Success Messages -->
                    <?php echo $__env->make('common.success', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <!-- Display Validation Errors -->
                    <?php echo $__env->make('common.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <div class="clearfix pull-right" style="margin-bottom: 10px;">
                    <a href="<?php echo e(route('issue-create', ['report' => $report->id])); ?>" class="btn btn-primary" role="button">
                        <span class="fa fa-btn fa-plus" aria-hidden="true"> Create</span>
                    </a>
                    <a href="<?php echo e(route('report-list')); ?>" class="btn btn-default" role="button">
                        <span class="fa fa-btn fa-undo" aria-hidden="true"> Back to Reports</span>
                    </a>
                    <a href="<?php echo e(route('report-preview', ['report' => $report->id])); ?>" class="btn btn-success" role="button">
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
                            <?php if(count($issues)): ?>
                            <?php foreach($issues as $issue): ?>
                                <tr>
                                    <td><?php echo e($i); ?></td>
                                    <td><?php echo e($issue->name); ?> <a title="Screenshots" href="<?php echo e(route('screenshot-list', ['report' => $report->id, 'issue' => $issue->id])); ?>">(<?php echo e(count($issue->screenshots) ? count($issue->screenshots) : 0); ?>)</a></td>
                                    <td title="<?php echo e($issue->vulnerability->name); ?>"><?php echo e($issue->vulnerability->code); ?></td>
                                    <td style="background-color: <?php echo e($issue->severity->color_code); ?>"><?php echo e($issue->severity->level); ?></td>
                                    <td><?php echo e($issue->rejected_by_id ? $issue->rejecter->name.' on '.DateHelper::formatDate($issue->rejected_at) : 'No'); ?></td>
                                    <td>
                                        <form action="<?php echo e(route('issue-del', ['report' => $report->id, 'issue' => $issue->id])); ?>" method="POST">
                                                <?php echo e(csrf_field()); ?>

                                                <?php echo e(method_field('DELETE')); ?>

                                        <a href="<?php echo e(route('issue-edit', ['report' => $report->id, 'issue' => $issue->id])); ?>" class="btn btn-default" role="button">
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
                    <?php echo e($issues->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>