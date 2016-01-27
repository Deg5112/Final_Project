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
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


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


    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/stylesheet.css">
</head>
<body ng-app="apartmentShark" ng-controller="mainController as mC">


<nav class="navbar"> <!--top navigation-->
    <div class="container-fluid">
        <div class="navbar-header">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <a class="navbar-brand" href="#">apartmentShark</a>
        </div>
        <div>
            <ul id="navdrop" class="nav navbar-nav navbar-right" ng-controller="loginController as lC">
<!--                <li class="active"><a href="#">Home</a></li>-->
<!--                <li><a href="#">Settings</a></li>-->
                <!--show if logged in-->

                <li ng-show="lC.returnLoggedInBool();" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{lC.returnUsername()}}<span class="caret"></span></a>
                    <!-- login dropdown menu-->
                    <ul class="dropdown-menu logoutMenu" ng-click="lC.stop($event)">
                        <!-- login dropdown-->
<!--                        <li><a href="#">settings</a></li>-->
                        <li><a href="#" ng-click="lC.logout()">Log Out</a></li>
                    </ul>
                </li>

                        <!--username logged in end-->

                <li ng-hide="lC.returnLoggedInBool();" class="dropdown" >
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">LogIn<span class="caret"></span></a>
                    <!-- login dropdown menu-->
                    <ul class="dropdown-menu" ng-click="lC.stop($event)">
                        <!-- login dropdown-->

                        <li ng-show="lC.bool">


                            <button type='button' class="pull-right btn-small btn-info btn-small" ng-click="lC.changeBool()">Or Register</button><h4>Login</h4>

                            <span id="usernameLog" ng-show="lC.badusername">{{ lC.datamessage }}</span>


                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i> </span>
                                <input  type="text" class="form-control" placeholder="User Name" ng-model="lC.login.userLog">
                            </div>

                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i> </span>
                                <input  type="text" class="form-control" placeholder="password" ng-model="lC.login.password">
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
                                <input  type="text" class="form-control" placeholder="password" ng-model="lC.register.password">
                            </div>

                            <div class="form-group input-group">
                                <span class="input-group-addon"> <i class="glyphicon  glyphicon glyphicon-lock"></i>  </span>
                                <input  type="text" class="form-control" placeholder="confirm-password" ng-model="lC.register.passwordConfirm">
                            </div>
                            <p class="passwordMessage">{{lC.registerMessage}}</p>

                            <button class="btn btn-success" type="button" ng-click="lC.registerUser(lC.register.userReg, lC.register.emailReg, lC.register.password, lC.register.passwordConfirm)">Submit</button>
                            <button type="button" class="btn btn-danger" ng-click="lC.clear();">Clear</button>

                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid mainContainer">

    <div class="col-xs-4 leftSide">

        <div class="container-fluid">
            <div class="row" ng-controller="formController as fc">
                <div resize-Attr></div>
                <div class="mobileModal" ng-show="(windowWidth<992)"><p>apartmentShark Mobile is under construction, and will be available soon</p></div>

                <div class="col-xs-12">
                    <h2 class="text-center">Find a listing</h2>
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
                    <br>
                    <button type="button" class="btn btn-success" ng-click="fc.search(fc.currentFormInput.street,fc.currentFormInput.city, fc.currentFormInput.state)">Search!</button>
                    <p id="formMessage">{{fc.returnSearchMessage()}}</p>
                </div>
            </div>

            <div class="row" ng-controller="savedController as sC">
                <div id="modal" ng-show="sC.getModal()">
                    <div class="container-fluid">
                        <h1>Welcome to apartmentShark</h1>
                        <p>Plug in an address, click search, and have the majority of your apartment hunting, organizing, appointments, location and renters information, and notes
                            all in one place. No more jumping from one apartment site to another, never remembering where you left off, which apartment you're supposed
                        to see this weekend, and so on!</p>
                        <p>After finding an address for an apartment online, plug it into apartmentShark and let it do all
                            the heavy lifting for you. view side by side comparisons of google maps street view, zillow data, images, and more.
                        </p>
                        <p>Register for login credentails and you can save apartments to your account</p>

                    </div>
                </div>
                <div class="col-xs-12" id="savedColumn">
                    <div id="savedApartments" >
                        <h2 class="text-center">Saved Locations</h2>
                        <div id='savedNothing' ng-show="sC.returnSavedBool()"><h4>You have nothing saved! Search for listings, and if there's a match, apartmentShark will automatically saved the apartment</h4></div>

                        <div ng-hide="sC.returnSavedBool()" class="panel-group" id="accordion">
                            <p>{{sC.serverErrorMessage}}</p>

                            <div  class="panel panel-default animateIn" ng-repeat="i in sC.returnSavedApartments()" > <!--panel 1-->

                                <div class="panel-heading" ng-init="panelBool=true;">

                                    <div class="row" ng-show="panelBool"> <!--init row with title and change/remove button-->

                                        <div class="col-xs-6">
                                            <h4 ng-show='panelBool' class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="{{'#collapse' + (+$index +1)}}" ng-click="sC.switchView($index);">{{sC.returnTitle($index)}}</a>
                                            </h4>
                                    </div>


                                            <button class="btn btn-warning pull-right" ng-click="sC.remove($index)">remove</button>
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

                                </div> <!--panel heading end-->


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

<!--right section-->
    <div class="col-xs-8 rightSide">
        <div ng-view id="ngView"></div>
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
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.1/angular-animate.min.js"></script>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQiyuVDFYzhXtLnYDABXLAz0elReamKns&signed_in=true&callback=initialize">
</script>
<script src="maps.js"></script>

</body>
</html>






