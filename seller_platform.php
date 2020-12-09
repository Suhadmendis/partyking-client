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

    <meta name="theme-color" content="#1D2C41">

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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <link rel="stylesheet" href="_css/footer.css"> -->


    



</head>

<body>
    <div class="container-fluid" id="app">
        <div class="row">
        
            <div class="col-lg-2 nopadding" id="seller-information-palet">
            <br>
                <div id="account-information-palet-logo-box">
                    <img id="account-information-palet-logo" src="_img/logo full siteo.png" alt="">
                </div>
                <div id="account-information-palet-user-box">
                    <img id="account-information-palet-user" v-bind:src="user.url" alt="">
                </div>
                <div id="account-information-palet-benefits">
                
                    <p id="account-information-palet-benefits-text-head" v-if="user.full_name == ''">Your Name<i class="fas fa-sign-out-alt edit-icon-other" @click="logout();"></i></p>
                    <p id="account-information-palet-benefits-text-head" v-if="user.full_name != ''">
                        {{ user.full_name }}<i class="fas fa-power-off edit-icon-other" @click="logout();"></i></p>

                    
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
                        {{ user.contact_number }} <i class="fas fa-pen edit-icon-other" @click="edit('user_number');"></i>
                    </p>
                    
                </div>

                <br>

                <div class="store-pill store-pill-active">
                    <div id="account-information-store-logo-box">
                        <img id="account-information-store-logo" v-if="store.url == ''" v-bind:src="'_img/logo full siteo.png'" alt="" alt="">
                        <img id="account-information-store-logo" v-if="store.url != ''" v-bind:src="'uploads/store_logo/' + store.url" alt="" alt="">
                    </div>
                    <p class="account-information-store-name">
                        {{ store.name }} <i class="fas fa-power-off logout-icon-other" @click="logout();"></i>
                    </p>
                  
                </div>

                
            </div>


            <div class="col-lg-10 nopadding" id="store-input-palet">
            <!-- <div class="col-lg-10 nopadding"> -->
