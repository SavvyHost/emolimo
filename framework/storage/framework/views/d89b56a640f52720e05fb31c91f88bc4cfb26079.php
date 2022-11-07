<?php $__env->startSection('extra_css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/bootstrap-datetimepicker.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection("breadcrumb"); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('bookings.index')); ?>"><?php echo app('translator')->get('menu.bookings'); ?></a></li>
<li class="breadcrumb-item active"><?php echo app('translator')->get('fleet.edit_booking'); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-md-12">
    <div class="card card-warning">
      <div class="card-header">
        <h3 class="card-title"><?php echo app('translator')->get('fleet.edit_booking'); ?>
        </h3>
      </div>

      <div class="card-body">
        <?php if(count($errors) > 0): ?>
        <div class="alert alert-danger">
          <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>
        <?php endif; ?>
        <div class="alert alert-info hide fade in alert-dismissable" id="msg_driver" style="display: none;">
          <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
          Your current driver is not available in the chosen times. Available driver has been selected.
        </div>
        <div class="alert alert-info hide fade in alert-dismissable" id="msg_vehicle" style="display: none;">
          <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
          Your current vehicle is not available in the chosen times. Available vehicle has been selected.
        </div>

        <?php echo Form::open(['route' => ['bookings.update',$data->id],'method'=>'PATCH']); ?>

        <?php echo Form::hidden('user_id',Auth::user()->id); ?>

        <?php echo Form::hidden('status',0); ?>

        <?php echo Form::hidden('id',$data->id); ?>


        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <?php echo Form::label('customer_id',__('fleet.selectCustomer'), ['class' => 'form-label']); ?>

              <select id="customer_id" disabled="" name="customer_id" class="form-control xxhvk" required>
                <option selected value="<?php echo e($data->customer['id']); ?>"><?php echo e($data->customer['name']); ?></option>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <?php echo Form::label('pickup',__('fleet.pickup'), ['class' => 'form-label']); ?>

              <div class='input-group date' id='from_date'>
                <div class="input-group-prepend">
                  <span class="input-group-text"><span class="fa fa-calendar"></span></span>
                </div>
                <?php echo Form::text('pickup',$data->pickup,['class'=>'form-control','required']); ?>

              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <?php echo Form::label('dropoff',__('fleet.dropoff'), ['class' => 'form-label']); ?>

              <div class='input-group date' id='to_date'>
                <div class="input-group-prepend">
                  <span class="input-group-text"><span class="fa fa-calendar"></span>
                  </span>
                </div>
                <?php echo Form::text('dropoff',$data->dropoff,['class'=>'form-control','required']); ?>

              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <?php echo Form::label('vehicle_id',__('fleet.selectVehicle'), ['class' => 'form-label']); ?>

              <select id="vehicle_id" name="vehicle_id" class="form-control" required>
                <option value="">-</option>
                <?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($vehicle['id']); ?>" <?php if($vehicle['id']==$data->vehicle_id): ?> selected <?php endif; ?>>
                  <?php echo e($vehicle->maker->make); ?> - <?php echo e($vehicle->vehiclemodel->model); ?> - <?php echo e($vehicle->license_plate); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <?php echo Form::label('vehicle_id',__('fleet.selectDriver'), ['class' => 'form-label']); ?>

              <select id="driver_id" name="driver_id" class="form-control" required>
                <option value="">-</option>
                <?php $__currentLoopData = $drivers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $driver): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($driver->id); ?>" <?php if($driver->id == $data->driver_id): ?> selected
                  <?php endif; ?>><?php echo e($driver->name); ?><?php if($driver->getMeta('is_active') != 1): ?>
                  ( <?php echo app('translator')->get('fleet.in_active'); ?> ) <?php endif; ?></option>
                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <?php echo Form::label('travellers',__('fleet.no_travellers'), ['class' => 'form-label']); ?>

              <?php echo Form::number('travellers',$data->travellers,['class'=>'form-control','min'=>1]); ?>

            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <?php echo Form::label('pickup_addr',__('fleet.pickup_addr'), ['class' => 'form-label']); ?>

              <?php echo Form::text('pickup_addr',$data->pickup_addr,['class'=>'form-control','required','style'=>'height:100px']); ?>

            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <?php echo Form::label('dest_addr',__('fleet.dropoff_addr'), ['class' => 'form-label']); ?>

              <?php echo Form::text('dest_addr',$data->dest_addr,['class'=>'form-control','required','style'=>'height:100px']); ?>

            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <?php echo Form::label('note',__('fleet.note'), ['class' => 'form-label']); ?>

              <?php echo Form::textarea('note',$data->note,['class'=>'form-control','placeholder'=>__('fleet.book_note'),'style'=>'height:100px']); ?>

            </div>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="form-group col-md-6">
            <?php echo Form::label('udf1',__('fleet.add_udf'), ['class' => 'col-xs-5 control-label']); ?>

            <div class="row">
              <div class="col-md-8">
                <?php echo Form::text('udf1', null,['class' => 'form-control']); ?>

              </div>
              <div class="col-md-4">
                <button type="button" class="btn btn-info add_udf"> <?php echo app('translator')->get('fleet.add'); ?></button>
              </div>
            </div>
          </div>
        </div>
        <?php if($udfs != null): ?>
        <?php $__currentLoopData = $udfs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="row">
          <div class="col-md-8">
            <div class="form-group"> <label class="form-label text-uppercase"><?php echo e($key); ?></label> <input type="text"
                name="udf[<?php echo e($key); ?>]" class="form-control" required value="<?php echo e($value); ?>"></div>
          </div>
          <div class="col-md-4">
            <div class="form-group" style="margin-top: 30px"><button class="btn btn-danger" type="button"
                onclick="this.parentElement.parentElement.parentElement.remove();">Remove</button> </div>
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <div class="blank"></div>
        <div class="col-md-12">
          <?php echo Form::submit(__('fleet.update'), ['class' => 'btn btn-warning']); ?>

        </div>
        <?php echo Form::close(); ?>

      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection("script"); ?>
