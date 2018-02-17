<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Sell Cars</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
 
        <!-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/2.3.2/css/bootstrap.min.css" /> -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" />
        <link href="../css/materialize.min.css" rel="stylesheet"> 
        <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
        <link rel="stylesheet" href="../css/CSstyle.css" />

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="../css/style-sellcars.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato|Open+Sans:400,600,700" rel="stylesheet">
    </head>

    <body>
    <?php
require 'db_config.php';
if(isset($_POST['submit']))
{
$car_name=mysqli_real_escape_string($con,$_POST['formModel.level1']);
$status = "SHOW TABLE STATUS LIKE 'car_details'";
$status_result = mysqli_query($con,$status);
$status_result_data = mysqli_fetch_assoc($status_result);
$next_increment = $status_result_data['Auto_increment'];
echo $next_increment;
$target_dir = "../public/assets/images/uploads/cardetails";
$images_name="";
$uploadOk=0;

$fileToUpload = $_FILES['fileToUpload'];
/*$imageFileType=end(explode('.',$fileToUpload));
$target_file = $target_dir.$next_increment. ".".$imageFileType;
$uploadOk = 1;
echo $imageFileType."<br/>".$target_file."<br/>";*/
$extension=array("jpeg","jpg","png","gif","JPG","PNG","JPEG");
// if(is_array($_FILES["fileToUpload"]["tmp_name"]))
// {
if(!empty($fileToUpload)){
    $img_desc = reArrayFiles($fileToUpload);
    $total=count($img_desc);
    echo $total."<br />";
    for($key=0;$key<$total;$key++)
    {  
        $ext=end(explode('.',$img_desc[$key]["name"]));
        $targetfile="../public/assets/images/uploads/cardetails/".$next_increment.$car_name.$key.".".$ext;
        echo $targetfile;
        if(in_array($ext,$extension))
        {
            if($img_desc[$key]["size"]<50000000)
            {
             
                if(move_uploaded_file($img_desc[$key]["tmp_name"],$targetfile))
                {
                    if($key == 0){$images_name=$next_increment.$car_name.$key.".".$ext;}
                    if($key > 0){$images_name = $images_name.",".$next_increment.$car_name.$key.".".$ext;}
                    // echo $images_name;
                    $uploadOk=1;

                }
                else{
                    echo "Sorry, there was an error uploading your file.";
                     
                }
             } 
            else
            {
                echo "too large";
            }
        }
        else
        {
            echo "upload img only";
        }
    }
}







$brand_name=mysqli_real_escape_string($con,$_POST['make']);
$varient=mysqli_real_escape_string($con,$_POST['varient']);
$brand_id=mysqli_real_escape_string($con,$_POST['brand_id']);
$year=mysqli_real_escape_string($con,$_POST['year']);
$color=mysqli_real_escape_string($con,$_POST['color']);
$car_img=$images_name;
$body_type=mysqli_real_escape_string($con,$_POST['body_type']);
$kilometers=mysqli_real_escape_string($con,$_POST['kilometers']);
$transmission=mysqli_real_escape_string($con,$_POST['transmission']);
$owners=mysqli_real_escape_string($con,$_POST['owners']);
$mileage=mysqli_real_escape_string($con,$_POST['mileage']);
$fuel_type=mysqli_real_escape_string($con,$_POST['fuel_type']);
$price=mysqli_real_escape_string($con,$_POST['price']);
$count=mysqli_real_escape_string($con,$_POST['count']);
$sql = "INSERT INTO car_details (car_name, model, brand_name, brand_id, year, color, car_img, body_type, kilometers, transmission, owners, mileage, fuel_type, price)
VALUES ('$car_name', '$model', '$brand_name', '$brand_id','$year', '$color', '$car_img','$body_type', '$kilometers', '$transmission', '$owners', '$mileage', '$fuel_type', '$price')";
if ($uploadOk == 1) {
if (mysqli_query($con, $sql)) {
    $count_update = "UPDATE brands SET count = count+1 WHERE id='$brand_id'";
    mysqli_query($con,$count_update);
    echo "New record created successfully";
    //header('location:car_details_list.php');
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}
}
}

