// Talal
var talla, autocompleteService, placesService, results, results2, markers,
    map, geocoder, route, directionsService, directionsRenderer;

function initMap() {
    results = document.getElementById("results");
    results2 = document.getElementById("results2");
    geocoder = new google.maps.Geocoder();
    directionsService = new google.maps.DirectionsService();
    directionsRenderer = new google.maps.DirectionsRenderer({
        draggable: true,
    });
    route = {
        origin: {
            lat: "",
            lng: "",
        },
        destination: {
            lat: "",
            lng: "",
        },
        travelMode: "DRIVING",
    };
    markers = [];
    // The location of Uluru
    const uluru = {lat: 30.033333, lng: 31.233334};
    // The map, centered at Uluru
    var Eqypt_area = {
        north: 31.86, // lng: 28.55813437026767
        south: 21.73, //  lng: 31.94311397274863
        west: 24.84, // lat: 27.040908702545803
        east: 36.24, // lat: 24.017322186373715
    };
    var displayedAreaCoords = [
        {lat: 15.00095085934315, lng: 10.97673282861709}, // bottom left
        {lat: 32.82284271222603, lng: 10.97673282861709}, // top left
        {lat: 105.82284271222603, lng: 10.97673282861709}, // top right
        {lat: 21.00095085934315, lng: 45.97673282861709}, // bottom right
        // { lat: 15.00095085934315, lng: 10.97673282861709 }, // bottom left
    ];


    var Eqypt_outer_boundary = [];

    map = new google.maps.Map(document.getElementById("map"), {
        zoom: 6,
        minZoom: 6,
        center: uluru,
        restriction: {
            latLngBounds: Eqypt_area,
            strictBounds: false,
        },
        disableDefaultUI: true,
        zoomControl: true,
        // scrollwheel: false,
        // keyboardShortcuts: false,
        // disableDoubleClickZoom: true,
        // gestureHandling: "none",
    });


    // Bind listener for address search
    google.maps.event.addDomListener(
        document.getElementById("pickup_address"),
        "input",
        function () {
            if (this.value == "") {
                $("#distance").text("")
                $("#distance-div").css("display", 'none');
                removeAllMarkers();
            }
            results.style.display = "block";
            getPlacePredictions(document.getElementById("pickup_address").value);
        }
    );
    google.maps.event.addDomListener(
        document.getElementById("dropoff_address"),
        "input",
        function () {
            if (this.value == "") {
                $("#distance-div").css("display", 'none');
                removeAllMarkers();
            }
            results2.style.display = "block";
            getPlacePredictions2(document.getElementById("dropoff_address").value);
        }
    );
    // Show results when address field is focused (if not empty)
    google.maps.event.addDomListener(
        document.getElementById("pickup_address"),
        "focus",
        function () {
            if (document.getElementById("pickup_address").value !== "") {
                results.style.display = "block";
                getPlacePredictions(document.getElementById("pickup_address").value);
            } else {
                showCurrentLocationOptionOnly();
            }
        }
    );
    google.maps.event.addDomListener(
        document.getElementById("dropoff_address"),
        "focus",
        function () {
            if (document.getElementById("dropoff_address").value !== "") {
                results2.style.display = "block";
                getPlacePredictions2(document.getElementById("dropoff_address").value);
            }
        }
    );
    // Hide res ults when click occurs out of the results and inputs
    google.maps.event.addDomListener(document, "click", function (e) {
        if (
            e.target.parentElement.className !== "pac-container" &&
            e.target.parentElement.className !== "pac-item" &&
            e.target.className !== "label-animate" &&
            e.target.className !== "text-input placesInput"
        ) {
            results.style.display = "none";
            results2.style.display = "none";
        } else {
            if (
                e.target.attributes['id'].value == "pickup_address" ||
                e.target.attributes['id'].value == "pickup_label"
            ) {
                results.style.display = "block";
                results2.style.display = "none";
            } else if (
                e.target.attributes['id'].value == "dropoff_address" ||
                e.target.attributes['id'].value == "dropoff_label"
            ) {
                results.style.display = "none";
                results2.style.display = "block";
            }
        }
    });
    google.maps.event.addDomListener(
        document.getElementById("pickup_label"),
        "click",
        function () {
            setTimeout(function () {
                $("#results").css('display', 'block');
            }, 100)
        }
    );
    google.maps.event.addDomListener(
        document.getElementById("dropoff_label"),
        "click",
        function () {
            setTimeout(function () {
                $("#results2").css('display', 'block');
            }, 100)
        }
    );
    autocompleteService = new google.maps.places.AutocompleteService();
    placesService = new google.maps.places.PlacesService(map);

    directionsRenderer.addListener("directions_changed", () => {
        console.log('changed');
        const directions = directionsRenderer.getDirections();

        if (directions) {
            console.log(directions.routes[0].legs[0]);
            computeTotalDistance(directions.routes[0].legs[0]);
        }
    });

    addYourLocationButton(map);
    // The marker, positioned at Uluru
    //   const marker = new google.maps.Marker({
    //     position: uluru,
    //     map: map,
    //   });

    // var infoWindow = new google.maps.InfoWindow({
    //     content: "<h3>Cario</h3>"
    // })
    // marker.addListener('click', function () {
    //     infoWindow.open(map, marker);
    // });

    function handleOriginEvent(event) {
        route.origin.lat = event.latLng.lat();
        route.origin.lng = event.latLng.lng();
        showDistination();
    }
    function handleDestinationEvent(event) {
        route.destination.lat = event.latLng.lat();
        route.destination.lng = event.latLng.lng();
        showDistination();
    }

    function addMarker(point) {
        // if(markers.length == 0){
        //     route.origin.lat = routeData.start_location.lat();
        //     route.origin.lng = routeData.start_location.lng();
        //     $("#origin_coords").val(routeData.start_location.lat() + "-" + routeData.start_location.lng());
        // }
        if (markers.length == 0) {
            route.origin.lat = point.coords.lat();
            route.origin.lng = point.coords.lng();
            var icon = {
                url: _iconUrl + "A_marker.svg",
                size: new google.maps.Size(36, 50),
                scaledSize: new google.maps.Size(36, 50),
                anchor: new google.maps.Point(18, 50)
            }
            var marker = new google.maps.Marker({
                position: point.coords,
                icon: icon,
                map: map,
                draggable: true,
                title: "Start"
            });
            marker.addListener('drag', handleOriginEvent);
            marker.addListener('dragend', handleOriginEvent);
            markers.push(marker);
        } else if (markers.length == 1) {
            route.destination.lat = point.coords.lat();
            route.destination.lng = point.coords.lng();
            var icon = {
                url: _iconUrl + "B_marker.svg",
                size: new google.maps.Size(36, 50),
                scaledSize: new google.maps.Size(36, 50),
                anchor: new google.maps.Point(18, 50)
            }
            var marker = new google.maps.Marker({
                position: point.coords,
                icon: icon,
                map: map,
                draggable: true,
                title: "End"
            });
            marker.addListener('drag', handleDestinationEvent);
            marker.addListener('dragend', handleDestinationEvent);

            // marker on drag end

            markers.push(marker);

            directionsRenderer.setMap(map); // Existing map object displays directions
            directionsService.route(route, function (response, status) {
                // anonymous function to capture directions
                if (status == "OK") {
                    for (var i = 0; i < markers.length; i++) {
                        markers[i].setMap();
                    }
                    directionsRenderer.setDirections(response); // Add route to the map
                    var directionsData = response.routes[0].legs[0]; // Get data about the mapped route
                    if (!directionsData) {
                        window.alert("Directions request failed");
                        return;
                    } else {
                        let text = "Driving distance is " +
                            directionsData.distance.text +
                            " (" +
                            directionsData.duration.text +
                            ").";
                        $("#km_num").val(directionsData.distance.text.replace(" km", ""))
                        $("#distance").text(text)
                        $("#distance-hidden-input").val(text)
                        $("#distance-div").css('display', 'flex');
                    }
                } else if (status == "ZERO_RESULTS") {
                    let text = "There is no way between the selected points";
                    $("#km_num").val("")
                    $("#distance").text(text)
                    $("#distance-hidden-input").val(text)
                    $("#distance-div").css('display', 'flex');
                    return;
                }
            });
        } else {
            alert("You already added two points");
        }
        console.log(markers);
    }

    google.maps.event.addListener(map, "click", function (e) {
        console.log("lng: " + e.latLng.lng());
        console.log("lat: " + e.latLng.lat());
        geocoder.geocode({location: e.latLng}, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                console.log(results[results.length - 1]["formatted_address"]);
                if (results[results.length - 1]["formatted_address"] == "Egypt") {
                    addMarker({coords: e.latLng});
                } else {
                    alert("Can't Choose Place Outside Egypt");
                }
            } else {
                alert("Error: " + status);
            }
        });
        console.log(markers.length);
    });

