<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo e(Hyvikk::get('app_name')); ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
 <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/cdn/bootstrap.min.css')); ?>" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/cdn/font-awesome.min.css')); ?>">
  <!-- Ionicons -->
  <link href="<?php echo e(asset('assets/css/cdn/ionicons.min.css')); ?>" rel="stylesheet">
  <!-- Theme style -->
   <link href="<?php echo e(asset('assets/css/AdminLTE.min.css')); ?>" rel="stylesheet">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/cdn/fonts.css')); ?>">
  <style type="text/css">
    body {
      height: auto;
    }
    @media  print{@page  {size: landscape}}
  </style>
</head>
<body onload="window.print();">
<?php ($date_format_setting=(Hyvikk::get('date_format'))?Hyvikk::get('date_format'):'d-m-Y'); ?>

  <div class="wrapper">
    <section class="invoice">
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <span class="logo-lg">
              <img src="<?php echo e(asset('assets/images/'. Hyvikk::get('icon_img') )); ?>" class="navbar-brand" style="margin-top: -15px">
              <?php echo e(Hyvikk::get('app_name')); ?>

            </span>
              <small class="pull-right"> <b><?php echo app('translator')->get('fleet.date'); ?> : </b><?php echo e(date($date_format_setting,strtotime($i->booking_income->date))); ?></small>
          </h2>
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
         <b> To</b>
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
        <div class="col-xs-6">
          <?php if(Hyvikk::get('invoice_text') != null): ?>
          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
           <?php echo e(Hyvikk::get('invoice_text')); ?>

          </p>
          <?php endif; ?>
        </div>
        <div class="col-xs-6 pull-right">
          <p class="lead"></p>
          <div class="table-responsive">
            <table class="table">
               <?php if($booking->vehicle_id != null): ?>
              <tr>
                <th style="width:50%"><?php echo app('translator')->get('fleet.vehicle'); ?>:</th>
                <td> <?php echo e($booking->vehicle->maker['make']); ?> - <?php echo e($booking->vehicle->vehiclemodel['model']); ?> - <?php echo e($booking->vehicle['license_plate']); ?></td>
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
                <td><?php echo e(Hyvikk::get('currency')); ?> <?php echo e($booking->total); ?> </td>
              </tr>
              <tr>
                <th><?php echo app('translator')->get('fleet.total_tax'); ?> (%) :</th>
                <td><?php echo e(($booking->total_tax_percent) ? $booking->total_tax_percent : 0); ?> %</td>
              </tr>
              <tr>
                <th><?php echo app('translator')->get('fleet.total'); ?> <?php echo app('translator')->get('fleet.tax_charge'); ?> :</th>
                <td><?php echo e(Hyvikk::get('currency')); ?> <?php echo e(($booking->total_tax_charge_rs) ? $booking->total_tax_charge_rs : 0); ?> </td>
              </tr>
              <tr>
                <th><?php echo app('translator')->get('fleet.total'); ?>:</th>
                <td><?php echo e(Hyvikk::get('currency')); ?> <?php echo e($i->booking_income->amount); ?></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </section>
  </div>
</body>
</html><?php /**PATH /var/www/vhosts/emolimo.savvyhost.co/httpdocs/framework/resources/views/bookings/print.blade.php ENDPATH**/ ?>