function reArrayFiles($file)
{
    $file_ary = array();
    $file_count = count($file['name']);
    $file_key = array_keys($file);
    
    for($i=0;$i<$file_count;$i++)
    {
        foreach($file_key as $val)
        {
            $file_ary[$i][$val] = $file[$val][$i];
        }
    }
    return $file_ary;
}
/*$brandlist_sql = "SELECT * FROM brands";
$brandlist_result = mysqli_query($con,$brandlist_sql);
$Colors=["AliceBlue","AntiqueWhite","Aqua","Aquamarine","Azure","Beige","Bisque","Black","BlanchedAlmond","Blue","BlueViolet","Brown","BurlyWood","CadetBlue","Chartreuse","Chocolate","Coral","CornflowerBlue","Cornsilk","Crimson","Cyan","DarkBlue","DarkCyan","DarkGoldenRod","DarkGray","DarkGrey","DarkGreen","DarkKhaki","DarkMagenta","DarkOliveGreen","Darkorange","DarkOrchid","DarkRed","DarkSalmon","DarkSeaGreen","DarkSlateBlue","DarkSlateGray","DarkSlateGrey","DarkTurquoise","DarkViolet","DeepPink","DeepSkyBlue","DimGray","DimGrey","DodgerBlue","FireBrick","FloralWhite","ForestGreen","Fuchsia","Gainsboro","GhostWhite","Gold","GoldenRod","Gray","Grey","Green","GreenYellow","HoneyDew","HotPink","IndianRed","Indigo","Ivory","Khaki","Lavender","LavenderBlush","LawnGreen","LemonChiffon","LightBlue","LightCoral","LightCyan","LightGoldenRodYellow","LightGray","LightGrey","LightGreen","LightPink","LightSalmon","LightSeaGreen","LightSkyBlue","LightSlateGray","LightSlateGrey","LightSteelBlue","LightYellow","Lime","LimeGreen","Linen","Magenta","Maroon","MediumAquaMarine","MediumBlue","MediumOrchid","MediumPurple","MediumSeaGreen","MediumSlateBlue","MediumSpringGreen","MediumTurquoise","MediumVioletRed","MidnightBlue","MintCream","MistyRose","Moccasin","NavajoWhite","Navy","OldLace","Olive","OliveDrab","Orange","OrangeRed","Orchid","PaleGoldenRod","PaleGreen","PaleTurquoise","PaleVioletRed","PapayaWhip","PeachPuff","Peru","Pink","Plum","PowderBlue","Purple","Red","RosyBrown","RoyalBlue","SaddleBrown","Salmon","SandyBrown","SeaGreen","SeaShell","Sienna","Silver","SkyBlue","SlateBlue","SlateGray","SlateGrey","Snow","SpringGreen","SteelBlue","Tan","Teal","Thistle","Tomato","Turquoise","Violet","Wheat","White","WhiteSmoke","Yellow","YellowGreen"];
    $fueltypes=["Petrol","Diesel","CNG","LPG","Electric"];*/
    $transmissiontypes=["Manual","Automatic"];
    $bodyOptions = ["Hatchback","SUV","MUV","Sedan","Minivan","Station Wagon","Coupe","Truck","Convertible"];
