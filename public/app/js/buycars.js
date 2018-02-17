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
let priceMin = getParameterByName('priceMin');
let priceMax = getParameterByName('priceMax');
let selectedBT = getParameterByName('selectedBT');

// console.log(SelectedId);
var cars = angular.module('allCars', ['dataServices']);
cars.controller('carsCtrl', ['$scope', '$http','getData', 'setData', function ($scope, $http, getData, setData){
			getData.getBrandsList().then(function (data) {
				$scope.brands = data.data;
			});
			getData.getAllCarsDetails().then(function (data) {
				$scope.cars = data.data;
			});  
			getData.getAllCarsList().then(function (data) {
				$scope.all_cars = data.data;
			}); 
		$scope.priceInfo = {
			'min': '50000',
			'max': '999999999'
		}
		$scope.kilometersInfo = {
			'min': '0',
			'max': '9999999'
		}
                    

       
                      function kmsList(startKms,stopKms) {
                      		var kmsdone = [];
                            startKms = startKms || 0;
                            stopKms = stopKms || 100000; 
                            while ( startKms <= stopKms ) {

                                    kmsdone.push(startKms);
                                    startKms+=5000;
                            } 

                            $scope.kmsDone = kmsdone;
                    }
                    kmsList();
                    function ownerList(minval,maxval) {
                      		var ownerslist = [];
                            minval = minval || 1;
                            maxval = maxval || 4; 
                            while ( minval <= maxval ) {

                                    ownerslist.push(minval);
                                    minval+=1;
                            } 

                            $scope.ownerOptions = ownerslist;
                    }
                    ownerList();
                    function priceList(starPrice,endPrice) {
                      		var prcRange = [];
                            starPrice = starPrice || 50000;
                            endPrice = endPrice || 20000000; 
                            // console.log(starPrice,endPrice)
                            while ( starPrice <= endPrice ) {
                            		prcRange.push(starPrice);
                                    if(starPrice < 2000000){
                                    	starPrice+=150000;
                                    }else if(2000000 <= starPrice && starPrice <= 5000000){
                                    	starPrice+=1000000;
                                    }else if(5000000 < starPrice && starPrice < 10000000){
                                    	starPrice+=2000000;
                                    }else if(10000000 <= starPrice && starPrice <= 20000000){
                                    	starPrice+=2500000;
                                    }
                            } 
                            // console.log(prcRange);
                            $scope.priceRangeList = prcRange;
                    }
                    priceList();
                      $scope.bodyOptions = ["Hatchback","SUV","MUV","Sedan","Minivan","Station Wagon","Coupe","Truck","Convertible"];
                      $scope.fuelOptions = ["Petrol","Diesel","CNG","LPG","Electric"];
                      $scope.transmissionOptions = ["Manual","Automatic"];
                      $scope.colorOptions = ["White","Black","Silver","Red","Blue","Grey","Beige","Brown","Yellow","Green","Purple","Maroon"];
                      $scope.Filter = new Object(); 
                      $scope.Filter.carNames = {}; 
                      $scope.Filter.bodyTypes = {}; 
                      $scope.Filter.fuelTypes = {}; 
                      $scope.Filter.transmissionTypes = {}; 
                      $scope.ownerInfo ={};
                      $scope.colorTypes = {};
					if (priceMin != null && priceMax != null && selectedBT != null) {
						
						$scope.priceInfo.min = priceMin;
						$scope.priceInfo.max = priceMax;
						if(selectedBT != "ud"){
							$scope.Filter.bodyTypes[selectedBT] = selectedBT;
						}
					}
                      
                    

		}]);
		
	



		cars.filter('split',function(){
				return function(input,splitChar,splitIndex){
					return input.split(splitChar)[splitIndex];
				}
			});	
		cars.filter('numberSeparator',function(){
			return function numberWithCommas(x) {
		    	return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
			}
		});
		cars.filter('alphanumPrice',function(){
			return function(x){
				if(x > 9999999){
					x = x/10000000;
					return x+" Cr";
				}else if(x < 100000){
					return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
				}else{
					x = x/100000;
					return x+" Lakh";
				}
			}
		});
		cars.filter('priceRange', function() {

			return function(listings, priceInfo) {
				// console.log(priceInfo);
				var filtered = [];

				var min = parseInt(priceInfo.min);
				var max = parseInt(priceInfo.max);

				angular.forEach(listings, function(listing) {
					var iCarPrice = parseInt(listing.price);
					if( iCarPrice >= min && iCarPrice <= max) {
						filtered.push(listing);
					}
				});

				return filtered;
			}
		});
		cars.filter('kilometersDone', function() {

			return function(listings,kilometersInfo) {
				var filtered = [];

				var min = parseInt(kilometersInfo.min);
				var max = parseInt(kilometersInfo.max);

				angular.forEach(listings, function(listing) {
					var iKilometersdone = parseInt(listing.kilometers);
					if( iKilometersdone >= min && iKilometersdone <= max) {
						filtered.push(listing);
					}
				});

				return filtered;
			}
		});
		cars.filter('ownershipNum', function() {
			return function(listings, filtrs) {
				var filtered = [];

			var Continue= true;
			var nonNegative= false;
				var ownerInfo = filtrs;console.log(ownerInfo);
				angular.forEach(listings, function(listing) {
					var iOwnership = parseInt(listing.owners);
					angular.forEach(ownerInfo, function(ownerInf){
						 if(Continue) {
	   					 if(ownerInf.charAt(0)!="!"){
	   					 	console.log(ownerInf.charAt(0));
	      						Continue = false;
	      						nonNegative = true;
	   						 }
	  					} 
						if( iOwnership == ownerInf) {
							filtered.push(listing);
						}
						if(ownerInf == 99 && iOwnership>4){
							filtered.push(listing);
						}
					});
					
				});
				console.log(filtered.length,nonNegative);
				if(filtered.length < 1 && nonNegative==false){
	                	return listings;
	            }else if(filtered.length < 1 && nonNegative==true){
	                	return filtered;
	            }else if(filtered.length>0){
	            		return filtered;
	            }
			}
		});
		cars.filter('colorFilter', function() {

			return function(listings, filtrs) {
				var filtered = [];
				var Colors = filtrs;
				 // console.log(Colors);
				var ColorList = ["White","Black","Silver","Red","Blue","Grey","Beige","Brown","Yellow","Green","Purple","Maroon"];
				angular.forEach(Colors, function(colr) {
					var fColor = colr.toLowerCase();
					// console.log(fColor);
					fColor = fColor.toLowerCase();
					angular.forEach(listings, function(listing){
					var lColor = listing.color;
						lColor = lColor.toLowerCase();
						console.log(lColor,fColor);
						if( lColor == fColor) {
							filtered.push(listing);
							console.log(filtered);
						}
					});
					
				});
				// console.log(filtered.length);
				if(filtered.length<1){
					return listings;
				}else{
					return filtered;
				}
				
	        }    
		});
		cars.filter('num2Words', function(){
			var special = ['Zeroth','First', 'Second', 'Third', 'Fourth', 'Fifth', 'Sixth', 'Seventh', 'Eighth', 'Ninth', 'Tenth', 'Eleventh', 'Twelvth', 'Thirteenth', 'Fourteenth', 'Fifteenth', 'Sixteenth', 'Seventeenth', 'Eighteenth', 'Nineteenth'];
			var deca = ['Twent', 'Thirt', 'Fourt', 'Fift', 'Sixt', 'Sevent', 'Eight', 'Ninet'];
			return function(n){
				if (n < 20) return special[n];
  				if (n%10 === 0) return deca[Math.floor(n/10)-2] + 'ieth';
  				return deca[Math.floor(n/10)-2] + 'y-' + special[n%10];
			}
		});

		cars.filter('searchFilter',function($filter) {
	        return function(items,searchfilter) {
	        	 // console.log(searchfilter);
	             var isSearchFilterEmpty = true;
	             var isNegative = false;  
	             var isAssigned = false;  
	             var keepGoing = true;  
	             var keepGoing2 = true;  
	              angular.forEach(searchfilter, function(searchstring) {   

	   					 	// console.log(searchstring.charAt(0));
	                  if(searchstring !=null && searchstring !=""){
	                      isSearchFilterEmpty= false;
	                      // console.log(isSearchFilterEmpty);
	                      if(keepGoing) {
	   					 if(searchstring.charAt(0)=="!"){
	      						keepGoing = false;
	      						isNegative = true;
	   						 }
	  					}
	  					if(keepGoing2) {
	   					 if(searchstring.charAt(0)!="!"){
	      						keepGoing2 = false;
	      						isAssigned = true;
	   						 }
	  					}
	                  }
	                  
	              });
	        if(!isSearchFilterEmpty){
	                var result = [];
	                angular.forEach(items, function(item) {  
	                    var isFound = false;
	                     angular.forEach(item, function(term,key) {     
	                      // console.log(item);                    
	                         if(term != null &&  !isFound){
	                         	// console.log(!isFound);
	                             term = term.toString();
	                             term = term.toLowerCase();
	                              // console.log(term);
	                                angular.forEach(searchfilter, function(searchstring) {      
	                                    searchstring = searchstring.toLowerCase();
	                                     console.log(searchfilter);
	                                    if(searchstring !="" && term.indexOf(searchstring) !=-1 && !isFound){
	                                    	// console.log(item);
	                                       result.push(item);
	                                        isFound = true;
	                                    }
	                                });
	                         }
	                            });
	                       });
	                // console.log(result.length);
	                if(result.length < 1){
	  				// console.log(isNegative,isAssigned);
	  				if( (isNegative && isAssigned) || isAssigned){
	  					return result;
	  				}else{
	                	return items;
	                }
	                	
	                }else{
	                	return result;
	                }
	            
	        }else{
	  				// console.log(isNegative);
	        return items;
	        }
	    }
	});

$(document).ready(function () { 
    $(".button-collapse").sideNav();
	// $(".filter-button-collapse").click(function () {
		
	// 	$(".filter-button-collapse").css("width", "250px");
		
	// });
	



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
	$('#slide-submenu').on('click', function () {
		$("#wrapper").css('padding-left', '0px');
		$('.mini-submenu').fadeIn();
		

	});

	$('.mini-submenu').on('click', function () {
		// $(this).next('.list-group').toggle('slide');
		$('.mini-submenu').hide();
		$("#wrapper").css('padding-left', '250px');
		
	});	
});