//   const bermudaTriangle = new google.maps.Polygon({
//     // paths: [displayedAreaCoords, Eqypt_outer_boundary],
//     paths: Eqypt_outer_boundary,
//     strokeColor: "#FFC107",
//     strokeOpacity: 0.8,
//     strokeWeight: 2,
//     fillColor: "#FFC107",
//     fillOpacity: 0.35,
//   });

//   bermudaTriangle.setMap(map);

//   var origin1 = new google.maps.LatLng(55.930385, -3.118425);
//   var origin2 = "Greenwich, England";
//   var destinationA = "Stockholm, Sweden";
//   var destinationB = new google.maps.LatLng(50.087692, 14.42115);

//   var from = {
//     lat: 30.168994885075673,
//     lng: 31.043633237089015,
//   };
//   var to = {
//     lat: 30.276463980766895,
//     lng: 30.933139113486938,
//   };

//   const ctaLayer = new google.maps.KmlLayer({
//     url: "C:\\Users\\hp\\Downloads\\EGY_adm0+(2).kml",
//     map: map,
//   });

    // const options = {
    //     // types: ['(cities)'],
    //     componentRestrictions: { country: "eg" },
    //     language: "en",
    // };

//   var input = document.getElementById("places");
//   const autocomplete = new google.maps.places.Autocomplete(input, options);