?>

      <!--   <div id="header" class="header">

              <nav>
                <div class="nav-wrapper">
                  <a href="#!" class="brand-logo logo"><img src="../images/logo1.png"></a>
                  <a href="#" data-activates="mobile-demo" class="button-collapse"> <img src="images/menu.png"><!-- <i class="material-icons">menu</i> --></a>
                  <div class="menu">
                      <ul class="right hide-on-med-and-down menu">
                        <a href="index.html"><li class="sliding-middle-out">Home</li></a>
                        <a href="buycars.html"><li class="sliding-middle-out">Buy Cars</li></a>
                        <a href="sellcars.html"><li class="sliding-middle-out">Sell Cars</li></a>
                        <a href="index.html"><li class="sliding-middle-out">Reviews</li></a>
                        <a href="contact.php"><li class="sliding-middle-out">Contact</li></a>
                      </ul>
                  </div>
                  <div class="side-menu">
                      <ul class="side-nav" id="mobile-demo">
                        <a href="index.html"><li>Home</li></a>
                        <a href="buycars.html"><li>Buy Cars</li></a>
                        <a href="sellcars.html"><li>Sell Cars</li></a>
                        <a href="index.html"><li>Reviews</li></a>
                        <a href="contact.php"><li>Contact</li></a>
                      </ul>
                  </div>
                </div>
              </nav>
        </div>

 -->


        <div id="sellCars" ng-app="Demo">     
            <div class="container" ng-controller="DemoController">
                
                <form name="myForm" novalidate method="post" action="" multipart="" enctype="multipart/form-data">
                        <h3>Car Details</h3>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Make</label><br/>
                                <div custom-select="item.id as item.name for item in nestedItemsLevel1 | filter: $searchTerm" custom-select-options="level1Options" ng-model="formModel.level1" name="make"  ng-class="{'has-error': !myForm.make.$valid && !myForm.make.$pristine}" required></div>
                                <span class="help-block" ng-show="myForm.make.$error.required  && (!myForm.make.$pristine || myForm.$submitted)">Required!</span>
                            </div>
                            <div class="col-md-3">
                                <label>Model</label><br/>
                                <div custom-select="x for x in nestedItemsLevel2 | filter: $searchTerm" custom-select-options="level2Options" ng-model="formModel.level2" cs-depends-on="formModel.level1" name="model"  ng-class="{'has-error': !myForm.model.$valid && !myForm.model.$pristine}" required></div>
                                <span class="help-block" ng-show="myForm.make.$error.required  && (!myForm.make.$pristine || myForm.$submitted)">Required!</span>
                            </div>
                            <div class="col-md-3">
                                <label>Varient</label><br/>
                                <div custom-select="x for x in nestedItemsLevel3 | filter: $searchTerm" custom-select-options="level3Options" ng-model="formModel.level3" cs-depends-on="formModel.level2" name="varient"></div>
                            </div>
                            <div class="col-md-3">
                                <label>Fuel Type</label><br/>
                                <div custom-select="x for x in nestedItemsLevel4 | filter: $searchTerm" ng-model="formModel.level4" cs-depends-on="formModel.level3" name="fType" required></div>
                                <span class="help-block" ng-show="myForm.fType.$error.required && (!myForm.fType.$pristine || myForm.$submitted)">Required!</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label>Kilometers</label><br/>
                                <input class="kmsInput form-control" type="text" name="kilometers" ng-model="formModel.kms" required>
                                <span class="help-block" ng-show="myForm.kilometers.$error.required && (!myForm.kilometers.$pristine || myForm.$submitted)">Required!</span>
                            </div>
                            <div class="col-md-3 form-group">
                               <label>Colors</label><br/>
                                <div custom-select="x for x in Colors | filter: $searchTerm" ng-model="formModel.color" name="color"></div> 
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Ownership</label><br/>
                                <div custom-select="x for x in Ownership | filter: $searchTerm" ng-model="formModel.ownership" name="owner" required></div>
                                <span class="help-block" ng-show="myForm.owner.$error.required && (!myForm.owner.$pristine || myForm.$submitted)">Required!</span>
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Year</label><br/>
                                <div custom-select="x for x in Years | filter: $searchTerm" ng-model="formModel.year" name="year" required></div>
                                <span class="help-block" ng-show="myForm.year.$error.required && (!myForm.year.$pristine || myForm.$submitted)">Required!</span>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label>Transmission</label><br/>
                                <div custom-select="x for x in Transmission | filter: $searchTerm" ng-model="formModel.transmission" name="transmission" required></div>
                                <span class="help-block" ng-show="myForm.transmission.$error.required && (!myForm.transmission.$pristine || myForm.$submitted)">Required!</span>
                            </div>
                          <!--   <div class="col-md-3 form-group">
                               <label>Colors</label><br/>
                                <div custom-select="x for x in Colors | filter: $searchTerm" ng-model="formModel.color" name="color"></div> 
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Ownership</label><br/>
                                <div custom-select="x for x in Ownership | filter: $searchTerm" ng-model="formModel.ownership" name="owner" required></div>
                                <span class="help-block" ng-show="myForm.owner.$error.required && (!myForm.owner.$pristine || myForm.$submitted)">Required!</span>
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Year</label><br/>
                                <div custom-select="x for x in Years | filter: $searchTerm" ng-model="formModel.year" name="year" required></div>
                                <span class="help-block" ng-show="myForm.year.$error.required && (!myForm.year.$pristine || myForm.$submitted)">Required!</span>
                            </div> -->
                        </div>
