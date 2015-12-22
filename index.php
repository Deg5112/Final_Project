<?php header('Access-Control-Allow-Origin: *'); ?>
<!--need to ask how to allow crossorigin without the plugin? -->
<!--TODO maybe have a chrome extension that you can dump the address into your app?-->
<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <title>Custom Street View panorama tiles</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <style>
        body{
            height: 1015px;
        }

        div#map, div#pano {
            height: 100%;
        }

        #googleContainer {
            height: 100%;
        }


        .container-fluid:nth-child(2) {
            height: 95%;
            margin-top: 3%;
        }
        nav.navbar.navbar-inverse {
            margin-bottom: 0%;
        }

        .col-md-3{
            border: 1px solid black !important;
        }

        /*form*/

        .col-md-4:first-child {
            height: 100%;
            background-color: #69D2E7;
        }
        /*container for right section*/
        .col-md-8 {
            height: 100%;
        }

        .container-fluid {
            height: 100%;
        }
        .col-md-4>.container-fluid>.row:first-child {
            height: 30%;
        }

        .col-md-4>.container-fluid>.row:nth-child(2) {
            height: 70%;
        }

        .col-md-8 .container-fluid .row:first-child{
            height: 50%;
        }

        .col-md-8 .row:first-child>.col-md-6 {
            height: 100%;
        }

        .col-md-8 .container-fluid .row:nth-child(2) {
            height: 50%;
        }

        .col-md-8 .container-fluid .row:nth-child(2) .col-xs-12 {
            height: 100%;
        }

        .col-xs-6 {
            height: 100%;
        }

        .col-md-8 .container-fluid .row:nth-child(2) .col-xs-6 {
            height: 100%;
        }

        div#myCarousel {
            height: 100%;
        }

        .carousel-inner {
            height: 100%;
        }

        .item.active{
            height: 100%;
        }

        nav.navbar.navbar-fixed-top {
            background-color: #F38630;
        }

        .panel-heading a {
            font-size: 1.7em;
        }

        .panel-body {
            font-size: 1.6em;
        }

        a.navbar-brand {
            font-size: 1.8em;
            font-family: cursive;
            color: black;
        }

        .navbar-nav>li>a {
            padding-top: 15px;
            padding-bottom: 15px;
            font-size: 1.6em;
        }


    </style>
</head>
<body>


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

    <div class="col-md-4" >

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2>search for an apartment</h2>
                    <input id='street' type="text" placeholder="street" class="form-control">
                    <input id="city" type="text" placeholder = "city" class="form-control">
                    <input id='state' type="text" placeholder="state" class="form-control">
                    <br>
                    <button type="button" class="btn btn-info" >Go</button>
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
                                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
                                </div>
                            </div>

                            <div class="panel panel-default"> <!--panel 2-->
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Elan Huntington</a>
                                    </h4>
                                </div>
                                <div id="collapse2" class="panel-collapse collapse">
                                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
                                </div>
                            </div>

                            <div class="panel panel-default"> <!--panel 3-->
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Apex Laguna</a>
                                    </h4>
                                </div>
                                <div id="collapse3" class="panel-collapse collapse">
                                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
                                </div>
                            </div>

                            <div class="panel panel-default"> <!--panel 4-->
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Apex Laguna</a>
                                    </h4>
                                </div>
                                <div id="collapse4" class="panel-collapse collapse">
                                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
                                </div>
                            </div>

                            <div class="panel panel-default"> <!--panel 5-->
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">The Residences at Bella Terra</a>
                                    </h4>
                                </div>
                                <div id="collapse5" class="panel-collapse collapse">
                                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
                                </div>
                            </div>

                            <div class="panel panel-default"> <!--panel 6-->
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">Huntington Vista</a>
                                    </h4>
                                </div>
                                <div id="collapse5" class="panel-collapse collapse">
                                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
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


                <div class="col-md-6">

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

<!--                                <div class="item active">-->
<!--                                    <img src="amanda.jpg" >-->
<!--                                </div>-->
<!---->
<!--                                <div class="item">-->
<!--                                    <img src="background_silicon.jpg" >-->
<!--                                </div>-->
<!---->
<!--                                <div class="item">-->
<!--                                    <img src="gavin.jpg" >-->
<!--                                </div>-->
<!---->
<!--                                <div class="item">-->
<!--                                    <img src="erlich.jpg" >-->
<!--                                </div>-->

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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQiyuVDFYzhXtLnYDABXLAz0elReamKns&signed_in=true&callback=initialize">
</script>
<script src="maps.js"></script>

</body>
</html>






