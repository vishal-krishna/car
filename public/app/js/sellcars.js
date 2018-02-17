(function () {
    var app = angular.module('Demo', ['chainSelect','dataServices']);
                /*app.value('level1', {
                    displayText: 'make'
                });*/
    app.controller('DemoController', ['$scope', '$timeout', '$q', '$http','getData','setData', function ($scope, $timeout, $q, $http, getData, setData) {
                    
                    $scope.phoneNumbr = /^\+?\d{2}[- ]?\d{3}[- ]?\d{5}$/;
                    var co_option;
                    getData.getBrandsList().then(function (data) {
                        $scope.nestedItemsLevel1 = data.data;
                     });
                    getData.getAllCarsList().then(function (data) {
                        co_option = data.data;
                    });    

                      $scope.Colors=["AliceBlue","AntiqueWhite","Aqua","Aquamarine","Azure","Beige","Bisque","Black","BlanchedAlmond","Blue","BlueViolet","Brown","BurlyWood","CadetBlue","Chartreuse","Chocolate","Coral","CornflowerBlue","Cornsilk","Crimson","Cyan","DarkBlue","DarkCyan","DarkGoldenRod","DarkGray","DarkGrey","DarkGreen","DarkKhaki","DarkMagenta","DarkOliveGreen","Darkorange","DarkOrchid","DarkRed","DarkSalmon","DarkSeaGreen","DarkSlateBlue","DarkSlateGray","DarkSlateGrey","DarkTurquoise","DarkViolet","DeepPink","DeepSkyBlue","DimGray","DimGrey","DodgerBlue","FireBrick","FloralWhite","ForestGreen","Fuchsia","Gainsboro","GhostWhite","Gold","GoldenRod","Gray","Grey","Green","GreenYellow","HoneyDew","HotPink","IndianRed","Indigo","Ivory","Khaki","Lavender","LavenderBlush","LawnGreen","LemonChiffon","LightBlue","LightCoral","LightCyan","LightGoldenRodYellow","LightGray","LightGrey","LightGreen","LightPink","LightSalmon","LightSeaGreen","LightSkyBlue","LightSlateGray","LightSlateGrey","LightSteelBlue","LightYellow","Lime","LimeGreen","Linen","Magenta","Maroon","MediumAquaMarine","MediumBlue","MediumOrchid","MediumPurple","MediumSeaGreen","MediumSlateBlue","MediumSpringGreen","MediumTurquoise","MediumVioletRed","MidnightBlue","MintCream","MistyRose","Moccasin","NavajoWhite","Navy","OldLace","Olive","OliveDrab","Orange","OrangeRed","Orchid","PaleGoldenRod","PaleGreen","PaleTurquoise","PaleVioletRed","PapayaWhip","PeachPuff","Peru","Pink","Plum","PowderBlue","Purple","Red","RosyBrown","RoyalBlue","SaddleBrown","Salmon","SandyBrown","SeaGreen","SeaShell","Sienna","Silver","SkyBlue","SlateBlue","SlateGray","SlateGrey","Snow","SpringGreen","SteelBlue","Tan","Teal","Thistle","Tomato","Turquoise","Violet","Wheat","White","WhiteSmoke","Yellow","YellowGreen"];
                      $scope.Ownership=["First owner","Second owner","Third owner","Fourth owner","Fifth owner"];
                      

                     function yearsList(startYear) {
                            var currentYear = new Date().getFullYear(), years = [];
                            startYear = startYear || 1980;

                            while ( startYear <= currentYear ) {
                                    years.push(startYear++);
                            } 

                            $scope.Years = years;
                    }
                    yearsList();
                    $scope.level1Options = {
                        onSelect: function (item) {
                            console.log(item.name);
                            var items = [];
                            angular.forEach(co_option, function(value, key) {
                                 if(value.brand_id == item.id){
                                 this.push(value.car_name);        
                                 }
                            }, items);
                            $scope.nestedItemsLevel2 = items;
                        }
                    };
                    $scope.level2Options = {
                        onSelect: function (item) {
                            console.log(item);
                            var items = [];
                            angular.forEach(co_option, function(value, key) {
                                 if(value.car_name == item){
                                    var count = value.varients.split(',').length;
                                    for(var i=0; i<count; i++){
                                        this.push(value.varients.split(',')[i]); 
                                    }    
                                 }
                            },items);
                            $scope.nestedItemsLevel3 = items;
                        }
                    };
                    $scope.level3Options = {
                        onSelect: function (item) {
                            console.log(item);
                            var items = ["Petrol","Diesel","CNG","LPG","Electric"];
                            $scope.nestedItemsLevel4 = items;
                        }
                    };
                    
                    $scope.nestedItemsLevel2 = [];
                    $scope.nestedItemsLevel3 = [];
                    $scope.nestedItemsLevel4 = [];
                    $scope.onSubmit = function(valid){
                        if (valid) {
                        console.log("success");
                        //$scope.formModel = angular.copy({});
                        var config= {
                            method : 'POST',
                            url: '../../../ws/seller_details.php',
                            data : {
                                'make' : $scope.formModel.level1,
                                'model' : $scope.formModel.level2,
                                'varient' : $scope.formModel.level3,
                                'fuelType' : $scope.formModel.level4,
                                'kilometers' : $scope.formModel.kms,
                                'color' : $scope.formModel.color,
                                'year' : $scope.formModel.year,
                                'owner_ship': $scope.formModel.ownership,
                                'sellerName' : $scope.formModel.name,
                                'sellerEmail' : $scope.formModel.email,
                                'sellerMobile' : $scope.formModel.phone
                            }
                        };
                        var request = $http(config);
                        request.then(function(response){
                            alert("Successfully Submitted");
                            window.location.href = "sellcars.html";
                        },function(error){
                            alert("Try again!")
                        });

                        }else{
                         console.log("invalid")   
                        }
                    };
                }]);
                

   
            })();

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