function getParameterByName(name, url) {
    if (!url) {
        url = window.location.href;
    }
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}
var SelectedId = getParameterByName('id');
var imgId1;
var cardetailsApp = angular.module("cardetailsApp", ["dataServices"]);
cardetailsApp.controller('cardetailsCtrl', ['$scope', '$http', 'getData', function ($scope, $http, getData) {
    getData.getSelectedCarsDetails(SelectedId).then(function (data) {
        console.log(data.data);
       
        var selectedCD = data.data;
        var sCDimg = selectedCD.car_img;
        $scope.carImg = sCDimg.split(",");
        $scope.CDdata = selectedCD;
        $scope.imgId1 = $scope.carImg[0]; 
        // var img1 = document.getElementById(imgId1);
        // myFunction(img1);

    });
}]);
cardetailsApp.filter('numberSeparator', function () {
    return function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
});
cardetailsApp.filter('alphanumPrice', function () {
    return function (x) {
        if (x > 9999999) {
            x = x / 10000000;
            return x + " Cr";
        } else if (x < 100000) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        } else {
            x = x / 100000;
            return x + " Lakh";
        }
    }
});


function myFunction(imgs) {
    var expandImg = document.getElementById("expandedImg");
    var imgText = document.getElementById("imgtext");
    expandImg.src = imgs.src;
    imgText.innerHTML = imgs.alt;
    expandImg.parentElement.style.display = "block";
}

$(document).ready(function () {
    $(".button-collapse").sideNav();
    var scroll_pos = 0;
    $(document).scroll(function () {
        scroll_pos = $(this).scrollTop();
        if ($(window).scrollTop() > $('nav:visible').height()) {
            // if(scroll_pos > $("#header").height()) {
            $("nav").css({ '-moz-transition': 'background  .2s ease-in', '-o-transition': 'background  .2s ease-in', '-webkit-transition': 'background  .2s ease-in', 'background': 'rgba(14, 64, 91,.9)' });
        } else {
            $("nav").css('background-color', 'rgba(50, 7, 97, 0)');
        }
    });
});