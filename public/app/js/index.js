    var filter_app = angular.module('indexFiltersApp',[]);
		filter_app.controller('indexFilterCtrl',function($scope,$http){
        $scope.priceInfo = {
            'min': '50000',
            'max': '999999999'
        }
			function priceList(starPrice,endPrice) {
                      		var prcRange = [];
                            starPrice = starPrice || 50000;
                            endPrice = endPrice || 20000000; 
                            // console.log(starPrice,endPrice)
                            while ( starPrice <= endPrice ) {
        prcRange.push(starPrice);
    if(starPrice < 2000000){
        starPrice += 150000;
    }else if(2000000 <= starPrice && starPrice <= 5000000){
        starPrice += 1000000;
    }else if(5000000 < starPrice && starPrice < 10000000){
        starPrice += 2000000;
    }else if(10000000 <= starPrice && starPrice <= 20000000){
        starPrice += 2500000;
    }
                            }
                            // console.log(prcRange);
                            $scope.priceRangeList = prcRange;
                    }
                    priceList();
                    $scope.bodyOptions = ["Hatchback","SUV","MUV","Sedan","Minivan","Station Wagon","Coupe","Truck","Convertible"];
                    $scope.submit = function(){
                    	
                    	var indexMin = $scope.priceInfo.min;
                    	var indexMax = $scope.priceInfo.max;
                    	//console.log($scope.priceInfo.min);
                    	var selectedBT = $scope.bodyOption;
                    	if(selectedBT == undefined || selectedBT == ""){
        selectedBT = "ud"
    }
    // console.log(selectedBT);
    window.location="buycars.html#"+"?priceMin="+indexMin+"&priceMax="+indexMax+"&selectedBT="+selectedBT;
                    }
		});
		filter_app.filter('alphanumPrice',function(){
			return function(x){
				if(x > 9999999){
        x = x / 10000000;
    return x+" Cr";
				}else if(x < 100000){
					return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
				}else{
        x = x / 100000;
    return x+" Lakh";
				}
			}
		});

var rc_app = angular.module('recentcarsApp', ['dataServices']);
rc_app.controller('recentcarsCtrl', ['$scope', 'getData', function ($scope,  getData){    
    getData.getAllCarsDetails().then(function (data) {
            $scope.recentcars = data.data;
        }); 
    }]);
		rc_app.filter('split',function(){
			return function(input,splitChar,splitIndex){
				return input.split(splitChar)[splitIndex];
			}
		});
		angular.bootstrap(document.getElementById("recentCars"), ['recentcarsApp']);

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
    testimonialCarosule();
});

function testimonialCarosule() {
    var owl = $('.testimonial-owl-carousel');
    owl.owlCarousel({
        stagePadding: 130,
        loop: true,
        margin: 10,
        nav: true,
        // autoplay: true,
        dots: false,
        navText: [
            "<img class='prev' src='../../assets/images/back.png' />",
            "<img class='next' src='../../assets/images/next.png' />"
        ],
        responsive: {
            0: {
                items: 1,
                // stagePadding: -30
            }
            
        }
    });
}

