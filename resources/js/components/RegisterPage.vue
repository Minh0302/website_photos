<template>
  <div class="container">
    <section class="vh-100">
      <div class="container py-5 h-100">
        <div class="row d-flex align-items-center justify-content-center h-100">
          <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
            <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign Up</p>
            <div v-if="showError">
              <span v-if="errors">
                <small
                  v-for="error in errors"
                  class="text-danger d-block"
                  v-bind:key="error[0]"
                  >{{ error[0] }}</small
                >
              </span>
            </div>
            <form @submit.prevent="userRegister">
              <!-- Email input -->
              <div class="form-outline mb-4">
                <label class="form-label" for="form1Example03">User Name</label>
                <input
                  type="text"
                  id="form1Example03"
                  class="form-control form-control-lg"
                  v-model="user.name"
                />
              </div>
              <!-- Email input -->
              <div class="form-outline mb-4">
                <label class="form-label" for="form1Example13"
                  >Email address</label
                >
                <input
                  type="email"
                  id="form1Example13"
                  class="form-control form-control-lg"
                  v-model="user.email"
                />
              </div>

              <!-- Password input -->
              <div class="form-outline mb-4">
                <label class="form-label" for="form1Example23">Password</label>
                <input
                  type="password"
                  id="form1Example23"
                  class="form-control form-control-lg"
                  v-model="user.password"
                />
              </div>
              <div class="form-outline mb-4">
                <label class="form-label" for="form1Example33">Password Confirm</label>
                <input
                  type="password"
                  id="form1Example33"
                  class="form-control form-control-lg"
                  v-model="user.password_confirmation"
                />
              </div>

              <!-- Submit button -->
              <button type="submit" class="btn btn-info btn-lg btn-block">
                Sign Up
              </button>

              <div class="divider d-flex align-items-center my-4">
                <p class="text-center fw-bold mx-3 mb-0 text-muted">OR</p>
              </div>

              <a
                class="btn btn-primary btn-lg btn-block"
                style="background-color: #3b5998"
                href="#!"
                role="button"
              >
                <i class="fa fa-facebook-f me-2"></i> Continue with Facebook
              </a>
              <a
                class="btn btn-primary btn-lg btn-block"
                style="background-color: red"
                href="#!"
                role="button"
              >
                <i class="fa fa-google me-2"></i> Continue with Google</a
              >
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
import { mapActions, mapGetters } from "vuex";
export default {
  data() {
    return {
      users: [],
      user: {
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
      },
      showError: false,
    };
  },
  computed: {
    ...mapGetters({ errors: "getError" }),
  },
  methods: {
    ...mapActions(["register"]),
    userRegister: function () {
      let data = {
        name: this.user.name,
        email: this.user.email,
        password: this.user.password,
        password_confirmation: this.user.password_confirmation,
      };
      this.$store
        .dispatch("register", data)
        .then(() => this.$router.push("/"))
        .catch((err) => {
          this.showError = true;
        });
    },
  },
};
</script>