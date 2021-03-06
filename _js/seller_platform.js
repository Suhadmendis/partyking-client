var app = new Vue({
  el: "#app",
  data: {
    information_pallet: false,
    message: "",
    message_head: "",
    editflag: "",
    editplaceholder: "",
    updateMainPanel: "",
    number: false,
    user: {
      REF: "",
      full_name: "",
      email: "suhad.a.mendis@gmail.com",
      password: "",
      url: "_img/linked_face.webp",
      contact_number: "077XXXXXXX",
    },
    store: {
      REF: "",
      name: "Store Name",
      tagline: "Tagline",
      email: "Email",
      contact_number: "Contact Number",
      street_address: "Street address",
      city: "City",
      postal: "ZIP / Postal",
      url: "logo full siteo.png",
    },
    PRODUCTS: [],
    product_pallet: false,
  },
  mounted: function () {
    this.generate();
  },
  methods: {
    generate: function () {
      axios
        .get("server/product_operation_data.php?Command=generateProducts")
        .then((response) => {
          this.PRODUCTS = response.data[0];
          console.log(response.data[1].length);
          if (response.data[1].length == 0) {
            this.logout();
          }
          this.getPic(response.data[1][0].fb_id);
          this.user.full_name =
            response.data[1][0].first_name ||
            "" + " " + response.data[1][0].last_name ||
            "";
          this.user.REF = response.data[1][0].REF;
          this.user.contact_number = response.data[1][0].tel_1 || "077XXXXXXX";
          this.product_pallet = true;

          this.store.REF = response.data[2][0].REF;
          this.store.name = response.data[2][0].name || "Store Name";
          this.store.tagline = response.data[2][0].tagline || "Tagline";
          this.store.email = response.data[2][0].email || "Email";
          this.store.contact_number =
            response.data[2][0].tel_1 || "Contact Number";
          this.store.street_address =
            response.data[2][0].address_1 || "Street Address";
          this.store.city = response.data[2][0].city_name || "City";
          this.store.postal = response.data[2][0].postal || "ZIP / Postal";
          this.store.url =
            response.data[2][0].img_logo || "logo full siteo.png";
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
        });
    },
    delete_product: function (ref) {
      if (confirm("Do you want to Remove this Product?")) {
        axios
          .get(
            "server/product_operation_data.php?Command=delete_product&REF=" +
              ref
          )
          .then((response) => {
            if (response.data == "Deleted") {
              this.generate();
            }
          });
      } else {
      }
    },
    edit: function (flag) {
      this.updateMainPanel = "";
      
      
      if (flag == "user_number") {
        this.number = false;
        this.message_head = "Seller Contact Number";
        this.message = "Please enter the seller Contact Number";
        this.editplaceholder = "077XXXXXXX";
        $("#exampleModal").modal("show");
      }

      if (flag == "store_name") {
        this.number = false;
        this.message_head = "Store Name";
        this.message = "Please enter the name of the Store";
        this.editplaceholder = "Colombo Party Store";
        $("#exampleModal").modal("show");
      }

      if (flag == "tagline") {
        this.number = false;
        this.message_head = "Tagline";
        this.message = "Please enter the Tagline of the Store";
        this.editplaceholder = "The King of Parties";
        $("#exampleModal").modal("show");
      }

      if (flag == "store_email") {
        this.number = false;
        this.message_head = "Email";
        this.message = "Please enter the Tagline of the Store";
        this.editplaceholder = "mystore@gmail.com";
        $("#exampleModal").modal("show");
      }

      if (flag == "store_number") {
        this.number = true;
        this.message_head = "Contact Number";
        this.message = "Please enter the Tagline of the Store";
        this.editplaceholder = "077XXXXXXX";
        $("#exampleModal").modal("show");
      }

      if (flag == "store_address") {
        this.number = false;
        this.message_head = "Street Address";
        this.message = "Please enter the Tagline of the Store";
        this.editplaceholder = "No: 154, Party Lane";
        $("#exampleModal").modal("show");
      }

      if (flag == "store_city") {
        this.number = false;
        this.message_head = "City";
        this.message = "Please enter the City where the Store is Located";
        this.editplaceholder = "Moratuwa";
        $("#exampleModal").modal("show");
      }

      if (flag == "store_postal") {
        this.number = false;
        this.message_head = "ZIP / Postal";
        this.message = "Please enter the ZIP / Postal of the Store";
        this.editplaceholder = "10350";
        $("#exampleModal").modal("show");
      }

      this.editflag = flag;
    },
    edit_update: function (editflag) {
      axios
        .get(
          "server/product_operation_data.php?Command=edit_update&flag=" +
            editflag +
            "&value=" +
            this.updateMainPanel +
            "&REF=" +
            this.user.REF
        )
        .then((response) => {
          if (response.data == "Saved") {
            $("#exampleModal").modal("hide");
            this.generate();
            this.updateMainPanel = "";
          }
        });
    },
    debug: function () {
      axios
        .get("server/product_operation_data.php?Command=debug")
        .then((response) => {
          console.log(response);
        });
    },
    logout: function () {
      axios.get("CheckUsers.php?Command=logout").then((response) => {
        location.reload("seller_auth.php");
      });
    },
  },
});
// edit_update;

$(document).ready(function () {
  $("#upload-input").change(function () {
    // $("#myform").change(function () {
    var fd = new FormData();
    var files = $("#upload-input")[0].files[0];
    fd.append("file", files);

    $.ajax({
      url: "server/image_upload.php?Command=store_logo_upload",
      dataType: "script",
      cache: false,
      contentType: false,
      processData: false,
      data: fd,
      type: "post",
      success: function (response) {
        if (response.length < 20) {
          app.store.url = response;
        } else {
          alert(response);
        }
      },
    });
  });
});


$(document).ready(function () {
  $("#upload-input1").change(function () {
    // $("#myform").change(function () {
    var fd = new FormData();
    var files = $("#upload-input1")[0].files[0];
    fd.append("file", files);

    $.ajax({
      url: "server/image_upload.php?Command=store_logo_upload",
      dataType: "script",
      cache: false,
      contentType: false,
      processData: false,
      data: fd,
      type: "post",
      success: function (response) {
        if (response.length < 20) {
          app.store.url = response;
        } else {
          alert(response);
        }
      },
    });
  });
});
