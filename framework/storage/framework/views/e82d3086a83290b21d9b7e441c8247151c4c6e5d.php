<div class="btn-group">
    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
      <span class="fa fa-gear"></span>
      <span class="sr-only">Toggle Dropdown</span>
    </button>
    <div class="dropdown-menu custom" role="menu">
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Vehicles edit')): ?><a class="dropdown-item" href="<?php echo e(url("admin/vehicles/".$row->id."/edit")); ?>"> <span aria-hidden="true" class="fa fa-edit" style="color: #f0ad4e;"></span> <?php echo app('translator')->get('fleet.edit'); ?></a><?php endif; ?>
      <?php echo Form::hidden("id",$row->id); ?>

      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Vehicles delete')): ?><a class="dropdown-item" data-id="<?php echo e($row->id); ?>" data-toggle="modal" data-target="#myModal"><span aria-hidden="true" class="fa fa-trash" style="color: #dd4b39"></span> <?php echo app('translator')->get('fleet.delete'); ?></a><?php endif; ?>
      <a class="dropdown-item openBtn" data-id="<?php echo e($row->id); ?>" data-toggle="modal" data-target="#myModal2" id="openBtn">
      <span class="fa fa-eye" aria-hidden="true" style="color: #398439"></span> <?php echo app('translator')->get('fleet.view_vehicle'); ?>
      </a>
    </div>
  </div>
  <?php echo Form::open(['url' => 'admin/vehicles/'.$row->id,'method'=>'DELETE','class'=>'form-horizontal','id'=>'form_'.$row->id]); ?>


  <?php echo Form::hidden("id",$row->id); ?>


  <?php echo Form::close(); ?><?php /**PATH /var/www/vhosts/emolimo.savvyhost.co/httpdocs/framework/resources/views/vehicles/list-actions.blade.php ENDPATH**/ ?>