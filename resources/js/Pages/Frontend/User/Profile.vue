<template>
  <FrontendMain>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Account Details
      </h2>
    </template>
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Profile Details</h5>
      </div>
      <div class="modal-body">
        <form @submit.prevent="updateUser">
          <!-- name -->
          <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right"
              >Name*</label
            >

            <div class="col-md-6">
              <input
                id="name"
                type="text"
                class="form-control"
                :class="{ 'is-invalid': updateUserform.errors.has('name') }"
                name="name"
                v-model="updateUserform.name"
                required
                autocomplete="name"
                autofocus
              />

              <has-error :form="updateUserform" field="name"></has-error>
            </div>
          </div>

          <!-- email -->
          <!-- <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right"
              >E-Mail Address*</label
            >

            <div class="col-md-6">
              <input
                id="email"
                type="email"
                class="form-control"
                :class="{ 'is-invalid': updateUserform.errors.has('email') }"
                name="email"
                v-model="updateUserform.email"
                required
                autocomplete="email"
              />

              <has-error :form="updateUserform" field="email"></has-error>
            </div>
          </div> -->

          <!-- address -->
          <div class="form-group row">
            <label for="address" class="col-md-4 col-form-label text-md-right"
              >Address*</label
            >

            <div class="col-md-6">
              <input
                id="address"
                type="text"
                class="form-control"
                :class="{ 'is-invalid': updateUserform.errors.has('address') }"
                name="address"
                v-model="updateUserform.address"
                required
                autocomplete="address"
              />

              <has-error :form="updateUserform" field="address"></has-error>
            </div>
          </div>

          <!-- state -->
          <div class="form-group row">
            <label for="state" class="col-md-4 col-form-label text-md-right"
              >State</label
            >

            <div class="col-md-6">
              <input
                id="state"
                type="text"
                class="form-control"
                :class="{ 'is-invalid': updateUserform.errors.has('state') }"
                name="state"
                v-model="updateUserform.state"
                autocomplete="state"
              />

              <has-error :form="updateUserform" field="state"></has-error>
            </div>
          </div>

          <!-- country -->
          <div class="form-group row">
            <label for="country" class="col-md-4 col-form-label text-md-right"
              >Country*</label
            >

            <div class="col-md-6">
              <country-select
                class="form-control"
                :class="{ 'is-invalid': updateUserform.errors.has('country') }"
                id="country"
                name="country"
                required
                v-model="updateUserform.country"
                :country="updateUserform.country"
                :countryName="true"
                topCountry="Pakistan"
              />

              <has-error :form="updateUserform" field="country"></has-error>
            </div>
          </div>

          <!-- phone number -->
          <div class="form-group row">
            <label
              for="phone_number"
              class="col-md-4 col-form-label text-md-right"
              >Phone Number</label
            >

            <div class="col-md-6">
              <input
                id="phone_number"
                type="text"
                class="form-control"
                :class="{
                  'is-invalid': updateUserform.errors.has('phone_number'),
                }"
                name="phone_number"
                v-model="updateUserform.phone_number"
                autocomplete="phone_number"
              />

              <has-error
                :form="updateUserform"
                field="phone_number"
              ></has-error>
            </div>
          </div>

          <!-- logo -->
          <div class="form-group row">
            <label for="logo" class="col-md-4 col-form-label text-md-right"
              >Logo</label
            >

            <div class="col-md-6">
              <div class="w-75 d-inline-block">
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
              <div class="d-inline-block" style="width: 100px; height: 50px">
                <img
                  :src="updateUserform.logo_url"
                  style="object-fit: cover"
                  class="h-100"
                />
              </div>
            </div>
          </div>

          <!-- notes -->
          <div class="form-group row">
            <label for="notes" class="col-md-4 col-form-label text-md-right"
              >Default Notes</label
            >

            <div class="col-md-6">
              <textarea
                id="notes"
                type="text"
                class="form-control"
                :class="{
                  'is-invalid': updateUserform.errors.has('notes'),
                }"
                name="notes"
                v-model="updateUserform.notes"
                autocomplete="notes"
              ></textarea>

              <has-error :form="updateUserform" field="notes"></has-error>
            </div>
          </div>

          <!-- submit -->
          <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
              <button
                type="submit"
                :disabled="updateUserform.busy"
                class="btn btn-info lift"
              >
                Update
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </FrontendMain>
</template>

<script>
import { Form } from "vform";
export default {
  data() {
    return {
      updateUserform: new Form({
        username: "",
        name: "",
        email: "",
        address: "",
        state: "",
        country: "",
        phone_number: "",
        logo: "",
        notes: "",
      }),
      country: "",
      logoImage: [],
    };
  },
  beforeMount() {
    this.updateUserDataLocally(this.$page.user);
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
              this.updateUserform.logo = newFile.response.data;
              this.completeUpdateUser(); // here this will continue after file upload
            }
          }
        }
      }
    },
    updateUser() {
      if (this.logoImage.length > 0) {
        this.$refs.upload.active = true; // this will trigger file upload and then will continue registration process
      } else {
        this.completeUpdateUser();
      }
    },
    completeUpdateUser() {
      this.updateUserform
        .put("/user")
        .then((res) => {
          this.updateUserDataLocally(res.data.data);
        })
        .catch((err) => {
          if (err) {
            this.$notify({
              group: "app",
              type: "error",
              title: "Request Faild",
              text: err.message,
              duration: 5000,
              speed: 1000,
              closeOnClick: true,
            });
          }
        });
    },
    updateUserDataLocally(user) {
      if (user) {
        this.updateUserform.username = user.username;
        this.updateUserform.name = user.name;
        this.updateUserform.email = user.email;
        this.updateUserform.address = user.address;
        this.updateUserform.state = user.state;
        this.updateUserform.country = user.country;
        this.updateUserform.phone_number = user.phone_number;
        this.updateUserform.logo = user.logo;
        this.updateUserform.logo_url = user.logo_url;
        this.updateUserform.notes = user.notes;
      }
    },
  },
};
</script>

<style>
</style>