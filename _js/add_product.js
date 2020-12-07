var app = new Vue({
  el: "#app",
  data: {
    PRODUCT: {
      name: "",
      category_ref: "",
      sub_category_ref: "",
      condition: "",
      brand: "",
      model: "",
      theme: "",
      description: "",
      type: "",
      day_price: "",
      sell_price: "",
      pro_image: "_img/imageupload.jpg",
      pro_image_pass: 0,
      image: "",
    },
    categories: "",
    subCategories: "",
    conditions: [{ name: "New" }, { name: "New with tags" }, { name: "Used" }],
    types: [{ name: "Rent" }, { name: "Rent or Sell" }, { name: "Sell" }],
    selected_category: { REF: "", category_name: "Category" },
    selected_subCategory: { REF: "", name: "Sub Category" },
    selected_condition: "Condition",
    selected_type: "Rent",
  },
  mounted: function () {
    this.generate();
  },
  methods: {
    generate: function () {
      axios
        .get("server/product_operation_data.php?Command=generate")
        .then((response) => {
          this.categories = response.data[0];
        });
    },
    getPic: function (fb_id) {
      axios
        .get(
          "https://graph.facebook.com/" +
            fb_id +
            "/picture?redirect=0&width=400"
        )
        .then((response) => {
          this.user.url = response.data.data.url;
          setTimeout(function () {
            app.checkUser();
          }, 5000);
        });
    },
    select_cat: function (value) {
      this.selected_category = value;
      this.PRODUCT.category_ref = value.REF;
      axios
        .get(
          "server/product_operation_data.php?Command=getSubCategories&REF=" +
            this.selected_category.REF
        )
        .then((response) => {
          this.subCategories = response.data[0];
        });
    },
    select_sub_cat: function (value) {
      this.selected_subCategory = value;
      this.PRODUCT.sub_category_ref = value.REF;
    },
    select_condition: function (value) {
      this.selected_condition = value.name;
      this.PRODUCT.condition = value.name;
    },
    select_type: function (value) {
      this.selected_type = value.name;
      this.PRODUCT.type = value.name;

      if (this.selected_type == "Rent") {
        this.PRODUCT.sell_price = "";
      }
      if (this.selected_type == "Sell") {
        this.PRODUCT.day_price = "";
      }
    },
    save_product: function () {
      if (this.PRODUCT.name == "") {
        alert("Name is not Entered");
        return;
      }
      if (this.PRODUCT.pro_image_pass == 0) {
        alert("Please insert an image");
        return;
      }
      if (this.PRODUCT.category_ref == "") {
        alert("Category is not Entered");
        return;
      }
      if (this.PRODUCT.sub_category_ref == "") {
        alert("Sub Category is not Entered");
        return;
      }
      if (this.PRODUCT.condition == "") {
        alert("Condition is not Entered");
        return;
      }
      if (this.PRODUCT.description == "") {
        alert("Description is not Entered");
        return;
      }
      if (this.PRODUCT.type == "") {
        alert("Type is not Entered");
        return;
      }

      if (this.selected_type == "Rent") {
        if (this.PRODUCT.day_price == "") {
          alert("Day Price is not Entered");
          return;
        }
      }
      if (this.selected_type == "Sell") {
        if (this.PRODUCT.sell_price == "") {
          alert("Sell Price is not Entered");
          return;
        }
      }
      if (this.selected_type == "Rent or Sell") {
        if (this.PRODUCT.day_price == "") {
          alert("Day Price is not Entered");
          return;
        }
        if (this.PRODUCT.sell_price == "") {
          alert("Sell Price is not Entered");
          return;
        }
      }

      axios
        .get(
          "server/product_operation_data.php?Command=save_product" +
            "&name=" +
            this.PRODUCT.name +
            "&category_ref=" +
            this.PRODUCT.category_ref +
            "&sub_category_ref=" +
            this.PRODUCT.sub_category_ref +
            "&condition=" +
            this.PRODUCT.condition +
            "&brand=" +
            this.PRODUCT.brand +
            "&model=" +
            this.PRODUCT.model +
            "&theme=" +
            this.PRODUCT.theme +
            "&description=" +
            this.PRODUCT.description +
            "&type=" +
            this.PRODUCT.type +
            "&day_price=" +
            this.PRODUCT.day_price +
            "&sell_price=" +
            this.PRODUCT.sell_price +
            "&image=" +
            this.PRODUCT.image
        )
        .then((response) => {
          if (response.data == "Saved") {
            this.upload_image();
            this.PRODUCT.name = "";
            this.PRODUCT.category_ref = "";
            this.PRODUCT.sub_category_ref = "";
            this.PRODUCT.condition = "";
            this.PRODUCT.brand = "";
            this.PRODUCT.model = "";
            this.PRODUCT.theme = "";
            this.PRODUCT.description = "";
            this.PRODUCT.type = "Rent";
            this.PRODUCT.day_price = "";
            this.PRODUCT.sell_price = "";
          }
        });
    },
    upload_image: function () {
      // $("#myform").change(function () {
      var fd = new FormData();
      var files = $("#upload-input")[0].files[0];
      fd.append("file", files);
      $.ajax({
        url: "server/image_upload.php?Command=post_to_hdd",
        dataType: "script",
        cache: false,
        contentType: false,
        processData: false,
        data: fd,
        type: "post",
        success: function (response) {
          alert("Saved");
          app.PRODUCT.pro_image_pass = 0;
          app.PRODUCT.pro_image = "_img/imageupload.png";
        },
      });
    },
  },
});





$(document).ready(function () {
  
  $("#upload-input").change(function () {
  // $("#myform").change(function () {
    var fd = new FormData();
    var files = $("#upload-input")[0].files[0];
    fd.append("file", files);
  
    $.ajax({
      url: "server/image_upload.php?Command=upload",
      dataType: "script",
      cache: false,
      contentType: false,
      processData: false,
      data: fd,
      type: "post",
      success: function (response) {
        // if (response != 0) {
        //   $("#img").attr("src", response);
        //   $(".preview img").show(); // Display image element
        // } else {
        //   alert("file not uploaded");
        console.log(response);
        if (response.length < 20) {
          app.PRODUCT.pro_image = "uploads/1/products/" + response;
          app.PRODUCT.image = response;
          app.PRODUCT.pro_image_pass = 1;

        }else{
          alert(response);
          app.PRODUCT.pro_image_pass = 0;
        }

        // document.getElementById("img_path").innerHTML =
        //   '<img src="uploads/item/books/' + res + '" alt="" width="400" >';
        // document.getElementById("img_logo").value = res;
        

        // }
      },
    });
  });
});


