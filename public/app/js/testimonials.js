var reviews = angular.module('customerReviews', ['dataServices']);

reviews.controller('testimonials', ['$scope', '$http','getData', 'setData', function ($scope, $http, getData, setData) {
    getData.getReviews().then(function (data) {
        $scope.testimonialsContents = data.data;
    });
}]);

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