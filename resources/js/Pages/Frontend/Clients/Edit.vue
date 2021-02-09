<template>
  <FrontendMain>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Client Details
      </h2>
    </template>
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Client Details</h5>
      </div>
      <div class="modal-body">
        <form @submit.prevent="updateClient">
          <!-- company -->
          <div class="form-group row">
            <label for="company" class="col-md-4 col-form-label text-md-right"
              >Company Name*</label
            >

            <div class="col-md-6">
              <input
                id="company"
                type="text"
                class="form-control"
                :class="{
                  'is-invalid': updateClientform.errors.has('company'),
                }"
                name="company"
                v-model="updateClientform.company"
                required
                autocomplete="company"
                autofocus
              />

              <has-error :form="updateClientform" field="company"></has-error>
            </div>
          </div>

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
                :class="{
                  'is-invalid': updateClientform.errors.has('address'),
                }"
                name="address"
                v-model="updateClientform.address"
                required
                autocomplete="address"
              />

              <has-error :form="updateClientform" field="address"></has-error>
            </div>
          </div>

          <!-- zipcode -->
          <div class="form-group row">
            <label for="zipcode" class="col-md-4 col-form-label text-md-right"
              >Zip Code*</label
            >

            <div class="col-md-6">
              <input
                id="zipcode"
                type="text"
                class="form-control"
                :class="{
                  'is-invalid': updateClientform.errors.has('zipcode'),
                }"
                name="zipcode"
                v-model="updateClientform.zipcode"
                required
                autocomplete="zipcode"
              />

              <has-error :form="updateClientform" field="zipcode"></has-error>
            </div>
          </div>

          <!-- city -->
          <div class="form-group row">
            <label for="city" class="col-md-4 col-form-label text-md-right"
              >City*</label
            >

            <div class="col-md-6">
              <input
                id="city"
                type="text"
                class="form-control"
                :class="{ 'is-invalid': updateClientform.errors.has('city') }"
                name="city"
                v-model="updateClientform.city"
                required
                autocomplete="city"
              />

              <has-error :form="updateClientform" field="city"></has-error>
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
                :class="{
                  'is-invalid': updateClientform.errors.has('country'),
                }"
                id="country"
                name="country"
                required
                v-model="updateClientform.country"
                :country="updateClientform.country"
                :countryName="true"
                topCountry="Pakistan"
              />

              <has-error :form="updateClientform" field="country"></has-error>
            </div>
          </div>

          <!-- name -->
          <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right"
              >Contact Full Name*</label
            >

            <div class="col-md-6">
              <input
                id="name"
                type="text"
                class="form-control"
                :class="{ 'is-invalid': updateClientform.errors.has('name') }"
                name="name"
                v-model="updateClientform.name"
                required
                autocomplete="name"
              />

              <has-error :form="updateClientform" field="name"></has-error>
            </div>
          </div>

          <!-- email -->
          <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right"
              >E-Mail Address</label
            >

            <div class="col-md-6">
              <input
                id="email"
                type="email"
                class="form-control"
                :class="{ 'is-invalid': updateClientform.errors.has('email') }"
                name="email"
                v-model="updateClientform.email"
                autocomplete="email"
              />

              <has-error :form="updateClientform" field="email"></has-error>
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
                  'is-invalid': updateClientform.errors.has(
                    'company_registration_number'
                  ),
                }"
                name="company_registration_number"
                v-model="updateClientform.company_registration_number"
                autocomplete="company_registration_number"
              />

              <has-error
                :form="updateClientform"
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
                  'is-invalid': updateClientform.errors.has('vat_number'),
                }"
                name="vat_number"
                v-model="updateClientform.vat_number"
                autocomplete="vat_number"
              />

              <has-error
                :form="updateClientform"
                field="vat_number"
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
                  'is-invalid': updateClientform.errors.has('default_currency'),
                }"
                v-model="updateClientform.default_currency"
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
                :form="updateClientform"
                field="default_currency"
              ></has-error>
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
                  'is-invalid': updateClientform.errors.has('notes'),
                }"
                name="notes"
                v-model="updateClientform.notes"
                autocomplete="notes"
              ></textarea>

              <has-error :form="updateClientform" field="notes"></has-error>
            </div>
          </div>

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
                class="form-control"
                :class="{
                  'is-invalid': updateClientform.errors.has('bank_details'),
                }"
                name="bank_details"
                v-model="updateClientform.bank_details"
                autocomplete="bank_details"
              ></textarea>

              <has-error
                :form="updateClientform"
                field="bank_details"
              ></has-error>
            </div>
          </div>

          <!-- submit -->
          <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
              <button
                type="submit"
                :disabled="updateClientform.busy"
                class="btn btn-info lift"
              >
                Update
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- state -->
    <!-- <div class="form-group row">
            <label for="state" class="col-md-4 col-form-label text-md-right"
              >State</label
            >

            <div class="col-md-6">
              <input
                id="state"
                type="text"
                class="form-control"
                :class="{ 'is-invalid': updateClientform.errors.has('state') }"
                name="state"
                v-model="updateClientform.state"
                autocomplete="state"
              />

              <has-error :form="updateClientform" field="state"></has-error>
            </div>
          </div> -->

    <!-- logo -->
    <!-- <div class="form-group row">
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
                  :src="updateClientform.logo_url"
                  style="object-fit: cover"
                  class="h-100"
                />
              </div>
            </div>
          </div> -->

    <!-- phone number -->
    <!-- <div class="form-group row">
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
                  'is-invalid': updateClientform.errors.has('phone_number'),
                }"
                name="phone_number"
                v-model="updateClientform.phone_number"
                autocomplete="phone_number"
              />

              <has-error
                :form="updateClientform"
                field="phone_number"
              ></has-error>
            </div>
          </div> -->
  </FrontendMain>
