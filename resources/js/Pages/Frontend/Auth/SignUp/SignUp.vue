<template>
  <FrontendMain>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Register
      </h2>
    </template>
    <div class="container-fluid pt-12">
      <div class="row justify-content-center">
        <div class="col-12 col-md-12 col-xl-10">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <form
                    @submit.prevent="register"
                    @keydown="form.onKeydown($event)"
                    enctype="multipart/form-data"
                  >
                    <!-- name -->
                    <div class="form-group row">
                      <label
                        for="name"
                        class="col-md-4 col-form-label text-md-right"
                        >Name*</label
                      >

                      <div class="col-md-6">
                        <input
                          id="name"
                          type="text"
                          class="form-control"
                          :class="{ 'is-invalid': form.errors.has('name') }"
                          name="name"
                          v-model="form.name"
                          required
                          autocomplete="name"
                          autofocus
                        />

                        <has-error :form="form" field="name"></has-error>
                      </div>
                    </div>
                    <!-- email -->
                    <div class="form-group row">
                      <label
                        for="email"
                        class="col-md-4 col-form-label text-md-right"
                        >E-Mail Address*</label
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
                    <!-- address -->
                    <div class="form-group row">
                      <label
                        for="address"
                        class="col-md-4 col-form-label text-md-right"
                        >Address*</label
                      >

                      <div class="col-md-6">
                        <input
                          id="address"
                          type="text"
                          class="form-control"
                          :class="{ 'is-invalid': form.errors.has('address') }"
                          name="address"
                          v-model="form.address"
                          required
                          autocomplete="address"
                        />

                        <has-error :form="form" field="address"></has-error>
                      </div>
                    </div>
                    <!-- state -->
                    <div class="form-group row">
                      <label
                        for="state"
                        class="col-md-4 col-form-label text-md-right"
                        >State</label
                      >

                      <div class="col-md-6">
                        <input
                          id="state"
                          type="text"
                          class="form-control"
                          :class="{ 'is-invalid': form.errors.has('state') }"
                          name="state"
                          v-model="form.state"
                          autocomplete="state"
                        />

                        <has-error :form="form" field="state"></has-error>
                      </div>
                    </div>
                    <!-- country -->
                    <div class="form-group row">
                      <label
                        for="country"
                        class="col-md-4 col-form-label text-md-right"
                        >Country*</label
                      >

                      <div class="col-md-6">
                        <!-- <input
                          id="country"
                          type="text"
                          class="form-control"
                          :class="{ 'is-invalid': form.errors.has('country') }"
                          name="country"
                          v-model="form.country"
                          required
                          autocomplete="country"
                        /> -->
                        <country-select
                          class="form-control"
                          :class="{
                            'is-invalid': form.errors.has('country'),
                          }"
                          id="country"
                          name="country"
                          required
                          v-model="form.country"
                          :country="form.country"
                          :countryName="true"
                          topCountry="Pakistan"
                        />

                        <has-error :form="form" field="country"></has-error>
                      </div>
                    </div>
                    <!-- phone -->
                    <div class="form-group row">
                      <label
                        for="phone_number"
                        class="col-md-4 col-form-label text-md-right"
                        >Phone</label
                      >

                      <div class="col-md-6">
                        <input
                          id="phone_number"
                          type="text"
                          class="form-control"
                          :class="{
                            'is-invalid': form.errors.has('phone_number'),
                          }"
                          name="phone_number"
                          v-model="form.phone_number"
                          autocomplete="phone_number"
                        />

                        <has-error
                          :form="form"
                          field="phone_number"
                        ></has-error>
                      </div>
                    </div>
                    <!-- logo -->
                    <div class="form-group row">
                      <label
                        for="logo"
                        class="col-md-4 col-form-label text-md-right"
                        >Logo</label
                      >

                      <div class="col-md-6">
                        <file-upload
                          input-id="invoiceUserLogo"
                          input-name="invoiceUserLogo"
                          ref="upload"
                          post-action="/upload-files"
                          accept="image/*"
                          extensions="jpg,gif,png,webp"
                          @input-file="inputFile"
                          :drop="true"
                          v-model="logoImage"
                          :multiple="false"
                          ><button type="button" class="btn btn-primary lift">
                            Upload Company Logo
                          </button>
                        </file-upload>
                      </div>
                    </div>
                    <!-- password -->
                    <div class="form-group row">
                      <label
                        for="password"
                        class="col-md-4 col-form-label text-md-right"
                        >Password*</label
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
                    <!-- confirm password -->
                    <div class="form-group row">
                      <label
                        for="password-confirm"
                        class="col-md-4 col-form-label text-md-right"
                        >Confirm Password*</label
                      >

                      <div class="col-md-6">
                        <input
                          id="password-confirm"
                          type="password"
                          class="form-control"
                          v-model="form.password_confirmation"
                          :class="{
                            'is-invalid': form.errors.has(
                              'password_confirmation'
                            ),
                          }"
                          name="password_confirmation"
                          required
                          autocomplete="new-password"
                        />
                        <has-error
                          :form="form"
                          field="password_confirmation"
                        ></has-error>
                      </div>
                    </div>
                    <!-- submit button -->
                    <div class="form-group row mb-0">
                      <div class="col-md-6 offset-md-4">
                        <button
                          type="submit"
                          :disabled="form.busy"
                          class="btn btn-primary"
                        >
                          Register
                        </button>
                        or
                        <inertia-link
                          :href="route('login.view')"
                          class="text-primary"
                          >login</inertia-link
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
import FrontendMain from "@/Layouts/FrontendMain";
import { Form } from "vform";
export default {
  components: {
    FrontendMain,
  },
  data() {
    return {
      form: new Form({
        username: "",
        name: "",
        email: "",
        address: "",
        state: "",
        country: "",
        phone_number: "",
        logo: "",
        password: "",
        password_confirmation: "",
      }),
      logoImage: [],
    };
  },
  methods: {
    // upload file
    inputFile: function (newFile, oldFile) {
      if (newFile && oldFile && !newFile.active && oldFile.active) {
        // Get response data
        console.log("response = ", newFile.response);
        if (newFile.xhr) {
          console.log("newFile.xhr.status = ", newFile.xhr.status);
          //  Get the response status code
          if (newFile.xhr.status == 200) {
            if (newFile.response.data) {
              this.form.logo = newFile.response.data;
              this.completeRegistration(); // here this will continue after file upload
            }
          }
        }
      }
    },
    uploadLogo(data) {
      console.log("data = ", data);
      console.log("this.logoImage = ", this.logoImage);
      console.log("this.$refs.upload = ", this.$refs.upload);
      this.$refs.upload.upload();
    },
    // register user
    register() {
      // Submit the form via a POST request
      // this.completeRegistration();
      if (this.logoImage.length > 0) {
        this.$refs.upload.active = true; // this will trigger file upload and then will continue registration process
      } else {
        this.completeRegistration();
      }
    },
    completeRegistration() {
      this.form
        .post("/sign-up")
        .then(({ data }) => {
          this.$inertia.visit("/createinvoice");
        })
        .catch((err) => {
          window.scrollTo(0, 0);
          console.log("err = ", err);
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