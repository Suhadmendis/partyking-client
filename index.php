<?php
// header('Location: ' . "seller_auth.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <title>Partyking</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="p:domain_verify" content="113937a596f36d03edeb800760f78acc"/>
    
    
    <!-- Pinterest Tag -->
<script>
!function(e){if(!window.pintrk){window.pintrk = function () {
window.pintrk.queue.push(Array.prototype.slice.call(arguments))};var
  n=window.pintrk;n.queue=[],n.version="3.0";var
  t=document.createElement("script");t.async=!0,t.src=e;var
  r=document.getElementsByTagName("script")[0];
  r.parentNode.insertBefore(t,r)}}("https://s.pinimg.com/ct/core.js");
pintrk('load', '2612714408352', {em: '<user_email_address>'});
pintrk('page');
</script>
<noscript>
<img height="1" width="1" style="display:none;" alt=""
  src="https://ct.pinterest.com/v3/?event=init&tid=2612714408352&pd[em]=<hashed_email_address>&noscript=1" />
</noscript>
<!-- end Pinterest Tag -->



    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
        crossorigin="anonymous" />
        
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="/path/to/bootstrap/js/bootstrap.min.js"></script>
        
        
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.0/axios.min.js"
        integrity="sha512-DZqqY3PiOvTP9HkjIWgjO6ouCbq+dxqWoJZ/Q+zPYNHmlnI2dQnbJ5bxAHpAMw+LXRm4D72EIRXzvcHQtE8/VQ=="
        crossorigin="anonymous"></script>


        
        <meta name="theme-color" content="#1D2C41">

    <link rel="stylesheet" href="_css/header.css">
    <link rel="stylesheet" href="_css/index.css">
    <link rel="stylesheet" href="_css/footer.css">
    
</head>
<body>


<div id="app">


    <!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"  aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="model-pallet">
                <div class="modal-header" id="model-pallet-header">
                   
                    <img src="_img/logo full site 2.webp" width="100" height="100" class="d-inline-block align-top" alt="" loading="lazy">
                   
                </div>
                <div class="modal-body">
                    <p> {{ message }} </p>
                    <form>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Email Address:</label>
                            <input type="text" class="form-control" id="recipient-address" v-model="inquiry.email" @keyup="check_Submit" placeholder="someone@gmail.com">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Full Name:</label>
                            <input type="text" class="form-control" id="recipient-name" v-model="inquiry.full_name" @keyup="check_Submit" placeholder="Kalana Pasindu Manawage">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Contact:</label>
                            <input type="number" class="form-control" id="recipient-contact" v-model="inquiry.contact" @keyup="check_Submit" placeholder="077XXXXXXX">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <p>gfysdg</p>
                    <button type="button" id="model-pallet-send-btn" class="btn btn-primary" @click="send" :disabled="button_blocker">Send</button>
                </div>
            </div>
        </div>
    </div> -->



<nav class="navbar navbar-expand-lg navbar-light">
    <div id="header-area">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
                aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="form-inline navbar-brand" href="#">
                <img src="_img/logo full site.webp" width="50" height="50" class="d-inline-block align-top" alt="" loading="lazy">
            
            </a>
            <a id="company-name" href="#">
                <p>Party King</p>
            
            </a>
        
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <!-- <li class="nav-item active">
                                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Link</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                            </li> -->
                </ul>
        
                <div id="main-search-palet">
                    <input id="main-search" class="mr-sm-2" type="search" placeholder="Search for items, brands and inspiration"
                        aria-label="Search">
                </div>
        
                <div class="form-inline my-2 my-lg-0">
                    <div id="header-top-items-heart">
                        <i class="far fa-heart"></i>
                    </div>
                </div>
                <div class="form-inline my-2 my-lg-0">
                    <div id="header-top-items-circle">
                        <p>10</p>
                    </div>
                </div>
                <div class="form-inline my-2 my-lg-0">
                    <div id="header-top-items-text">
                        <a><b>US</b></a>
                    </div>
                </div>
        
            </div>
        </div>
    </div>
</nav>



















<div id="banner-section">
    <div class="container-fluid">
        <div id="banner-area">
            <!-- 1300 400 -->
            <img src="_img/banner.jpg" class="banner">
        </div>
    </div>
</div>




<br><br>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            
            <div id="category-pallet" >
                <div @click="activate(categories.REF,categories.category_name)" :class="categories.active_pill == 1 ? 'custom-pill active-custom-pill' : 'custom-pill'" v-for="categories in CATEGORIES" >
                    <div class="category-text">
                        <p class="pill-text">{{ categories.category_name }}</p>
                    </div>
                    <div class="category-icon">
                        <i class="fas fa-home pill-icon"></i>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-9">
            
            <div class="row">
                <div class="col-md-12">
                    <h1 id="category-name">{{ selected_category_name }}</h1>
                    <h3 id="view-button">View more</h3>
                    
                    <div id='sub-category-box'>
                    
                        <div @click="activate_sub(sub_categories.REF)" :class="sub_categories.REF == selected_sub_category ? 'sub-category-button scb-active' : 'sub-category-button'" v-for="sub_categories in selected_sub_categories">
                            {{ sub_categories.name }}
                        </div>
                        
                    </div>
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-md-3" v-for="product in PRODUCTS_SHOW" @click="goto_product(product.REF)">
                    <div class="small-product-pallet">
                        <div class="image-pallet">
                            <img class="product-image" v-bind:src="'https://www.partyking.lk/uploads/1/products/' + product.image_1" alt="">
                        </div>
                        <div class="info-pallet">
                            <div class="product-info">
                                <p class="product-title">{{ product.name }}</p>
                                <p class="product-des">Anti wrinkle</p>
                            </div>
                            <div class="info-icon-pallet">
                                <p class="product-price">Rs 2200</p>
                                <i class="fas fa-eye product-icon"></i>
                            </div>
                        </div>
                    </div>




                </div>
            </div>




        </div>


    </div>

    
