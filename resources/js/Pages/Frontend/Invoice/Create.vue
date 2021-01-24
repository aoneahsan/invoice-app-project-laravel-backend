<template>
  <FrontendMain>
    <template #header>
      <div class="row align-items-center">
        <div class="col">
          <!-- Pretitle -->
          <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-1">
            Payments
          </h2>
          <!-- Title -->
          <h1 class="header-title">Invoice #SDF9823KD</h1>
        </div>
        <div class="col-auto">
          <!-- Buttons -->
          <a href="#!" class="btn btn-white lift"> Download </a>
          <a href="#!" class="btn btn-primary ml-2 lift"> Save </a>
        </div>
      </div>
    </template>
    <div class="col-12 pt-12">
      <div class="container">
        <div class="row">
          <div class="col-12" v-if="!$page.user">
            <div class="alert alert-primary" role="alert">
              <strong>Kindly Login first before continue.</strong>
            </div>
          </div>
          <div class="col-11 col-lg-10 col-xl-10 mx-auto">
            <!-- Header -->
            <!-- Content -->
            <div class="card card-body p-5">
              <div class="row">
                <div class="col-12 col-md-6">
                  <div
                    class="mt-2 mb-4 overlay profile-pic"
                    style="line-height: 25px"
                  >
                    <input
                      v-model="invoiceForm.user.name"
                      name="invoice_user_name"
                    /><br />
                    <input
                      v-model="invoiceForm.user.address"
                      name="invoice_user_address"
                    />
                    <br />
                    <input
                      v-model="invoiceForm.user.state"
                      name="invoice_user_state"
                    />,
                    <input
                      v-model="invoiceForm.user.country"
                      name="invoice_user_country"
                    /><br />
                    <input
                      v-model="invoiceForm.user.email"
                      name="invoice_user_email"
                    />
                    <br />
                    <input
                      v-model="invoiceForm.user.phone_number"
                      name="invoice_user_phone_number"
                    /><br />
                    <div
                      class="edit mt-3"
                      data-toggle="modal"
                      data-target="#useredit"
                      data-whatever="@mdo"
                      data-placement="bottom"
                      title="Edit This"
                    >
                      <v-icon name="edit"></v-icon>
                    </div>
                  </div>
                  <p class="text-muted mt-5">Bill To:</p>
                  <div class="clickable">
                    <div
                      class="ml-3 my-2"
                      data-toggle="modal"
                      data-target="#exampleModal"
                    >
                      <a v-if="invoiceForm.client.id" class="nav-link active">
                        {{ invoiceForm.client.id.name }}
                        <br />
                        {{ invoiceForm.client.id.email }} <br />
                        {{ invoiceForm.client.id.address }} <br />
                        {{ invoiceForm.client.id.country }}
                      </a>

                      <a
                        class="nav-link active"
                        v-if="!invoiceForm.client.id"
                        @click="openClientListModal"
                      >
                        <i class="fe fe-user ml-2"> </i>
                        Add Client
                      </a>
                    </div>
                  </div>
                </div>
                <!-- above this -->
                <div class="col-12 col-md-6 text-md-right">
                  <div>
                    <label for="upload-photo">
                      <img
                        class="image rounded-circle ml-8"
                        v-bind:src="invoiceForm.user.logo"
                        alt=""
                        width="200px"
                      />
                      <form enctype="multipart/form-data">
                        <input
                          type="file"
                          id="upload-photo"
                          name="pic"
                          class="hidden"
                          @change="updateAvatar"
                        />
                      </form>
                    </label>
                  </div>

                  <div class="mr-4">
                    <h1 class="invoice">Invoice</h1>
                    <div class="d-flex mb-3 justify-content-end">
                      <span class="text-muted mr-2">Invoice no:</span>
                      <input
                        type="text"
                        class="form-control form-control-sm w-auto"
                        v-model="invoiceForm.invoice_no"
                        readonly
                      />
                    </div>
                    <div class="d-flex mb-3 justify-content-end">
                      <span class="text-muted mr-2">Date:</span>
                      <input
                        type="date"
                        class="form-control form-control-sm w-auto"
                        v-model="invoiceForm.date"
                      />
                    </div>
                    <div class="d-flex mb-3 justify-content-end">
                      <span class="text-muted mr-2">Due Date:</span>
                      <input
                        type="date"
                        class="form-control form-control-sm w-auto"
                        v-model="invoiceForm.due_date"
                      />
                    </div>
                    <br />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <!-- Table -->
                  <div class="table-responsive">
                    <table class="table my-4">
                      <thead class="tablehead">
                        <tr>
                          <th class="bg-transparent border-top-0">
                            <span class="h6">Item & Description</span>
                          </th>
                          <th class="bg-transparent border-top-0">
                            <span class="h6">Quantity</span>
                          </th>
                          <th class="bg-transparent border-top-0">
                            <span class="h6">Rate</span>
                          </th>
                          <th class="bg-transparent border-top-0">
                            <span class="h6">Amount</span>
                          </th>
                          <th class="bg-transparent border-top-0 text-right">
                            <span class="h6"></span>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr
                          v-for="(item, index) in invoiceForm.items"
                          :key="index"
                        >
                          <td class="td w-50">
                            <input
                              class="form-control form-control-sm"
                              type="text"
                              v-model="item.item_detail"
                            />
                          </td>
                          <td class="td">
                            <input
                              type="number"
                              class="form-control form-control-sm"
                              v-model.number="item.qty"
                            />
                          </td>
                          <td class="td">
                            <input
                              type="number"
                              class="form-control form-control-sm"
                              v-model.number="item.rate"
                            />
                          </td>
                          <td class="td text-right">
                            {{ item.qty * item.rate }}
                          </td>
                          <td class="td">
                            <button
                              @click="deleteRow(index)"
                              class="btn-rounded-circle badge-danger"
                            >
                              <v-icon name="times"></v-icon>
                            </button>
                          </td>
                        </tr>
                        <tr>
                          <td class="dddd">
                            <button
                              @click="addRow()"
                              class="btn-rounded-circle badge-primary"
                            >
                              <v-icon name="plus"></v-icon>
                            </button>
                            <span @click="addRow()" class="text-primary ml-2">
                              <a href="javascript:void(0)">
                                Add a line item</a
                              ></span
                            >
                          </td>
                          <td class=""></td>
                          <td class=""></td>
                          <td class="text-right"></td>
                        </tr>
                        <tr>
                          <td colspan="2" class="text-right">
                            <strong>Subtotal</strong>
                          </td>
                          <td colspan="3" class="text-right">
                            <span class="">
                              {{ calculateSubtotal() }}
                            </span>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2" class="text-right">
                            <strong>VAT (10%)</strong>
                          </td>
                          <td colspan="3" class="text-right border-bottom">
                            <span class="">
                              <input
                                type="number"
                                class="form-control form-control-sm"
                                v-model.number="invoiceForm.discount"
                              />
                            </span>
                          </td>
                        </tr>

                        <tr>
                          <td colspan="2" class="text-right">
                            <strong
                              data-toggle="modal"
                              data-target="#exampleModalCurrency"
                              style="cursor: pointer"
                              >TOTAL ({{
                                invoiceForm.selected_currency
                              }})</strong
                            >
                          </td>
                          <td colspan="3" class="text-right border-bottom">
                            <span class="">
                              {{ calculateTotal() }}
                            </span>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <hr class="my-5" />
                  <!-- Title -->
                  <h6 class="text-uppercase">Notes</h6>

                  <!-- Text -->
                  <p class="text-muted mb-0">
                    We really appreciate your business and if there’s anything
                    else we can do, please let us know! Also, should you need us
                    to add VAT or anything else to this order, it’s super easy
                    since this is a template, so just ask!
                  </p>
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
      invoiceForm: new Form({
        user: {
          id: "USER_ID",
          name: "USER_NAME",
          email: "USER_EMAIL",
          phone_number: "USER_NUMBER",
          state: "USER_STATE",
          company: "USER_COMPANY",
          country: "USER_COUNTRY",
          address: "USER_ADDRESS",
          logo: "/images/sitelogo.jpeg",
        },
        client: {
          id: null,
          name: "",
          email: "",
          phone_number: "",
          address: "",
          logo: "",
        },
        items: [
          {
            item_detail: "",
            qty: 1,
            rate: 0,
          },
        ],
        date: new Date(),
        due_date: new Date(),
        invoice_no: "############",
        selected_currency: "USD",
        discount: 0,
        sub_total: "",
        total: "",
      }),
      currency: [{ name: "USD" }, { name: "EUR" }, { name: "ALL" }],
    };
  },
  beforeMount() {
    if (this.$page.user) {
      this.invoiceForm.user.id = this.$page.user.id;
      this.invoiceForm.user.name = this.$page.user.name;
      this.invoiceForm.user.email = this.$page.user.email;
      this.invoiceForm.user.address = this.$page.user.address;
      this.invoiceForm.user.state = this.$page.user.state;
      this.invoiceForm.user.country = this.$page.user.country;
      this.invoiceForm.user.company = this.$page.user.company;
      this.invoiceForm.user.state = this.$page.user.state;
    }
  },
  methods: {
    openClientListModal() {
      if (this.$page.user) {
        this.$modal.show("ClientsListModal");
      } else {
        this.$inertia.visit("/sign-in");
      }
    },
    addRow: function () {
      this.invoiceForm.items.push({
        item_detail: "",
        qty: 1,
        rate: 0,
      });
    },
    deleteRow(index) {
      console.log(index);
      this.$delete(this.invoiceForm.items, index);
    },
    calculateSubtotal: function () {
      let subtotal = 0;
      this.invoiceForm.items.forEach((val) => {
        subtotal += val.qty * val.rate;
      });
      this.subtotal = subtotal;
      this.invoiceForm.sub_total = subtotal;
      return subtotal;
    },
    calculateTotal: function () {
      let total = 0;
      total = this.subtotal - this.subtotal * (this.invoiceForm.discount / 100);
      this.invoiceForm.total = total;
      return total;
    },

    // below methods are from amir code (rewrite or delete these methods)
    addCurrency: function (index) {
      console.log(index);
      this.invoiceForm.selected_currency = this.currency[index].name;
    },
    addClient: function (index) {
      console.log(index);
      this.invoiceForm.client.id = this.clients[index];
      console.log(this.invoiceForm.client.id);
      this.invoiceForm.client_id = this.invoiceForm.client.id.id;
    },
    createInvoice() {
      if (this.invoiceForm.items.length) {
        if (this.invoiceForm.client_id) {
          this.invoiceForm.post("/create-invoice").then(({ data }) => {
            console.log(data);
          });
        } else {
        }
      } else {
      }
    },
    updateAvatar: function (e) {
      const file = e.target.files[0];
      this.pic = file;
      const config = {
        headers: { "content-type": "multipart/form-data" },
      };
      console.log(config);
      const data = new FormData();
      data.append("logo", this.pic);
      data.append("name", this.invoiceForm.user.name);
      data.append("email", this.invoiceForm.user.email);
      data.append("address", this.invoiceForm.user.address);
      data.append("state", this.invoiceForm.user.state);
      data.append("country", this.invoiceForm.user.country);
      data.append("phone", this.invoiceForm.user.phone);
      const t = this;
      axios.post("/update-user", data, config).then(function (response) {
        t.invoiceForm.user = response.data;
      });
    },
  },
};
</script>

