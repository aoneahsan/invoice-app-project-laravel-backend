<template>
  <FrontendMain>
    <template #header>
      <div class="row align-items-center">
        <div class="col">
          <!-- Pretitle -->
          <h2 class="mb-1 text-xl font-semibold leading-tight text-gray-800">
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
              class="ml-2 btn btn-success lift"
            >
              Switch To Invoice
            </button>
            <button
              @click="toggleInvoiceToExpense('expense')"
              v-if="invoiceForm.invoice_type == 'invoice'"
              class="ml-2 btn btn-danger lift"
            >
              Switch To Expense
            </button>
            <button
              @click="downloadInvoice()"
              :disabled="changes_not_saved"
              class="ml-2 btn btn-white lift"
            >
              Download
            </button>
          </template>
          <button @click="saveInvoice()" class="ml-2 btn btn-primary lift">
            Save
          </button>
          <select
            class="ml-2 form-control form-control-sm d-inline-block"
            style="width: 100px; height: 40px"
            v-model="invoiceForm.selected_currency"
          >
            <option
              v-for="(item, index) in currencies"
              :key="index"
              :value="item"
            >
              {{ item }}
            </option>
          </select>
        </div>
      </div>
    </template>
    <div class="pt-12 col-12">
      <div class="container">
        <div class="row">
          <!-- Alert for Login -->
          <div class="col-12" v-if="!$page.user">
            <div class="text-center alert alert-primary" role="alert">
              <strong
                >Kindly Login first before continue (no data will be saved
                otherwise)</strong
              >
            </div>
          </div>
          <!-- Invoice Setting -->

          <div class="mx-auto col-11 col-lg-10 col-xl-10">
            <!-- Header -->
            <!-- Content -->
            <div class="p-5 card card-body">
              <div class="row">
                <div class="col-12 col-md-6">
                  <div
                    class="mt-2 mb-4 overlay profile-pic"
                    style="line-height: 25px; max-width: 500px"
                  >
                    <span
                      contenteditable="true"
                      @blur="(event) => changeValue(event, 'user_company_name')"
                      v-html="invoiceForm.user.company"
                    ></span
                    ><br v-if="invoiceForm.user.address" />
                    <span
                      contenteditable="true"
                      @blur="(event) => changeValue(event, 'user_address')"
                      v-html="invoiceForm.user.address"
                    ></span>
                    <br
                      v-if="invoiceForm.user.zipcode || invoiceForm.user.city"
                    />
                    <span
                      contenteditable="true"
                      @blur="(event) => changeValue(event, 'user_zipcode')"
                      v-html="invoiceForm.user.zipcode"
                    ></span
                    ><span
                      v-if="invoiceForm.user.zipcode && invoiceForm.user.city"
                      >,</span
                    >
                    <span
                      contenteditable="true"
                      @blur="(event) => changeValue(event, 'user_city')"
                      v-html="invoiceForm.user.city"
                    ></span
                    ><br v-if="invoiceForm.user.country" />
                    <span
                      contenteditable="true"
                      @blur="(event) => changeValue(event, 'user_country')"
                      v-html="invoiceForm.user.country"
                    ></span>
                    <br v-if="invoiceForm.user.company_registration_number" />
                    <span v-if="invoiceForm.user.company_registration_number"
                      >Company Number:
                    </span>
                    <span
                      contenteditable="true"
                      @blur="
                        (event) =>
                          changeValue(event, 'user_company_registration_number')
                      "
                      v-html="invoiceForm.user.company_registration_number"
                    ></span
                    ><br v-if="invoiceForm.user.vat_number" />
                    <span v-if="invoiceForm.user.vat_number">VAT Number: </span>
                    <span
                      contenteditable="true"
                      @blur="(event) => changeValue(event, 'user_vat_number')"
                      v-html="invoiceForm.user.vat_number"
                    ></span
                    ><br />
                    <div class="mt-3 edit" title="Edit This">
                      <v-icon name="edit"></v-icon>
                    </div>
                  </div>
                  <p class="mt-14 text-muted">Bill To:</p>
                  <div class="clickable">
                    <div
                      class="my-2 ml-3"
                      data-toggle="modal"
                      data-target="#exampleModal"
                    >
                      <a
                        v-if="invoiceForm.client.id"
                        @click="openClientListModal"
                        class="nav-link active"
                      >
                        {{ invoiceForm.client.company }}
                        <br v-if="invoiceForm.client.company" />
                        {{ invoiceForm.client.address }}
                        <br
                          v-if="
                            invoiceForm.client.zipcode ||
                            invoiceForm.client.city
                          "
                        />
                        {{ invoiceForm.client.zipcode
                        }}<span
                          v-if="
                            invoiceForm.client.zipcode &&
                            invoiceForm.client.city
                          "
                          >,</span
                        >
                        {{ invoiceForm.client.city
                        }}<br v-if="invoiceForm.client.country" />
                        {{ invoiceForm.client.country }}
                        <br
                          v-if="invoiceForm.client.company_registration_number"
                        />
                        <span
                          v-if="invoiceForm.client.company_registration_number"
                          >{{
                            "Company Number: " +
                            invoiceForm.client.company_registration_number
                          }}</span
                        >
                        <br v-if="invoiceForm.client.vat_number" />
                        <span v-if="invoiceForm.client.vat_number">{{
                          "VAT Number: " + invoiceForm.client.vat_number
                        }}</span>
                      </a>
                      <a
                        class="nav-link active"
                        v-if="!invoiceForm.client.id"
                        @click="openClientListModal"
                      >
                        <i class="ml-2 fe fe-user"> </i>
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
                        v-model="invoiceLogo"
                        post-action="/upload-files"
                        @input-file="inputFile"
                        @input="updatetInvoiceLogo"
                        :drop="true"
                        :multiple="false"
                        v-show="true"
                        @input-filter="invoiceLogoFilter"
                      >
                        <img
                          class="ml-8 image rounded-circle"
                          v-bind:src="invoice_logo_url"
                          v-show="!hideInvoiceLogo"
                          alt="User Company Logo"
                          style="object-fit: cover; width: 200px; height: 200px"
                        />
                      </file-upload>
                    </label>
                  </div>

                  <div class="mr-4">
                    <h3 class="mb-3 invoice">Invoice</h3>
                    <div
                      class="mb-3 d-flex justify-content-end"
                      v-if="invoiceForm.invoice_no"
                    >
                      <span class="mr-2 text-muted">Invoice no:</span>
                      <span
                        contenteditable="true"
                        @blur="(event) => changeValue(event, 'invoice_no')"
                        v-html="invoiceForm.invoice_no"
                      ></span>
                    </div>
                    <div
                      class="mb-3 d-flex justify-content-end"
                      v-if="!invoiceForm.invoice_no"
                    >
                      <span class="mr-2 text-muted">Invoice no:</span>
                      <span>############</span>
                    </div>
                    <div class="mb-3 d-flex justify-content-end">
                      <span class="mr-2 text-muted">Date:</span>
                      <input
                        type="date"
                        class="w-auto form-control form-control-sm"
                        @blur="toggleChangesNotSaved(true)"
                        v-model="invoiceForm.date"
                      />
                    </div>
                    <div class="mb-3 d-flex justify-content-end">
                      <span class="mr-2 text-muted">Due Date:</span>
                      <input
                        type="date"
                        class="w-auto form-control form-control-sm"
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
                          <th class="text-right bg-transparent border-top-0">
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
                            <currency-input
                              class="form-control form-control-sm"
                              :currency="invoiceForm.selected_currency"
                              :locale="userLocale"
                              :allow-negative="false"
                              v-model.number="item.rate"
                            />
                          </td>
                          <td class="text-right td">
                            {{
                              (item.qty * item.rate).toLocaleString(
                                userLocale,
                                {
                                  style: "currency",
                                  currency: invoiceForm.selected_currency,
                                }
                              )
                            }}
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
                            <span @click="addRow()" class="ml-2 text-primary">
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
                              ><strong>VAT (%)</strong></label
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
                  <h6 class="text-uppercase">Notes</h6>
                  <p class="mb-0 text-muted">
                    <textarea
                      @blur="toggleChangesNotSaved(true)"
                      v-model="invoiceForm.invoice_notes"
                      style="width: 100%; height: auto"
                      class="form-control form-control-sm js-autoresize"
                    />
                  </p>
                  <!-- <hr class="my-5" /> -->
                  <h6 class="mt-4 text-uppercase">Bank Details</h6>
                  <p class="mb-0 text-muted">
                    <textarea
                      @blur="toggleChangesNotSaved(true)"
                      v-model="invoiceForm.invoice_bank_details"
                      style="width: 100%; height: auto"
                      class="form-control form-control-sm js-autoresize"
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
import { setResizeListeners } from "./../../../utils/auto-resize";

