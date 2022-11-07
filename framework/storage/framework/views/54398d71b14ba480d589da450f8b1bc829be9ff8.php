

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/custom-switch.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/map_style.css')); ?>" />
    <style>
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
        #distance-div{
            display: none;
        }
        #distance{
            padding: 7px 14px;
            font-size: 17px;
            color: black;
            font-weight: 600;
        }
        #contact-btn{
            width: auto;
            background: transparent;
            color: #00CC37;
            border: 1px solid #00CC37;
        }
        #contact-btn:hover{
            width: auto;
            background: #00CC37;
            color: white;
            border: 1px solid #00CC37;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
        <section class="hero-section--home">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="hero-content--home w-100 text-center mt-5">
                            <h1 class="mb-3"><?php echo app('translator')->get('frontend.reliable_way'); ?></h1>
                            <div>
                                <a href="#" class="d-inline-block"><button class="btn mx-auto form-submit-button" id="contact-btn"><?php echo app('translator')->get('frontend.contact_us'); ?> (<?php echo e(Hyvikk::frontend('contact_phone')); ?>)</button></a>
                                <a href="#book_now" class="d-inline-block"><button class="btn mx-auto form-submit-button"><?php echo app('translator')->get('frontend.book_now'); ?></button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Ends hero section -->
        <!-- Booking section -->
        <section class="booking-section py-5 my-5 text-white" id="book_now">
            <div class="container">
                <div class="row justify-content-center">
                    <?php if(session('success')): ?>
                        <div class="alert alert-success col-sm-12">
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>

                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger col-md-8 flex-col-center">
                            <ul>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <div class="col-md-7 flex-col-center">
                        <h1 class="text-center"><?php echo app('translator')->get('frontend.book_now'); ?></h1>
                        <div id="distance-div" class="justify-content-center align-items-center">
                            <div><img src="<?php echo e(asset('assets/images/distance.png')); ?>" style="width: 40px;" /></div>
                            <div id="distance"></div>
                        </div>
                        <form action="<?php echo e(route('getJourneyData')); ?>" class="mt-4 w-100" method="POST" id="booking_form">
                            <?php echo csrf_field(); ?>

                            <input type="hidden" id="distance-hidden-input" name="distance" />
                            <input type="hidden" id="destination_coords" name="destination_coords" />
                            <input type="hidden" id="origin_coords" name="origin_coords" />
                            <input type="hidden" id="km_num" name="km_num" />
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            <div class="form-inputs mt-2 w-100">
                                <div class="row w-100 m-0 p-0">
                                    <div class="col-lg-6 col-md-6" style="position:relative;">
                                        <div class="form-group">
                                            <label for="" class="label-animate" id="pickup_label"><?php echo app('translator')->get('frontend.pickup_address'); ?></label>
                                            <input type="text" class="text-input placesInput" name="pickup_address" id="pickup_address" value="<?php echo e(old('pickup_address')); ?>" required>
                                            <span class="input-addon">
                                                <img src="<?php echo e(asset('assets/frontend/icons/fleet-pickup.png')); ?>" alt="">
                                            </span>
                                        </div>
                                        <div id="results" class="pac-container"></div>
                                    </div>
                                    <div class="col-lg-6 col-md-6" style="position:relative;">
                                        <div class="form-group">
                                            <label for="" class="label-animate" id="dropoff_label"><?php echo app('translator')->get('frontend.dropoff_address'); ?></label>
                                            <input type="text" class="text-input placesInput" name="dropoff_address" id="dropoff_address" value="<?php echo e(old('dropoff_address')); ?>" required>
                                            <span class="input-addon">
                                                <img src="<?php echo e(asset('assets/frontend/icons/fleet-drop.png')); ?>" alt="">
                                            </span>
                                        </div>
                                        <div id="results2" class="pac-container"></div>
                                    </div>
                                    <!-- imaginery row 2 -->
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="" class="label-animate"><?php echo app('translator')->get('frontend.pickup_date'); ?></label>
                                            <input type="text" class="text-input datepicker" id="datepicker" name="pickup_date" value="<?php echo e(old('pickup_date')); ?>" required>
                                            <span class="input-addon">
                                                <img src="<?php echo e(asset('assets/frontend/icons/fleet-date.png')); ?>" alt="">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="" id="pickup_time_label" class="label-animate"><?php echo app('translator')->get('frontend.pickup_time'); ?></label>
                                            <input type="text" class="text-input timepicker" id="timepicker" name="pickup_time" value="<?php echo e(old('pickup_time')); ?>" required>
                                            <span class="input-addon">
                                                <img src="<?php echo e(asset('assets/frontend/icons/fleet-date.png')); ?>" alt="">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group pessengers_group">
                                            <label for="" class="control-label"><?php echo app('translator')->get('frontend.Return Journey?'); ?></label>
                                            <div style="display: flex;">
                                                <input type="checkbox" class="custom-switch-input checkbox" id="customSwitch1" name="return_journey" value="1" <?php echo e(old('status') == 1 ? 'checked' : ''); ?>>
                                                <label class="custom-switch-label" for="customSwitch1" data-before=""></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 hide-return-journey">
                                        <div class="form-group">
                                            <label for="" class="label-animate"><?php echo app('translator')->get('frontend.pickup_date'); ?></label>
                                            <input type="text" class="text-input datepicker" id="datepicker2" name="return_date" value="<?php echo e(old('return_date')); ?>">
                                            <span class="input-addon">
                                                <img src="<?php echo e(asset('assets/frontend/icons/fleet-date.png')); ?>" alt="">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 hide-return-journey">
                                        <div class="form-group">
                                            <label for="" class="label-animate"><?php echo app('translator')->get('frontend.pickup_time'); ?></label>
                                            <input type="text" class="text-input timepicker" id="timepicker2" name="return_time" value="<?php echo e(old('return_time')); ?>">
                                            <span class="input-addon">
                                                <img src="<?php echo e(asset('assets/frontend/icons/fleet-date.png')); ?>" alt="">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group pessengers_group">
                                            <label for="" class="control-label"><?php echo app('translator')->get('frontend.no_of_person'); ?></label>
                                            <div>
                                                <button type="button" class="decrease_persons"><i class="fas fa-minus"></i></button>
                                                <input type="number" class="text-input pessengers_input" name="no_of_person" id="no_of_person" value="<?php echo e(old('no_of_person', 1)); ?>" min="1" required>
                                                <button type="button" class="increase_persons"><i class="fas fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Row 2 ends -->
                                    
                                    
                                    
                                    
                                    
                                    <?php ($methods = json_decode(Hyvikk::payment('method'))); ?>
                                    <?php if(Hyvikk::frontend('admin_approval')==0 && Hyvikk::api('api_key') != null): ?>
                                        <div class="col-lg-12">
                                            <div class="checkboxes flex-row-center">
                                                <label class="state custom-state"><?php echo app('translator')->get('frontend.select_payment_method'); ?>: &nbsp;</label>
                                                <?php $__currentLoopData = $methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="pretty p-default p-round">
                                                        <input type="radio" name="method" id="method" value="<?php echo e($method); ?>" <?php if($method == "cash"): ?> checked <?php endif; ?>>
                                                        <div class="state custom-state">
                                                            <label><?php echo e($method); ?></label>
                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>

                                        </div>
                                    <?php endif; ?>
                                    <button class="tab-button mx-auto mt-3" type="submit" id="booking"><?php echo app('translator')->get('frontend.book_now'); ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-5">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Ends booking section -->
        <!-- Vechicles Section -->
        <!-- *Note* : there are two sliders one for vehicle details and one for vehicle images, they both are synchronized -->
        <section class="vehicle-section my-5">
            <!-- Section title -->
            <div class="container mt-4">
                <div class="row">
                    <div class="col-sm-12">
                        <h2 class="text-center"><?php echo app('translator')->get('frontend.our_vehicle'); ?></h2>
                    </div>
                </div>
            </div>
            <!-- Ends Section title -->
            <div class="vehicle-details-container vehicle-details-slider">
                <!-- Vehicle detail Slides starts -->
                <!-- Slide -->
                <?php $__currentLoopData = $vehicle; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="vehicle-detail animated">
                    <div class="vehicle_name w-100"><?php echo e($v->year); ?> <?php echo e($v->maker->make); ?> <?php echo e($v->vehiclemodel->model); ?></div>
                    <div class="vehicle_details">
                        <div class="passengers"> <?php echo e($v->types->seats); ?> Passengers </div>
                        <div class="vehicle-class">
                            <img src="<?php echo e(asset('assets/frontend/icons/fleet-luxurious.png')); ?>" alt="">
                        </div>
                        <div class="vehicle-data"><?php echo e($v->average); ?>/100 MPG</div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <!-- Slide -->
                <!-- Vehicle image Slides ends -->
            </div>
            <div class="vehicle-container mt-5">
                <div class="row vehicle-slider">
                    <!-- Vehicle image Slides starts -->
                    <?php $__currentLoopData = $vehicle; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-sm-4">
                        <?php if($v->vehicle_image): ?>
                            <img src="<?php echo e(url('uploads/' . $v->vehicle_image)); ?>" alt="Vehicle Image" class="img-fluid">
                        <?php else: ?> 
                            <img src="<?php echo e(asset("assets/images/vehicle.jpeg")); ?>" alt="Vehicle Image" class="img-fluid">
                        <?php endif; ?>  
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <!-- Vehicle image Slides ends -->
                </div>
            </div>
            <!-- Slide dots and current / total slides -->
            <div class="custom-controls-container">
                <h6 class="js-vehicle-slide-current"> 1 </h6>
                <div class="custom-dots">
                    <!-- Dots will be automatically appended here by js -->
                </div>
                <h6 class="js-vehicle-slide-total"><?php echo e($vehicle->count()); ?></h6>
            </div>
        </section>
        <!-- Ends vehicles section -->
        <!-- Services section -->
        <section class="my-5 relative">
            <!-- Section title -->
            <div class="container my-5">
                <div class="row">
                    <div class="col-sm-12">
                        <h2 class="text-center"><?php echo app('translator')->get('frontend.our_service'); ?></h2>
                    </div>
                </div>
            </div>
            <!-- Ends Section title -->
            <div class="container my-0 my-lg-5">
                <div class="row js-service-slider">
                    <?php $__currentLoopData = $company_services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-sm-6 py-5 ">
                        <div class="row w-100 m-0 p-0">
                            <div class="col-sm-4">
                                <div class="service-round-element">
                                    <?php if($service->image != null): ?>
                                        <img src="<?php echo e(url('uploads/' . $service->image)); ?>" alt="Service Image">
                                    <?php else: ?>
                                        <img src="" alt="Service Image">
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <h6><?php echo e($service->title); ?></h6>
                                <p class="mt-3"><?php echo e($service->description); ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <!-- Slider arrows -->
            <div class="service-slide-prev">
                <img src="<?php echo e(asset('assets/frontend/icons/fleet-arrow-left.png')); ?>" alt="">
            </div>
            <div class="service-slide-next">
                <img src="<?php echo e(asset('assets/frontend/icons/fleet-arrow-right.png')); ?>" alt="">
            </div>
        </section>
        <!-- Ends services section -->
        <!-- Testimonial section -->
        <section class="pb-5 pt-0">
            <div class="container text-center no-padding-mobile relative">
                <!-- Section title -->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2 class="text-center"><?php echo app('translator')->get('frontend.testimonials'); ?></h2>
                        </div>
                    </div>
                </div>
                <!-- Ends Section title -->
                <div class="js-testimonial-slider">
                    <!-- Slide -->
                    <?php $__currentLoopData = $testimonial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-sm-12">
                        <div class="row mt-5">
                            <div class="col-lg-4 flex-col-center">
                                <div class="testimonial-image-block">
                                    <div class="shadow-overlay"></div>
                                    <?php if($t->image != null): ?>
                                        <img src="<?php echo e(url('uploads/' . $t->image)); ?>" alt="Testimonial Image" class="testimonial-image">
                                    <?php else: ?> 
                                        <img src="<?php echo e(url('assets/images/no-user.jpg')); ?>" alt="Testimonial Image" class="testimonial-image">
                                    <?php endif; ?>
                                    <div class="quote-round">
                                        <img src="<?php echo e(asset('assets/frontend/icons/fleet-quote.png')); ?>" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 d-flex flex-column align-items-center">
                                <div class="testimonial-content w-100 text-center text-lg-left">
                                    <?php echo e($t->details); ?>

                                    <br><br>
                                    <i> - <?php echo e($t->name); ?></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <!-- Slide -->
                    <!-- Slides end -->
                </div>
                <div class="testimonial-dots mx-auto">
                </div>
            </div>
        </section>
        <!-- Ends wrapper  -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        window._iconUrl = "<?php echo e(asset('/')); ?>"
    </script>
<script src="<?php echo e(asset('assets/js/map2.js')); ?>"></script>
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








































































































<script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAygfWV6pZGwRoN3dANb0LrLt_kGLLTAvk&libraries=places&language=en&callback=initMap&v=weekly"
        defer
        async>
</script>
<script>
    $(".datepicker").flatpickr({
        disableMobile: "true"
    });
    $("#timepicker").flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        disableMobile: "true",
        onOpen: function (){
            setTimeout(function (){
                $("#pickup_time_label").addClass('label-top stay')
            }, 80)
        }
    });


    // window.setTimeout(function () {
    //      $(".alert-danger").alert('close');
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

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/emolimo.savvyhost.co/httpdocs/framework/resources/views/frontend/home.blade.php ENDPATH**/ ?>