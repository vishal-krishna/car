angular.module('dataServices',[])
    .factory('getData', function ($http, $q) {
        var getdataFactory = {};

        getdataFactory.getBrandsList = function () {
            return $http.get("../../../ws/brand1.php").then(function (response) {
                return response.data;
            });
        }
        getdataFactory.getAllCarsList = function () {
            return $http.get("../../../ws/all_cars.php").then(function (response) {
                return response.data;
            });
        }
        getdataFactory.getAllCarsDetails = function () {
            return $http.get("../../../ws/cars_list.php").then(function (response) {
                return response.data;
            });
        }
        getdataFactory.getSelectedCarsDetails = function (SelectedId) {
            return $http.get("../../../ws/car_details.php?id=" + SelectedId).then(function (response) {
                return response.data;
            });
        }
        getdataFactory.getReviews = function () {
            return $http.get("../../../ws/customer_reviews_list.php").then(function (response) {
                return response.data;
            });
        }
        getdataFactory.setSellerDetails = function () {
            return $http.get("../../../ws/get_seller_details.php").then(function (response) {
                return response.data;
            });
        }

        return getdataFactory;
})
    .factory('setData', function ($http, $q) {
        var setdataFactory = {};

        setdataFactory.setSellerDetails = function (config) {
            return $http(config).then(function (response) {
                return response;
            }, function (error) {
                return error;
            });
        }
        return setdataFactory;
})