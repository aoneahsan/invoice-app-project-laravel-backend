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

          <div class="form-group row">
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
          </div>

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

          <div class="form-group row">
            <label for="logo" class="col-md-4 col-form-label text-md-right"
              >Logo</label
            >

            <div class="col-md-6">
              <input
                id="logo"
                type="file"
                class="form-control"
                :class="{ 'is-invalid': updateUserform.errors.has('logo') }"
                name="logo"
                autocomplete="logo"
              />

              <has-error :form="updateUserform" field="logo"></has-error>
            </div>
          </div>

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
      }),
      country: "",
    };
  },
  beforeMount() {
    this.updateUserDataLocally(this.$page.user);
  },
  methods: {
    updateUser() {
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
    updateUserDataLocally(data) {
      if (data) {
        this.updateUserform.username = data.username;
        this.updateUserform.name = data.name;
        this.updateUserform.email = data.email;
        this.updateUserform.address = data.address;
        this.updateUserform.state = data.state;
        this.updateUserform.country = data.country;
        this.updateUserform.phone_number = data.phone_number;
        this.updateUserform.logo = data.logo;
      }
    },
  },
};
</script>

<style>
</style>