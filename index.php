<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
?>
<!--TODO need to ask how to allow crossorigin without the plugin? -->
<!--TODO maybe have a chrome extension that you can dump the address into your app?-->
<!--TODO make a chrome extension that takes an address and plugs it into your database-->
<!DOCTYPE html>
<html>
<head>

    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">

    <title>Apartment-Shark</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.1/angular.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.1/angular-route.min.js"></script>

    <script src="javascript/angularApp.js"></script>
    <script src="javascript/apiService.js"></script>
    <script src="javascript/getIdFromZillowJson.js"></script>
    <script src="javascript/urlCreationService.js"></script>
    <script src="javascript/xmlToJson.js"></script>
    <script src="javascript/mainController.js"></script>
    <script src="javascript/googleMapsController.js"></script>
    <script src="javascript/displayController.js"></script>
    <script src="javascript/formController.js"></script>
    <script src="javascript/savedController.js"></script>
    <script src="javascript/gallaryController.js"></script>
    <script src="javascript/statsController.js"></script>

    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/stylesheet.css">
</head>
<body ng-app="apartmentShark" ng-controller="mainController as mC">


<nav class="navbar navbar-fixed-top"> <!--top navigation-->
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Apartment-Shark</a>
        </div>
        <div>
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">Settings</a></li>

            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">

    <div class="col-md-4">

        <div class="container-fluid">
            <div class="row" ng-controller="formController as fc">

                <div class="col-md-12">
                    <h2>search for an apartment</h2>
                    <div class="form-group">
                        <label for="street">Street:</label>
                        <input id='street' type="text" placeholder="enter a street" class="form-control" ng-model="fc.currentFormInput.street">
                        <p>{{fc.currentFormInput.street}}</p>
                    </div>

                    <div class="form-group">
                        <label for="city">City:</label>
                        <input id="city" type="text" placeholder = "enter a city" class="form-control" ng-model="fc.currentFormInput.city">
                        <p>{{fc.currentFormInput.city}}</p>
                    </div>

                    <div class="form-group">
                        <label for="street">State:</label>
                        <input id='state' type="text" placeholder="enter a state" class="form-control" ng-model="fc.currentFormInput.state">
                        <p>{{fc.currentFormInput.state}}</p>
                    </div>
                    <br>
                    <button type="button" class="btn btn-success" ng-click="fc.search(fc.currentFormInput.street,fc.currentFormInput.city, fc.currentFormInput.state)">Search!</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12" id="savedColumn">
                    <div id="savedApartments" >
                        <h2>Your Saved Apartments</h2>


                        <div class="panel-group" id="accordion" ng-controller="savedController as sC">
                            <p>{{sC.serverErrorMessage}}</p>
                            <div class="panel panel-default" ng-repeat="i in sC.savedApartments"> <!--panel 1-->

                                <div class="panel-heading" ng-init="panelBool=true;">


                                    <h4 ng-show='panelBool' class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="{{'#collapse' + (+$index +1)}}" ng-click="sC.switchView($index)">{{sC.returnTitle($index)}}</a>
                                        <button class="btn btn-warning pull-right">remove</button>
                                        <button  ng-click="panelBool = !panelBool" type="button" class="btn btn-info pull-right">change title</button>
                                    </h4>

                                    <div ng-hide="panelBool" class="row">
                                        <div class="container-fluid">
                                            <div class ='col-md-8'>

                                                <div class="form-group">
                                                    <input  type="text" placeholder="Apartment Name" ng-model="sC.savedApartments[$index].title" class="form-control">
                                                </div>

                                            </div>

                                            <div class="col-md-2 col-md-offset-1">
                                                <button  ng-click="panelBool = !panelBool; sC.updateTitleInDB(sC.savedApartments[$index].title, $index)" type="button" class="btn btn-info pull-right danger2">submit</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                                <div id="{{'collapse' + (+$index +1)}}" class="panel-collapse collapse">

                                    <div class="panel-body">

                                        <div class="form-group">
                                            <label for="comment"> notes:</label>
                                            <textarea class="form-control" rows="5" id="comment">{{i.comments}}</textarea>
                                            <button type="button" class="btn btn-success savedBtn pull-right">Update</button>
                                        </div>

                                    </div>
                                </div>

                            </div> <!--panel end-->

                        </div> <!--panel group end-->

                    </div>

                </div>
            </div>

        </div>

    </div> <!--left section end--> <!--col-md-4 ends-->

<!--right section-->
    <div class="col-md-8">
        <div ng-view></div>
    </div>

</div>
<!--bottom navigation-->
<footer>
    <nav class="navbar"> <!--top navigation-->
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#"></a>
            </div>
            <div>

                <p class="text-center">&copy; 2016 David Goodman All Rights Reserved</p>

            </div>
        </div>
    </nav>
</footer>






<script src="http://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.9.0.js"></script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQiyuVDFYzhXtLnYDABXLAz0elReamKns&signed_in=true&callback=initialize">
</script>
<script src="maps.js"></script>

</body>
</html>






