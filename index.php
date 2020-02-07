<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
?>

<!--TODO maybe have a chrome extension that you can dump the address into your app?-->
<!--TODO make a chrome extension that takes an address and plugs it into your database-->
<!--TODO need user comments if DB doesn't get updated for comments or title update-->
<!DOCTYPE html>
<html>
<head>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
    <title>apartmentShark</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.1/angular.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.1/angular-route.min.js"></script>
    <script src="javascript/angularApp.js"></script>
    <script src="javascript/loginRegisterService.js"></script>
    <script src="javascript/apiService.js"></script>
    <script src="javascript/modalService.js"></script>
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
    <script src="javascript/loginController.js"></script>
    <script src="javascript/directive.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.1/angular-animate.min.js"></script>


    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/stylesheet.css">
</head>
<body ng-app="apartmentShark" ng-controller="mainController as mC">
<div resize-Attr></div>
<!--<div class="mobileModal" ng-show="(windowWidth<992)"><p>apartmentShark mobile is not ready just yet, it will be available soon</p></div>-->



<nav class="navbar navbar-fixed-top " role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">apartmentShark</a>
        </div>

        <div class="navbar-collapse collapse" >
            <ul class="nav navbar-nav navbar-right" ng-controller="loginController as lC">

                <li ng-show="lC.returnLoggedInBool()"><a href="#" ng-click="lC.logout()">Log Out</a></li> <!--logout no dropdown-->

                <li ng-click="mC.showModal()"><a>About</a></li>

                <li class="dropdown" ng-hide="lC.returnLoggedInBool()">  <!--logIn with dropdown-->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>Login</a>
                    <ul class="dropdown-menu" ng-click="lC.stop($event)">
<!--                        dropdown for the above list item-->

                        <li ng-show="lC.bool">  <!--login form-->
                            <button type='button' class="pull-right btn-small btn-info btn-small" ng-click="lC.changeBool()">Or Register</button><h4>Login</h4>

                            <span id="usernameLog" ng-show="lC.badusername">{{ lC.datamessage }}</span>


                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i> </span>
                                <input  type="text" class="form-control" placeholder="User Name" ng-model="lC.login.userLog">
                            </div>

                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i> </span>
                                <input  type="password" class="form-control" placeholder="password" ng-model="lC.login.password">
                            </div>

                            <button class="btn btn-success" type="button" ng-click="lC.loginUser(lC.login.userLog, lC.login.password)">Submit</button>
                            <button type="button" class="btn btn-danger" ng-click="lC.clear();">Clear</button>
                            <p id="regSuccess">{{lC.regSuccessfulMessage}}</p>
                        </li>

                        <!-- register dropdown-->
                        <li ng-hide="lC.bool">

                            <button type='button' class="pull-right btn-small btn-info btn-small" ng-click="lC.changeBool()">back to Login</button><h4>Register</h4>


                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" class="form-control" placeholder="User Name" ng-model="lC.register.userReg">
                            </div>
                            <!--                            <p ng-show="">Username already exist!</p>-->

                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i> </span>
                                <input type="text" class="form-control" placeholder="e-mail" ng-model="lC.register.emailReg">
                            </div>

                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="glyphicon  glyphicon glyphicon-lock"></i> </span>
                                <input  type="password" class="form-control" placeholder="password" ng-model="lC.register.password">
                            </div>

                            <div class="form-group input-group">
                                <span class="input-group-addon"> <i class="glyphicon  glyphicon glyphicon-lock"></i>  </span>
                                <input  type="password" class="form-control" placeholder="confirm-password" ng-model="lC.register.passwordConfirm">
                            </div>
                            <p class="passwordMessage">{{lC.registerMessage}}</p>

                            <button class="btn btn-success" type="button" ng-click="lC.registerUser(lC.register.userReg, lC.register.emailReg, lC.register.password, lC.register.passwordConfirm)">Submit</button>
                            <button type="button" class="btn btn-danger" ng-click="lC.clear();">Clear</button>

                        </li>

                    </ul>
                </li>

            </ul>


        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container-fluid mainContainer">
    <div id="modal" ng-hide="aboutBool">
        <div class="container-fluid">
           <div class="row">
               <div class="col-xs-12 col-sm-8 col-sm-offset-2 modalCol">
                   <span class="glyphicon glyphicon-remove pull-right" ng-click="aboutBool = true"></span>
                   <h1>Welcome to apartmentShark</h1>
                   <p>Once you've found the apartment you want to keep track of, just plug in the address of the community/property, and let apartmentShark store apartment data, images, and navigation view for you</p>
                   <p>To demo, click the panels below the search form to view the respective apartment on the dashboard.
                       Register for login credentials and you can save apartments to your account!
                   </p>
               </div>
           </div>
        </div>
        <button type="button" class="btn btn-success" ng-click="aboutBool = true">Got it!</button>
    </div>

    <div class="col-xs-4 leftSide">
        <div class="container-fluid">
            <div class="row" ng-controller="formController as fc">

