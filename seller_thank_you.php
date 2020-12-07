<?php

session_start();
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

    <link rel="stylesheet" href="_css/seller_thank_you.css">
    <!-- <link rel="stylesheet" href="_css/footer.css"> -->
  

</head>
<body>


    <div class="container-fluid" id="app">
        <div class="row">
            <div class="col-md-12" id="seller-thank-palet">
                <div id="seller-thank-palet-box">
                    <h1 id="thank-you-text">Thank you!</h1>
                    <br>
                    <br>
                    <p>Thank you for choosing us. We are happy to let you know that you are among the first 60 to 110 sellers. This is the best opportunity for you to increase your sales. Make sure to let other fellow sellers aware about our website.</p>
                
                    <p>Get ready to send your sales shoot over the roof!</p>
                    <p>Many tricks and method will also be shared among each seller.</p>

                </div>

                <div id="seller-relationship-palet-box">
                        <div class="seller-relationship-palet-sub-box">
                            <img class="seller-relationship-palet-image" src="_img/logo full site.webp" alt="">
                            <p class="seller-relationship-palet-text">Party King</p>
                        </div>

                        <div class="seller-relationship-palet-sub-box">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </div>

                        <div class="seller-relationship-palet-sub-box">
                            <img class="seller-relationship-palet-image" src="_img/infinity_love.png" alt="">
                        </div>

                        <div class="seller-relationship-palet-sub-box">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </div>

                        <div class="seller-relationship-palet-sub-box">
                            <img class="seller-relationship-palet-image-user" src="_img/linked_face.PNG" alt="">
                            <p class="seller-relationship-palet-text"><?php echo $_SESSION['CURRENT_USER']; ?></p>
                        </div>
                        
                </div>

                <div id="seller-goto-btn">
                        <a href="seller_auth.php">
                            <button class="goto-btn">
                                Go
                            </button>
                        </a>
                        
                </div>

                <br><br>
                
            </div>
       </div>
   </div>
           



    
      





























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