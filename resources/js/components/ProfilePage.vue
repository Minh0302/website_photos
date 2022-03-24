<template>
  <div>
    <div>
      <div v-if="user.user_background==null"
        class="jumbotron border-round-0 min-50vh"
        style="
          background-image: url('upload/background-default.png');
        "
      ></div>
      <div v-else
        class="jumbotron border-round-0 min-50vh"
        v-bind:style="{ 'background-image': 'url(upload/' + user.user_background + ')' }"
      ></div>
      <div class="container mb-4">
        <img
          v-if="user.user_avatar!=null"
          :src="'upload/'+user.user_avatar"
          class="mt-neg100 mb-4 rounded-circle"
          width="128"
        />
        <img
          v-else
          src="upload/default.png"
          class="mt-neg100 mb-4 rounded-circle"
          width="128"
        />
        <h1 class="font-weight-bold title">{{ user.name }}</h1>
        <div v-for="showUser in forms" v-bind:key="showUser.id">
          <button
            type="button"
            class="btn btn-danger"
            data-toggle="modal"
            data-target="#editProfile"
            @click="editUser(showUser)"
          >
            Edit Profile
          </button>
        </div>
        <button
          type="button"
          class="btn btn-danger btn-add-image"
          data-toggle="modal"
          data-target="#addImg"
        >
          Add Image
        </button>
        <p v-if="user.user_desc!=null">{{ user.user_desc }}</p>
        <p v-else>Add a description for yourself</p>
      </div>
    </div>
    <!-- Modal user -->
    <div
      class="modal fade"
      id="editProfile"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form
            @submit.prevent="handleUpdateUser"
            enctype="multipart/form-data"
          >
            <div class="modal-body">
              <div class="form-group">
                <label for="exampleFormControlInput1">Name</label>
                <input
                  type="text"
                  class="form-control"
                  id="exampleFormControlInput1"
                  v-model="form.name"
                />
              </div>
              <div class="form-group">
                <label for="exampleFormControlInput1">Description</label>
                <textarea
                  class="form-control"
                  id="exampleFormControlTextarea1"
                  rows="3"
                  v-model="form.user_desc"
                ></textarea>
              </div>
              <div class="form-group">
                <label for="exampleFormControlInput1">Avatar</label>
                <input type="file" class="form-control" id="user_avatar" />
                <div class="mt-2" id="preview">
                  <img
                    class="w-50"
                    v-if="editUserAvatar"
                    :src="editUserAvatar"
                  />
                </div>
              </div>
              <div class="form-group">
                <label for="exampleFormControlInput1">Background</label>
                <input type="file" class="form-control" id="user_background" />
                <div class="mt-2" id="preview">
                  <img
                    class="w-50"
                    v-if="editUserBackground"
                    :src="editUserBackground"
                  />
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
              >
                Close
              </button>
              <button type="submit" class="btn btn-primary">
                Save changes
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Modal img -->
    <div
      class="modal fade"
      id="addImg"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Image</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="createProduct" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-group">
                <label for="exampleFormControlInput1">Name Image</label>
                <input
                  type="text"
                  class="form-control"
                  placeholder="Name Image"
                  name="product_name"
                  v-model="product.product_name"
                />
              </div>
              <div class="form-group">
                <label for="exampleFormControlInput1">Description Image</label>
                <textarea
                  class="form-control"
                  rows="3"
                  name="product_desc"
                  v-model="product.product_desc"
                ></textarea>
              </div>
              <div class="form-group">
                <label for="exampleFormControlInput1">Image</label>
                <input
                  type="file"
                  class="form-control"
                  name="product_image"
                  id="product_image"
                  ref="fileUpload"
                />
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
              >
                Close
              </button>
              <button type="submit" class="btn btn-primary">
                Save changes
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="container mb-4">
      <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
          <a
            class="nav-link active"
            id="pills-home-tab"
            data-toggle="pill"
            href="#pills-home"
            role="tab"
            aria-controls="pills-home"
            aria-selected="true"
            >Recent photos</a
          >
        </li>
        <li class="nav-item" role="presentation">
          <a
            class="nav-link"
            id="pills-profile-tab"
            data-toggle="pill"
            href="#pills-profile"
            role="tab"
            aria-controls="pills-profile"
            aria-selected="false"
            >Deleted photo</a
          >
        </li>
      </ul>
    </div>
    <div class="tab-content" id="pills-tabContent">
      <div
        class="container-fluid mb-5 tab-pane fade show active"
        id="pills-home"
        role="tabpanel"
        aria-labelledby="pills-home-tab"
      >
        <div class="row">
          <div class="card-columns">
            <div
              class="card card-pin"
              v-for="showProductUser in products"
              v-bind:key="showProductUser.product_id"
            >
              <img
                class="card-img"
                :src="'upload/' + showProductUser.product_image"
                :alt="showProductUser.product_name"
              />
              <div class="overlay">
                <h2 class="card-title title">
                  {{ showProductUser.product_name }}
                </h2>
                <div class="more">
                  <button class="btn btn-sm" @click="deleteProduct(showProductUser.product_id)">
                    <i
                      class="fa fa-arrow-circle-o-right"
                      aria-hidden="true"
                    ></i>
                    Delete
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div
        class="container-fluid mb-5 tab-pane fade"
        id="pills-profile"
        role="tabpanel"
        aria-labelledby="pills-profile-tab"
      >
        <div class="row">
          <div class="card-columns">
            <div class="card card-pin" v-for="showDeleted in products_delete" v-bind:key="showDeleted.product_id">
              <img
                class="card-img"
                :src="'upload/'+showDeleted.product_image"
                :alt="showDeleted.product_name"
              />
              <div class="overlay">
                <h2 class="card-title title">{{showDeleted.product_name}}</h2>
                <div class="more">
                  <button class="btn btn-sm" @click="restoreProduct(showDeleted.product_id)">
                    <i
                      class="fa fa-arrow-circle-o-right"
                      aria-hidden="true"
                    ></i>
                    Restore
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapActions, mapGetters } from "vuex";
export default {
  data() {
    return {
      products: [],
      product: {
        product_id: "",
        user_id: "",
        product_name: "",
        product_desc: "",
        product_image: "",
      },
      products_delete: [],
      product_delete: {
        product_id: "",
        user_id: "",
        product_name: "",
        product_desc: "",
        product_image: "",
      },
      forms: [],
      form: {
        user_id: "",
        name: "",
        user_background: "",
        user_avatar: "",
        user_desc: "",
      },
      product_id: "",
      editUserBackground: "",
      editUserAvatar: "",
    };
  },
  created() {
    this.fetchProduct();
    this.fetchUser();
    this.showProductDeleted();
    // console.log(this.$route.params.id)
  },
  computed: {
    ...mapGetters({ user: "getUser" }),
  },
  methods: {
    fetchProduct: function () {
      fetch(
        `http://127.0.0.1:8000/api/v1/products/user/${this.$route.params.id}`
      )
        .then((res) => res.json())
        .then((res) => {
          this.products = res.data;
          // console.log(res.data)
        })
        .catch((err) => console.log(err));
    },
    fetchUser: function () {
      let token = window.localStorage.getItem('token');
      if(token == null){
        this.$router.push("/login");
      }
      axios.get(
        `http://127.0.0.1:8000/api/v1/profile/user/${this.$route.params.id}`,
        { headers: { Authorization: token } }
      )
        // .then((res) => res.json())
        .then((res) => {
          this.forms = res.data;
          // console.log(res.data)
        })
        .catch((err) => {
          this.$router.push("/login");
          console.log(err);
        });
    },
    createProduct: function () {
      let formData = new FormData();
      formData.append("product_name", this.product.product_name);
      formData.append("product_desc", this.product.product_desc);
      formData.append("user_id", this.user.id);
      if (document.getElementById("product_image").files[0]) {
        // console.log(document.getElementById("product_image").files[0]);
        formData.append(
          "product_image",
          document.getElementById("product_image").files[0]
        );
      }
      axios
        .post(`http://127.0.0.1:8000/api/v1/products/user`, formData)
        .then((res) => {
          alert("Add Successfully!!!");
          this.product.product_name = "";
          this.product.product_desc = "";
          this.$refs.fileUpload.value = "";
          this.fetchProduct();
        })
        .catch((err) => console.log(err));
    },
    editUser: function (showUser) {
      this.form.id = showUser.id;
      this.form.name = showUser.name;
      this.form.user_desc = showUser.user_desc;
      this.editUserBackground = `upload/${showUser.user_background}`;
      this.editUserAvatar = `upload/${showUser.user_avatar}`;
    },
    handleUpdateUser: function () {
      let formData = new FormData();
      formData.append("name", this.form.name);
      formData.append("user_desc", this.form.user_desc);
      if (document.getElementById("user_avatar").files[0]) {
        // console.log(document.getElementById('user_avatar').files[0]);
        formData.append(
          "user_avatar",
          document.getElementById("user_avatar").files[0]
        );
      }
      if (document.getElementById("user_background").files[0]) {
        // console.log(document.getElementById('user_background').files[0]);
        formData.append(
          "user_background",
          document.getElementById("user_background").files[0]
        );
      }
      formData.append("_method", "PUT");
      axios
        .post(
          `http://127.0.0.1:8000/api/v1/profile/user/${this.$route.params.id}`,
          formData
        )
        .then((res) => {
          alert("Update Successfully!!!");
          this.fetchUser();
        })
        .catch((err) => console.log(err));
    },
    deleteProduct: function(id){
      if(confirm("Are you sure you want to delete this product?")){
        axios.delete(`http://127.0.0.1:8000/api/v1/product/delete/${id}`)
          .then((res) => {
            alert("Delete Successfully!!!");
            this.fetchProduct();
            this.showProductDeleted();
          })
          .catch((err) => console.log(err));
      }
    },
    showProductDeleted: function(){
      fetch(`http://127.0.0.1:8000/api/v1/product/deleted`)
        .then((res) => res.json())
        .then((res) => {
          this.products_delete = res.data;
        })
        .catch((err) => console.log(err))
    },
    restoreProduct: function(id){
      if(confirm("Are you sure you want to restore?")){
        axios.delete(`http://127.0.0.1:8000/api/v1/product/restore/${id}`)
          .then((res) =>{
            alert("Restore Successfully!!!");
            this.showProductDeleted();
            this.fetchProduct();
          })
          .catch((err) => console.log(err))
      }
    }
  },
};
</script>
