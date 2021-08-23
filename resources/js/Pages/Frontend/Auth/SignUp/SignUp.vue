<template>
  <FrontendMain>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Register
      </h2>
    </template>
    <div class="pt-12 container-fluid">
      <div class="row justify-content-center">
        <div class="col-12 col-md-12 col-xl-10">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <form
                    @submit.prevent="register()"
                    enctype="multipart/form-data"
                  >
                    <!-- company -->
                    <div class="form-group row">
                      <label
                        for="company"
                        class="col-md-4 col-form-label text-md-right"
                        >Company Name*</label
                      >

                      <div class="col-md-6">
                        <input
                          id="company"
                          type="text"
                          class="form-control"
                          :class="{ 'is-invalid': form.errors.has('company') }"
                          name="company"
                          v-model="form.company"
                          required
                          autocomplete="company"
                          autofocus
                        />

                        <has-error :form="form" field="company"></has-error>
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

                    <!-- zipcode -->
                    <div class="form-group row">
                      <label
                        for="zipcode"
                        class="col-md-4 col-form-label text-md-right"
                        >Zip Code*</label
                      >

                      <div class="col-md-6">
                        <input
                          id="zipcode"
                          type="text"
                          class="form-control"
                          :class="{ 'is-invalid': form.errors.has('zipcode') }"
                          name="zipcode"
                          v-model="form.zipcode"
                          required
                          autocomplete="zipcode"
                        />

                        <has-error :form="form" field="zipcode"></has-error>
                      </div>
                    </div>

                    <!-- city -->
                    <div class="form-group row">
                      <label
                        for="city"
                        class="col-md-4 col-form-label text-md-right"
                        >City*</label
                      >

                      <div class="col-md-6">
                        <input
                          id="city"
                          type="text"
                          class="form-control"
                          :class="{ 'is-invalid': form.errors.has('city') }"
                          name="city"
                          v-model="form.city"
                          required
                          autocomplete="city"
                        />

                        <has-error :form="form" field="city"></has-error>
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
                        />

                        <has-error :form="form" field="country"></has-error>
                      </div>
                    </div>

                    <!-- name -->
                    <div class="form-group row">
                      <label
                        for="name"
                        class="col-md-4 col-form-label text-md-right"
                        >Full Name</label
                      >

                      <div class="col-md-6">
                        <input
                          id="name"
                          type="text"
                          class="form-control"
                          :class="{ 'is-invalid': form.errors.has('name') }"
                          name="name"
                          v-model="form.name"
                          autocomplete="name"
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

                    <!-- company_registration_number -->
                    <div class="form-group row">
                      <label
                        for="company_registration_number"
                        class="col-md-4 col-form-label text-md-right"
                        >Company Registration Number</label
                      >

                      <div class="col-md-6">
                        <input
                          id="company_registration_number"
                          type="text"
                          class="form-control"
                          :class="{
                            'is-invalid': form.errors.has(
                              'company_registration_number'
                            ),
                          }"
                          name="company_registration_number"
                          v-model="form.company_registration_number"
                          autocomplete="company_registration_number"
                        />

                        <has-error
                          :form="form"
                          field="company_registration_number"
                        ></has-error>
                      </div>
                    </div>

                    <!-- vat_number -->
                    <div class="form-group row">
                      <label
                        for="vat_number"
                        class="col-md-4 col-form-label text-md-right"
                        >VAT Number</label
                      >

                      <div class="col-md-6">
                        <input
                          id="vat_number"
                          type="text"
                          class="form-control"
                          :class="{
                            'is-invalid': form.errors.has('vat_number'),
                          }"
                          name="vat_number"
                          v-model="form.vat_number"
                          autocomplete="vat_number"
                        />

                        <has-error :form="form" field="vat_number"></has-error>
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

                    <!-- default_currency -->
                    <div class="form-group row">
                      <label
                        for="default_currency"
                        class="col-md-4 col-form-label text-md-right"
                        >Default Currency</label
                      >

                      <div class="col-md-6">
                        <select
                          id="default_currency"
                          class="form-control"
                          :class="{
                            'is-invalid': form.errors.has('default_currency'),
                          }"
                          v-model="form.default_currency"
                        >
                          <option value="">Select Currency</option>
                          <option
                            v-for="(item, index) in currencies"
                            :key="index"
                            :value="item"
                          >
                            {{ item }}
                          </option>
                        </select>

                        <has-error
                          :form="form"
                          field="default_currency"
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
                        <div class="row">
                          <div class="col-7">
                            <file-upload
                              input-id="invoiceUserLogo"
                              input-name="invoiceUserLogo"
                              ref="upload"
                              post-action="/upload-files"
                              accept="image/*"
                              @input-file="inputFile"
                              :drop="true"
                              v-model="logoImage"
                              @input="updatetImageFunction"
                              @input-filter="imageFilterFunction"
                              :multiple="false"
                              ><button
                                type="button"
                                class="btn btn-primary lift"
                              >
                                Upload Company Logo
                              </button>
                            </file-upload>
                          </div>
                          <div class="col-5">
                            <div
                              class="d-inline-block"
                              style="width: 100px; height: 50px"
                            >
                              <img
                                :src="logo_url"
                                style="object-fit: cover"
                                class="h-100"
                              />
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- notes -->
                    <!-- <div class="form-group row">
                      <label
                        for="notes"
                        class="col-md-4 col-form-label text-md-right"
                        >Default Notes</label
                      >

                      <div class="col-md-6">
                        <textarea
                          id="notes"
                          type="text"
                          class="form-control js-autoresize"
                          :class="{
                            'is-invalid': form.errors.has('notes'),
                          }"
                          name="notes"
                          v-model="form.notes"
                          autocomplete="notes"
                        ></textarea>

                        <has-error :form="form" field="notes"></has-error>
                      </div>
                    </div> -->

                    <!-- bank_details -->
                    <div class="form-group row">
                      <label
                        for="bank_details"
                        class="col-md-4 col-form-label text-md-right"
                        >Bank Details</label
                      >

                      <div class="col-md-6">
                        <textarea
                          id="bank_details"
                          type="text"
                          class="form-control js-autoresize"
                          :class="{
                            'is-invalid': form.errors.has('bank_details'),
                          }"
                          name="bank_details"
                          v-model="form.bank_details"
                          autocomplete="bank_details"
                        ></textarea>

                        <has-error
                          :form="form"
                          field="bank_details"
                        ></has-error>
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
                    <div class="mb-0 form-group row">
                      <div class="col-md-6 offset-md-4">
                        <button
                          type="submit"
                          :disabled="form.busy || accountCreated"
                          class="btn btn-primary"
                        >
                          Register
                        </button>
                        or
                        <inertia-link
                          v-if="!accountCreated"
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