</template>

<script>
import { Form } from "vform";
export default {
  props: ["client"],
  data() {
    return {
      updateClientform: new Form({
        username: "",
        name: "",
        email: "",
        address: "",
        state: "",
        country: "",
        phone_number: "",
        notes: "",
        company: "",
        company_registration_number: "",
        city: "",
        zipcode: "",
        vat_number: "",
        default_currency: "",
        bank_details: "",
      }),
      country: "",
      logoImage: [],
      currencies: ["USD", "EUR", "GBP", "YEN", "INR", "IDR"],
    };
  },
  beforeMount() {
    this.updateClientDataLocally(this.client);
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
              this.updateClientform.logo = newFile.response.data;
              this.completeUpdateClient(); // here this will continue after file upload
            }
          }
        }
      }
    },
    updateClient() {
      if (this.logoImage.length > 0) {
        this.$refs.upload.active = true; // this will trigger file upload and then will continue registration process
      } else {
        this.completeUpdateClient();
      }
    },
    completeUpdateClient() {
      this.updateClientform
        .put("/clients/" + this.updateClientform.id)
        .then((res) => {
          this.updateClientDataLocally(res.data.data);
          this.$notify({
            group: "app",
            type: "success",
            title: "Request Successfull",
            text: "Client Updated Successfully",
            duration: 5000,
            speed: 1000,
            closeOnClick: true,
          });
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
    updateClientDataLocally(client) {
      if (client) {
        this.updateClientform.id = client.id;
        this.updateClientform.name = client.name;
        this.updateClientform.email = client.email;
        this.updateClientform.address = client.address;
        this.updateClientform.state = client.state;
        this.updateClientform.country = client.country;
        this.updateClientform.phone_number = client.phone_number;
        this.updateClientform.logo = client.logo;
        this.updateClientform.logo_url = client.logo_url;
        this.updateClientform.notes = client.notes;
        this.updateClientform.company = client.company;
        this.updateClientform.company_registration_number =
          client.company_registration_number;
        this.updateClientform.city = client.city;
        this.updateClientform.zipcode = client.zipcode;
        this.updateClientform.vat_number = client.vat_number;
        this.updateClientform.default_currency = client.default_currency;
        this.updateClientform.bank_details = client.bank_details;
      }
    },
  },
};
</script>

<style>
</style>