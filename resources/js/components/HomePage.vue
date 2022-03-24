<template>
  <div>
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
      <router-link to="/" class="navbar-brand font-weight-bolder mr-3"
        ><img src="img/logo.png"
      /></router-link>
      <button
        class="navbar-light navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarsDefault"
        aria-controls="navbarsDefault"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarsDefault">
        <ul class="navbar-nav mr-auto align-items-center">
          <li class="nav-item">
            <router-link to="/" class="nav-link active">Home</router-link>
          </li>
          <li class="nav-item">
            <form class="bd-search hidden-sm-down">
              <div class="input-group">
                <input
                  type="text"
                  class="form-control"
                  placeholder="Search..."
                />
                <div class="input-group-append">
                  <button class="btn btn-info" type="button">
                    <i class="fa fa-search"></i>
                  </button>
                </div>
              </div>
            </form>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto align-items-center">
          <li class="nav-item" v-if="!isLoggedIn">
            <div class="btn-group">
              <router-link to="/login" class="btn btn-sm btn-info"
                >Login
              </router-link>
            </div>
          </li>
          <li class="nav-item" v-else>
            <div class="btn-group">
              <button
                class="btn btn-sm btn-info dropdown-toggle"
                type="button"
                id="dropdownMenuButton"
                data-toggle="dropdown"
                aria-expanded="false"
              >
                <img
                  class="rounded-circle mr-2"
                  src="img/user.png"
                  width="30"
                /><span class="align-middle">{{ user.name }}</span>
              </button>
              <div class="dropdown-menu">
                <router-link
                  v-bind:to="'/profile/' + user.id"
                  class="dropdown-item"
                  >Profile</router-link
                >
                <button class="dropdown-item" @click="logout()">Logout</button>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </nav>

    <main role="main">
      <router-view :key="$route.path"></router-view>
    </main>

    <footer class="footer pt-5 pb-5 text-center">
      <div class="container">
        <div class="socials-media">
          <ul class="list-unstyled">
            <li class="d-inline-block ml-1 mr-1">
              <a href="#" class="text-dark"><i class="fa fa-facebook"></i></a>
            </li>
            <li class="d-inline-block ml-1 mr-1">
              <a href="#" class="text-dark"><i class="fa fa-twitter"></i></a>
            </li>
            <li class="d-inline-block ml-1 mr-1">
              <a href="#" class="text-dark"><i class="fa fa-instagram"></i></a>
            </li>
            <li class="d-inline-block ml-1 mr-1">
              <a href="#" class="text-dark"
                ><i class="fa fa-google-plus"></i
              ></a>
            </li>
            <li class="d-inline-block ml-1 mr-1">
              <a href="#" class="text-dark"><i class="fa fa-behance"></i></a>
            </li>
            <li class="d-inline-block ml-1 mr-1">
              <a href="#" class="text-dark"><i class="fa fa-dribbble"></i></a>
            </li>
          </ul>
        </div>

        <p>
          ©
          <span class="credits font-weight-bold">
            <a target="_blank" class="text-dark" href=""
              ><u>Pintereso Bootstrap HTML Template</u> by Lê Minh</a
            >
          </span>
        </p>
      </div>
    </footer>
  </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
export default {
  data() {
    return {
      // user: ""
    };
  },
  computed: {
    isLoggedIn: function () {
      return this.$store.getters.isLoggedIn;
    },
    ...mapGetters({ user: "getUser" }),
  },
  created() {
    if (this.isLoggedIn) {
      this.$store.dispatch("getUser");
    }
  },
  methods: {
    async logout() {
      await this.$store.dispatch("logout");
      this.$router.push("/login");
    },
  },
};
</script>