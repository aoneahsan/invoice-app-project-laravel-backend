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
          <h1 class="header-title" v-if="invoiceForm.invoice_no">
            Invoice#{{ invoiceForm.invoice_no }}
          </h1>
          <h1
            class="header-title"
            style="color: #bdbdbd"
            v-if="!invoiceForm.invoice_no"
          >
            Invoice no will generate once you select a client
          </h1>
        </div>
        <div class="col-auto" v-if="$page.user">
          <!-- Buttons -->
          <template v-if="invoiceForm.invoice_no">
            <button
              @click="toggleInvoiceToExpense('invoice')"
              v-if="invoiceForm.invoice_type == 'expense'"
              class="btn btn-success ml-2 lift"
            >
              Switch To Invoice
            </button>
            <button
              @click="toggleInvoiceToExpense('expense')"
              v-if="invoiceForm.invoice_type == 'invoice'"
              class="btn btn-danger ml-2 lift"
            >
              Switch To Expense
            </button>
          </template>
          <button @click="textResult()" class="btn btn-white ml-2 lift">
            test
          </button>
          <button @click="generateReport()" class="btn btn-white ml-2 lift">
            Generate Report
          </button>
          <button @click="downloadInvoice()" class="btn btn-white ml-2 lift">
            Download
          </button>
          <button @click="saveInvoice()" class="btn btn-primary ml-2 lift">
            Save
          </button>
        </div>
      </div>
    </template>
    <div class="col-12 pt-12">
      <div class="container">
        <div class="row">
          <!-- Alert for Login -->
          <div class="col-12" v-if="!$page.user">
            <div class="alert alert-primary text-center" role="alert">
              <strong
                >Kindly Login first before continue (no data will be saved
                otherwise)</strong
              >
            </div>
          </div>
          <!-- Invoice Setting -->

          <div class="col-11 col-lg-10 col-xl-10 mx-auto">
            <!-- Header -->
            <!-- Content -->
            <div class="card card-body p-5">
              <div class="row">
                <div class="col-12 col-md-6">
                  <div
                    class="mt-2 mb-4 overlay profile-pic"
                    style="line-height: 25px; max-width: 500px"
                  >
                    <span
                      contenteditable="true"
                      @blur="(event) => changeValue(event, 'user_name')"
                      v-html="invoiceForm.user.name"
                    ></span
                    ><br />
                    <span
                      contenteditable="true"
                      @blur="(event) => changeValue(event, 'user_address')"
                      v-html="invoiceForm.user.address"
                    ></span>
                    <br />
                    <span
                      contenteditable="true"
                      @blur="(event) => changeValue(event, 'user_state')"
                      v-html="invoiceForm.user.state"
                    ></span
                    >,
                    <span
                      contenteditable="true"
                      @blur="(event) => changeValue(event, 'user_country')"
                      v-html="invoiceForm.user.country"
                    ></span
                    ><br />
                    <span
                      contenteditable="true"
                      @blur="(event) => changeValue(event, 'user_email')"
                      v-html="invoiceForm.user.email"
                    ></span>
                    <br />
                    <span
                      contenteditable="true"
                      @blur="(event) => changeValue(event, 'user_phone_number')"
                      v-html="invoiceForm.user.phone_number"
                    ></span
                    ><br />
                    <div class="edit mt-3" title="Edit This">
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
                      <a
                        v-if="invoiceForm.client.id"
                        @click="openClientListModal"
                        class="nav-link active"
                      >
                        {{ invoiceForm.client.name }}
                        <br />
                        {{ invoiceForm.client.email }} <br />
                        {{ invoiceForm.client.address }} <br />
                        {{ invoiceForm.client.country }} <br />
                        {{ invoiceForm.client.phone_number }}
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
                  <div style="min-width: 200px; min-height: 200px">
                    <label for="upload-photo">
                      <v-icon
                        v-if="!hideInvoiceLogo"
                        name="trash"
                        @click="hideInvoiceLogo = true"
                        style="position: absolute; right: 0"
                      ></v-icon>
                      <v-icon
                        v-if="hideInvoiceLogo"
                        name="plus"
                        @click="hideInvoiceLogo = false"
                      ></v-icon>
                      <!-- input-id="invoiceUserLogo"
                        input-name="invoiceUserLogo" -->
                      <file-upload
                        ref="upload"
                        accept="image/*"
                        extensions="jpg,gif,png,webp"
                        v-model="invoiceLogo"
                        post-action="/upload-files"
                        @input-file="inputFile"
                        @input="updatetInvoiceLogo"
                        :drop="true"
                        :multiple="false"
                        :directory="false"
                        :drop-directory="false"
                        v-show="true"
                        @input-filter="invoiceLogoFilter"
                      >
                        <img
                          class="image rounded-circle ml-8"
                          v-bind:src="invoice_logo_url"
                          v-show="!hideInvoiceLogo"
                          alt="User Company Logo"
                          style="object-fit: cover; width: 200px; height: 200px"
                        />
                      </file-upload>
                    </label>
                  </div>

                  <div class="mr-4">
                    <h3 class="invoice mb-3">Invoice</h3>
                    <div
                      class="d-flex mb-3 justify-content-end"
                      v-if="invoiceForm.invoice_no"
                    >
                      <span class="text-muted mr-2">Invoice no:</span>
                      <span>{{ invoiceForm.invoice_no }}</span>
                    </div>
                    <div
                      class="d-flex mb-3 justify-content-end"
                      v-if="!invoiceForm.invoice_no"
                    >
                      <span class="text-muted mr-2">Invoice no:</span>
                      <span>############</span>
                    </div>
                    <div class="d-flex mb-3 justify-content-end">
                      <span class="text-muted mr-2">Date:</span>
                      <input
                        type="date"
                        class="form-control form-control-sm w-auto"
                        @blur="toggleChangesNotSaved(true)"
                        v-model="invoiceForm.date"
                      />
                    </div>
                    <div class="d-flex mb-3 justify-content-end">
                      <span class="text-muted mr-2">Due Date:</span>
                      <input
                        type="date"
                        class="form-control form-control-sm w-auto"
                        @blur="toggleChangesNotSaved(true)"
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
                            <span
                              ><input
                                type="checkbox"
                                name="is_vat_applied"
                                @blur="toggleChangesNotSaved(true)"
                                id="is_vat_applied"
                                v-model="invoiceForm.is_invoice_vat_applied"
                            /></span>
                            <label for="is_vat_applied"
                              ><strong>VAT (10%)</strong></label
                            >
                          </td>
                          <td colspan="3" class="text-right border-bottom">
                            <span class="">
                              <input
                                type="number"
                                :disabled="!invoiceForm.is_invoice_vat_applied"
                                @blur="toggleChangesNotSaved(true)"
                                class="form-control form-control-sm"
                                v-model.number="invoiceForm.vat_value"
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
                    <textarea
                      @blur="toggleChangesNotSaved(true)"
                      v-model="invoiceForm.invoice_notes"
                      style="width: 100%; height: auto"
                    />
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
  props: ["invoice"],
  data() {
    return {
      invoiceForm: new Form({
        user_id: null,
        client_id: null,
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
          company: "",
          logo: "",
        },
        invoice_logo: null, // for now this and user.logo are same but can change
        date: null,
        due_date: null,
        vat_value: 0,
        is_invoice_vat_applied: false,
        items: [
          {
            item_detail: "",
            qty: 1,
            rate: 0,
          },
        ],
        invoice_notes: `We really appreciate your business and if there’s anything else we can do, please let us know! Also, should you need us to add VAT or anything else to this order, it’s super easy since this is a template, so just ask!`,
        invoice_terms: null,
        invoice_no: null,
        selected_currency: "USD",
        invoice_type: "invoice", // "invoice" | "expense"
        sub_total: "",
        total: "",
      }),
      invoice_logo_url: "/images/sitelogo.jpeg",
      invoiceLogo: [],
      currency: [{ name: "USD" }, { name: "EUR" }, { name: "ALL" }],
      invoice_due_date_add_days: 15,
      hideInvoiceLogo: false,
      changes_not_saved: false,
    };
  },
  beforeMount() {
    const invoiceData = this.invoice.data;
      console.log("invoiceData = ", invoiceData);
    if (invoiceData) {
      invoiceData.user_id && (this.invoiceForm.user_id = invoiceData.user_id);
      invoiceData.user && (this.invoiceForm.user = invoiceData.user);
      invoiceData.client_id && (this.invoiceForm.client_id = invoiceData.client_id);
      invoiceData.client && (this.invoiceForm.client = invoiceData.client);
      invoiceData.invoice_logo && (this.invoiceForm.invoice_logo = invoiceData.invoice_logo);
      invoiceData.date && (this.invoiceForm.date = invoiceData.date);
      invoiceData.due_date && (this.invoiceForm.due_date = invoiceData.due_date);
      invoiceData.vat_value && (this.invoiceForm.vat_value = invoiceData.vat_value);
      invoiceData.is_invoice_vat_applied && (this.invoiceForm.is_invoice_vat_applied = invoiceData.is_invoice_vat_applied);
      invoiceData.items && (this.invoiceForm.items = invoiceData.items);
      invoiceData.invoice_notes && (this.invoiceForm.invoice_notes = invoiceData.invoice_notes);
      invoiceData.invoice_terms && (this.invoiceForm.invoice_terms = invoiceData.invoice_terms);
      invoiceData.invoice_no && (this.invoiceForm.invoice_no = invoiceData.invoice_no);
      invoiceData.selected_currency && (this.invoiceForm.selected_currency = invoiceData.selected_currency);
      invoiceData.invoice_type && (this.invoiceForm.invoice_type = invoiceData.invoice_type);
      invoiceData.sub_total && (this.invoiceForm.sub_total = invoiceData.sub_total);
      invoiceData.total && (this.invoiceForm.total = invoiceData.total);
      invoiceData.invoice_logo_url && (this.invoice_logo_url = invoiceData.invoice_logo_url);
    }
    if (this.$page.user) {
      this.invoiceForm.user_id = this.$page.user.id;
      this.invoiceForm.user.id = this.$page.user.id;
      this.invoiceForm.user.name = this.$page.user.name;
      this.invoiceForm.user.email = this.$page.user.email;
      this.invoiceForm.user.address = this.$page.user.address;
      this.invoiceForm.user.state = this.$page.user.state;
      this.invoiceForm.user.country = this.$page.user.country;
      this.invoiceForm.user.company = this.$page.user.company;
      this.invoiceForm.user.phone_number = this.$page.user.phone_number;
      this.invoiceForm.user.state = this.$page.user.state;
      if (this.$page.user.logo_url) {
        this.invoiceForm.invoice_logo = this.$page.user.logo;
        this.invoiceForm.user.logo = this.$page.user.logo_url;
        this.invoice_logo_url = this.$page.user.logo_url;
      }
      if (this.$page.user.notes) {
        this.invoiceForm.invoice_notes = this.$page.user.notes;
      }
    }
    // setting date and due date
    const monthsObj = {
      0: "01",
      1: "02",
      2: "03",
      3: "04",
      4: "05",
      5: "06",
      6: "07",
      7: "08",
      8: "09",
      9: "10",
      10: "11",
      11: "12",
    };
    const monthsDaysLimit = {
      0: 31,
      1: 28,
      2: 31,
      3: 30,
      4: 31,
      5: 30,
      6: 31,
      7: 31,
      8: 30,
      9: 31,
      10: 30,
      11: 31,
    };
    const currentDateObj = new Date();
    const currentYear = currentDateObj.getFullYear();
    const currentMonthNumber = currentDateObj.getMonth();
    const currentMonth = monthsObj[currentMonthNumber]; // already string
    const currentDate = currentDateObj.getDate();
    let invoiceCurrentDate =
      currentYear.toString() +
      "-" +
      currentMonth +
      "-" +
      currentDate.toLocaleString("en-US", {
        minimumIntegerDigits: 2,
        useGrouping: false,
      });

    const estimateInvoiceDueDate = currentDate + this.invoice_due_date_add_days;
    let invoiceDueDate = null;
    if (estimateInvoiceDueDate < monthsDaysLimit[currentMonthNumber]) {
      invoiceDueDate =
        currentYear.toString() +
        "-" +
        currentMonth +
        "-" +
        estimateInvoiceDueDate.toLocaleString("en-US", {
          minimumIntegerDigits: 2,
          useGrouping: false,
        });
    } else {
      const remainingDaysOfMonth =
        monthsDaysLimit[currentMonthNumber] - currentDate;
      const remainingDaysTemp =
        this.invoice_due_date_add_days - remainingDaysOfMonth;
      const nextMonth = monthsObj[currentMonthNumber + 1];
      invoiceDueDate =
        currentYear.toString() +
        "-" +
        nextMonth +
        "-" +
        remainingDaysTemp.toLocaleString("en-US", {
          minimumIntegerDigits: 2,
          useGrouping: false,
        });
    }

    // checking if invoice date is not set then setting a default invoice date
    if (this.invoice) {
      if (this.invoice.date) {
        this.invoiceForm.date = this.invoice.date;
      } else {
        this.invoiceForm.date = invoiceCurrentDate;
      }
      if (this.invoice.due_date) {
        this.invoiceForm.due_date = this.invoice.due_date;
      } else {
        this.invoiceForm.due_date = invoiceDueDate;
      }
    } else {
      this.invoiceForm.date = invoiceCurrentDate;
      this.invoiceForm.due_date = invoiceDueDate;
    }
  },
  mounted() {
    // listening for events
    EventBus.$on("event_clientAdded", this.onClientAdded);
    EventBus.$on("event_clientSelected", this.onClientSelected);

    // setting upload component to active
    this.$refs.upload.active = true;
  },
  methods: {
    textResult() {
      console.log("test here");
    },
    changeValue(event, fieldName) {
      if (fieldName == "user_name") {
        this.invoiceForm.user.name = event.target.innerText;
      }
      if (fieldName == "user_email") {
        this.invoiceForm.user.email = event.target.innerText;
      }
      if (fieldName == "user_address") {
        this.invoiceForm.user.address = event.target.innerText;
      }
      if (fieldName == "user_state") {
        this.invoiceForm.user.state = event.target.innerText;
      }
      if (fieldName == "user_country") {
        this.invoiceForm.user.country = event.target.innerText;
      }
      if (fieldName == "user_phone_number") {
        this.invoiceForm.user.phone_number = event.target.innerText;
      }
      if (fieldName == "user_company") {
        this.invoiceForm.user.company = event.target.innerText;
      }
      if (fieldName == "client_name") {
        this.invoiceForm.client.name = event.target.innerText;
      }
      if (fieldName == "client_email") {
        this.invoiceForm.client.email = event.target.innerText;
      }
      if (fieldName == "client_address") {
        this.invoiceForm.client.address = event.target.innerText;
      }
      if (fieldName == "client_state") {
        this.invoiceForm.client.state = event.target.innerText;
      }
      if (fieldName == "client_country") {
        this.invoiceForm.client.country = event.target.innerText;
      }
      if (fieldName == "client_phone_number") {
        this.invoiceForm.client.phone_number = event.target.innerText;
      }
      if (fieldName == "client_company") {
        this.invoiceForm.client.company = event.target.innerText;
      }
      this.toggleChangesNotSaved(true); // avoid user changing page without saving changes
    },

    // custom methods
    openClientListModal() {
      if (this.$page.user) {
        this.$inertia.reload({ only: ["clients"] });
        this.$modal.show("ClientsListModal");
      } else {
        this.$inertia.visit("/sign-in");
      }
    },
    updateInvoiceNumber(clientID, clientName) {
      axios
        .get("/check-client-invoices/" + clientID)
        .then((res) => {
          // 1
          let invoiceNameLetters =
            this.invoiceForm.invoice_type == "invoice" ? "INV" : "EXP";
          // 2
          let clientNameLetters = null;
          if (clientName.length > 3) {
            clientNameLetters = clientName.substring(0, 3).toUpperCase();
          }
          if (clientName.length <= 3) {
            clientNameLetters = clientName.toUpperCase();
          }
          // 3
          let invoicesSendToClientAlready = res.data.data;
          let thisInvoiceNumber = invoicesSendToClientAlready + 1;
          let clientInvoiceNumber = thisInvoiceNumber.toLocaleString("en-US", {
            minimumIntegerDigits: 2,
            useGrouping: false,
          });
          // 4
          let currentYear = new Date().getFullYear().toString();

          this.invoiceForm.invoice_no =
            invoiceNameLetters +
            clientNameLetters +
            clientInvoiceNumber +
            currentYear;

          this.toggleChangesNotSaved(true); // avoid user changing page without saving changes
        })
        .catch((err) => {
          this.$notify({
            group: "app",
            type: "error",
            title: "Request Faild",
            text: err.message,
            duration: 5000,
            speed: 1000,
            closeOnClick: true,
          });
        });
    },
    toggleInvoiceToExpense(type) {
      // invoice | expense
      if (this.invoiceForm.invoice_no) {
        let oldInvoiceNumber = this.invoiceForm.invoice_no;
        let temp = oldInvoiceNumber.substring(3);
        let newInvoiceNumber = oldInvoiceNumber;
        if (type == "invoice") {
          newInvoiceNumber = "INV" + temp;
        }
        if (type == "expense") {
          newInvoiceNumber = "EXP" + temp;
        }
        this.invoiceForm.invoice_no = newInvoiceNumber;
        this.invoiceForm.invoice_type = type;

        this.toggleChangesNotSaved(true); // avoid user changing page without saving changes
      }
    },
    toggleChangesNotSaved(state) {
      this.changes_not_saved = state;
    },
    downloadInvoice() {
      // saving invoice first
      this.saveInvoice();
      // downloading invoice afterwords
      this.startDownloadingInvoice();
    },
    startDownloadingInvoice() {
      console.log("download");
    },
    saveInvoice() {
      if (this.invoiceLogo.length > 0) {
        this.$refs.upload.active = true;
      } else {
        this.finishSavingInvoice();
      }
    },
    finishSavingInvoice() {
      this.invoiceForm
        .post("/user/invoices")
        .then((res) => {
          console.log("saveInvoice == res = ", res);
          this.$notify({
            group: "app",
            type: "success",
            title: "Request Successfull",
            text: "Changes saved Successfully!",
            duration: 5000,
            speed: 1000,
            closeOnClick: true,
          });
          this.toggleChangesNotSaved(false); // letting user change page after saving changes
        })
        .catch((err) => {
          this.$notify({
            group: "app",
            type: "error",
            title: "Request Faild",
            text: err.message,
            duration: 5000,
            speed: 1000,
            closeOnClick: true,
          });
        });
    },

    // below amir functions but can be reuse (read and verify)
    addRow: function () {
      this.invoiceForm.items.push({
        item_detail: "",
        qty: 1,
        rate: 0,
      });
      this.toggleChangesNotSaved(true); // avoid user changing page without saving changes
    },
    deleteRow(index) {
      console.log(index);
      this.$delete(this.invoiceForm.items, index);
      this.toggleChangesNotSaved(true); // avoid user changing page without saving changes
    },
    calculateSubtotal: function () {
      this.toggleChangesNotSaved(true); // avoid user changing page without saving changes

      let subtotal = 0;
      this.invoiceForm.items.forEach((val) => {
        subtotal += val.qty * val.rate;
      });
      this.subtotal = subtotal;
      this.invoiceForm.sub_total = subtotal;
      return subtotal;
    },
    calculateTotal: function () {
      this.toggleChangesNotSaved(true); // avoid user changing page without saving changes

      let total = 0;
      if (this.invoiceForm.is_invoice_vat_applied) {
        total =
          this.subtotal - this.subtotal * (this.invoiceForm.vat_value / 100);
      } else {
        total = this.subtotal;
      }
      this.invoiceForm.total = total;
      return total;
    },

    // upload file component methods
    inputFile: function (newFile, oldFile) {
      if (newFile && oldFile && !newFile.active && oldFile.active) {
        // Get response data
        console.log("response = ", newFile.response);
        if (newFile.xhr) {
          console.log("newFile.xhr.status = ", newFile.xhr.status);
          //  Get the response status code
          if (newFile.xhr.status == 200) {
            if (newFile.response.data) {
              this.invoiceForm.invoice_logo = newFile.response.data;
              this.finishSavingInvoice(); // here this will continue after file upload
            }
          }
        }
      }
    },
    invoiceLogoFilter(newFile, oldFile, prevent) {
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
    updatetInvoiceLogo(value) {
      this.invoiceLogo = value;
      if (this.invoiceLogo[0]) {
        this.invoice_logo_url = this.invoiceLogo[0].blob;
        this.toggleChangesNotSaved(true); // avoid user changing page without saving changes
      }
    },

    // event handlers
    onClientAdded(client) {
      this.invoiceForm.client_id = client.id;
      this.invoiceForm.client.id = client.id;
      this.invoiceForm.client.name = client.name;
      this.invoiceForm.client.email = client.email;
      this.invoiceForm.client.phone_number = client.phone_number;
      this.invoiceForm.client.address = client.address;
      this.invoiceForm.client.country = client.country;
      this.updateInvoiceNumber(client.id, client.name);
    },
    onClientSelected(client) {
      this.invoiceForm.client_id = client.id;
      this.invoiceForm.client.id = client.id;
      this.invoiceForm.client.name = client.name;
      this.invoiceForm.client.email = client.email;
      this.invoiceForm.client.phone_number = client.phone_number;
      this.invoiceForm.client.address = client.address;
      this.invoiceForm.client.country = client.country;
      this.updateInvoiceNumber(client.id, client.name);
    },

    // methods for pdf plugin
    onProgress(event) {
      console.log("onProgress === event = ", event);
    },
    hasStartedGeneration() {
      console.log("hasStartedGeneration");
    },
    hasGenerated(event) {
      console.log("hasGenerated === event = ", event);
    },
    generateReport() {
      this.$refs.html2Pdf.generatePdf();
    },
    async beforeDownload({ html2pdf, options, pdfContent }) {
      await html2pdf()
        .set(options)
        .from(pdfContent)
        .toPdf()
        .get("pdf")
        .then((pdf) => {
          const totalPages = pdf.internal.getNumberOfPages();
          for (let i = 1; i <= totalPages; i++) {
            pdf.setPage(i);
            pdf.setFontSize(10);
            pdf.setTextColor(150);
            pdf.text(
              "Page " + i + " of " + totalPages,
              pdf.internal.pageSize.getWidth() * 1,
              pdf.internal.pageSize.getHeight() - 0
            );
          }
        })
        .save();
    },
  },
  beforeDestroy(event) {
    console.log("event = ", event);
    if (this.changes_not_saved) {
      // this.$modal.show("dialog", {
      //   title: "Changes Not saved!",
      //   text: "Changes Not saved, save now before leaving?",
      //   buttons: [
      //     {
      //       title: "Cancel",
      //       handler: () => {
      //         this.$modal.hide("dialog");
      //         return;
      //       },
      //     },
      //     {
      //       title: "Save & Continue",
      //       handler: () => {
      //         // this.finishSavingInvoice();
      //         console.log("save changes & continue");
      //       },
      //     },
      //     {
      //       title: "Discard & Continue",
      //       handler: () => {
      //         console.log("leave changes & continue");
      //       },
      //     },
      //   ],
      // });
      if (confirm("Changes Not saved, save now before leaving?")) {
        if (this.invoiceLogo.length > 0) {
          this.$refs.upload.active = true;
        } else {
          this.finishSavingInvoice();
        }
      }
    }
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
input:disabled {
  background-color: lightgrey !important;
}
</style>

