

<?php $__env->startSection('content'); ?>
        <section class="mt-120 mb-4"></section>
        <section class="booking-section py-5 my-5 text-white" id="edit_profile">
            <h1 class="text-center"><?php echo app('translator')->get('frontend.change_details'); ?></h1>
            <div class="container">
                <div class="row">
                    <?php if(session('success')): ?>
                        <div class="alert alert-success col-sm-6 offset-sm-3 text-center">
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>

                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger col-sm-4 offset-sm-4">
                            <ul>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <div class="col-sm-12 flex-col-center">
                        <form action="<?php echo e(url('edit_profile')); ?>" class="mt-4 w-100" method="POST" id="profile_form">
                            <?php echo csrf_field(); ?>

                            <?php echo Form::hidden('id',$detail->id); ?>

                            <div class="form-inputs mt-5 w-100">
                                <div class="row w-100 m-0 p-0">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="label-animate"><?php echo app('translator')->get('frontend.first_name'); ?></label>
                                            <input type="text" class="text-input" name="first_name" value="<?php echo e($detail->first_name); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="label-animate"><?php echo app('translator')->get('frontend.last_name'); ?></label>
                                            <input type="text" class="text-input" name="last_name" value="<?php echo e($detail->last_name); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="checkboxes form-group">
                                            <div class="pretty p-default p-round">
                                                <input type="radio" name="gender" value="1" checked>
                                                <div class="state custom-state">
                                                    <label class="text-white"><?php echo app('translator')->get('frontend.male'); ?></label>
                                                </div>
                                            </div>
                                            <div class="pretty p-default p-round">
                                                <input type="radio" name="gender" value="0" <?php echo e(($detail->gender == "0") ? "checked" : ""); ?>>
                                                <div class="state custom-state">
                                                    <label class="text-white"><?php echo app('translator')->get('frontend.female'); ?></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="label-animate"><?php echo app('translator')->get('frontend.email'); ?></label>
                                            <input type="text" class="text-input" name="email" value="<?php echo e($detail->email); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="label-animate"><?php echo app('translator')->get('frontend.phone'); ?></label>
                                            <input type="text" class="text-input" name="phone" value="<?php echo e($detail->mobno); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <textarea class="text-input" cols="30" rows="4" name="address" placeholder="<?php echo app('translator')->get('frontend.your_address'); ?>"><?php echo e($detail->address); ?></textarea>
                                    </div>
                                    
                                    <button class="tab-button mx-auto mt-3" type="submit" id="booking"><?php echo app('translator')->get('frontend.update'); ?></button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/emolimo.savvyhost.co/httpdocs/framework/resources/views/frontend/edit_profile.blade.php ENDPATH**/ ?>