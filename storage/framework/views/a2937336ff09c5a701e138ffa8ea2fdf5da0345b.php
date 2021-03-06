<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Report</div>

                <div class="panel-body">
                    <div class="clearfix" style="margin-bottom: 10px;">
                    <a href="<?php echo e(route('report-gen', ['id' => $report->id])); ?>" class="btn btn-primary pull-right" role="button">
                        <span class="fa fa-btn fa-envelope" aria-hidden="true"> Generate</span>
                    </a>
                    </div>
                    <section id="cover-page">
                        <div style="background-color: #68A12E; color: #FFFFFF;text-align: center;font-size: x-large;">
                            <?php echo e($report->document_title); ?> <br />
                            <?php echo e($report->project->name); ?> <br />
                            <?php echo e(DateHelper::formatDate($now)); ?>

                        </div>
                    </section>
                    <hr />
                    <section id="table-of-content">
                        <div style="text-align: center;font-size: x-large;">
                            Table of Content
                        </div>
                    </section>
                    <hr />
                    <section id="preface">
                        <?php ($a = 1); ?>
                        <h3><?php echo e($a); ?>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DISCLAIMER </h3>
                        <p>
                            All information contained in this document is confidential and proprietary to Biz2Credit, disclosure or use of any information contained in this document by photographic, electronic or any other means, in whole or part, for any reason other than for the purpose of operations / Web Application security enhancement of Biz2Credit internal review is strictly prohibited without written consent.
                        </p>
                        <h3><?php echo e(++$a); ?>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PROJECT DETAILS </h3>
                        <table class="table table-bordered table-responsive table-striped">
                            <tbody>
                                <tr style="background-color: #68A12E;color: #FFFFFF;"><td>Document Title</td><td><?php echo e($report->document_title); ?></td></tr>
                                <tr><td>Project Name</td><td><?php echo e($report->project->name); ?></td></tr>
                                <tr><td>Submission Date</td><td><?php echo e(DateHelper::formatDate($report->submission_date)); ?></td></tr>
                                <tr><td>Version</td><td><?php echo e($report->version); ?></td></tr>
                            </tbody>
                        </table>
                        <h3><?php echo e(++$a); ?>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;INTRODUCTION </h3>
                        <p>
                            Lorem Lipsum
                        </p>
                        <h3><?php echo e(++$a); ?>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TERMS, DEFINITIONS, AND LEGENDS </h3>
                        <p>
                            Lorem Lipsum
                        </p>
                        <h3><?php echo e(++$a); ?>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;METHODOLOGY </h3>
                        <p>
                            Lorem Lipsum
                        </p>
                        <h3><?php echo e(++$a); ?>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;EXECUTIVE SUMMARY </h3>
                        <p>
                            The purpose of reporting existing security loopholes in the web application and also to
                            provide with recommendation to rectify the problems. This Web Application Security
                            Assessment Report assesses the use of resources and controls to eliminate and/or
                            manage vulnerabilities that are exploitable by threats internal and external infrastructure. 
                            The scope of this security assessment effort was limited to the security controls applicable to the system environment.
                        </p>
                        <p>
                            The methodology used to conduct this security assessment is qualitative, and no
                            attempt was made to determine any annual loss expectancies, asset cost projections,
                            or cost-effectiveness of security safeguard recommendations. The Approach uses
                            OWASP, WASC and SANS and other industry best practices that are used industry-wide
                            by security and audit professionals.
                        </p>
                        <?php ($b = 1); ?>
                        <h4><?php echo e($a); ?>.<?php echo e($b); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Graph Representations of the Vulnerabilities </h4>
                        <p>The following graph presents the total number of vulnerability and their severity levels</p>
                        <p>TO DO: Make Graph</p>
                        <h4><?php echo e($a); ?>.<?php echo e(++$b); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Summary of the Key Observation </h4>
                        <p>Following table presents a list of identified vulnerabilities and their severity level with their current status:</p>
                        <table class="table table-bordered table-responsive table-striped">
                            <thead>
                                <tr>
                                    <th>S No</th>
                                    <th>Vulnerability Name</th>
                                    <th class="text-center">Severity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php ($c = 1); ?>
                                <?php if(count($report->issues)): ?>
                                <?php foreach($report->issues as $issue): ?>
                                    <tr>
                                        <td><?php echo e($c); ?></td>
                                        <td><?php echo e($issue->name); ?></td>
                                        <td style="background-color: <?php echo e($issue->severity->color_code); ?>" class="text-center"><?php echo e(strtoupper($issue->severity->level)); ?></td>
                                    </tr>
                                    <?php ($c++); ?>
                                <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="3"><i>No rows found</i></td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </section>
                    <hr />
                    <section id="issue">
                        <h3><?php echo e(++$a); ?>.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Detailed Report and Recommendations</h3>
                        <?php ($b = 1); ?>
                        <?php if(count($report->issues)): ?>
                        <?php foreach($report->issues as $issue): ?>
                            <div class="issue-div">
                                <table class="table table-bordered issue-table">
                                    <thead><tr style="background-color: #33CCCC;"><th colspan="2"><?php echo e($a.'.'.$b.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$issue->name); ?></th></tr></thead>
                                    <tbody>
                                        <tr>
                                            <th style="width: 25%">Vulnerability Name</th><td><?php echo e($issue->vulnerability->name); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Severity</th><td style="background-color: <?php echo e($issue->severity->color_code); ?>"><?php echo e(strtoupper($issue->severity->level)); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Description</th><td><?php echo nl2br(e($issue->description)); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Recommendation</th><td><?php echo nl2br(e($issue->recommendation)); ?></td>
                                        </tr>
                                        <tr>
                                            <th>URL</th><td><?php echo e($issue->affected_url); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Parameter</th><td><?php echo e($issue->affected_params); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php if(count($issue->screenshots)): ?>
                                <?php ($c = 1); ?>
                                <?php ($screen_counter = count($issue->screenshots)); ?>
                                <?php foreach($issue->screenshots as $screenshot): ?>
                                    <div class="screenshot-container">
                                        <b>Screenshot <?php echo e($screen_counter > 1 ? $c : ''); ?>:</b><br /><br />
                                        <p><?php echo e($screenshot->img_description); ?></p><br />
                                        <img style="max-width: 100%" class="image" src="<?php echo e(ImageHelper::getSecureImageURL($screenshot->img_path, $screenshot->img_name)); ?>" />
                                        <hr />
                                    </div>
                                    <?php ($c++); ?>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <?php ($b++); ?>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <p><i>No issue reported</i></p>
                        <?php endif; ?>                        
                        <hr />
                    </section>
                    <hr />
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>