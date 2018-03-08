<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                <div class="panel-body">
                    <?php if(Auth::guest()): ?>
                        You can generate security reports from here. But you need to be logged in!
                    <?php elseif(Auth::user() && Auth::user()->hasRole([\App\Role::ADMIN])): ?>
                        Hurray! Now go to Reports link and do what you want. You can also manage vulnerabilities.
                    <?php else: ?>
                        Hurray! Now go to Reports link and do what you want.
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>