var app = new Vue({
  el: "#app",
  data: {
    message: "",
    message_head: "",
    icon_flag: false,
    TEMP_PRO: "",
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
      updated_image: "",
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
  watch: {
    "PRODUCT.day_price": function (newQuestion, oldQuestion) {
      if (newQuestion < 0) {
        this.PRODUCT.day_price = parseInt(newQuestion) * -1;
        console.log(parseInt(newQuestion));
      } else {
        this.PRODUCT.day_price = parseInt(newQuestion);
      }
      // return parseInt(newQuestion);
    },
    "PRODUCT.sell_price": function (newQuestion, oldQuestion) {
      if (newQuestion < 0) {
        this.PRODUCT.sell_price = parseInt(newQuestion) * -1;
        console.log(parseInt(newQuestion));
      } else {
        this.PRODUCT.sell_price = parseInt(newQuestion);
      }
      // return parseInt(newQuestion);
    },
  },
  methods: {
    generate: function () {
      axios
        .get("server/product_operation_data.php?Command=generate")
        .then((response) => {
          this.categories = response.data[0];
          this.getProduct();
        });
    },
    getProduct: function () {
      axios
        .get(
          "server/product_operation_data.php?Command=getProduct&REF=" +
            document.getElementById("PRO_REF").value
        )
        .then((response) => {
          // this.TEMP_PRO = response.data[0];
          // REF: "PRO/0000000056";
          // approve: null;
          // brand: "df";
          // category_ref: "CAT/0000001";
          // day_price: "4325.00";
          // description: "gdfgd";
          // id: "86";
          // image_1: "5fce4d4f100e2.png";
          // inactive: null;
          // model: "gdfg";
          // name: "hfghf";
          // pro_condition: "New";
          // sell_price: "0.00";
          // status: null;
          // store_ref: "ST/0000000005";
          // sub_category_ref: "SUCAT/0000053";
          // sys_time: "2020-12-07 10:42:41";
          // theme: "";
          // type: "Rent";
          // user: "User Name";
          
          this.PRODUCT.name= response.data[0].name;
          this.select_cat(response.data[1]);                    
          this.select_sub_cat(response.data[2]);
          var temp_vari1 = { name: response.data[0].pro_condition };
          this.select_condition(temp_vari1);

          var temp_vari2 = { name: response.data[0].type };
          this.select_type(temp_vari2);

          this.PRODUCT.brand= response.data[0].brand;
          this.PRODUCT.model= response.data[0].model;
          this.PRODUCT.theme= response.data[0].theme;
          this.PRODUCT.description= response.data[0].description;
          this.PRODUCT.day_price= response.data[0].day_price;
          this.PRODUCT.sell_price= response.data[0].sell_price;
          this.PRODUCT.pro_image= "uploads/1/products/" + response.data[0].image_1;
          this.PRODUCT.pro_image_pass = 1;
          this.PRODUCT.image = response.data[0].image_1;
          this.PRODUCT.updated_image = response.data[0].image_1;

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
      // console.log(value);
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
    update_product: function () {
      app.icon_flag = false;
      if (this.PRODUCT.name == "") {
        this.message = "Name is not Entered";
        $("#exampleModal").modal("show");
        return;
        // alert("Name is not Entered");
      }
      if (this.PRODUCT.pro_image_pass == 0) {
        this.message = "Please insert an image";
        $("#exampleModal").modal("show");
        return;
      }
      if (this.PRODUCT.category_ref == "") {
        this.message = "Category is not Entered";
        $("#exampleModal").modal("show");
        return;
      }
      if (this.PRODUCT.sub_category_ref == "") {
        this.message = "Sub Category is not Entered";
        $("#exampleModal").modal("show");
        return;
      }
      if (this.PRODUCT.condition == "") {
        this.message = "Condition is not Entered";
        $("#exampleModal").modal("show");
        return;
      }
      if (this.PRODUCT.description == "") {
        this.message = "Description is not Entered";
        $("#exampleModal").modal("show");
        return;
      }
      if (this.PRODUCT.type == "") {
        this.message = "Type is not Entered";
        $("#exampleModal").modal("show");
        return;
      }

      if (this.selected_type == "Rent") {
        if (this.PRODUCT.day_price == "") {
          this.message = "Day Price is not Entered";
          $("#exampleModal").modal("show");
          return;
        }
      }

      if (this.selected_type == "Sell") {
        if (this.PRODUCT.sell_price == "") {
          this.message = "Sell Price is not Entered";
          $("#exampleModal").modal("show");
          return;
        }
      }
      if (this.selected_type == "Rent or Sell") {
        if (this.PRODUCT.day_price == "") {
          this.message = "Day Price is not Entered";
          $("#exampleModal").modal("show");
          return;
        }
        if (this.PRODUCT.sell_price == "") {
          this.message = "Sell Price is not Entered";
          $("#exampleModal").modal("show");
          return;
        }
      }

      axios
        .get(
          "server/product_operation_data.php?Command=update_product" +
            "&name=" +
            this.PRODUCT.name +
            "&REF=" +
            document.getElementById("PRO_REF").value +
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
          if (response.data == "Updated") {
            
            if (this.PRODUCT.image != this.PRODUCT.updated_image) {
              this.upload_image();
            }else{
              app.message = "Updated";
              app.icon_flag = true;
  
              $("#exampleModal").modal("show");

            }

            // this.PRODUCT.name = "";
            // this.PRODUCT.category_ref = "";
            // this.PRODUCT.sub_category_ref = "";
            // this.PRODUCT.condition = "";
            // this.PRODUCT.brand = "";
            // this.PRODUCT.model = "";
            // this.PRODUCT.theme = "";
            // this.PRODUCT.description = "";
            // this.PRODUCT.type = "Rent";
            // this.PRODUCT.day_price = "";
            // this.PRODUCT.sell_price = "";
            // this.selected_category = { REF: "", category_name: "Category" };
            // this.selected_subCategory = { REF: "", name: "Sub Category" };
            // this.selected_condition = "Condition";
            // this.selected_type = "Rent";
            // this.PRODUCT.pro_image = "_img/imageupload.jpg";
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
          app.message = "Updated";
          app.icon_flag = true;

          $("#exampleModal").modal("show");

          app.PRODUCT.pro_image_pass = 0;
          app.PRODUCT.pro_image = "_img/imageupload.jpg";
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
          app.message = response;
          
          $("#exampleModal").modal("show");
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


