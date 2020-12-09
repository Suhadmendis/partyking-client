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

    <link rel="stylesheet" href="_css/seller_auth.css">
    <!-- <link rel="stylesheet" href="_css/footer.css"> -->


</head>

<body>


    <div class="container-fluid" id="app">
        <div class="row">
            <div class="col-lg-4 information-palet" id="seller-information-palet"  v-show="information_pallet">
                <div id="seller-information-palet-logo-box">
                    <img id="seller-information-palet-logo" src="_img/logo full site.webp" alt="">
                </div>
                <div id="seller-information-palet-benefits">
                   
                    <p id="seller-information-palet-benefits-text-head">
                        Why Party King
                    </p>

                    
                    <ul>
                        <li class="seller-information-palet-benefits-text-des">Customer will solve your storage problem by making back to back renting. </li>
                    </ul>
                    <ul>
                        <li class="seller-information-palet-benefits-text-des">Wider reach to audience and speedy way to approach markets.</li>
                    </ul>
                    <ul>
                        <li class="seller-information-palet-benefits-text-des">You can easily display all your products within 2-3 clicks.</li>
                    </ul>
                    <ul>
                        <li class="seller-information-palet-benefits-text-des">High chances of customers searching on your store.</li>
                    </ul>
                    <ul>
                        <li class="seller-information-palet-benefits-text-des">Party King Offers Seller Flexibility to promote their products.</li>
                    </ul>
                    <ul>
                        <li class="seller-information-palet-benefits-text-des">Get fast and more stable results.</li>
                    </ul>
                    <ul>
                        <li class="seller-information-palet-benefits-text-des">The Sky’s the Limit on Product Sales at Party King.</li>
                    </ul>
                </div>
            </div>


            <div class="col-lg-4 information-palet" id="seller-information-palet"  v-show="!information_pallet">
                <div id="new-seller-information-palet-logo-box">
                    <img id="new-seller-information-palet-logo" src="_img/logo full site.webp" alt="">
                </div>
                <div id="new-seller-information-palet-user-box">
                    <img id="new-seller-information-palet-user" src="_img/linked_face.webp" alt="">
                </div>
                <div id="new-seller-information-palet-benefits">

                    <p id="new-seller-information-palet-benefits-text-head" v-if="user.full_name == ''">Your Name</p>
                    <p id="new-seller-information-palet-benefits-text-head" v-if="user.full_name != ''">
                        {{ user.full_name }}</p>

                    <p class="new-seller-information-palet-benefits-text-des">
                        Email: {{ user.email }}
                    </p>
                    <p class="new-seller-information-palet-benefits-text-des">
                        Contact Number: {{ user.contact_number }}
                    </p>
                    <p class="new-seller-information-palet-benefits-text-des">
                        Password: Valid
                    </p>

                </div>
            </div>


            <div class="col-lg-8" id="seller-input-palet-reg">
                <div id="input-box">
                    <p class="input-text-head">
                        Create your account and gain access to become a seller.
                    </p>


                    <label for="" class="seller-input-palet-text-label">Full Name: </label>
                    <input type="text" class="seller-input-palet-text-box" v-model="user.full_name" @click="change_panel()">
                    <br><br>
                    <label for="" class="seller-input-palet-text-label">Email: </label>
                    <input type="text" class="seller-input-palet-text-box" v-model="user.email" @click="change_panel()">
                    <br><br>
                    <label for="" class="seller-input-palet-text-label">Contact Number: </label>
                    <input type="number" class="seller-input-palet-text-box" v-model="user.contact_number" @click="change_panel()">
                    <br><br>
                    <label for="" class="seller-input-palet-text-label">New Password: </label>
                    <input type="password" id="txtPassword" onkeypress="checkEnter(event);" class="seller-input-palet-text-box" v-model="user.password" @click="change_panel()">


                    <div id="seller-input-palet-bottom">
                        <!-- <a href="seller_thank_you.html"> -->
                            <button class="seller-button" @click="register()">
                                Register
                            </button>
                        <!-- </a> -->



                        <div id="seller-register-text-box">
                            <a href="seller_auth.php" style="text-decoration: none;">
                                <p id="seller-register-text">
                                    <strong>Login</strong>
                                </p>
                            </a>

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
                        <h5 class="modal-title" id="exampleModalLabel">Registration</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ message }}
                    </div>
                    <div class="modal-footer">
                    <a href="seller_auth.php">
                        <button type="button" class="btn btn-primary" >Login</button>
                    </a>
                    
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Registration</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ message }}
                    </div>
                    <div class="modal-footer">
                    <a href="seller_auth.php">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </a>
                    
                    </div>
                </div>
            </div>
        </div>



    </div>



    
<script>
    function checkEnter(params) {
        if (params.keyCode == 13) {
            app.register();
        }
    }
</script>

    
  <script src="_js/seller_registration.js"></script>


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