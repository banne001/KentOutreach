/**
 * Gets the Google Map of the outreach location.
 */
function initMap() {
    // The location of Uluru
    let outreach = {lat: 47.381830, lng: -122.216370};
    // The map, centered at Uluru
    let map = new google.maps.Map(
        document.getElementById('map'), {zoom:13, center: outreach});
    // The marker, positioned at Uluru
    let marker = new google.maps.Marker({position: outreach, map: map});
}