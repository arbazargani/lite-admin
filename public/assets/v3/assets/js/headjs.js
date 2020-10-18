// Sidebar Toggle
function sideBarOpener(){
    var sidebar = document.querySelector("#sidebar");
    sidebar.classList.toggle("sidebar-show");

    var overlay = document.querySelector(".sidebar-overlay");
    overlay.classList.toggle("sidebar-overlay-active");
}

// Nice Select Start
$(document).ready(function() {
    $('select').niceSelect();
});

// Switch Tab
function openCity(evt, cityName) {
var i, tabcontent, tablinks;

tabcontent = document.getElementsByClassName("user-left-box-tabs");
for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
}

tablinks = document.getElementsByClassName("user-left-box-tab-links");
for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active-tablink", "");
}

document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active-tablink";
} 