import {setResizeListeners} from "./../../../../utils/auto-resize";
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
        company: "",
        company_registration_number: "",
        city: "",
        zipcode: "",
        vat_number: "",
        default_currency: "",
        password: "",
        password_confirmation: "",
        bank_details: "",
        notes: "",
      }),
      logo_url: null,
      logoImage: [],
      currencies: ["USD", "EUR", "GBP", "YEN", "INR", "IDR"],
      accountCreated: false,
    };
  },
  mounted() {
    setResizeListeners(this.$el, ".js-autoresize");
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
    imageFilterFunction(newFile, oldFile, prevent) {
      if (newFile && !oldFile) {
        if (!/\.(jpeg|jpe|jpg|gif|png|webp)$/i.test(newFile.name)) {
          return prevent();
        }
        newFile.blob = "";
        let URL = window.URL || window.webkitURL;
        if (URL && URL.createObjectURL) {
          newFile.blob = URL.createObjectURL(newFile.file);
        }
      }

      if (newFile && oldFile) {
        if (!newFile.version) {
          newFile.version = 0;
        }
        newFile.version++;
      }

      if (!newFile && oldFile) {
      }
    },
    updatetImageFunction(value) {
      this.logoImage = value;
      console.log();
      if (this.logoImage[0]) {
        this.logo_url = this.logoImage[0].blob;
      }
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
          this.$notify({
            group: "app",
            type: "success",
            title: "Request Successfull",
            text: "Signup Completed Successfully.",
            duration: 7000,
            speed: 1000,
          });
          setTimeout(() => {
            this.$inertia.visit("/user/profile");
          }, 1000);
        })
        .catch((err) => {
          window.scrollTo(0, 0);
          console.log("err = ", err.response);
          if (err.response.status == 422) {
            this.$notify({
              group: "app",
              type: "error",
              title: "Request Faild",
              text: "Provide correct data to continue.",
              duration: 7000,
              speed: 1000,
            });
          }
        });
    },
  },
};
</script>

<style>
</style>
