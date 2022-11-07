

<?php $__env->startSection('content'); ?>
        <section class="mt-120 mb-4">
            <h2 class="primary text-center bg-strip"><?php echo app('translator')->get('frontend.booking_history'); ?></h2>
        </section>
        <!-- Start bookings -->
        <section>
            <div class="container pb-5">
                
                <?php if($bookings->count() > 0): ?>
                    <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="booking">
                        <span class="booking-date">
                            <?php echo e(date((Hyvikk::get('date_format')) ? Hyvikk::get('date_format') : 'd-m-Y', strtotime($booking->journey_date))); ?>

                        </span>
                        <span class="booking-status pill danger filled"> <?php echo e(($booking->ride_status)?$booking->ride_status:"Pending"); ?> </span>
                        <div class="row">
                            <div class="col-lg-4">
                                <h6 class="primary"><?php echo app('translator')->get('frontend.from'); ?></h6>
                                <p> <?php echo e($booking->pickup_addr); ?></p>
                            </div>
                            <div class="col-lg-4">
                                <h6 class="primary"><?php echo app('translator')->get('frontend.to'); ?></h6>
                                <p> <?php echo e($booking->dest_addr); ?></p>
                            </div>
                            <div class="col-lg-4">
                                <h6 class="primary"><?php echo app('translator')->get('frontend.payment'); ?></h6>
                                <p> <?php echo e(($booking->payment == 1)?"Success":"Pending"); ?></p>
                            </div>
                            <div class="col-sm-12 mt-3">
                                <div class="pills-container">
                                    <?php if($booking->driving_time): ?>
                                    <span class="pill dark">
                                        <img src="<?php echo e(asset('assets/frontend/icons/fleet-booking-time.png')); ?>" alt="">
                                        <?php echo e($booking->driving_time); ?>

                                    </span>
                                    <?php endif; ?>

                                    <?php if($booking->tax_total): ?><span class="pill dark"> <span class="rupees"> <?php echo e(Hyvikk::get('currency')); ?> </span><?php echo e($booking->tax_total); ?></span><?php endif; ?>
                                    <?php if($booking->total_kms): ?><span class="pill dark"> <img src="<?php echo e(asset('assets/frontend/icons/fleet-kilometer.png')); ?>" alt=""> <?php echo e($booking->total_kms); ?> <?php echo e(Hyvikk::get('dis_format')); ?> </span><?php endif; ?>
                                    
                                </div>
                            </div>
                            <div class="col-sm-12 mt-3">
                                <div class="pills-container">
                                    <?php ($methods = json_decode(Hyvikk::payment('method'))); ?>
                                    <?php if($booking->receipt == 1 && $booking->payment == 0): ?>
                                    <?php echo Form::open(['route' => 'redirect-payment','method'=>'post']); ?>

                                    <?php echo Form::hidden('booking_id',$booking->id); ?>

                                    <div class="form-group">
                                        <?php $__currentLoopData = $methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="pretty p-default p-round">
                                            <input type="radio" name="method" value="<?php echo e($method); ?>" checked>
                                            <div class="state custom-state">
                                                <label class=""><?php echo e($method); ?></label>
                                            </div>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <button type="submit" class="btn btn-success"><?php echo app('translator')->get('frontend.pay_now'); ?></button>
                                    </div>                                   
                                    <?php echo Form::close(); ?>

                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <h4 class="text-center">No Record Found.</h4>    
                <?php endif; ?>
            </div>
        </section>
        <!-- End bookings -->
        <!-- Contact tiles -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/emolimo.savvyhost.co/httpdocs/framework/resources/views/frontend/booking_history.blade.php ENDPATH**/ ?>