<script src="<?php echo e(asset('assets/js/moment.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datetimepicker.js')); ?>"></script>
<script type="text/javascript">
  $(".add_udf").click(function () {
    // alert($('#udf').val());
    var field = $('#udf1').val();
    if(field == "" || field == null){
      alert('Enter field name');
    }

    else{
      $(".blank").append('<div class="row"><div class="col-md-8">  <div class="form-group"> <label class="form-label">'+ field.toUpperCase() +'</label> <input type="text" name="udf['+ field +']" class="form-control" placeholder="Enter '+ field +'" required></div></div><div class="col-md-4"> <div class="form-group" style="margin-top: 30px"><button class="btn btn-danger" type="button" onclick="this.parentElement.parentElement.parentElement.remove();">Remove</button> </div></div></div>');
      $('#udf1').val("");
    }
  });
</script>
<script type="text/javascript">
  $('#customer_id').select2({placeholder: "<?php echo app('translator')->get('fleet.selectCustomer'); ?>"});
  $('#driver_id').select2({placeholder: "<?php echo app('translator')->get('fleet.selectDriver'); ?>"});
  $('#vehicle_id').select2({placeholder: "<?php echo app('translator')->get('fleet.selectVehicle'); ?>"});
  function get_driver(from_date,to_date){
    var id=$("input:hidden[name=id]").val();
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      type: "POST",
      url: "<?php echo e(url('admin/get_driver')); ?>",
      data: "req=edit&id="+id+"&from_date="+from_date+"&to_date="+to_date,
      success: function(data2){
        $("#driver_id").empty();
        $("#driver_id").select2({placeholder: "<?php echo app('translator')->get('fleet.selectDriver'); ?>",data:data2.data});
        // if(data2.show_error=="yes"){
        //   // alert("test");
        // $("#msg_driver").removeClass("hide").fadeIn(1000);
        // } else {
        // $("#msg_driver").addClass("hide").fadeIn(1000);
        // }
      },
      error: function(data){
      var errors = $.parseJSON(data.responseText);

        $(".print-error-msg").find("ul").html('');
      $(".print-error-msg").css('display','block');
      $.each( errors, function( key, value ) {
        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
      });

      },
      dataType: "json"
    });
  }

  function get_vehicle(from_date,to_date){
    var id=$("input:hidden[name=id]").val();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      type: "POST",
      url: "<?php echo e(url('admin/get_vehicle')); ?>",
      data: "req=edit&id="+id+"&from_date="+from_date+"&to_date="+to_date,
      success: function(data2){
        $("#vehicle_id").empty();
        $("#vehicle_id").select2({placeholder: "<?php echo app('translator')->get('fleet.selectVehicle'); ?>",data:data2.data});
        // if(data2.show_error=="yes"){

        // $("#msg_vehicle").removeClass("hide").fadeIn(1000);
        // } else {
        // $("#msg_vehicle").addClass("hide").fadeIn(1000);
        // }
      },
      error: function(data){
        var errors = $.parseJSON(data.responseText);
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display','block');
        $.each( errors, function( key, value ) {
        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
        });
      },
      dataType: "json"
    });
  }

  $(document).ready(function() {
    $('#pickup').datetimepicker({format: 'YYYY-MM-DD HH:mm:ss',sideBySide: true,icons: {
              previous: 'fa fa-arrow-left',
              next: 'fa fa-arrow-right',
              up: "fa fa-arrow-up",
              down: "fa fa-arrow-down"
    }});

    $('#dropoff').datetimepicker({format: 'YYYY-MM-DD HH:mm:ss',sideBySide: true,icons: {
              previous: 'fa fa-arrow-left',
              next: 'fa fa-arrow-right',
              up: "fa fa-arrow-up",
              down: "fa fa-arrow-down"
    }});

    $("#pickup").on("dp.change", function (e) {
      if($('#dropoff').val() == null || $('#dropoff').val() == ""){
        var to_date=e.date.format("YYYY-MM-DD HH:mm:ss");
      }
      else{
        var to_date=$('#dropoff').data("DateTimePicker").date().format("YYYY-MM-DD HH:mm:ss");
      }
      var from_date=e.date.format("YYYY-MM-DD HH:mm:ss");

      get_driver(from_date,to_date);
      get_vehicle(from_date,to_date);

      $('#dropoff').data("DateTimePicker").minDate(e.date);
    });

    $("#dropoff").on("dp.change", function (e) {
      $('#pickup').data("DateTimePicker").date().format("YYYY-MM-DD HH:mm:ss")
      var from_date=$('#pickup').data("DateTimePicker").date().format("YYYY-MM-DD HH:mm:ss");
      var to_date=e.date.format("YYYY-MM-DD HH:mm:ss");
      get_driver(from_date,to_date);
      get_vehicle(from_date,to_date);
    });
  });
</script>
<?php if(Hyvikk::api('google_api') == "1"): ?>
<script>
  function initMap() {
    $('#pickup_addr').attr("placeholder","");
    $('#dest_addr').attr("placeholder","");
      // var input = document.getElementById('searchMapInput');
      var pickup_addr = document.getElementById('pickup_addr');
      new google.maps.places.Autocomplete(pickup_addr);

      var dest_addr = document.getElementById('dest_addr');
      new google.maps.places.Autocomplete(dest_addr);

      // autocomplete.addListener('place_changed', function() {
      //     var place = autocomplete.getPlace();
      //     document.getElementById('pickup_addr').innerHTML = place.formatted_address;
      // });
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo e(Hyvikk::api('api_key')); ?>&libraries=places&callback=initMap"
  async defer></script>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/emolimo.savvyhost.co/httpdocs/framework/resources/views/bookings/edit.blade.php ENDPATH**/ ?>