<!--                <div ng-view id="ngView" class="hidden-md hidden-lg"></div>-->

                        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-12 col-md-pull-2 ">
                            <h2 class="text-center">Find a listing</h2>
                            <form>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-street-view"></i></span>
                                    <input id='street' type="text" placeholder="enter a street" class="form-control" ng-model="fc.currentFormInput.street">
            <!--                        <p>{{fc.currentFormInput.street}}</p>-->
                                </div>

                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-building"></i></span>
                                    <input id="city" type="text" placeholder = "enter a city" class="form-control" ng-model="fc.currentFormInput.city">
            <!--                        <p>{{fc.currentFormInput.city}}</p>-->
                                </div>

                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                                    <input id='state' type="text" placeholder="enter a state" class="form-control" ng-model="fc.currentFormInput.state">
            <!--                        <p>{{fc.currentFormInput.state}}</p>-->
                                </div>
                                <button type="button" class="btn btn-success" ng-click="fc.search(fc.currentFormInput.street,fc.currentFormInput.city, fc.currentFormInput.state)">Search!</button>
                                <p id="formMessage">{{fc.returnSearchMessage()}}</p>
                            </form>
                        </div>
            </div>

            <h2 class="text-center">Saved Locations</h2>

            <div class="row sC" ng-controller="savedController as sC">
                <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-12 col-md-pull-2" id="savedColumn">
                    <div id="savedApartments" >
                        <div id='savedNothing' ng-show="sC.returnSavedBool()"><h4>You have nothing saved! Search for listings, and if there's a match, apartmentShark will automatically saved the apartment</h4></div>
                        <div ng-hide="sC.returnSavedBool()" class="panel-group" id="accordion">
                            <p>{{sC.serverErrorMessage}}</p>
                            <div  class="panel panel-default animateIn" ng-repeat="i in sC.returnSavedApartments()" > <!--panel 1-->
                                <a data-toggle="collapse" data-parent="#accordion" href="{{'#collapse' + (+$index +1)}}" ng-click="sC.switchView($index, $event); mC.switchApartmentSelectedBool();"><div class="panel-heading" ng-init="panelBool=true;">
                                    <div class="row" ng-show="panelBool"> <!--init row with title and change/remove button-->
                                        <div class="col-xs-6">
                                            <h4 ng-show='panelBool' class="panel-title">{{sC.returnTitle($index)}}</h4>
                                        </div>
                                            <button class="btn btn-danger pull-right " ng-click="sC.remove($index, $event)">Delete</button>
                                            <button  ng-click="panelBool = !panelBool" type="button" class="btn btn-info pull-right">change title</button>
                                    </div>


<!--                                    change title -->
                                    <div  ng-hide="panelBool"  class="container-fluid">
                                        <div class="row">
                                                <div class="col-xs-8">
                                                    <input  type="text" placeholder="Apartment Name" ng-model="i.title" ng-change="sC.newTitle = i.title" class="form-control">
                                               </div>
                                                <div class="col-xs-4">
                                                    <button  ng-click="panelBool = !panelBool; sC.updateTitleInDB(sC.newTitle, $index)" type="button" class="btn btn-info danger2" ng-click="sC.updateTitleInDB(i.title, $index)">submit</button>
                                                </div>
                                        </div>
                                    </div>

                                </div> <!--panel heading end--></a>


                                <div id="{{'collapse' + (+$index +1)}}" class="panel-collapse collapse">

                                    <div class="panel-body">

                                        <div class="form-group">
                                            <label for="comment" class="text-center"> notes:</label>
                                            <textarea ng-change="sC.savedBool = false;" class="form-control" rows="5" id="comment" ng-change='sC.newComments = i.comments' ng-model="i.comments">{{i.comments}}</textarea>
                                            <p ng-show="sC.savedBool">Changes Saved!</p>
                                            <button ng-click='sC.updateCommentsInDB(sC.newComments, $index)' type="button" class="btn btn-success savedBtn pull-right">save</button>
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

<!--right section  ngview for big screen-->
    <div class="col-xs-8 rightSide" ng-hide="windowWidth<1092 && mC.homeBool">
<!--        <div id="gif">-->
<!--            <img src="http://www.projefe.com/en/projefe/urun/loading.gif">-->
<!--        </div>-->
        <div class="noApartmentSelectedModal" ng-hide="apartmentSelectedBool">
            <p>Please select an apartment to view info</p>
        </div>
        <div ng-view id="ngView"></div>
    </div>

</div>
<!--bottom navigation-->

<nav class="navbar-fixed-bottom hidden-md " >
    <div class="container">
        <div class="row">
            <div class="col-xs-2 col-xs-offset-1"><a href="#" ng-click="mC.homeBool = true; mC.active($event)" ><i style="color: #0036DA" class="bNav fa fa-home"></i></a></div>
            <div class="col-xs-2"><a href="#zillowStatsFull" ng-click="mC.homeBool = false; mC.active($event)" ><i class="bNav fa fa-info-circle"></i></a></div>
            <div class="col-xs-2"><a href="#galleryFull" ng-click="mC.homeBool = false; mC.active($event)"><i class="bNav fa fa-picture-o"></i></a></div>
            <div class="col-xs-2"><a href="#mapsFull" ng-click="mC.homeBool = false; mC.active($event)" ><i class="bNav fa fa-map"></i></a></div>
            <div class="col-xs-2"><a href="#panoFull" ng-click="mC.homeBool = false; mC.active($event)"><i class="bNav fa fa-street-view"></i></a></div>
        </div>
    </div>
</nav>

<script src="https://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.9.0.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.1/angular-animate.min.js"></script>

<!--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQiyuVDFYzhXtLnYDABXLAz0elReamKns&signed_in=true&callback=initialize"></script>-->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC2Ja3mHIQR8bURXOHCXLpAg58PN39LhpI"></script>

<!--                         https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap"-->
</body>
</html>