export default {
  props: ["invoice"],
  data() {
    return {
      invoiceForm: new Form({
        user_id: null,
        client_id: null,
        user: {
          id: "USER_ID",
          name: "user_company_name",
          email: "USER_country",
          phone_number: "USER_NUMBER",
          state: "USER_zipcode",
          company: "USER_COMPANY",
          country: "USER_City",
          address: "USER_ADDRESS",
          logo: "/images/sitelogo.jpeg",
          company_registration_number: "",
          city: "",
          zipcode: "",
          vat_number: "",
          default_currency: "",
          notes: "",
        },
        client: {
          id: null,
          name: "",
          email: "",
          phone_number: "",
          address: "",
          company: "",
          logo: "",
          company_registration_number: "",
          city: "",
          zipcode: "",
          vat_number: "",
          default_currency: "",
          notes: "",
          bank_details: "",
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
        invoice_notes: ``,
        invoice_bank_details: "",
        invoice_terms: null,
        invoice_no: null,
        selected_currency: "USD",
        invoice_type: "invoice", // "invoice" | "expense"
        sub_total: "",
        total: "",
      }),
      invoice_logo_url: "/images/sitelogo.jpeg",
      invoiceLogo: [],
      currencies: ["USD", "EUR", "GBP", "YEN", "INR", "IDR"],
      invoice_due_date_add_days: 15,
      hideInvoiceLogo: false,
      changes_not_saved: false,
      is_creating_invoice: true,
      userLocale: "en",
      isCreatingNewInvoice: false,
      invoiceId: null,
    };
  },
  beforeMount() {
    const invoiceData = this.invoice.data;
    console.log("invoiceData = ", invoiceData);
    if (invoiceData) {
      this.invoiceId = invoiceData.invoice_unique_id;
      this.is_creating_invoice = false; // invoice viewed so updating invoice instead of creating
      invoiceData.user_id && (this.invoiceForm.user_id = invoiceData.user_id);
      invoiceData.user && (this.invoiceForm.user = invoiceData.user);
      invoiceData.client_id &&
        (this.invoiceForm.client_id = invoiceData.client_id);
      invoiceData.client && (this.invoiceForm.client = invoiceData.client);
      invoiceData.date && (this.invoiceForm.date = invoiceData.date);
      invoiceData.due_date &&
        (this.invoiceForm.due_date = invoiceData.due_date);
      invoiceData.vat_value &&
        (this.invoiceForm.vat_value = invoiceData.vat_value);
      invoiceData.is_invoice_vat_applied &&
        (this.invoiceForm.is_invoice_vat_applied =
          invoiceData.is_invoice_vat_applied);
      invoiceData.items && (this.invoiceForm.items = invoiceData.items);
      invoiceData.invoice_notes &&
        (this.invoiceForm.invoice_notes = invoiceData.invoice_notes);
      invoiceData.invoice_bank_details &&
        (this.invoiceForm.invoice_bank_details =
          invoiceData.invoice_bank_details);

      invoiceData.invoice_terms &&
        (this.invoiceForm.invoice_terms = invoiceData.invoice_terms);
      invoiceData.invoice_no &&
        (this.invoiceForm.invoice_no = invoiceData.invoice_no);
      invoiceData.selected_currency &&
        (this.invoiceForm.selected_currency = invoiceData.selected_currency);
      invoiceData.invoice_type &&
        (this.invoiceForm.invoice_type = invoiceData.invoice_type);
      invoiceData.sub_total &&
        (this.invoiceForm.sub_total = invoiceData.sub_total);
      invoiceData.total && (this.invoiceForm.total = invoiceData.total);
      invoiceData.invoice_logo &&
        (this.invoiceForm.invoice_logo = invoiceData.invoice_logo);
      invoiceData.invoice_logo_url &&
        (this.invoice_logo_url = invoiceData.invoice_logo_url);
      invoiceData.selected_currency &&
        (this.invoiceForm.selected_currency = invoiceData.selected_currency);
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
      this.invoiceForm.user.company_registration_number = this.$page.user.company_registration_number;
      this.invoiceForm.user.phone_number = this.$page.user.phone_number;
      this.invoiceForm.user.city = this.$page.user.city;
      this.invoiceForm.user.zipcode = this.$page.user.zipcode;
      this.invoiceForm.user.vat_number = this.$page.user.vat_number;
      this.invoiceForm.user.default_currency = this.$page.user.default_currency;
      this.invoiceForm.user.notes = this.$page.user.notes;
      if (!invoiceData.invoice_logo_url && this.$page.user.logo_url) {
        this.invoiceForm.invoice_logo = this.$page.user.logo;
        this.invoiceForm.user.logo = this.$page.user.logo_url;
        this.invoice_logo_url = this.$page.user.logo_url;
      }
      if (!invoiceData.invoice_notes && this.$page.user.notes) {
        this.invoiceForm.invoice_notes = this.$page.user.notes;
      }
      if (!invoiceData.selected_currency && this.$page.user.default_currency) {
        this.invoiceForm.selected_currency = this.$page.user.default_currency;
      }
      if (!invoiceData && this.$page.client.default_currency) {
        this.invoiceForm.selected_currency = this.$page.client.default_currency;
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

    if (invoiceData) {
      if (invoiceData.date) {
        this.invoiceForm.date = invoiceData.date;
      } else {
        this.invoiceForm.date = invoiceCurrentDate;
      }
      if (invoiceData.due_date) {
        this.invoiceForm.due_date = invoiceData.due_date;
      } else {
        this.invoiceForm.due_date = invoiceDueDate;
      }
    } else {
      this.invoiceForm.date = invoiceCurrentDate;
      this.invoiceForm.due_date = invoiceDueDate;
    }

    // listinging for unload event to delete invoice if not saved when creating first time
    // window.addEventListener("beforeunload", (event) => {
    //     console.log("beforeMount === window.addEventListener == event = ",event);
    //   if (!this.isCreatingNewInvoice) return;
    //   event.preventDefault();
    //   // Chrome requires returnValue to be set.
    //   event.returnValue = "";
    //   console.log("beforeDestroy == isCreatingNewInvoice = true");
    //   // delete invoice
    //   this.$http
    //     .delete(`/user/invoices/${this.invoiceId}`)
    //     .then((res) => {
    //       this.isCreatingNewInvoice = false;
    //       console.log("beforeDestroy == invoice deleted == res = ", res);
    //       this.$inertia.visit("/invoices");
    //     })
    //     .catch((err) => {
    //       console.log("beforeDestroy == invoice deleted == err = ", err);
    //     });
    // });
  },
  mounted() {
    // listening for events
    EventBus.$on("event_clientAdded", this.onClientAdded);
    EventBus.$on("event_clientSelected", this.onClientSelected);

    // setting upload component to active
    this.$refs.upload.active = true;
    setResizeListeners(this.$el, ".js-autoresize");
    var url = new URL(window.location.href);
    this.isCreatingNewInvoice = url.searchParams.get("isCreating");
  },
  methods: {
    textResult() {
      console.log("test here");
    },
    changeValue(event, fieldName) {
      if (fieldName == "user_company_name") {
        this.invoiceForm.user.name = event.target.innerText;
      }
      if (fieldName == "user_country") {
        this.invoiceForm.user.email = event.target.innerText;
      }
      if (fieldName == "user_address") {
        this.invoiceForm.user.address = event.target.innerText;
      }
      if (fieldName == "user_zipcode") {
        this.invoiceForm.user.state = event.target.innerText;
      }
      if (fieldName == "user_city") {
        this.invoiceForm.user.country = event.target.innerText;
      }
      if (fieldName == "user_company_registration_number") {
        this.invoiceForm.user.phone_number = event.target.innerText;
      }
      if (fieldName == "user_company") {
        this.invoiceForm.user.company = event.target.innerText;
      }
      if (fieldName == "user_vat_number") {
        this.invoiceForm.user.vat_number = event.target.innerText;
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
      if (fieldName == "invoice_no") {
        this.invoiceForm.invoice_no = event.target.innerText;
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
    updateInvoiceNumber(clientID, companyName) {
      axios
        .get("/check-client-invoices/" + clientID)
        .then((res) => {
          console.log(
            "Invoices => Create.vue === updateInvoiceNumber == res = ",
            res
          );
          // 1
          let invoiceNameLetters =
            this.invoiceForm.invoice_type == "invoice" ? "INV" : "EXP";
          // 2
          let companyNameLetters = null;
          if (companyName.length > 3) {
            companyNameLetters = companyName.substring(0, 3).toUpperCase();
          }
          if (companyName.length <= 3) {
            companyNameLetters = companyName.toUpperCase();
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
            companyNameLetters +
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
            duration: 7000,
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
      window.open(
        `/download-invoice/${this.invoice.data.invoice_unique_id}`,
        "_blank"
      );
    },
    saveInvoice() {
      this.isCreatingNewInvoice = false;
      if (this.invoiceLogo.length > 0) {
        this.$refs.upload.active = true;
      } else {
        this.finishSavingInvoice();
      }
    },
    finishSavingInvoice() {
      if (this.is_creating_invoice) {
        this.invoiceForm
          .post("/user/invoices")
          .then((res) => {
            // console.log("saveInvoice == res = ", res);
            this.$notify({
              group: "app",
              type: "success",
              title: "Request Successfull",
              text: "Changes saved Successfully!",
              duration: 7000,
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
              duration: 7000,
              speed: 1000,
              closeOnClick: true,
            });
          });
      } else {
        this.invoiceForm
          .put("/user/invoices/" + this.invoice.data.invoice_unique_id)
          .then((res) => {
            // console.log("saveInvoice == res = ", res);
            this.$notify({
              group: "app",
              type: "success",
              title: "Request Successfull",
              text: "Changes saved Successfully!",
              duration: 7000,
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
              duration: 7000,
              speed: 1000,
              closeOnClick: true,
            });
          });
      }
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
      // console.log(index);
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
      return subtotal.toLocaleString(this.userLocale, {
        style: "currency",
        currency: this.invoiceForm.selected_currency,
      });
    },
    calculateTotal: function () {
      this.toggleChangesNotSaved(true); // avoid user changing page without saving changes

      let total = 0;
      if (this.invoiceForm.is_invoice_vat_applied) {
        total =
          this.subtotal + this.subtotal * (this.invoiceForm.vat_value / 100);
      } else {
        total = this.subtotal;
      }
      this.invoiceForm.total = total;
      return total.toLocaleString(this.userLocale, {
        style: "currency",
        currency: this.invoiceForm.selected_currency,
      });
    },

    // upload file component methods
    inputFile: function (newFile, oldFile) {
      if (newFile && oldFile && !newFile.active && oldFile.active) {
        // Get response data
        // console.log("response = ", newFile.response);
        if (newFile.xhr) {
          // console.log("newFile.xhr.status = ", newFile.xhr.status);
          //  Get the response status code
          if (newFile.xhr.status == 200) {
            if (newFile.response.data) {
              this.invoiceForm.invoice_logo = newFile.response.data;
              // console.log("newFile.response.data = ", newFile.response.data);
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
      this.invoiceForm.client.company = client.company;
      this.invoiceForm.client.company_registration_number =
        client.company_registration_number;
      this.invoiceForm.client.phone_number = client.phone_number;
      this.invoiceForm.client.city = client.city;
      this.invoiceForm.client.zipcode = client.zipcode;
      this.invoiceForm.client.vat_number = client.vat_number;
      this.invoiceForm.client.default_currency = client.default_currency;
      this.invoiceForm.client.notes = client.notes;
      if (client.default_currency) {
        this.invoiceForm.selected_currency = client.default_currency;
      }
      if (client.notes) {
        this.invoiceForm.invoice_notes = client.notes;
      }
      if (client.bank_details) {
        this.invoiceForm.invoice_bank_details = client.bank_details;
      }
      this.updateInvoiceNumber(client.id, client.company);
    },
    onClientSelected(client) {
      this.invoiceForm.client_id = client.id;
      this.invoiceForm.client.id = client.id;
      this.invoiceForm.client.name = client.name;
      this.invoiceForm.client.email = client.email;
      this.invoiceForm.client.phone_number = client.phone_number;
      this.invoiceForm.client.address = client.address;
      this.invoiceForm.client.country = client.country;
      this.invoiceForm.client.company = client.company;
      this.invoiceForm.client.company_registration_number =
        client.company_registration_number;
      this.invoiceForm.client.phone_number = client.phone_number;
      this.invoiceForm.client.city = client.city;
      this.invoiceForm.client.zipcode = client.zipcode;
      this.invoiceForm.client.vat_number = client.vat_number;
      this.invoiceForm.client.default_currency = client.default_currency;
      this.invoiceForm.client.notes = client.notes;
      this.invoiceForm.client.bank_details = client.bank_details;
      if (client.default_currency) {
        this.invoiceForm.selected_currency = client.default_currency;
      }
      if (client.notes) {
        this.invoiceForm.invoice_notes = client.notes;
      }
      this.updateInvoiceNumber(client.id, client.company);
    },
  },
  beforeDestroy(event) {
    console.log("event = ", event);
    if (this.changes_not_saved) {
      if (confirm("Changes Not saved, save now before leaving?")) {
        if (this.invoiceLogo.length > 0) {
          this.$refs.upload.active = true;
        } else {
          this.finishSavingInvoice();
        }
      } else {
        return;
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

