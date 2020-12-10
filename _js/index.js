var app = new Vue({
  el: "#app",
  data: {
    PRODUCTS: "",
    PRODUCTS_SHOW: [],
    CATEGORIES: "",
    selected_category: "",
    selected_category_name: "Loading...",
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

          // call_products
          this.get_products();
        });
    },
    get_products: function () {
      axios
        .get("server/product_operation_data.php?Command=user_get_products")
        .then((response) => {
          this.PRODUCTS = response.data[0];
          this.show_products();
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
      this.show_products();
    },
    activate_sub: function (REF) {
      this.selected_sub_category = REF;
      this.show_products();
    },
    goto_product: function (REF) {
      location.replace("product_page.html?REF=" + REF);
    },
    show_products: function () {
      this.PRODUCTS_SHOW = [];

      for (let index = 0; index < this.PRODUCTS.length; index++) {
        if (this.PRODUCTS[index].category_ref == this.selected_category.REF) {
          if (this.PRODUCTS[index].sub_category_ref == this.selected_sub_category) {
            this.PRODUCTS_SHOW.push(this.PRODUCTS[index]);
          }
        }
      }
    },
  },
});
