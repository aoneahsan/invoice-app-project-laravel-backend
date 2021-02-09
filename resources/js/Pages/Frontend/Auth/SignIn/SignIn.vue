<template>
  <FrontendMain>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Login</h2>
    </template>
    <div class="container-fluid pt-12">
      <div class="row justify-content-center">
        <div class="col-12 col-md-12 col-xl-10">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <form
                    @submit.prevent="login"
                    @keydown="form.onKeydown($event)"
                  >
                    <div class="form-group row">
                      <label
                        for="email"
                        class="col-md-4 col-form-label text-md-right"
                        >E-Mail Address</label
                      >

                      <div class="col-md-6">
                        <input
                          id="email"
                          type="email"
                          class="form-control"
                          :class="{ 'is-invalid': form.errors.has('email') }"
                          name="email"
                          v-model="form.email"
                          required
                          autocomplete="email"
                        />

                        <has-error :form="form" field="email"></has-error>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="password"
                        class="col-md-4 col-form-label text-md-right"
                        >Password</label
                      >

                      <div class="col-md-6">
                        <input
                          id="password"
                          type="password"
                          class="form-control"
                          :class="{ 'is-invalid': form.errors.has('password') }"
                          name="password"
                          v-model="form.password"
                          required
                          autocomplete="new-password"
                        />

                        <has-error :form="form" field="password"></has-error>
                      </div>
                    </div>

                    <div class="form-group row mb-0">
                      <div class="col-md-6 offset-md-4">
                        <button
                          type="submit"
                          :disabled="form.busy"
                          class="btn btn-primary"
                        >
                          Login
                        </button>
                        or
                        <inertia-link
                          :href="route('register.view')"
                          class="text-primary"
                          >register</inertia-link
                        >
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </FrontendMain>
</template>

<script>
import { Form } from "vform";
export default {
  data() {
    return {
      form: new Form({
        email: "",
        password: "",
      }),
    };
  },
  methods: {
    login() {
      // Submit the form via a POST request
      this.form
        .post("/sign-in")
        .then(({ data }) => {
          this.$inertia.visit("/user/profile");
        })
        .catch((err) => {
          if (err) {
            // this.$notify({
            //   group: "app",
            //   type: "error",
            //   title: "Request Faild",
            //   text: err.message,
            //   duration: 10000,
            //   speed: 1000,
            // });
          }
        });
    },
  },
};
</script>

<style>
</style>