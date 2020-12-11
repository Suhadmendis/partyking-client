var app = new Vue({
  el: "#app",
  data: {
    REF: "",
    PRODUCT: "",
    STORE: "",
  },
  mounted: function () {
    var url = new URL(window.location.href);
    this.REF = url.searchParams.get("REF");
    
    $("#contact-hidden").fadeOut(10);
    
    this.get_product();
  },
  methods: {
    get_product: function () {
      axios
        .get("server/product_operation_data.php?Command=user_get_product&REF=" + this.REF)
        .then((response) => {
          this.PRODUCT = response.data[0];
          this.STORE = response.data[1];
        });
    },
    goto_store: function (REF) {
      location.replace("storage_page.html?REF=" + REF);
    },
    price_format: function (price) {
      var number = parseInt(price);
      return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      
    },
    show_contact: function () {
      var boxHeight = $("#description-lower").height();
     
          $("#description-lower").delay(400).animate({
            height: "210",
            backgroundColor: "#ebebeba4",
          });

          $("#contact-seller").fadeOut(350);
          $("#contact-hidden").delay(400).fadeIn(1000);

      console.log(boxHeight);
    },
  },
});