</div>



<br><br><br><br><br><br><br>
<br><br><br><br><br><br><br>

























<br><br>

<div id="footer-section">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-5">
                <div id="footer-logo-box">
                    <div id="footer-logo-icon">
                        <img id="footer-logo-image" src="_img/logo full site 2.png" alt="">
                    </div>
                    <div id="footer-logo-description">
                        <p class="footer-logo-description-line">
                            If you are a <strong>Party Planner</strong>
                        </p>
                        <p class="footer-logo-description-line">
                            this would be an easy way to gather
                        </p>
                        <p class="footer-logo-description-line">
                            all the <strong>Products</strong> needed for the <strong>Event</strong>.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div id="footer-category-box">
                    <p class="footer-category-head">Categories</p>
                    <p class="footer-category-text">Decorations</p>
                    <p class="footer-category-text">Costumes</p>
                    <p class="footer-category-text">Tableware</p>
                    <p class="footer-category-text">Food</p>
                    <p class="footer-category-text">Electronic</p>
                </div>
            </div>
            <div class="col-md-2">
                <div id="footer-policy-box">
                    <p class="footer-policy-head">Policy</p>
                    <p class="footer-policy-text">Terms & conditions</p>
                    <p class="footer-policy-text">Privacy Policy</p>
                    <p class="footer-policy-text">Delivery Policy</p>
                    <p class="footer-policy-text">Return & Exchange Policy</p>
                </div>
            </div>
            <div class="col-md-3">
                <div id="footer-contact-box">
                    <p class="footer-contact-head">We’d love to hear from you.</p>
                    <p class="footer-contact-text">+94 77 874567</p>
                    <p class="footer-contact-text">Partyking@gmail.com</p>
                </div>
            </div>

        </div>

        <br><br><br><br>
        <div class="row">
            <div class="col-md-3">
                <p>© 2020 Party king. All Rights Reserved.</p>
            </div>
            <div class="offset-md-6 col-md-3" id="bottom-contact">
                <p>Contact - 0771 234 567</p>
            </div>
        </div>
    </div>

</div>







</div>



<script src="_js/index.js"></script>

<!-- <script>
    var app = new Vue({
            el: '#app',
            data: {
                inquiry: { email: "", full_name: "", contact: "" },
                button_blocker: true,
                message: "We are planning to launch our new website by the middle of December we are inviting you all to  please  complete the below details and join with the rest who are already registered.",
                CATEGORIES: "",
            },
            mounted: function () {
            
                this.get_categories();
            },
            methods: {
                send: function () {
                    axios
                        .get(
                            "server/seller_operation_data.php?Command=inquiry&email=" +
                            this.inquiry.email +
                            "&full_name=" +
                            this.inquiry.full_name +
                            "&contact=" +
                            this.inquiry.contact
                        )
                        .then((response) => {
                            
                            console.log(response.data == "Done");
                            if (response.data == "Done") {
                                console.log(response.data == "Done");
                                this.inquiry.email = "";
                                this.inquiry.full_name = "";
                                this.inquiry.contact = "";

                                this.message = "Thank You!, Please spread the message to who are interested in";
                                this.button_blocker = true;
                            }else{
                                this.message = "Already Applied";
                            }
                        });
                },
                check_Submit: function () {
                    this.message = "We are planning to launch our new website by the middle of December we are inviting you all to  please  complete the below details and join with the rest who are already registered.";
                    this.button_blocker = false; 

                    if (this.inquiry.email == "prashan") { $("#exampleModal").modal("hide");  }
                    if (this.inquiry.email == "") { this.button_blocker = true; }
                    if (this.inquiry.full_name == "") { this.button_blocker = true; }
                    if (this.inquiry.contact == "") { this.button_blocker = true; }

                },
                get_categories: function () {
                    axios
                        .get(
                            "server/product_operation_data.php?Command=user_category"
                        )
                        .then((response) => {
                            
                            this.CATEGORIES = response.data[0];
                        });

                },
                activate: function (REF) {
                    for (let index = 0; index < this.CATEGORIES.length; index++) {
                        if (this.CATEGORIES[index].REF == REF) {
                            this.CATEGORIES[index].active_pill = 1;
                        }else{
                            this.CATEGORIES[index].active_pill = 0;
                        }
                        
                    }

                }
            }
        })
</script> -->













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