//   google.maps.event.addListener(autocomplete, "place_changed", function () {
//     console.log("kk");
//     var marker = new google.maps.Marker({
//       position: autocomplete.getPlace().geometry.location,
//       map: map,
//     });
//     map.panTo(autocomplete.getPlace().geometry.location);
//   });

    // Bind the map's bounds (viewport) property to the autocomplete object,
    // so that the autocomplete requests use the current map bounds for the
    // bounds option in the request.
    // autocomplete.bindTo("bounds", map);

//   const displaySuggestions = function (predictions, status) {
//     if (status != google.maps.places.PlacesServiceStatus.OK || !predictions) {
//       alert(status);
//       return;
//     }

//     let currentLocationDiv = `<div class="pac-item current-location-item" id="currentLocation"><span class="pac-icon pac-icon-marker"></span><span class="pac-item-query"><span class="pac-matched">Use Current Location</span></span></div>`;
//     $(".pac-container").prepend(currentLocationDiv);
//     $(".current-location-item").on("click", () => {
//       console.log("current location");
//     });
//     google.maps.event.addDomListener(
//       document.getElementById("currentLocation"),
//       "click",
//       function (e) {
//         console.log("currentLocation");
//       }
//     );
//   };

//   function handleLocationError(browserHasGeolocation, infoWindow, pos) {
//     infoWindow.setPosition(pos);
//     infoWindow.setContent(
//       browserHasGeolocation
//         ? "Error: The Geolocation service failed."
//         : "Error: Your browser doesn't support geolocation."
//     );
//     infoWindow.open(map);
//     // li.appendChild(document.createTextNode(prediction.description));
//     // document.getElementById("results").appendChild(li);
//   }

//   const service = new google.maps.places.AutocompleteService();

//   service.getQueryPredictions({ input: "pizza near Syd" }, displaySuggestions);

    // var url = `https://maps.googleapis.com/maps/api/distancematrix/json?origins=${from.lat},${from.lng}&destinations=${to.lat},${to.lng}&key=AIzaSyAygfWV6pZGwRoN3dANb0LrLt_kGLLTAvk`;
    // $.ajax({
    //     url: url,
    //     success: function (result) {
    //         $("#div1").html(result);
    //     },
    //     error: function (result) {
    //         console.log(result);
    //     }
    // });
}