<br>
                <div class="row">
                    <div class="col-sm-2">
                        <div id="store-logo-area">
                            <img id="store-logo" v-if="store.url == ''" v-bind:src="'_img/logo full siteo.png'" alt="">
                            <img id="store-logo" v-if="store.url != ''" v-bind:src="'uploads/store_logo/' + store.url" alt="">
                        </div>
                        
                    </div>
                
                    <div class="col-sm-5">
                
                        <p class="store-input-name">
                            {{ store.name }} <i class="fas fa-pen edit-icon-name" @click="edit('store_name');"></i>
                        </p>
                        <p class="store-input-name-tagline">
                            {{ store.tagline }} <i class="fas fa-pen edit-icon-tagline" @click="edit('tagline');"></i>
                        </p>
                        <div class="mobile-fix1">
                            <div style="background-color:  #1D2C41;" id="upload-pallet" class="seller-button">
                                Upload Logo
                                <input id="upload-input" type="file" name="file" />
                            </div>
                            
                        </div>
                        <div class="mobile-fix2">
                            <a href="add_product.php">
                                <button  style="background-color:  #1D2C41;" class="file btn btn-sm btn-primary">Add Product</button>
                            </a>
                        </div>
                        
                
                        
                    </div>
                    <div class="col-sm-5">
                
                        <p class="store-input-name-email">
                            {{ store.email }} <i class="fas fa-pen edit-icon-other" @click="edit('store_email');"></i>
                        </p>
                        <p class="store-input-name-contact-number">
                            {{ store.contact_number }} <i class="fas fa-pen edit-icon-other" @click="edit('store_number');"></i>
                        </p>
                        <p class="store-input-name-street-address">
                            {{ store.street_address }} <i class="fas fa-pen edit-icon-other" @click="edit('store_address');"></i>
                        </p>
                        <p class="store-input-name-city">
                            {{ store.city }} <i class="fas fa-pen edit-icon-other" @click="edit('store_city');"></i>
                        </p>
                        <p class="store-input-name-postal">
                            {{ store.postal }} <i class="fas fa-pen edit-icon-other" @click="edit('store_postal');"></i>
                        </p>
                    </div>
                
                </div>

                <div class="row">
                    <div class="col-md-12" id="add-button-pallet">
                        <div class="mobile-fix2">
                           <div style="background-color:  #1D2C41;" id="upload-pallet" class="seller-button">
                                Upload Logo
                                <input id="upload-input" type="file" name="file" />
                            </div>
                        </div>

                        
                        <div class="mobile-fix1">
                             <a href="add_product.php">
                                <button  style="background-color:  #1D2C41;" class="file btn btn-sm btn-primary">Add Product</button>
                            </a>
                            
                        </div>

                    </div>
                </div>

                <div class="row" id="store-item-pallet" v-show="product_pallet">
                    <br><br><br>
                    <div class="col-lg-6" v-for="product in PRODUCTS">
                        <div class="store-item-image-area">
                            <div class="row">
                                <div class="col-lg-4">
                                    <img class="store-item-image" v-bind:src="'uploads/1/products/' + product.image_1" alt="">
                                </div>
                                <div class="col-lg-8">
                                    <div class="store-item-details">

                                        <p class="item-label-name">
                                            {{ product.name }}
                                            <span class="badge badge-secondary item-type-badge">{{ product.type }}</span>
                                        </p>
                                        
                                        <p class="item-label">
                                            Condition: {{ product.pro_condition }}
                                        </p>
                                        

                                        <div class="type-box">

                                            <div class="type-box-pallet" v-if="product.brand == ''">&nbsp;</div>    
                                            <div class="type-box-pallet" v-if="product.brand != ''">
                                                <p class="item-label-3type-dot" >
                                                    Brand:
                                                </p>
                                                <p class="item-label-3type">
                                                    {{ product.brand }}
                                                </p>
                                            </div>

                                            <div class="type-box-pallet" v-if="product.model == ''">&nbsp;</div>    
                                            <div class="type-box-pallet" v-if="product.model != ''">
                                                <p class="item-label-3type-dot" >
                                                    Model:
                                                </p>
                                                <p class="item-label-3type">
                                                    {{ product.model }}
                                                </p>
                                            </div>

                                            <div class="type-box-pallet" v-if="product.theme == ''">&nbsp;</div>    
                                            <div class="type-box-pallet" v-if="product.theme != ''">
                                                <p class="item-label-3type-dot" >
                                                    Theme:
                                                </p>
                                                <p class="item-label-3type">
                                                    {{ product.theme }}
                                                </p>
                                            </div>
                                            
                                            
                                            

                                        
                                            
                                            
                                            

                                        </div>
                                        
                                        

                                        
                                        <p class="item-label-des">
                                            {{ product.description }}
                                        </p>
                                        <div id="item-label-bottom">
                                            <p class="item-label-price" v-if="product.type == 'Sell' || product.type == 'Rent or Sell'">
                                                Selling Price - LKR {{ product.sell_price }}
                                            </p>
                                            <p class="item-label-price" v-if="product.type == 'Rent' || product.type == 'Rent or Sell'">
                                                Day - LKR {{ product.day_price }}
                                            </p>
                                        </div>
                                        <div id="item-label-bottom-button">
                                            
                                            <a>
                                                <i class="fas fa-trash-alt delete-btn" @click="delete_product(product.REF)" ></i>
                                            </a>
                                            <!-- <a v-bind:href="'update_product.php?REF=' + product.REF">
                                                <label class="switch">
                                                    <input type="checkbox" checked>
                                                    <span class="slider round"></span>
                                                </label>
                                            </a> -->
                                            <a v-bind:href="'update_product.php?REF=' + product.REF">
                                                <button class="update-button">Update</button>
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
        



        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ message_head }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ message }}
                        <br>
                        <br>
                        <input type="text" id="updateMainPanel" class="seller-input-palet-text-box" v-model="updateMainPanel" :placeholder="editplaceholder">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click="edit_update(editflag)">Update</button>
                    </div>
                </div>
            </div>
        </div>

        







    </div>

    
    <script src="_js/seller_platform.js"></script>


<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>


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