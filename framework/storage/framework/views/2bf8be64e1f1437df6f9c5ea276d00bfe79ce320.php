<?php ($date_format_setting=(Hyvikk::get('date_format'))?Hyvikk::get('date_format'):'d-m-Y'); ?>
<?php $__env->startSection("breadcrumb"); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('bookings.index')); ?>"><?php echo app('translator')->get('menu.bookings'); ?></a></li>
<li class="breadcrumb-item active"><?php echo app('translator')->get('fleet.booking_receipt'); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="invoice p-3 mb-3">
  <div class="row">
    <div class="col-12">
      <h4>
        <span class="logo-lg">
          <img src="<?php echo e(asset('assets/images/'. Hyvikk::get('icon_img') )); ?>" class="navbar-brand"
            style="margin-top: -15px">
          <?php echo e(Hyvikk::get('app_name')); ?>

        </span>
        <small class="float-right"> <b><?php echo app('translator')->get('fleet.date'); ?> : </b><?php echo e(date($date_format_setting,strtotime($i->booking_income->date))); ?></small>
      </h4>
    </div>
  </div>
  <div class="row invoice-info">
    <div class="col-sm-4 invoice-col">
      <b>From</b>
      <address>
        <?php echo e(Hyvikk::get('badd1')); ?>

        <br>
        <?php echo e(Hyvikk::get('badd2')); ?>

        <br>
        <?php echo e(Hyvikk::get('city')); ?>,

        <?php echo e(Hyvikk::get('state')); ?>

        <br>
        <?php echo e(Hyvikk::get('country')); ?>

      </address>
    </div>
    <div class="col-sm-4 invoice-col">
      <b><?php if($booking->customer->getMeta('address') != null): ?> To <?php endif; ?></b>
      <address>
        <?php echo nl2br(e($booking->customer->getMeta('address'))); ?>

      </address>
    </div>
    <div class="col-sm-4 invoice-col">
      <b>Invoice#</b>
      <?php echo e($i['income_id']); ?>

      <br>
      <b><?php echo e($booking->customer->name); ?></b>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-6 invoice-col">
      <strong> <?php echo app('translator')->get('fleet.pickup_addr'); ?>:</strong>
      <address>
        <?php echo e($booking->pickup_addr); ?>

        <br>
        <?php echo app('translator')->get('fleet.pickup'); ?>:
        <b> <?php echo e(date($date_format_setting.' g:i A',strtotime($booking->pickup))); ?></b>
      </address>
    </div>
    <div class="col-sm-6 invoice-col">
      <strong><?php echo app('translator')->get('fleet.dropoff_addr'); ?>:</strong>
      <address>
        <?php echo e($booking->dest_addr); ?>

        <br>
        <?php echo app('translator')->get('fleet.dropoff'); ?>:
        <b><?php echo e(date($date_format_setting.' g:i A',strtotime($booking->dropoff))); ?></b>
      </address>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6"></div>
    <div class="col-md-6 pull-right">
      <p class="lead"></p>
      <div class="table-responsive">
        <table class="table">
          <?php if($booking->vehicle_id != null): ?>
          <tr>
            <th style="width:50%"><?php echo app('translator')->get('fleet.vehicle'); ?>:</th>
            <td>
              <?php echo e($booking->vehicle->maker['make']); ?> - <?php echo e($booking->vehicle->vehiclemodel['model']); ?> -
              <?php echo e($booking->vehicle['license_plate']); ?>

            </td>
          </tr>
          <?php endif; ?>
          <?php if($booking->driver_id != null): ?>
          <tr>
            <th><?php echo app('translator')->get('fleet.driver'); ?>:</th>
            <td><?php echo e($booking->driver->name); ?></td>
          </tr>
          <?php endif; ?>
          <tr>
            <th><?php echo app('translator')->get('fleet.mileage'); ?>:</th>
            <td><?php echo e($i->booking_income->mileage); ?> <?php echo e(Hyvikk::get('dis_format')); ?></td>
          </tr>
          <tr>
            <th><?php echo app('translator')->get('fleet.waitingtime'); ?>:</th>
            <td>
              <?php echo e($booking->getMeta('waiting_time')); ?>

            </td>
          </tr>
          <tr>
            <th><?php echo app('translator')->get('fleet.amount'); ?>:</th>
            <td> <?php echo e(Hyvikk::get('currency')); ?> <?php echo e($booking->total); ?></td>
          </tr>
          <tr>
            <th><?php echo app('translator')->get('fleet.total_tax'); ?> (%) :</th>
            <td><?php echo e(($booking->total_tax_percent) ? $booking->total_tax_percent : 0); ?> %</td>
          </tr>
          <tr>
            <th><?php echo app('translator')->get('fleet.total'); ?> <?php echo app('translator')->get('fleet.tax_charge'); ?> :</th>
            <td><?php echo e(Hyvikk::get('currency')); ?> <?php echo e(($booking->total_tax_charge_rs) ? $booking->total_tax_charge_rs : 0); ?>

            </td>
          </tr>
          <tr>
            <th><?php echo app('translator')->get('fleet.total'); ?>:</th>
            <td><?php echo e(Hyvikk::get('currency')); ?> <?php echo e($i->booking_income->amount); ?></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
        <?php echo e(Hyvikk::get('invoice_text')); ?>

      </p>
    </div>
  </div>
  <div class="row no-print">
    <div class="col-xs-12">
      <a href="<?php echo e(url('admin/print/'.$id)); ?>" target="_blank" class="btn btn-danger"><i class="fa fa-print"></i>
        <?php echo app('translator')->get('fleet.print'); ?></a>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/emolimo.savvyhost.co/httpdocs/framework/resources/views/bookings/receipt.blade.php ENDPATH**/ ?>