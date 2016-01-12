<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
?>

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
            <ul class="nav navbar-nav navbar-right" ng-controller="loginController as lC">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">Settings</a></li>
                <!--show if logged in-->

                <li ng-show="lC.returnLoggedInBool();" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{lC.returnUsername()}}<span class="caret"></span></a>
                    <!-- login dropdown menu-->
                    <ul class="dropdown-menu" ng-click="lC.stop($event)">
                        <!-- login dropdown-->
                        <li><a href="#">settings</a></li>
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
                            <button type="button" class="btn btn-danger">Clear</button>



                        </li>


                        <!-- register dropdown-->
                        <li ng-hide="lC.bool">


                            <button type='button' class="pull-right btn-small btn-info btn-small" ng-click="lC.changeBool()">back to Login</button><h4>Register</h4>


                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" class="form-control" placeholder="User Name" ng-model="lC.register.userReg">
                            </div>

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




                            <button class="btn btn-success" type="submit" ng-click="lC.registerUser(lC.register.userReg, lC.register.emailReg, lC.register.password, lC.register.passwordConfirm)">Add</button>
                            <button type="button" class="btn btn-danger">Clear</button>



                        </li>
                    </ul>
                </li>

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
                <div class="col-md-12" id="savedColumn">
                    <div id="savedApartments" >
                        <h2>Your Saved Apartments</h2>


                        <div class="panel-group" id="accordion">
                            <p>{{sC.serverErrorMessage}}</p>

                            <div  class="panel panel-default animateIn" ng-repeat="i in sC.returnSavedApartments()" > <!--panel 1-->

                                <div class="panel-heading" ng-init="panelBool=true;">

                                    <h4 ng-show='panelBool' class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="{{'#collapse' + (+$index +1)}}" ng-click="sC.switchView($index);">{{sC.returnTitle($index)}}</a>
                                        <button class="btn btn-warning pull-right">remove</button>
                                        <button  ng-click="panelBool = !panelBool" type="button" class="btn btn-info pull-right">change title</button>
                                    </h4>

                                    <div ng-hide="panelBool" class="row">
                                        <div class="container-fluid">
                                            <div class ='col-md-8'>

                                                <div class="form-group">
                                                    <input  type="text" placeholder="Apartment Name" ng-model="i.title" class="form-control">
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
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.1/angular-animate.min.js"></script>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQiyuVDFYzhXtLnYDABXLAz0elReamKns&signed_in=true&callback=initialize">
</script>
<script src="maps.js"></script>

</body>
</html>






