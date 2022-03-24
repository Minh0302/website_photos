<template>
  <div>
    <section class="bg-gray200 pt-5 pb-5">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-7">
            <article class="card" id="scrollTop">
              <img
                class="card-img-top mb-2"
                :src="'upload/'+ product.product_image"
                :alt="product.product_name"
              />
              <div class="card-body">
                <h1 class="card-title display-4">{{product.product_name}}</h1>
                <div>
                    <h4>User: {{product.user_name}}</h4>
                </div>
                <h6>Date: {{product.created_at | formatDate}}</h6>
                <h6>Description:</h6>
                <ul>
                  <li>{{product.product_desc}}</li>
                </ul>
                <small class="d-block"
                  ><a class="btn btn-sm btn-gray200" href="#"
                    ><i class="fa fa-external-link"></i> Visit Website</a
                  ></small
                >
              </div>
            </article>
          </div>
        </div>
      </div>
      <div class="container-fluid mt-5">
        <div class="row">
          <h5 class="font-weight-bold">More like this</h5>
          <div class="card-columns">
            <div class="card card-pin"  v-for="showProduct in products" v-bind:key="showProduct.product_id">
              <img class="card-img" :src="'upload/'+showProduct.product_image" :alt="showProduct.product_name" />
              <div class="overlay">
                <h2 class="card-title title">{{showProduct.product_name}}</h2>
                <div class="more">
                  <router-link v-bind:to="'/details/'+showProduct.product_id">
                    <i
                      class="fa fa-arrow-circle-o-right"
                      aria-hidden="true"
                    ></i>
                    More
                  </router-link>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
import {mapGetters} from 'vuex';
export default {
  data() {
    return {
      products: [],
      product: {
        product_id: "",
        user_id: "",
        user_name: "",
        product_name: "",
        product_desc: "",
        product_image: "",
      },
      forms: [],
      form: {
        id: "",
        name: "",
        user_background: "",
        user_avatar: "",
        user_desc: "",
      },
    }
  },
  created() {
    this.fetchProduct();
    this.fetchProductDetails();
    this.fetchAllUser();
    // console.log(this.$route.params.id);
  },
  computed: {
    ...mapGetters({user: "getUser"})
  },
  mounted () {
    window.scrollTo(0, 0)
  },
  methods: {
    fetchProduct: function() {
      fetch(`http://127.0.0.1:8000/api/v1/products/related/${this.$route.params.id}`)
        .then((res) => res.json())
        .then((res) => {
          this.products = res.data;
        })
        .catch((err) => console.log(err))
    },
    fetchProductDetails: function() {
      fetch(`http://127.0.0.1:8000/api/v1/products/${this.$route.params.id}`)
        .then((res) => res.json())
        .then((res) => {
          this.product = res.data;
          // console.log(res.data);
          // console.log(res.data.product_name);
          // console.log(res.data.product_image);
          // console.log(res.data.product_desc);
        })
        .catch((err) => console.log(err))
    },
    fetchAllUser: function (){
      fetch("http://127.0.0.1:8000/api/v1/profile/users")
        .then((res) => res.json())
        .then((res) => {
          this.forms = res.data;
        })
        .catch((err) => console.log(err));
    },
    // scrollToTop: function(){
    //   const el = this.$el.getElementsById('scrollTop');
    //   const rect = el.getBoundingClientRect();
    //   window.scrollTo(rect.left, rect.top);
    // }
  },
}
</script>