var app = new Vue({
  el: "#app",
  data: {
    information_pallet: false,
    message: "",
    fb_id: "",
    user: {
      full_name: "",
      email: "",
      password: "",
      url: "_img/linked_face.webp",
    },
  },
  methods: {
    getInfo: function (fb_id, fb_accesst) {
      this.fb_id = fb_id;
      axios
        .get("https://graph.facebook.com/me?access_token=" + fb_accesst)
        .then((response) => {
          //   this.info = response;
          this.user.full_name = response.data.name;
          this.getPic(fb_id);
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
          // console.log(response.data.data.url);
          app.checkUser(fb_id);
        });
    },
    checkUser: function (fb_id) {
      axios
        .get(
          "server/seller_operation_data.php?Command=checkUser&fb_id=" + fb_id
        )
        .then((response) => {
          var users = response.data[0];
          if (users == 0) {
            this.message = "Please Register";
            $("#exampleModal").modal("show");
          } else {
            this.login_user_fb();
          }
        });
    },
    register_user: function () {
      axios
        .get(
          "server/seller_operation_data.php?Command=register_user_fb&fb_id=" +
            this.fb_id +
            "&fb_name=" +
            this.user.full_name
        )
        .then((response) => {
          if (response.data == "Saved") {
            this.message = "Please Register";
            $("#exampleModal").modal("hide");
            this.login_user_fb();
          }else{
            this.message = "Error";
          }
        });
    },
    login_user_fb: function () {
      axios
        .get(
          "server/seller_operation_data.php?Command=login_user_fb&fb_id=" +
            this.fb_id
        )
        .then((response) => {
          if (response.data == "ok") {
            $("html, body").animate(
              {
                scrollTop: $(".anchor").offset().top,
              },
              1000
            );
            setInterval(function () {
              location.reload();
            }, 2000);
          }
        });
    },
  },
});