<!--                         <div class="submit ">
                            <input class="submit-btn btn-primary" type="submit"></input>
                        </div>
                         -->
                         body_type: <select type="text" name="body_type">
                                <?php
                                foreach($bodyOptions as $val)
                                {
                                    echo '<option value="'.$val.'">'.$val.'</option>';
                                }
                             ?>
                        </select> <br>
                        <!-- kilometers: <input type="text" name="kilometers"><br> -->
                        
                        Image:<input type="file" name="fileToUpload[]" id="fileToUpload" multiple >
                        <br>
                        <input type="submit" name="submit">
                </form>
                <!-- <pre>{{myForm  | json}}</pre> -->
            </div>
        </div>


        <script src="../js/materialize.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>    
        
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.3/angular.min.js"></script>
        <script src="../js/customSelect.js"></script>
        <!-- <script src="js/jcs-auto-validate.min.js"></script> -->
        <script>
            (function () {
                var app = angular.module('Demo', ['chainSelect']);
                /*app.value('level1', {
                    displayText: 'make'
                });*/
                app.controller('DemoController', ['$scope', '$timeout', '$q', '$http', function ($scope, $timeout, $q, $http) {
                    
                    $scope.phoneNumbr = /^\+?\d{2}[- ]?\d{3}[- ]?\d{5}$/;
                    var co_option;
                    $http.get("../ws/brand1.php").then(function(response){
                        $scope.nestedItemsLevel1 = response.data.data;
                        // console.log(response.data.data);
                    });
                    $http.get("../ws/all1.php").then(function(response){
                        co_option = response.data.data;
                            // console.log(response.data.data);
                        });

                      $scope.Colors=["AliceBlue","AntiqueWhite","Aqua","Aquamarine","Azure","Beige","Bisque","Black","BlanchedAlmond","Blue","BlueViolet","Brown","BurlyWood","CadetBlue","Chartreuse","Chocolate","Coral","CornflowerBlue","Cornsilk","Crimson","Cyan","DarkBlue","DarkCyan","DarkGoldenRod","DarkGray","DarkGrey","DarkGreen","DarkKhaki","DarkMagenta","DarkOliveGreen","Darkorange","DarkOrchid","DarkRed","DarkSalmon","DarkSeaGreen","DarkSlateBlue","DarkSlateGray","DarkSlateGrey","DarkTurquoise","DarkViolet","DeepPink","DeepSkyBlue","DimGray","DimGrey","DodgerBlue","FireBrick","FloralWhite","ForestGreen","Fuchsia","Gainsboro","GhostWhite","Gold","GoldenRod","Gray","Grey","Green","GreenYellow","HoneyDew","HotPink","IndianRed","Indigo","Ivory","Khaki","Lavender","LavenderBlush","LawnGreen","LemonChiffon","LightBlue","LightCoral","LightCyan","LightGoldenRodYellow","LightGray","LightGrey","LightGreen","LightPink","LightSalmon","LightSeaGreen","LightSkyBlue","LightSlateGray","LightSlateGrey","LightSteelBlue","LightYellow","Lime","LimeGreen","Linen","Magenta","Maroon","MediumAquaMarine","MediumBlue","MediumOrchid","MediumPurple","MediumSeaGreen","MediumSlateBlue","MediumSpringGreen","MediumTurquoise","MediumVioletRed","MidnightBlue","MintCream","MistyRose","Moccasin","NavajoWhite","Navy","OldLace","Olive","OliveDrab","Orange","OrangeRed","Orchid","PaleGoldenRod","PaleGreen","PaleTurquoise","PaleVioletRed","PapayaWhip","PeachPuff","Peru","Pink","Plum","PowderBlue","Purple","Red","RosyBrown","RoyalBlue","SaddleBrown","Salmon","SandyBrown","SeaGreen","SeaShell","Sienna","Silver","SkyBlue","SlateBlue","SlateGray","SlateGrey","Snow","SpringGreen","SteelBlue","Tan","Teal","Thistle","Tomato","Turquoise","Violet","Wheat","White","WhiteSmoke","Yellow","YellowGreen"];
                      $scope.Ownership=["1","2","3","4","5","6","7","8","9","10"];
                      $scope.Transmission=["Manual","Automatic"];
                      
                      /*var items = ["Petrol","Diesel","CNG","LPG","Electric"];
                            $scope.nestedItemsLevel4 = items;*/
                     function yearsList(startYear) {
                            var currentYear = new Date().getFullYear(), years = [];
                            startYear = startYear || 1980;

                            while ( startYear <= currentYear ) {
                                    years.push(startYear++);
                            } 

                            $scope.Years = years;
                    }
                    yearsList();
                    var selectedBrand_id;
                    $scope.level1Options = {
                        onSelect: function (item) {
                            console.log(item.name);
                            var items = [];
                            selectedBrand_id= item.id;
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
                    /*$scope.onSubmit = function(valid){
                        if (valid) {
                        console.log("success");
                        //$scope.formModel = angular.copy({});
                        var config= {
                            method : 'POST',
                            url : 'ws/seller_details.php',
                            data : {
                                'make' : $scope.formModel.level1,
                                'model' : $scope.formModel.level2,
                                'varient' : $scope.formModel.level3,
                                'fuelType' : $scope.formModel.level4,
                                'kilometers' : $scope.formModel.kms,
                                'color' : $scope.formModel.color,
                                'year' : $scope.formModel.year,
                                'ownership' : $scope.formModel.ownership
                            }
                        };
                        var request = $http(config);
                        request.then(function(response){
                            console.log("sent")
                        },function(error){
                            console.log("error");
                        });

                        }else{
                         console.log("invalid")   
                        }
                    };*/
                }]);
                
            })();
        </script>
    </body>
</html>
