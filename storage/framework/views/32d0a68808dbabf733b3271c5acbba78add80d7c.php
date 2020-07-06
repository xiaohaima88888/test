<?php $__env->startSection("content"); ?>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-10 col-xs-6">
                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title">登录日志列表</h3>
                    </div>
                    
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody><tr>
                                <th style="width: 10px">id</th>
                                <th>用户ID</th>
                                <th>访问路径</th>
                                <th>访问方式</th>
                                <th>IP</th>
                                <th>时间</th>
                            </tr>
                            <?php $__currentLoopData = $notices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($notice->id); ?></td>
                                
                                    <td><?php echo e($notice->uid); ?></td>
                                    <td><?php echo e($notice->path); ?></td>
                                    <td><?php echo e($notice->method); ?></td>
                                    <td><?php echo e($notice->ip); ?></td>
                                    <td><?php echo e($notice->updated_at); ?></td>
                                    <td></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody></table>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("admin.layout.main", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>