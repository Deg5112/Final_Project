<?php header('Access-Control-Allow-Origin: *'); ?>
<!--TODO need to ask how to allow crossorigin without the plugin? -->
<!--TODO maybe have a chrome extension that you can dump the address into your app?-->
<!--TODO Different views with angular routes? Totally can do that-->
<!--TODO view full screen buttons for each square? -->
<!--TODO make a chrome extension that takes an address and plugs it into your database-->
<!DOCTYPE html>
<html>
<head>
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
    <script src="javascript/displayController.js"></script>
    <script src="javascript/formController.js"></script>
    <script src="javascript/gallaryController.js"></script>
    <title>Custom Street View panorama tiles</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/stylesheet.css">
</head>
<body ng-app="apartmentShark">


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
                <div class="col-md-12">
                    <div id="savedApartments" class="container-fluid">
                        <h2>Your Saved Apartments</h2>

                        <div class="panel-group" id="accordion">

                            <div class="panel panel-default"> <!--panel 1-->
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Seaview Summit</a>
                                    </h4>
                                </div>
                                <div id="collapse1" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label for="comment"> comment:</label>
                                            <textarea class="form-control" rows="5" id="comment">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</textarea>
                                        </div>


                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default"> <!--panel 2-->
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Elan Huntington</a>
                                    </h4>
                                </div>
                                <div id="collapse2" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label for="comment">comment:</label>
                                            <textarea class="form-control" rows="5" id="comment">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</textarea>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default"> <!--panel 3-->
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Apex Laguna</a>
                                    </h4>
                                </div>
                                <div id="collapse3" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label for="comment">comment:</label>
                                            <textarea class="form-control" rows="5" id="comment">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="panel panel-default"> <!--panel 5-->
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">The Residences at Bella Terra</a>
                                    </h4>
                                </div>
                                <div id="collapse4" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label for="comment">comment:</label>
                                            <textarea class="form-control" rows="5" id="comment">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default"> <!--panel 6-->
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">Huntington Vista</a>
                                    </h4>
                                </div>
                                <div id="collapse5" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label for="comment">comment:</label>
                                            <textarea class="form-control" rows="5" id="comment">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>

        </div>

    </div> <!--left section end-->

<!--right section-->
    <div class="col-md-8">

        <div class="container-fluid">

            <!-- zillow and yelp top row-->
            <div class="row"> <!--one row for yelp and zillow-->

                <div class="col-md-6">
                    <div class="zillow">zillow</div>
                </div>

<!--                ng-controller="gallaryController as gC"-->
                <div class="col-md-6" ng-controller="galleryController as gC" >

                        <div id="myCarousel" class="carousel slide">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
<!--                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>-->
<!--                                <li data-target="#myCarousel" data-slide-to="1"></li>-->
<!--                                <li data-target="#myCarousel" data-slide-to="2"></li>-->
<!--                                <li data-target="#myCarousel" data-slide-to="3"></li>-->
                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">

                                <div ng-repeat='i in gC.returnArray()' ng-class="{{i.divClass}}">
                                    <img ng-src="{{i.src}}" >
                                </div>
<!---->

                            </div>

                            <!-- Left and right controls -->
                            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>

                </div>
            </div>

<!--google bottom row  , another row below for google-->
            <div class="row">
                <div class="col-xs-6">
                    <div id="map"></div>
                </div>

                <div class="col-xs-6">
                    <div id="pano"></div>
                </div>

                </div>
            </div>

        </div>

    </div>
</div>




</div><!--main row ends-->


<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQiyuVDFYzhXtLnYDABXLAz0elReamKns&signed_in=true&callback=initialize">
</script>
<script src="maps.js"></script>

</body>
</html>






