var app = new Vue({
  el: "#app",
  data: {
    information_pallet: true,
    user: { full_name: "", email: "", contact_number: "", password: "" },
    message: "",
  },
  methods: {
    change_panel: function () {
      this.information_pallet = false;
    },
    register: function () {
      axios
        .get(
          "server/seller_operation_data.php?Command=register_web&full_name=" +
            this.user.full_name +
            "&email=" +
            this.user.email +
            "&contact_number=" +
            this.user.contact_number +
            "&password=" +
            this.user.password
        )
        .then((response) => {
          if (response.data == "Saved") {
            this.login_user_web();
          }

          if (response.data == "Not") {
            this.message = "Already Registered";
            $("#exampleModal").modal("show");
          }
          // var users = response.data[0];
          // response.data[0]
          // if (users == 0) {
          //   this.message = "Please Register";
          //   $("#exampleModal").modal("show");
          // } else {
          //   this.login_user_fb();
          // }
        });
    },
    login_user_web: function () {
      axios
        .get(
          "server/seller_operation_data.php?Command=login_user_web&email=" +
            this.user.email +
            "&password=" +
            this.user.password
        )
        .then((response) => {
          if (response.data == "ok") {
            location.replace("seller_thank_you.php");
          }
        });
    },
  },
});
