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

        
    <link rel="stylesheet" href="_css/seller_platform.css">
    <!-- <link rel="stylesheet" href="_css/footer.css"> -->


</head>

<body>





    <div class="container-fluid" id="app">
        <div class="row">

            <div class="col-md-2 nopadding" id="seller-information-palet">
                <div id="account-information-palet-logo-box">
                    <img id="account-information-palet-logo" src="_img/logo full site.webp" alt="">
                </div>
                <div id="account-information-palet-user-box">
                    <img id="account-information-palet-user" v-bind:src="user.url" alt="">
                </div>
                <div id="account-information-palet-benefits">
                
                    <p id="account-information-palet-benefits-text-head" v-if="user.full_name == ''">Your Name</p>
                    <p id="account-information-palet-benefits-text-head" v-if="user.full_name != ''">
                        {{ user.full_name }}</p>
                
                    <!-- <p class="account-information-palet-benefits-text-des">
                        Email:
                    </p>
                    <p class="account-information-palet-benefits-text-subdes">
                        {{ user.email }}
                    </p> -->
                    <!-- <p class="account-information-palet-benefits-text-des">
                        Contact Number:
                    </p> -->
                    <p class="account-information-palet-benefits-text-subdes">
                        {{ user.contact_number }}
                    </p>
                    
                </div>

                <br>

                <div class="store-pill store-pill-active">
                    <div id="account-information-store-logo-box">
                        <img id="account-information-store-logo" src="_img/logo full site.webp" alt="">
                    </div>
                    <p class="account-information-store-name">
                        Store Name
                    </p>
                  
                </div>

                
            </div>


            <div class="col-lg-10 nopadding" id="store-input-palet">
            <!-- <div class="col-lg-10 nopadding"> -->

                <div class="row">
                    <div class="col-md-2">
                        <div id="store-logo-area">
                            <img id="store-logo" src="_img/logo full site.webp" alt="">
                        </div>
                    </div>
                
                    <div class="col-md-5">
                
                        <p class="store-input-name">
                            Store Name
                        </p>
                        <p class="store-input-name-tagline">
                            Tagline
                        </p>
                
                
                        <div style="background-color:  #1D2C41;" id="upload-pallet" class="file btn btn-sm btn-primary">
                            Upload
                            <input id="upload-input" type="file" name="file" />
                        </div>
                    </div>
                    <div class="col-md-5">
                
                        <p class="store-input-name-email">
                            Email
                        </p>
                        <p class="store-input-name-contact-number">
                            Contact Number
                        </p>
                        <p class="store-input-name-street-address">
                            Street address
                        </p>
                        <p class="store-input-name-city">
                            City
                        </p>
                        <p class="store-input-name-postal">
                            ZIP / Postal
                        </p>
                    </div>
                
                </div>

                <div class="row">
                    <div class="col-md-12">
                        
                        <a href="add_product.html">
                            <button class="seller-button update-button">Add Product</button>
                        </a>

                    </div>
                </div>

                <div class="row" id="store-item-pallet" v-show="product_pallet">
                    <br><br><br>
                    <div class="col-md-6" v-for="product in PRODUCTS">
                        <div class="store-item-image-area">
                            <div class="row">
                                <div class="col-md-3">
                                    <img class="store-item-image" src="_img/products/pro0001.webp" alt="">
                                </div>
                                <div class="col-md-9">
                                    <div class="store-item-details">

                                        <p class="item-label-name">
                                            {{ product.name }}
                                            <span class="badge badge-secondary item-type-badge">{{ product.type }}</span>
                                        </p>
                                        
                                        <p class="item-label-3type">
                                            {{ product.pro_condition }}
                                        </p>
                                        <p class="item-label-3type">
                                            {{ product.brand }}
                                        </p>
                                        <p class="item-label-3type">
                                            {{ product.theme }}
                                        </p>

                                        <p class="item-label-des">
                                            {{ product.description }}
                                        </p>
                                        <div id="item-label-bottom">
                                            <p class="item-label-price">
                                                Selling Price - Rs {{ product.sell_price }}
                                            </p>
                                            <p class="item-label-price">
                                                Day - Rs {{ product.day_price }}
                                            </p>
                                            <a href="update_product.html">
                                                <button class="seller-button update-button">Update</button>
                                            </a>
                                            
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                
                    
                
                </div>



            



            </div>
        </div>



        
    </div>




    <script>
        var app = new Vue({
            el: '#app',
            data: {
                information_pallet: false,
                user: { full_name: "Suhad Mendis", email: "suhad.a.mendis@gmail.com", password: "", url: "_img/linked_face.webp", contact_number: "+94778182596" },
                PRODUCTS: [],
                product_pallet: false
            },
            mounted: function () {
                this.generate();
            },
            methods: {
                generate: function () {
                    axios
                        .get('server/product_operation_data.php?Command=generateProducts')
                        .then(response => {
                            this.PRODUCTS = response.data[0];
                            this.product_pallet = true;
                        });
                },
                getInfo: function (fb_id, fb_accesst) {
                    axios
                        .get('https://graph.facebook.com/me?access_token=' + fb_accesst)
                        .then(response => {
                            this.user.full_name = response.data.name;
                            this.getPic(fb_id);
                        });
                },
                getPic: function (fb_id) {
                    axios
                        .get('https://graph.facebook.com/' + fb_id + '/picture?redirect=0&width=400')
                        .then(response => {
                            this.user.url = response.data.data.url;
                            setTimeout(function () { app.checkUser() }, 5000);
                        });
                },
                checkUser: function () {
                    alert("Go to the Next Page");
                }
            }
        });
    </script>







    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
        integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s"
        crossorigin="anonymous"></script>

</body>

</html>