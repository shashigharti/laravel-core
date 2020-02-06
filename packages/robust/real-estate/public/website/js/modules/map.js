;
(function ($, FRW, window, document, undefined) {
    'use strict';
    FRW.Map = {
        init: function () {
            this.map = null;
            this.markerClusters = L.markerClusterGroup({
                iconCreateFunction: function (cluster) {
                    let childCount = cluster.getChildCount();
                    let c = ' marker-cluster-';
                    if (childCount < 4) {
                        c += 'small';
                    } else if (childCount < 100) {
                        c += 'medium';
                    } else {
                        c += 'large';
                    }
                    return new L.DivIcon({
                        html: '<div><span>' + childCount + '</span></div>',
                        className: 'marker-cluster' + c, iconSize: new L.Point(40, 40)
                    });
                }
            });
            const map = document.getElementById('listingMap');
            const zoom = map.dataset.zoom;


            this.map = new L.Map(document.getElementById('listingMap'));
            L.gridLayer.googleMutant({ type: 'roadmap' }).addTo(this.map);
            const items = document.querySelectorAll('.listing-map_data');
            let markers = [];
            const icon = new L.DivIcon({
                className: 'leaflet-marker_icon',
                html: '<i class="material-icons">home</i>'
            });
            const base_url = window.location.origin;

            items.forEach(function (item) {
                const name = item.dataset.name;
                const image = item.dataset.image;
                const slug = item.dataset.slug;
                const lat = item.dataset.lat;
                const lng = item.dataset.lng;
                const price = item.dataset.price;
                const marker = new L.Marker([lat, lng], {
                    title: name,
                    icon: icon
                });
                const url = `${base_url}/real-estate/${slug}`;
                const content = `
                                <div class="map--content">
                                    <p class="map--content_title"><a href="${url}">${name}</a></p>
                                    <img class="map--content_image" src="${image}" alt="${slug}">
                                    <p class="map--content_footer">$${price}</p>
                                </div>
                            `;
                marker.bindPopup(content);
                marker.on('mouseover', function (e) {
                    this.openPopup();
                });
                marker.on('click', function () {
                    window.open(url, '_blank');
                });
                markers.push(marker);
            });
            if (markers.length > 0) {
                this.markerClusters.addLayers(markers);
                this.map.fitBounds(this.markerClusters.getBounds());
                this.map.addLayer(this.markerClusters);
                this.map.setZoom(zoom);
            }
        },
        distance:function () {
            const _this = this;
            $('.get-distance').on('click',function (e) {
                e.preventDefault();
                const destination = $('#autocomplete_address').val();
                const listing = $('.listing-map_data').first();
                const from = `${listing.data('lat')},${listing.data('lng')}`;
                console.log(from);
                const geocoder = new google.maps.Geocoder();
                geocoder.geocode({'address' : destination},function (results,status) {
                    const to = `${results[0].geometry.location.lat()},${results[0].geometry.location.lng()}`;
                    const directionsService = new google.maps.DirectionsService();
                    var directionsDisplay = new google.maps.DirectionsRenderer();
                    const request = {
                        origin: from,
                        destination: to,
                        travelMode: google.maps.DirectionsTravelMode.DRIVING
                    };
                    directionsService.route(request, function (response, status) {
                        if(status === 'OK'){
                            const map = new google.maps.Map(document.getElementById("listingMap"),{
                                zoom: 4,
                                gestureHandling: 'greedy',
                                scrollwheel: false,
                            });
                            const legs = response.routes[0].legs[0];
                            console.log(response);
                            console.log(legs.distance.text);
                            $('.listing_location').html(legs.start_address);
                            $('.destination_location').html(legs.end_address);
                            $('.calculated_distance').parent().removeClass('hide');
                            $('.calculated_distance').html(legs.distance.text);
                            $('.calculated_duration').html(legs.duration.text);
                            directionsDisplay.setDirections(response);
                            directionsDisplay.setMap(map);
                        }else{
                            $('.destination_location').html('No results');
                            $('.calculated_distance').parent().addClass('hide');
                        }
                    });
                });
            })
        }
    };
    $(function () {
        const map = document.getElementById('listingMap');
        if (map) {
            FRW.Map.init();
            FRW.Map.distance();
        }

    });
}(jQuery, FRW, window, document));
