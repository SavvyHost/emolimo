@extends('frontend.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/custom-switch.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/map_style.css') }}" />
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
            background: #00000070;
            padding: 6px 10px 4px;
            border-radius: 20px;
            font-size: 12px;
            margin-top: 5px;
        }
        .price{
            display: block;
            text-align: center;
            color: #00cc37;
            font-size: 20px;
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
            height: 63px !important;
            width: 100%;
            font-size: 17px;
            font-weight: 400;
            text-align: center;
        }
        .distance-img{
            display: none;
        }
        #distance{
            padding: 7px 14px;
            font-size: 17px;
            color: black;
            font-weight: 600;
        }
        #map{
            width: 100%;
            height: {{ isset($data) ? "10rem" : "480px"  }};
        }
        .welcome-title h2,
        .ratings-title h2{
            border-bottom: 1px solid;
            padding-bottom: 6px;
            margin-bottom: 12px;
        }
        .welcome-div p {
            font-size: 17px;
        }
        .welcome-text ul{
            list-style: none;
        }
        .welcome-text li{
            font-size: 17px;
            font-weight: bold;
        }
        .welcome-text i{
            margin-left: 2rem;
            margin-right: 6px;
            color: black;
        }
        .ratings-div i {

            color: #f8c24a;
        }
        .ratings-div span i {
            margin-right: 4px;
        }
        .overAll-ratings{
            text-align: center;
            padding: 1rem 0;
        }
        .rating-card{
            margin-top: 0.5rem;
            background: #e3e3e352;
            padding: 1rem;
        }
        .rating-card-header{
            display: flex;
            justify-content: space-between;
        }
        .rating-card-title{
            margin-bottom: 6px;
            font-size: 17px;
            margin-top: 6px;
        }
        .rating-card-date,
        .auther{
            color: black;
        }

        .vehicle-card{
            background: white;
            margin-top: 1rem;
            padding: 1rem 0;
            border-radius: 5px;
            display: flex;
            justify-content: space-around;
            align-items: center;
            box-shadow: 0px 5px 11px 5px rgb(0 0 0 / 20%);
        }
        .vehicle-img img{
            width: 120px;
        }
        .vehicle-data{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        .vehicle-data h5{
            color: black;
            margin-bottom: 0;
            font-size: 16px;
        }
        .vehicle-price{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .vehicle-price .custom-btn{
            font-size: 14px;
            padding: 4px 16px;
        }
    </style>
@endsection

@section('content')
        <!-- Booking section -->
        <section class="booking-section py-5 mt-5 text-white" id="book_now">
            <div class="container">
                <div class="row">
                    @if(session('success'))
                        <div class="alert alert-success col-sm-12">
                            {{  session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger col-sm-12">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="col-md-6">
                        <h2 class="text-center">@lang('frontend.Booking Details')</h2>
                        <form action="{{ route('getJourneyData') }}" class="mt-4 w-100" method="POST" id="booking_form">
                            {!! csrf_field() !!}
                            <input type="hidden" name="distance" id="distance-hidden-input" value="{{ @$data['distance'] }}" />
                            <input type="hidden" id="destination_coords" name="destination_coords" value="{{ @$data['destination_coords'] }}" />
                            <input type="hidden" id="destination_name" name="destination_name" value="{{ @$data['destination_name'] }}" />
                            <input type="hidden" id="origin_coords" name="origin_coords" value="{{ @$data['origin_coords'] }}" />
                            <input type="hidden" id="origin_name" name="origin_name" value="{{ @$data['origin_name'] }}" />
                            <input type="hidden" id="km_num" name="km_num" value="{{ @$data['km_num'] }}" />
                            <input type="hidden" id="price" name="price" value="" />
                            <input type="hidden" id="vehicle_id" name="vehicle_id" value="" />

                            <div class="form-inputs mt-2 w-100">
                                <div class="row w-100 m-0 p-0">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="" class="label-animate" id="pickup_label">@lang('frontend.pickup_address')</label>
                                            <input type="text" class="text-input placesInput" name="pickup_address" id="pickup_address" value="{{ old('pickup_address', @$data['pickup_address']) }}" required>
                                            <span class="input-addon">
                                                <img src="{{ asset('assets/frontend/icons/fleet-pickup.png')}}" alt="">
                                            </span>
                                        </div>
                                        <div id="results" class="pac-container"></div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="" class="label-animate" id="dropoff_label">@lang('frontend.dropoff_address')</label>
                                            <input type="text" class="text-input placesInput" name="dropoff_address" id="dropoff_address" value="{{ old('dropoff_address', @$data['dropoff_address']) }}" required>
                                            <span class="input-addon">
                                                <img src="{{ asset('assets/frontend/icons/fleet-drop.png')}}" alt="">
                                            </span>
                                        </div>
                                        <div id="results2" class="pac-container"></div>
                                    </div>
                                    <!-- imaginery row 2 -->
{{--                                    <div class="col-lg-6 col-md-6">--}}
{{--                                        <select class="form-group wide col-sm-12 text-input" name="vehicle_type" id="vehicle_type" required>--}}
{{--                                            <option value="" disabled selected>@lang('frontend.vehicle_type')</option>--}}
{{--                                            @foreach($vehicle_type as $type)--}}
{{--                                                <option value="{{ $type->id }}" {{ ($type->id == old('vehicle_type')) ? "selected" : "" }}> {{ $type->vehicletype }} </option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="" class="label-animate">@lang('frontend.pickup_date')</label>
                                            <input type="text" class="text-input datepicker" id="datepicker" name="pickup_date" value="{{ old('pickup_date', @$data['pickup_date']) }}" required>
                                            <span class="input-addon">
                                                <img src="{{ asset('assets/frontend/icons/fleet-date.png')}}" alt="">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="" class="label-animate">@lang('frontend.pickup_time')</label>
                                            <input type="text" class="text-input timepicker" id="timepicker" name="pickup_time" value="{{ old('pickup_time', @$data['pickup_time']) }}" required>
                                            <span class="input-addon">
                                                <img src="{{ asset('assets/frontend/icons/fleet-date.png')}}" alt="">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group pessengers_group">
                                            <label for="" class="control-label">@lang('frontend.Return Journey?')</label>
                                            <div style="display: flex;">
                                                <input type="checkbox" class="custom-switch-input checkbox" id="customSwitch1" name="return_journey" value="1" {{ old('status', @$data['return_journey']) == 1 ? 'checked' : '' }}>
                                                <label class="custom-switch-label" for="customSwitch1" data-before=""></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 {{ @$data['return_journey'] ? '' : 'hide-return-journey'  }}">
                                        <div class="form-group">
                                            <label for="" class="label-animate">@lang('frontend.pickup_date')</label>
                                            <input type="text" class="text-input datepicker" id="datepicker2" name="return_date" value="{{ old('return_date', @$data['return_date']) }}">
                                            <span class="input-addon">
                                                <img src="{{ asset('assets/frontend/icons/fleet-date.png')}}" alt="">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 {{ @$data['return_journey'] ? '' : 'hide-return-journey'  }}">
                                        <div class="form-group">
                                            <label for="" class="label-animate">@lang('frontend.pickup_time')</label>
                                            <input type="text" class="text-input timepicker" id="timepicker2" name="return_time" value="{{ old('return_time', @$data['return_time']) }}">
                                            <span class="input-addon">
                                                <img src="{{ asset('assets/frontend/icons/fleet-date.png')}}" alt="">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group pessengers_group">
                                            <label for="" class="control-label">@lang('frontend.no_of_person')</label>
                                            <div>
                                                <button type="button" class="decrease_persons"><i class="fas fa-minus"></i></button>
                                                <input type="number" class="text-input pessengers_input" name="no_of_person" id="no_of_person" value="{{ old('no_of_person', $data['no_of_person'] ?? 1) }}" min="1" required>
                                                <button type="button" class="increase_persons"><i class="fas fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="tab-button mx-auto mt-3" type="submit" id="booking">{{ isset($data['distance']) ? __("frontend.Change Booking") : __("frontend.New Booking") }}</button>
                                </div>
                            </div>
                        </form>
                        <div class="ratings-div mt-4">
                            <div class="ratings-title">
                                <h2>What our customers say</h2>
                            </div>
                            <div class="overAll-ratings">
                                <h5>Overall Rating</h5>
                                <div><span><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half"></i></span> <span>(163)</span></div>
                            </div>
                            <div class="ratings">
                                <div class="rating-card">
                                    <div class="rating-card-header">
                                        <div class="stars">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <div class="auther">MAMDOUH EZAT</div>
                                    </div>
                                    <div class="rating-card-body">
                                        <p class="rating-card-title">
                                            "Again we enjoyed Omar very much. Punctual, helpful, friendly and a great driver. Thanks EmoLimo "
                                        </p>
                                    </div>
                                    <div class="rating-card-footer">
                                        <div>
                                            <div class="rating-card-date">18 Jul 2022</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="rating-card">
                                    <div class="rating-card-header">
                                        <div class="stars">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <div class="auther">MAMDOUH EZAT</div>
                                    </div>
                                    <div class="rating-card-body">
                                        <p class="rating-card-title">
                                            "Again we enjoyed Omar very much. Punctual, helpful, friendly and a great driver. Thanks EmoLimo "
                                        </p>
                                    </div>
                                    <div class="rating-card-footer">
                                        <div>
                                            <div class="rating-card-date">18 Jul 2022</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="rating-card">
                                    <div class="rating-card-header">
                                        <div class="stars">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <div class="auther">MAMDOUH EZAT</div>
                                    </div>
                                    <div class="rating-card-body">
                                        <p class="rating-card-title">
                                            "Again we enjoyed Omar very much. Punctual, helpful, friendly and a great driver. Thanks EmoLimo "
                                        </p>
                                    </div>
                                    <div class="rating-card-footer">
                                        <div>
                                            <div class="rating-card-date">18 Jul 2022</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="rating-card">
                                    <div class="rating-card-header">
                                        <div class="stars">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <div class="auther">MAMDOUH EZAT</div>
                                    </div>
                                    <div class="rating-card-body">
                                        <p class="rating-card-title">
                                            "Again we enjoyed Omar very much. Punctual, helpful, friendly and a great driver. Thanks EmoLimo "
                                        </p>
                                    </div>
                                    <div class="rating-card-footer">
                                        <div>
                                            <div class="rating-card-date">18 Jul 2022</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div id="distance-div" class="justify-content-center align-items-center @if(isset($data['distance'])) d-flex @endif">
                            <div class="distance-img @if(isset($data['distance'])) d-block @endif"><img src="{{ asset('assets/images/distance.png') }}" style="width: 40px;" /></div>
                            <div id="distance">
                                @if(isset($data['distance']))
                                    {{ $data['distance'] }}
                                @endif
                            </div>
                        </div>
                        <div id="map"></div>
                        <div class="vehicles-div">
                            @if(isset($suitableVehicles))
                                @foreach($suitableVehicles as $vehicle)
                                    <div class="vehicle-card">
                                        <div class="vehicle-img">
                                            <img src="{{ asset($vehicle->icon ?? 'assets/images/car.png') }}" />
                                        </div>
                                        <div class="vehicle-data">
                                            <h5>{{ $vehicle->vehicletype }}</h5>
                                            <span class="persons">{{ $vehicle->seats }} <i class="fas fa-users"></i></span>
                                        </div>
                                        <div class="vehicle-price">
                                            <span class="price">₹ {{ number_format(($vehicle->km_price ?? 0) * ($data['km_num'] ?? 0)) }}</span>
                                            <a href="{{ route('bookingSummary') }}" data-vehicle-id="{{ $vehicle->id }}" class="btn custom-btn">Select Vehicle</a>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="welcome-div mt-4">
                            <div class="welcome-title">
                                <h2>Welcome</h2>
                            </div>
                            <div class="welcome-text">
                                <p>
                                    Emolimo is one of Egypt's leading taxi services, providing corporate and personal car travel throughout Egypt and surrounding areas.
                                </p>
                                <ul>
                                    <li><span><i class="fa fa-check-circle"></i></span> Meet and Greet service on request.</li>
                                    <li><i class="fa fa-check-circle"></i> Meet and Greet service on request.</li>
                                    <li><i class="fa fa-check-circle"></i> Meet and Greet service on request.</li>
                                    <li><i class="fa fa-check-circle"></i> Meet and Greet service on request.</li>
                                    <li><i class="fa fa-check-circle"></i> Meet and Greet service on request.</li>
                                    <li><i class="fa fa-check-circle"></i> Meet and Greet service on request.</li>
                                </ul>
                                <p>
                                    We believe we have the best online booking system in the business. Follow the simple step by step proccess to book either via our special promotions page, or alternatively we have a unique instant quote and booking system.
                                </p>
                                <p>
                                    Specialising in airport transfers, we can handle business accounts of any size. We also cover general runs in and around Oxford and the local area.
                                </p>
                                <p>
                                    Oxford Taxis operate in the Oxford area offering a full service 24 hours a day, 7 days a week, 365 days a year. We aim to provide all of our passengers with a professional yet affordable service. Whether you're looking for an airport transfer for business or pleasure, or treating yourself to a night out with friends, we can cover it. Our helpful, reliable staff are always there at the end of the phone to assist you, whatever the question on 01865 238 062. With full online booking facilities and all major credit cards accepted we take the headache out of your travel arrangements.
                                </p>
                                <p>
                                    If you have any questions please get in touch or make a booking via the online system, we look forward to driving you soon.
                                </p>
                                <p>EmoLimo's Team</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection

@section('scripts')
<script>
    window._origin_lat = parseFloat("{{ @explode('-', @$data['origin_coords'])[0] }}");
    window._origin_lng = parseFloat("{{ @explode('-', @$data['origin_coords'])[1] }}");
    window._destination_lat = parseFloat("{{ @explode('-', @$data['destination_coords'])[0] }}");
    window._destination_lng = parseFloat("{{ @explode('-', @$data['destination_coords'])[1] }}");
    window._has_data = {{ isset($data['origin_coords']) && isset($data['destination_coords']) ? 1 : 0 }}

    $(".custom-btn").on('click', function(e){
        e.preventDefault();
        $("#price").val($(this).parent().find('.price').text())
        $("#vehicle_id").val($(this).attr("data-vehicle-id"))
        $("#booking_form").attr('action', '{{ route('getBookingSummary') }}')
        $("#booking_form").submit();
    })
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
<script>
    window._iconUrl = "{{ asset('/') }}"
</script>
<script src="{{ asset('assets/js/map.js') }}"></script>
<script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAygfWV6pZGwRoN3dANb0LrLt_kGLLTAvk&libraries=places&language=en&callback=initMap&v=weekly"
        defer
        async>
</script>


<script>
    $(".datepicker").flatpickr({
        disableMobile: "true"
    });
    $(".timepicker").flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        disableMobile: "true",
        onOpen: function (){
            setTimeout(function (){
                $("#pickup_time_label").addClass('label-top stay')
            }, 100)
        }
    });

    window.setTimeout(function () { 
         $(".alert-danger").alert('close'); 
    }, 5000);

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
@endsection