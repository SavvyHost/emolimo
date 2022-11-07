
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/custom-switch.css')); ?>" />
    <style>
        .close{
            height: 100% !important;
        }
        .booking-section input::-webkit-outer-spin-button,
        .booking-section input::-webkit-inner-spin-button {
            /* display: none; <- Crashes Chrome on hover */
            -webkit-appearance: none;
            margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
        }

        .booking-section input[type=number] {
            -moz-appearance:textfield; /* Firefox */
        }
        .pessengers_input {
            width: 65px;
            color: white;
            background: transparent;
            padding: 0;
            box-shadow: none !important;
            font-size: 20px;
            text-align: center;
            -moz-appearance: textfield;
            -webkit-appearance: none;
        }
        .increase_persons, .decrease_persons{
            background: white;
            display: inline-block;
            height: 20px;
            width: 20px;
            border-radius: 50%;
            color: #00cc37;
            text-align: center;
            cursor: pointer;
            border: none !important;
            padding: 0 !important;
        }
        .increase_persons:focus, .decrease_persons:focus{
            border: none;
            outline: none;
        }
        .pessengers_group{
            display: flex;
            justify-content: space-between;
        }
        .hide-return-journey{
            display: none;
        }
        header{
            background-color: white !important;
        }
        .nav-item:after{
            background-color: white !important;
        }
        .navbar-brand > img{
            height: 60px !important;
        }
        .booking-section {
            margin-top: 5rem !important;
        }
        .table td{
            text-align: center;
            vertical-align: middle;
        }
        .table img{
            width: 200px !important;
        }
        .persons{
            background: black;
            padding: 6px 12px;
            border-radius: 20px;
            color: white;
        }
        .price{
            display: block;
            text-align: center;
            color: white;
            font-size: 22px;
            font-weight: 900;
        }
        .custom-btn{
            background: black;
            color: #ffffff;
            font-size: 16px;
            font-weight: bold;
            border-radius: 40px;
        }
        #distance-div{
            height: 80px !important;
            width: 100%;
            font-size: 17px;
            font-weight: 400;
            text-align: center;
        }
        #distance{
            padding: 7px 14px;
            font-size: 17px;
            color: black;
            font-weight: 600;
        }
        #map{
            width: 100%;
            height: calc(100% - 80px);
        }

        .card-small-title{
            font-size: 14px;
        }
        .table td {
            text-align: left !important;
            vertical-align: middle !important;
            color: black;
        }
        .price-div{
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            color: black;
        }
        .card-header{
            padding: 6px 12px;
            background: #00cc37;
        }
        .card-body{
            color: black;
            background: white;
        }
        .btn-primaryColor{
            background: #00cc37;
            color: white;
        }
        .booking-section {
             background-color: #f5f5f5 !important;
        }
        .booking-section a,
        .booking-section a:hover,
        .booking-section a:active,
        .booking-section a:focus {
            text-decoration: underline !important;
        }
        .booking-section .form-group {
            margin-bottom: 14px !important;
        }
        .min, .sec{
            color: red;
        }

        .login-modal-wrapper.active {
            display: block;
            width: 100%;
        }
        .booking-section .checkboxes .pretty .custom-state label::before {
            border: 3px solid #28a745 !important;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Booking section -->
    <section class="booking-section py-5 my-5 text-white" id="book_now">
        <div class="container">
            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissable mt-3 xs-mt" role="alert">
                    <?php echo e(session('success')); ?>

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Journey Details
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tr>
                                    <td colspan="2" class="card-small-title" style="text-align: center !important;">Booking allocated for you at this price:<div class="price-div"><?php echo e(@$data['price']); ?></div><div>Time left: <span class="min">10m</span> <span class="sec">00s</span></div></td>
                                </tr>
                                <tr>
                                    <td>Pickup</td>
                                    <td><?php echo e(@$data['pickup_address']); ?></td>
                                </tr>
                                <tr>
                                    <td>Destination</td>
                                    <td><?php echo e(@$data['dropoff_address']); ?></td>
                                </tr>
                                <tr>
                                    <td>Outgoing Date</td>
                                    <td><?php echo e(isset($data['pickup_date']) ? date('l jS F Y', strtotime(@$data['pickup_date'])) . ' - ' . @$data['pickup_time'] : ""); ?></td>
                                </tr>
                                <tr>
                                    <td>Return Date</td>
                                    <?php if(!isset($data)): ?>
                                        <td></td>
                                    <?php else: ?>
                                        <td><?php echo e(isset($data['return_date']) && isset($data['return_date']) ? date('l jS F Y', strtotime(@$data['return_date'])) . ' - ' . @$data['return_time'] : "No Return Journey"); ?></td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <td>Passengers</td>
                                    <td><?php echo e(@$data['no_of_person']); ?></td>
                                </tr>
                                <tr>
                                    <td>Vehicle</td>
                                    <?php if(!isset($data)): ?>
                                        <td></td>
                                    <?php else: ?>
                                        <td>
                                            <h5><?php echo e(@$vehicle->displayname); ?></h5>
                                            <span class="persons"><?php echo e(@$vehicle->seats); ?> <i class="fas fa-users"></i></span>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: center !important;">Passengers Safety <a href="#">Find out more</a></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: center !important;">
                                        <button class="btn btn-primaryColor">Edit Booking</button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            Account Details
                        </div>
                        <div class="card-body p-3">
                            Would you like to <a class="link" data-target="CustomLoginModal">login</a> or <a class="link" data-target="login-modal">create an account</a>?
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            Customer Details
                        </div>
                        <div class="card-body">
                            <?php if(count($errors->customer) > 0): ?>
                                <div class="alert alert-danger alert-dismissible fade show xs-mt mt-3" role="alert">
                                    <ul class="m-0">
                                        <?php $__currentLoopData = $errors->customer->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><?php echo e($error); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>
                            <form action="<?php echo e(route('registerCustomerAndBooking')); ?>" method="POST" id="customer_form" style="padding: 14px 12px 12px;">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="pickup_address" value="<?php echo e(@$data['pickup_address']); ?>" />
                                <input type="hidden" name="dropoff_address" value="<?php echo e(@$data['dropoff_address']); ?>" />
                                <input type="hidden" name="pickup_date" value="<?php echo e(@$data['pickup_date']); ?>" />
                                <input type="hidden" name="pickup_time" value="<?php echo e(@$data['pickup_time']); ?>" />
                                <input type="hidden" name="no_of_person" value="<?php echo e(@$data['no_of_person']); ?>" />
                                <input type="hidden" name="return_journey" value="<?php echo e(@$data['return_journey']); ?>" />
                                <input type="hidden" name="return_date" value="<?php echo e(@$data['return_date']); ?>" />
                                <input type="hidden" name="return_time" value="<?php echo e(@$data['return_time']); ?>" />










                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="first_name">Customer First Name:</label>
                                            <input type="text" class="form-control is-valid" id="first_name" name="first_name" value="<?php echo e(old('first_name')); ?>" placeholder="First Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name">Customer Last Name:</label>
                                            <input type="text" class="form-control is-valid" id="last_name" name="last_name" value="<?php echo e(old('last_name')); ?>" placeholder="Last Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email:</label>
                                            <input type="email" class="form-control is-valid" id="email" name="email" value="<?php echo e(old('email')); ?>" placeholder="Contact Email">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Password:</label>
                                            <input type="password" class="form-control is-valid" id="password" name="password" placeholder="Secure Password">
                                            <input type="hidden" id="confirm_password" name="confirm_password" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 d-flex align-items-center">
                                        <div class="checkboxes form-group">
                                            <div class="pretty p-default p-round">
                                                <input type="radio" name="gender" value="1" checked>
                                                <div class="state custom-state">
                                                    <label class=""><?php echo app('translator')->get('frontend.male'); ?></label>
                                                </div>
                                            </div>
                                            <div class="pretty p-default p-round">
                                                <input type="radio" name="gender" value="0" <?php echo e((old('gender') == "0") ? "checked" : ""); ?>>
                                                <div class="state custom-state">
                                                    <label class=""><?php echo app('translator')->get('frontend.female'); ?></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">Telephone:</label>
                                            <input type="text" class="form-control is-valid" id="phone" name="phone" value="<?php echo e(old('phone')); ?>" placeholder="Phone Number">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="flight_num">Flight Number (Optional):</label>
                                            <input type="number" class="form-control is-valid" name="flight_num" value="<?php echo e(old('flight_num')); ?>" id="flight_num" placeholder="Flight Number">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="baggage_details">Baggage Details (Optional):</label>
                                            <input type="text" class="form-control is-valid" name="baggage_details" value="<?php echo e(old('baggage_details')); ?>" id="baggage_details" placeholder="Baggage Details">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="notes">Notes:</label>
                                            <textarea class="form-control is-valid" id="notes" name="notes" placeholder="Give us any notes.." rows="3"><?php echo e(old('notes')); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-end">
                                        <button type="submit" id="submit-form-btn" class="btn btn-primaryColor">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="login-modal-wrapper animated fadeInUp faster" id="CustomLoginModal">
        <div class="login-modal" role="document">
            <div class="modal-content">
                <div class="modal-body px-0">
                    <div class="container-fluid h-100">
                        <div class="row h-100  back-primary">
                            <div class="col-sm-5 d-flex flex-column justify-content-center align-items-center animated fadeInUp delay-05s">
                                <img src="<?php echo e(asset('assets/frontend/images/fleet-login.png')); ?>" alt="">
                            </div>
                            <div class="col-sm-7 d-flex flex-column justify-content-center align-items-center animated fadeInUp delay-05s">
                                <h2 class="modal-title pl-3 text-left w-100 mb-5">
                                    <?php echo app('translator')->get('frontend.login'); ?>
                                    <div class="modal-close" data-close="CustomLoginModal">
                                        <img src="<?php echo e(asset('assets/frontend/icons/fleet-close-white.png')); ?>">
                                    </div>
                                </h2>
                                <?php if($errors->any()): ?>
                                    <div class="alert alert-danger xs-mt mb-4">
                                        <ul>
                                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><?php echo e($error); ?></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                                <form action="<?php echo e(url('user-login')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>

                                    <div class="row w-100 m-0 p-0">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="label-animate"><?php echo app('translator')->get('frontend.email'); ?></label>
                                                <input type="text" class="text-input" name="email" value="<?php echo e(old('email')); ?>" required />
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="label-animate"><?php echo app('translator')->get('frontend.password'); ?></label>
                                                <input type="password" class="text-input" name="password" required />
                                            </div>
                                        </div>
                                        <input class="tab-button ml-3 mt-2" type="submit" value="<?php echo app('translator')->get('frontend.login'); ?>">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        $(document).ready(function () {
            $('#customSwitch1').change(function () {
                if ($("#customSwitch1").is(':checked')) {
                    $("#datepicker2").attr('required', 'required');
                    $("#datepicker2").attr('readonly', false);
                    $("#datepicker2").parent().parent().show();
                    $("#timepicker2").attr('required', 'required');
                    $("#timepicker2").attr('readonly', false);
                    $("#timepicker2").parent().parent().show();
                }else{
                    $("#datepicker2").parent().parent().hide();
                    $("#timepicker2").parent().parent().hide();
                    $("#datepicker2").attr('required', false);
                    $("#datepicker2").attr('readonly', true);
                    $("#timepicker2").attr('required', false);
                    $("#timepicker2").attr('readonly', true);
                }
            });
        });
    </script>
    <script src="<?php echo e(asset('assets/js/map.js')); ?>"></script>
    <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAygfWV6pZGwRoN3dANb0LrLt_kGLLTAvk&libraries=places&language=en&callback=initMap&v=weekly"
            defer
            async>
    </script>


    <script>
        $("#submit-form-btn").on('click', function (e){
            e.preventDefault();
            $("#confirm_password").val($('#password').val())
            $("#customer_form").submit();
        })
        $(".datepicker").flatpickr({
            disableMobile: "true"
        });
        $(".timepicker").flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            disableMobile: "true",
        });

        // window.setTimeout(function () {
        //     $(".alert-danger").alert('close');
        // }, 5000);

        if ($(location).attr('href').split('/')[4] == "#register")
        {
            $('#login-modal').addClass('active');
        }

        $(".increase_persons").on('click', function() {
            $("#no_of_person").val(parseInt($("#no_of_person").val()) + 1);
        })
        $(".decrease_persons").on('click', function() {
            if($("#no_of_person").val() > 1){
                $("#no_of_person").val($("#no_of_person").val() - 1);
            }else{
                $("#no_of_person").val(1);
            }
        })
        setTimeout(function () {
            window.location.href = "<?php echo e(url("/")); ?>";
        }, (10 * 60 * 1000))

        var seconds = 59;
        var minutes = 9;
        setInterval(function () {
            $(".sec").text(seconds + "s");
            $(".min").text(minutes + "m");
            if(seconds != 0){
                seconds--;
            }
            else{
                seconds = 59;
                minutes--;
            }
        }, 1000);
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/emolimo.savvyhost.co/httpdocs/framework/resources/views/frontend/summary.blade.php ENDPATH**/ ?>