function computeTotalDistance(routeData) {
    let text = "Driving distance is " +
        routeData.distance.text +
        " (" +
        routeData.duration.text +
        ").";
    $("#km_num").val(routeData.distance.text.replace(" km", ""))
    $("#distance").text(text)
    $("#distance-hidden-input").val(text)
    $("#distance-div").css('display', 'flex');

    $("#pickup_address").val(routeData.start_address);
    $("#pickup_label").addClass("label-top stay");
    route.origin.lat = routeData.start_location.lat();
    route.origin.lng = routeData.start_location.lng();
    $("#origin_coords").val(routeData.start_location.lat() + "-" + routeData.start_location.lng());

    $("#dropoff_address").val(routeData.end_address);
    $("#dropoff_label").addClass("label-top stay");
    route.destination.lat = routeData.end_location.lat();
    route.destination.lng = routeData.end_location.lng();
    $("#destination_coords").val(routeData.end_location.lat() + "-" + routeData.end_location.lng());
}

function getPlacePredictions(search) {
    autocompleteService.getPlacePredictions(
        {
            input: search,
            componentRestrictions: {country: "eg"},
            language: "en",
            // types: ['establishment', 'geocode']
        },
        callback
    );
}

function showCurrentLocationOptionOnly() {
    results.innerHTML = "";

    // Build output with custom addresses
    results.innerHTML +=
        '<div class="pac-item custom" id="Custom"><span class="pac-icon pac-icon-marker"></span>Use Current Location</div>';

    results.style.display = "block";

    google.maps.event.addDomListener(
        document.getElementById("Custom"),
        "click",
        function (e) {
            // Try HTML5 geolocation.
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude,
                        };

                        geocoder
                            .geocode({location: pos})
                            .then((response) => {
                                if (response.results[0]) {
                                    var marker = new google.maps.Marker({
                                        position: pos,
                                        map: map,
                                    });
                                    markers.push(marker);
                                    map.setZoom(12);
                                    map.setCenter(pos);
                                    $("#pickup_address").val(response.results[0].formatted_address);
                                    $("#pickup_label").addClass("label-top stay");
                                    route.origin.lat = pos.lat;
                                    route.origin.lng = pos.lng;
                                    $("#origin_coords").val(pos.lat + "-" + pos.lng);
                                    showDistination();
                                } else {
                                    window.alert("No results found");
                                }
                            })
                            .catch((e) => window.alert("Geocoder failed due to: " + e));
                        $("#results").css('display', 'none');
                    },
                    () => {
                        //   handleLocationError(true, infoWindow, map.getCenter());
                    }
                );
            } else {
                // Browser doesn't support Geolocation
                //   handleLocationError(false, infoWindow, map.getCenter());
            }
        }
    );
}

// Place search callback
function callback(predictions, status) {
    // Empty results container
    results.innerHTML = "";

    // Place service status error
    if (status != google.maps.places.PlacesServiceStatus.OK) {
        results.innerHTML =
            '<div class="pac-item pac-item-error">Your search returned no result. Status: ' +
            status +
            "</div>";
        return;
    }

    // Build output with custom addresses
    results.innerHTML +=
        '<div class="pac-item custom" id="Custom"><span class="pac-icon pac-icon-marker"></span>Use Current Location</div>';

    // Build output for each prediction
    for (var i = 0, prediction; (prediction = predictions[i]); i++) {
        // Insert output in results container
        results.innerHTML +=
            '<div class="pac-item" data-placeid="' +
            prediction.place_id +
            '" data-name="' +
            prediction.terms[0].value +
            '"><span class="pac-icon pac-icon-marker"></span>' +
            prediction.description +
            "</div>";
    }

    var items = document.getElementsByClassName("pac-item");

    // Results items click
    for (var i = 0, item; (item = items[i]); i++) {
        item.onclick = function () {
            if (this.dataset.placeid) {
                getPlaceDetails(this.dataset.placeid);
            }
        };
    }

    google.maps.event.addDomListener(
        document.getElementById("Custom"),
        "click",
        function (e) {
            // Try HTML5 geolocation.
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude,
                        };

                        geocoder
                            .geocode({location: pos})
                            .then((response) => {
                                if (response.results[0]) {
                                    var marker = new google.maps.Marker({
                                        position: pos,
                                        map: map,
                                    });
                                    markers.push(marker);
                                    map.setZoom(12);
                                    map.setCenter(pos);
                                    $("#pickup_address").val(response.results[0].formatted_address);
                                    $("#pickup_label").addClass("label-top stay");
                                    route.origin.lat = pos.lat;
                                    route.origin.lng = pos.lng;
                                    $("#origin_coords").val(pos.lat + "-" + pos.lng);
                                    showDistination();
                                } else {
                                    window.alert("No results found");
                                }
                            })
                            .catch((e) => window.alert("Geocoder failed due to: " + e));
                        $("#results").css('display', 'none');
                    },
                    () => {
                        //   handleLocationError(true, infoWindow, map.getCenter());
                    }
                );
            } else {
                // Browser doesn't support Geolocation
                //   handleLocationError(false, infoWindow, map.getCenter());
            }
        }
    );
}

