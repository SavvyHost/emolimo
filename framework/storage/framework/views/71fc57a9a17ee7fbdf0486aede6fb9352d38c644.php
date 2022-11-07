


<?php $__env->startSection('content'); ?>
        <section class="hero-section--contact d-flex">
            <div class="container-fluid mt-auto d-flex flex-column p-0">
                <div class="row no-gutters">
                    <div class="col-sm-12">
                        <div class="hero-content--contact w-100">
                            <div class="inner-content">
                                <h1 class="mb-0"><?php echo app('translator')->get('frontend.contact_us'); ?></h1>
                                <h5 class="karla"><?php echo app('translator')->get('frontend.tell_us'); ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Ends hero section -->
        <!-- Contact tiles -->
        <section>
            <div class="container my-5 pt-5">
                <div class="row">
                    <div class="col-md-6">
                        <div class="contact-tile">
                            <div class="contact-tile-image">
                                <img src="<?php echo e(asset('assets/frontend/icons/fleet-support.png')); ?>" alt="">
                            </div>
                            <div class="contact-tile-details">
                                <h5><?php echo app('translator')->get('frontend.customer_care'); ?></h5>
                                <p><?php echo app('translator')->get('frontend.contact_us_at'); ?> <strong class="primary"><?php echo e(Hyvikk::frontend('customer_support')); ?></strong> </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="contact-tile">
                            <div class="contact-tile-image">
                                <img src="<?php echo e(asset('assets/frontend/icons/fleet-query.png')); ?>" alt="">
                            </div>
                            <div class="contact-tile-details">
                                <h5><?php echo app('translator')->get('frontend.any_query'); ?></h5>
                                <p><?php echo app('translator')->get('frontend.contact_us_at'); ?> <strong class="primary"><?php echo e(Hyvikk::frontend('contact_phone')); ?></strong> </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 ">
                        <div class="contact-tile">
                            <div class="contact-tile-image">
                                <img src="<?php echo e(asset('assets/frontend/icons/fleet-email.png')); ?>" alt="">
                            </div>
                            <div class="contact-tile-details">
                                <h5><?php echo app('translator')->get('frontend.contact_us_email'); ?></h5>
                                <p><?php echo app('translator')->get('frontend.send_your_email'); ?> <strong class="primary"><?php echo e(Hyvikk::frontend('contact_email')); ?></strong> </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="contact-tile">
                            <div class="contact-tile-image">
                                <img src="<?php echo e(asset('assets/frontend/icons/fleet-drive.png')); ?>" alt="">
                            </div>
                            <div class="contact-tile-details">
                                <h5><?php echo app('translator')->get('frontend.drive_fleet'); ?></h5>
                                <p><?php echo app('translator')->get('frontend.join_us'); ?> <strong class="primary"><a href="#"><?php echo app('translator')->get('frontend.click_here'); ?>.</a></strong> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End contact tiles -->
        <!-- Contact map -->
        <section class="contact-map-section mb-5">
            <div class="map w-100 h-100">
                <!-- Google map starts -->
                <div id="map" class="w-100 h-100"></div>
                <script>
                    function initMap() {

                    var address = '<?php echo e(Hyvikk::get('badd1') . ", " . Hyvikk::get('badd2') . ", " . Hyvikk::get('city') . ", " . Hyvikk::get('state') . ", " . Hyvikk::get('country') . "."); ?>';
                    var geocoder = new google.maps.Geocoder();
                    geocoder.geocode( { 'address': address}, function(results, status) {

                    if (status == google.maps.GeocoderStatus.OK) {
                        var latitude = results[0].geometry.location.lat();
                        var longitude = results[0].geometry.location.lng();
                    }

                    var uluru = {lat: latitude, lng: longitude};
                    // Styles a map in night mode.
                    var map = new google.maps.Map(document.getElementById('map'), {
                    center: {lat: latitude, lng: longitude},
                    zoom: 15,
                    disableDefaultUI: true,
                    styles: [
                        {
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#033f21"
                            }
                            ]
                        },
                        {
                            "elementType": "labels.icon",
                            "stylers": [
                            {
                                "visibility": "off"
                            }
                            ]
                        },
                        {
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#848484"
                            }
                            ]
                        },
                        {
                            "elementType": "labels.text.stroke",
                            "stylers": [
                            {
                                "color": "#033f21"
                            }
                            ]
                        },
                        {
                            "featureType": "administrative",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#757575"
                            }
                            ]
                        },
                        {
                            "featureType": "administrative.country",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#9e9e9e"
                            }
                            ]
                        },
                        {
                            "featureType": "administrative.land_parcel",
                            "stylers": [
                            {
                                "visibility": "off"
                            }
                            ]
                        },
                        {
                            "featureType": "administrative.locality",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#bdbdbd"
                            }
                            ]
                        },
                        {
                            "featureType": "poi",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#757575"
                            }
                            ]
                        },
                        {
                            "featureType": "poi.park",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#033f21"
                            }
                            ]
                        },
                        {
                            "featureType": "poi.park",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#616161"
                            }
                            ]
                        },
                        {
                            "featureType": "poi.park",
                            "elementType": "labels.text.stroke",
                            "stylers": [
                            {
                                "color": "#1b1b1b"
                            }
                            ]
                        },
                        {
                            "featureType": "road",
                            "elementType": "geometry.fill",
                            "stylers": [
                            {
                                "color": "#022613"
                            }
                            ]
                        },
                        {
                            "featureType": "road",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#8a8a8a"
                            }
                            ]
                        },
                        {
                            "featureType": "road.arterial",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#022613"
                            }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#022613"
                            }
                            ]
                        },
                        {
                            "featureType": "road.highway.controlled_access",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#022613"
                            }
                            ]
                        },
                        {
                            "featureType": "road.local",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#616161"
                            }
                            ]
                        },
                        {
                            "featureType": "transit",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#757575"
                            }
                            ]
                        },
                        {
                            "featureType": "water",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#006838"
                            }
                            ]
                        },
                        {
                            "featureType": "water",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#3d3d3d"
                            }
                            ]
                        }
                        ],
                    });
                    var marker = new google.maps.Marker({position: uluru, map: map});
                    });
                }
                </script>
                <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo e(Hyvikk::api('api_key')); ?>&callback=initMap" async defer></script>
                <!-- Google map ends -->
            </div>
            <!-- Contact address strip -->
            <div class="contact-address">
                <h4 class="karla">
                    <strong><?php echo app('translator')->get('frontend.address'); ?><span class="d-none d-lg-inline"> - </span> </strong>
                    <span class="p pt-1 text-center"> &emsp;<?php echo e(Hyvikk::get('badd1') . ", " . Hyvikk::get('badd2') . ", " . Hyvikk::get('city') . ", " . Hyvikk::get('state') . ", " . Hyvikk::get('country') . "."); ?>

                    </span>
                </h4>
            </div>
            <!-- Ends Contact address strip -->
            <div class="contact-form">
                <h2 class="text-center"><?php echo app('translator')->get('frontend.get_in_touch'); ?></h2>
                <hr class="primary">

                <?php if(count($errors->contact) > 0): ?>
                    <?php $__currentLoopData = $errors->contact->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="alert alert-success" role="alert">
                        <?php echo e($error); ?>

                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

                <form action="<?php echo e(route('user.enquiry')); ?>" class="p-4" method="POST">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-group white-label">
                        <label class="label-animate"><?php echo app('translator')->get('frontend.your_name'); ?></label>
                        <input type="text" class="text-input" name="name">
                    </div>
                    <div class="form-group white-label">
                        <label class="label-animate"><?php echo app('translator')->get('frontend.email'); ?></label>
                        <input type="email" class="text-input" name="email">
                    </div>
                    <div class="form-group white-label">
                        <textarea placeholder="<?php echo app('translator')->get('frontend.your_message'); ?>" cols="10" rows="5" class="text-input" name="message"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn mx-auto form-submit-button--square w-100"><?php echo app('translator')->get('frontend.send'); ?></button>
                    </div>
                </form>
            </div>
        </section>
        <!-- End Contact map -->
        <section class="pt-5 pb-5">
            <div class="container mb-4">
                <h5 class="text-center mb-4"><?php echo app('translator')->get('frontend.follow_us'); ?></h5>
                <div class="contact-social-icons">
                    <div class="social-icon--facebook">
                        <a href="<?php echo e(Hyvikk::frontend('facebook')); ?>"> <i class="fab fa-facebook-f"></i></a>
                    </div>
                    <div class="social-icon--twitter">
                        <a href="<?php echo e(Hyvikk::frontend('twitter')); ?>"> <i class="fab fa-twitter"></i></a>
                    </div>
                    <div class="social-icon--instagram">
                        <a href="<?php echo e(Hyvikk::frontend('instagram')); ?>"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/emolimo.savvyhost.co/httpdocs/framework/resources/views/frontend/contact.blade.php ENDPATH**/ ?>