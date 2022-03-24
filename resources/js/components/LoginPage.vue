<template>
  <div class="container">
    <section class="vh-100">
      <div class="container py-5 h-100">
        <div class="row d-flex align-items-center justify-content-center h-100">
          <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
            <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign in</p>
            <p v-if="showError" class="text-danger">Email or Password incorrect</p>
            <form @submit.prevent="userLogin">
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

              <div
                class="d-flex justify-content-around align-items-center mb-4"
              >
                <!-- Checkbox -->
                <div class="form-check">
                  <input
                    class="form-check-input"
                    type="checkbox"
                    value=""
                    id="form1Example3"
                    checked
                  />
                  <label class="form-check-label" for="form1Example3">
                    Remember me
                  </label>
                </div>
                <router-link to="/register">Don't have account?</router-link>
              </div>

              <!-- Submit button -->
              <button type="submit" class="btn btn-info btn-lg btn-block">
                Sign in
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
import { mapGetters,mapActions } from 'vuex';
export default {
  name: 'Login',
  data () {
      return {
          users: [],
          user: {
              email: "",
              password: "",
          },
          showError: false,
      }
  },
  computed: {
    ...mapGetters({ errors: "getError" }),
  },
  methods: {
    ...mapActions(['login']),
    userLogin: function(){
      this.$store.dispatch('login', this.user)
        .then(() => this.$router.push('/'))
        .catch(err => this.showError = true)
    } 
  }
};
</script>
