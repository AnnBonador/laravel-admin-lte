var lat = document.getElementById("lat");
var long = document.getElementById("long");
var x = document.getElementById("demo");

if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
} else {
    x.innerHTML = "Geolocation is not supported by this browser.";
}

function showPosition(position) {
    console.log(position);
    $('#lat').val(position.coords.latitude);
    $('#long').val(position.coords.longitude);
}

var check_opt = document.getElementsByClassName('checkFilter');
console.log(check_opt);
var btn = document.getElementById('filter');

function detect() {
    btn.disabled = true;
    for (var index = 0; index < check_opt.length; ++index) {
        console.log(index);
        if (check_opt[index].checked == true) {
            console.log(btn);
            btn.disabled = false;
        }
    }
}
window.onload = function() {
    for (var i = 0; i < check_opt.length; i++) {
        check_opt[i].addEventListener('click', detect)
    }
    
    // when unchecked or checked, run the function
}
$(document).ready(function() {
    $('.search-btn').attr('disabled', true);
    $('input[name="search"]').on('input', function() {
        if ($(this).val().length > 0) {
            $('.search-btn').attr('disabled', false);
        } else {
            $('.search-btn').attr('disabled', true);
        }
    });
});