<style>
.invoice {
  font-style: normal;
  font-weight: normal;
  font-size: 48px;
  line-height: 56px;
  align-items: center;
  text-align: right;
  color: #3c445f;
}
.form-control-sm {
  border-style: dashed !important;
}
.clickable {
  background: #ffffff;
  border: 1px dashed #a4a8b7;
  box-sizing: border-box;
  border-radius: 8px;
  cursor: pointer;
}

.addrow {
  cursor: pointer;
}

.tablehead {
  background: #f4f4f4;
}

.h6 {
  color: #3c445f;
}

.td {
  cursor: pointer;
}

.svg-icon {
  width: 20px;
}
.btn-rounded-circle {
  width: 39px;
  height: 39px;
  border: 1px;
}
input {
  width: max-content;
}
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type="number"] {
  -moz-appearance: textfield;
}

.profile-pic {
  position: relative;
  display: inline-block;
}

.profile-pic:hover .edit {
  display: block;
}

.edit {
  padding-top: 7px;
  padding-right: 7px;
  position: absolute;
  right: 0;
  top: 0;
  display: none;
}

.edit a {
  color: #000;
}
.select-client {
  cursor: pointer;
}
label {
  cursor: pointer;
}

#upload-photo {
  opacity: 0;
  position: absolute;
  z-index: -1;
}
</style>