function getPlaceDetails(placeId) {
    var request = {
        placeId: placeId,
    };

    placesService.getDetails(request, function (place, status) {
        if (status === google.maps.places.PlacesServiceStatus.OK) {
            var center = place.geometry.location;
            var marker = new google.maps.Marker({
                position: center,
                // map: map,
            });
            markers.push(marker);
            map.setZoom(12);
            map.setCenter(center);
            $("#pickup_address").val(place.formatted_address);
            $("#pickup_label").addClass("label-top stay");
            route.origin.lat = place.geometry.location.lat();
            route.origin.lng = place.geometry.location.lng();
            $("#origin_coords").val(place.geometry.location.lat() + "-" + place.geometry.location.lng());

            showDistination();
            // Hide autocomplete results
            results.style.display = "none";
        }
    });
}

function getPlacePredictions2(search) {
    autocompleteService.getPlacePredictions(
        {
            input: search,
            componentRestrictions: {country: "eg"},
            language: "en",
            // types: ['establishment', 'geocode']
        },
        callback2
    );
}

// Place search callback
function callback2(predictions, status) {
    // Empty results container
    results2.innerHTML = "";

    // Place service status error
    if (status != google.maps.places.PlacesServiceStatus.OK) {
        results2.innerHTML =
            '<div class="pac-item pac-item-error">Your search returned no result. Status: ' +
            status +
            "</div>";
        return;
    }

    // Build output for each prediction
    for (var i = 0, prediction; (prediction = predictions[i]); i++) {
        // Insert output in results container
        results2.innerHTML +=
            '<div class="pac-item" data-placeid="' +
            prediction.place_id +
            '" data-name="' +
            prediction.terms[0].value +
            '"><span class="pac-icon pac-icon-marker"></span>' +
            prediction.description +
            "</div>";
    }

    var items = document.getElementsByClassName("pac-item");

    // Results items click
    for (var i = 0, item; (item = items[i]); i++) {
        item.onclick = function () {
            if (this.dataset.placeid) {
                getPlaceDetails2(this.dataset.placeid);
            }
        };
    }
}

function getPlaceDetails2(placeId) {
    var request = {
        placeId: placeId,
    };

    placesService.getDetails(request, function (place, status) {
        if (status === google.maps.places.PlacesServiceStatus.OK) {
            var center = place.geometry.location;
            var marker = new google.maps.Marker({
                position: center,
                // map: map,
            });
            markers.push(marker);
            map.setZoom(12);
            map.setCenter(center);
            $("#dropoff_address").val(place.formatted_address);
            $("#dropoff_label").addClass("label-top stay");
            route.destination.lat = place.geometry.location.lat();
            route.destination.lng = place.geometry.location.lng();
            $("#destination_coords").val(place.geometry.location.lat() + "-" + place.geometry.location.lng());
            showDistination();
            // Hide autocomplete results
            results2.style.display = "none";
        }
    });
}

