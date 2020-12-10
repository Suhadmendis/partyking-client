var app = new Vue({
  el: "#app",
  data: {
    PRODUCTS: [
      { name: "Title 1" },
      { name: "Title 2" },
      { name: "Title 3" },
      { name: "Title 4" },
      { name: "Title 5" },
      { name: "Title 6" },
      { name: "Title 7" },
      { name: "Title 8" },
      { name: "Title 9" },
      { name: "Title 10" },
    ],
    CATEGORIES: "",
    selected_category: "",
    selected_category_name: "",
    selected_sub_categories: "",
    selected_sub_category: "",
  },
  mounted: function () {
    this.get_categories();
  },
  methods: {
    get_categories: function () {
      axios
        .get("server/product_operation_data.php?Command=user_category")
        .then((response) => {
          this.CATEGORIES = response.data[0];
          this.activate(
            this.CATEGORIES[0].REF,
            this.CATEGORIES[0].category_name
          );
        });
    },
    activate: function (REF, name) {
      for (let index = 0; index < this.CATEGORIES.length; index++) {
        if (this.CATEGORIES[index].REF == REF) {
          this.selected_category = this.CATEGORIES[index];
          this.selected_sub_categories = this.CATEGORIES[index].sub_categories;
          this.selected_sub_category = this.CATEGORIES[
            index
          ].sub_categories[0].REF;
          this.selected_category_name = name;
          this.CATEGORIES[index].active_pill = 1;
        } else {
          this.CATEGORIES[index].active_pill = 0;
        }
      }
    },
    activate_sub: function (REF) {
      this.selected_sub_category = REF;
    },
    goto_product: function (REF) {
      alert(REF);
      location.replace("");
    },
  },
});
