<?php 
include './CheckCookie.php';
$cookie_name = "pk_seller";
$mo = "";
if (isset($_COOKIE[$cookie_name])) {

    // $mo = chk_cookie($_COOKIE[$cookie_name]);

    
}else{
    
    header('Location: ' . "seller_auth.php");
}

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <title>Product</title>
    <meta charset="utf-8">
    <link rel="icon" href="_img/logo full site icon.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
        crossorigin="anonymous" />

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.0/axios.min.js"
        integrity="sha512-DZqqY3PiOvTP9HkjIWgjO6ouCbq+dxqWoJZ/Q+zPYNHmlnI2dQnbJ5bxAHpAMw+LXRm4D72EIRXzvcHQtE8/VQ=="
        crossorigin="anonymous"></script>

    <link rel="stylesheet" href="_css/add_product.css">
    <!-- <link rel="stylesheet" href="_css/footer.css"> -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script> -->
    <!-- <script src="_js/jquery.min.js"></script> -->

</head>

<body>



<br>

    <div class="container-fluid" id="app">
        <div class="row">
            <div class="col-md-12">
                <a href="seller_platform.php">
                    <button class="btn btn-secondary">Back</button>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div id="head-topic">
                    <h2 style="color:  #1D2C41;">Add Your Product</h2>
                </div>
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col-lg-4">
                <div id="primary-upload-image-area">

                    <img id="primary-upload-image" v-bind:src="PRODUCT.pro_image" alt="">
                    <div class="sub-upload-image">
                        <div style="background-color:  #1D2C41;" id="upload-pallet" class="file btn btn-sm btn-primary">
                            Upload
                            <input id="upload-input" type="file" name="file" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="upload-product-details">
                    <!-- <div style="background-color:  #1D2C41;" id="upload-pallet" class="file btn btn-sm btn-primary">
                        Upload
                        <input id="upload-input" type="file" name="file" />
                    </div> -->
                    <div class="upload-product-details-pallet">
                        <label for="" class="seller-input-palet-text-label"> Name: </label>
                        <input type="text" class="seller-input-palet-text-box col-lg-8" v-model="PRODUCT.name">
                        <br><br>

                        <div class="input-group mb-3">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" 
                                aria-expanded="false">{{ selected_category.category_name }}</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" v-for="category in categories"
                                    @click="select_cat(category)">{{ category.category_name }}</a>
                            </div>
                        </div>


                        <div class="input-group mb-3">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">{{ selected_subCategory.name }}</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" v-for="subCategory in subCategories"
                                    @click="select_sub_cat(subCategory)">{{ subCategory.name }}</a>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">{{ selected_condition }}</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" v-for="condition in conditions"
                                    @click="select_condition(condition)" >{{ condition.name }}</a>
                            </div>
                        </div>
                       
                        <label for="" class="seller-input-palet-text-label"> Brand: </label>
                        <input type="text" class="seller-input-palet-text-box col-lg-3" v-model="PRODUCT.brand"> 
                        <p class="seller-input-palet-text-box-note"><b>Optional:</b> You can leave this empty.</p>
                        <br>

                        <label for="" class="seller-input-palet-text-label"> Model: </label>
                        <input type="text" class="seller-input-palet-text-box col-lg-3" v-model="PRODUCT.model">
                        <p class="seller-input-palet-text-box-note"><b>Optional:</b> You can leave this empty.</p>
                        <br>

                        <label for="" class="seller-input-palet-text-label"> Theme: </label>
                        <input type="text" class="seller-input-palet-text-box col-lg-3" v-model="PRODUCT.theme">
                        <p class="seller-input-palet-text-box-note"><b>Optional:</b> You can leave this empty.</p>
                        <br><br>

                        <label for="" class="seller-input-palet-text-label">Description: </label>
                        <textarea class="seller-input-palet-des-box col-lg-12" name="" id="" cols="30" rows="8" v-model="PRODUCT.description"></textarea>
                        <br><br>

                        <div class="input-group mb-3">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">{{ selected_type }}</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" v-for="type in types"
                                    @click="select_type(type)">{{ type.name }}</a>
                            </div>
                        </div>                    

                        <label for="" class="seller-input-palet-text-label" v-show="selected_type != 'Sell'"> Day: </label>
                        <input type="number" class="seller-input-palet-text-box" v-show="selected_type != 'Sell'"  v-model="PRODUCT.day_price">
                        <br><br>

                        <label for="" class="seller-input-palet-text-label" v-show="selected_type != 'Rent'"> Sell: </label>
                        <input type="number" class="seller-input-palet-text-box" v-show="selected_type != 'Rent'" v-model="PRODUCT.sell_price">
                        <br><br>

                        <button @click="save_product()" class="btn btn-secondary">Save</button>
                        
                    </div>

                    <br><br>
   
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ message_head }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> -->
                    <div class="modal-body" style="text-align: center;">
                        <div v-if="icon_flag" >
                            <br>
                            <i class="far fa-check-circle" id="check-icon"></i>
                        </div>
                        <br>
                        <p>{{ message }}</p>
        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        
    </div>


    

    <script>
        window.fbAsyncInit = function () {
            FB.init({
                appId: '400125357808841',
                cookie: true,
                xfbml: true,
                version: 'v9.0'
            });

            FB.AppEvents.logPageView();

        };
        var userid = "";
        function checkLoginState() {
            FB.getLoginStatus(function (response) {
                // statusChangeCallback(response);
                // console.log(response.status);
                console.log(response.authResponse);
                // console.log(response.authResponse.userID);

                if (response.status) {
                    userid = response.authResponse.userID;

                    app.getInfo(response.authResponse.userID, response.authResponse.accessToken);
                }

            });




        }

        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) { return; }
            js = d.createElement(s); js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>










<script src="_js/add_product.js"></script>

    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
        integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s"
        crossorigin="anonymous"></script>

</body>

</html>