function showDistination() {
    directionsRenderer.setMap(map); // Existing map object displays directions
    directionsService.route(route, function (response, status) {
        // anonymous function to capture directions
        if (status == "OK") {
            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap();
            }
            directionsRenderer.setDirections(response); // Add route to the map
            var directionsData = response.routes[0].legs[0]; // Get data about the mapped route
            if (!directionsData) {
                window.alert("Directions request failed");
                return;
            } else {
                let text = "Driving distance is " +
                    directionsData.distance.text +
                    " (" +
                    directionsData.duration.text +
                    ").";
                $("#km_num").val(directionsData.distance.text.replace(" km", ""))
                $("#distance").text(text)
                $("#distance-hidden-input").val(text)
                $("#distance-div").css('display', 'flex');
            }
        } else if (status == "ZERO_RESULTS") {
            let text = "There is no way between the selected points";
            $("#km_num").val("")
            $("#distance").text(text)
            $("#distance-hidden-input").val(text)
            $("#distance-div").css('display', 'flex');
            return;
        }
    });
}

function removeAllMarkers() {
    directionsRenderer.setMap();
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap();
    }
    markers = []
    route = {
        origin: {
            lat: "",
            lng: "",
        },
        destination: {
            lat: "",
            lng: "",
        },
        travelMode: "DRIVING",
    }
    map.setZoom(6);
    map.setCenter({lat: 30.033333, lng: 31.233334})
}

function addYourLocationButton(map) {
    var controlDiv = document.createElement('div');

    var firstChild = document.createElement('button');
    firstChild.style.backgroundColor = '#fff';
    firstChild.style.border = 'none';
    firstChild.style.outline = 'none';
    firstChild.style.width = '40px';
    firstChild.style.height = '40px';
    firstChild.style.borderRadius = '2px';
    firstChild.style.boxShadow = '0 1px 4px rgba(0,0,0,0.3)';
    firstChild.style.cursor = 'pointer';
    firstChild.style.marginRight = '10px';
    firstChild.style.padding = '0px';
    firstChild.title = 'Your Location';
    controlDiv.appendChild(firstChild);

    var secondChild = document.createElement('div');
    secondChild.style.margin = '5px';
    secondChild.style.width = '30px';
    secondChild.style.height = '30px';
    secondChild.style.backgroundImage = 'url(current-location-icon.png)';
    secondChild.style.opacity = '.6';
    secondChild.style.backgroundSize = '30px 30px';
    secondChild.style.backgroundPosition = '0px 0px';
    secondChild.style.backgroundRepeat = 'no-repeat';
    secondChild.id = 'you_location_img';
    firstChild.appendChild(secondChild);

    google.maps.event.addListener(map, 'dragend', function () {
        $('#you_location_img').css('background-position', '0px 0px');
    });

    firstChild.addEventListener('mouseenter', function () {
        secondChild.style.opacity = '1';
    })
    firstChild.addEventListener('mouseleave', function () {
        secondChild.style.opacity = '.6';
    })
    firstChild.addEventListener('click', function () {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude,
                    };

                    geocoder
                        .geocode({location: pos})
                        .then((response) => {
                            if (response.results[0]) {
                                var marker = new google.maps.Marker({
                                    position: pos,
                                    map: map,
                                });
                                markers.push(marker);
                                map.setZoom(12);
                                map.setCenter(pos);
                                $("#pickup_address").val(response.results[0].formatted_address);
                                $("#pickup_label").addClass("label-top stay");
                                route.origin.lat = pos.lat;
                                route.origin.lng = pos.lng;
                                $("#origin_coords").val(pos.lat + "-" + pos.lng);
                                showDistination();
                            } else {
                                window.alert("No results found");
                            }
                        })
                        .catch((e) => window.alert("Geocoder failed due to: " + e));
                    $("#results").css('display', 'none');
                },
                () => {
                    //   handleLocationError(true, infoWindow, map.getCenter());
                }
            );
        } else {
            // Browser doesn't support Geolocation
            //   handleLocationError(false, infoWindow, map.getCenter());
        }
    });

    controlDiv.index = 1;
    map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(controlDiv);
}


window.initMap = initMap;
