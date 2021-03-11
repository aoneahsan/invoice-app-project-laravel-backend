<template>
  <div>
    <button class="btn btn-primary download-btn" @click="generateReport()">
      Download PDF
    </button>
    <vue-html2pdf
      :show-layout="true"
      :float-layout="true"
      :enable-download="true"
      :preview-modal="true"
      :paginate-elements-by-height="1100"
      :filename="invoiceForm.invoice_no"
      :pdf-quality="10"
      :manual-pagination="true"
      pdf-format="a4"
      pdf-orientation="portrait"
      pdf-content-width="100%"
      @progress="onProgress($event)"
      ref="html2Pdf"
    >
      <!-- @hasStartedGeneration="hasStartedGeneration()"
      @hasGenerated="hasGenerated($event)" -->
      <!-- @beforeDownload="beforeDownload($event)" -->
      <section slot="pdf-content" class="w-full">
        <div class="pt-12 col-12">
          <div class="container">
            <div class="row">
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
                        <span v-html="invoiceForm.user.company"></span
                        ><br v-if="invoiceForm.user.address" />
                        <span v-html="invoiceForm.user.address"></span>
                        <br
                          v-if="
                            invoiceForm.user.zipcode || invoiceForm.user.city
                          "
                        />
                        <span v-html="invoiceForm.user.zipcode"></span
                        ><span
                          v-if="
                            invoiceForm.user.zipcode && invoiceForm.user.city
                          "
                          >,</span
                        >
                        <span v-html="invoiceForm.user.city"></span
                        ><br v-if="invoiceForm.user.country" />
                        <span v-html="invoiceForm.user.country"></span>
                        <br
                          v-if="invoiceForm.user.company_registration_number"
                        />
                        <span
                          v-if="invoiceForm.user.company_registration_number"
                          >Company Number:
                          {{
                            invoiceForm.user.company_registration_number
                          }}</span
                        ><br v-if="invoiceForm.user.vat_number" />
                        <span v-if="invoiceForm.user.vat_number"
                          >VAT Number: {{ invoiceForm.user.vat_number }}</span
                        ><br />
                      </div>
                      <p class="mt-5 text-muted">Bill To:</p>
                      <div class="clickable">
                        <div
                          class="p-0 my-2 ml-3"
                          data-toggle="modal"
                          data-target="#exampleModal"
                        >
                          <a
                            v-if="invoiceForm.client.id"
                            class="p-0 nav-link active"
                          >
                            <span v-html="invoiceForm.client.company"></span
                            ><br v-if="invoiceForm.client.address" />
                            <span v-html="invoiceForm.client.address"></span>
                            <br
                              v-if="
                                invoiceForm.client.zipcode ||
                                invoiceForm.client.city
                              "
                            />
                            <span v-html="invoiceForm.client.zipcode"></span
                            ><span
                              v-if="
                                invoiceForm.client.zipcode &&
                                invoiceForm.client.city
                              "
                              >,</span
                            >
                            <span v-html="invoiceForm.client.city"></span
                            ><br v-if="invoiceForm.client.country" />
                            <span v-html="invoiceForm.client.country"></span>
                            <br
                              v-if="
                                invoiceForm.client.company_registration_number
                              "
                            />
                            <span
                              v-if="
                                invoiceForm.client.company_registration_number
                              "
                              >Company Number:
                              {{
                                invoiceForm.client.company_registration_number
                              }}</span
                            ><br v-if="invoiceForm.client.vat_number" />
                            <span v-if="invoiceForm.client.vat_number"
                              >VAT Number:
                              {{ invoiceForm.client.vat_number }}</span
                            >
                          </a>
                          <a
                            class="nav-link active"
                            v-if="!invoiceForm.client.id"
                          >
                            <i class="ml-2 fe fe-user"> </i>
                            Client Details Will Show Here
                          </a>
                        </div>
                      </div>
                    </div>
                    <!-- above this -->
                    <div class="col-12 col-md-6 text-md-right">
                      <div style="min-width: 200px; min-height: 200px">
                        <label for="upload-photo">
                          <img
                            class="ml-8 image rounded-circle"
                            v-bind:src="invoice_logo_url"
                            v-if="!hideInvoiceLogo"
                            alt="User Company Logo"
                            style="
                              object-fit: cover;
                              width: 200px;
                              height: 200px;
                            "
                          />
                        </label>
                      </div>

                      <div class="mr-4">
                        <h3 class="mb-3 invoice">Invoice</h3>
                        <div
                          class="mb-3 d-flex justify-content-end"
                          v-if="invoiceForm.invoice_no"
                        >
                          <span class="mr-2 text-muted">Invoice no:</span>
                          <span>{{ invoiceForm.invoice_no }}</span>
                        </div>
                        <div class="mb-3 d-flex justify-content-end">
                          <span class="mr-2 text-muted">Date:</span>
                          <input
                            type="date"
                            class="w-auto form-control form-control-sm"
                            readonly
                            v-model="invoiceForm.date"
                          />
                        </div>
                        <div class="mb-3 d-flex justify-content-end">
                          <span class="mr-2 text-muted">Due Date:</span>
                          <input
                            type="date"
                            class="w-auto form-control form-control-sm"
                            readonly
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
                              <th
                                class="text-right bg-transparent border-top-0"
                              >
                                <span class="h6"></span>
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr
                              v-for="(item, index) in invoiceForm.items"
                              :key="index"
                            >
                              <td class="td w-50" style="max-width: 50%">
                                {{ item.item_detail }}
                              </td>
                              <td class="td">
                                {{ item.qty }}
                              </td>
                              <td class="td">
                                {{
                                  item.rate.toLocaleString(userLocale, {
                                    style: "currency",
                                    currency: invoiceForm.selected_currency,
                                  })
                                }}
                              </td>
                              <td class="td">
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
                            </tr>
                            <tr>
                              <td colspan="2" class="text-right">
                                <strong>Subtotal</strong>
                              </td>
                              <td colspan="3" class="text-right">
                                <span class="">
                                  {{
                                    invoiceForm.sub_total.toLocaleString(
                                      userLocale,
                                      {
                                        style: "currency",
                                        currency: invoiceForm.selected_currency,
                                      }
                                    )
                                  }}
                                </span>
                              </td>
                            </tr>
                            <tr v-if="invoiceForm.is_invoice_vat_applied">
                              <td colspan="2" class="text-right">
                                <span></span>
                                <label for="is_vat_applied"
                                  ><strong>VAT (%)</strong></label
                                >
                              </td>
                              <td colspan="3" class="text-right border-bottom">
                                <span class="">
                                  {{ invoiceForm.vat_value }}
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
                                  {{
                                    invoiceForm.total.toLocaleString(
                                      userLocale,
                                      {
                                        style: "currency",
                                        currency: invoiceForm.selected_currency,
                                      }
                                    )
                                  }}
                                </span>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <template v-if="invoiceForm.invoice_notes">
                        <hr class="my-5" />
                        <h6 class="text-uppercase">Notes</h6>
                        <p class="mb-0 text-muted">
                          {{ invoiceForm.invoice_notes }}
                        </p>
                      </template>
                      <template v-if="invoiceForm.client.bank_details">
                        <!-- <hr class="my-5" /> -->
                        <h6 class="mt-4 text-uppercase">Bank Details</h6>
                        <p class="mb-0 text-muted">
                          {{ invoiceForm.client.bank_details }}
                        </p>
                      </template>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </vue-html2pdf>
  </div>
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
          id: "",
          name: "",
          email: "",
          phone_number: "",
          state: "",
          company: "",
          country: "",
          address: "",
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
        invoice_notes: ``,
        invoice_terms: null,
        invoice_no: null,
        selected_currency: "USD",
        invoice_type: "invoice", // "invoice" | "expense"
        sub_total: 0,
        total: 0,
      }),
      invoice_logo_url: "/images/sitelogo.jpeg",
      invoiceLogo: [],
      currency: [{ name: "USD" }, { name: "EUR" }, { name: "ALL" }],
      invoice_due_date_add_days: 15,
      hideInvoiceLogo: false,
      changes_not_saved: false,
      is_creating_invoice: true,
      userLocale: "en",
    };
  },
  beforeMount() {
    const invoiceData = this.invoice.data;
    if (invoiceData) {
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
    }
  },
  methods: {
    // methods for pdf plugin
    onProgress(event) {},
    hasStartedGeneration() {},
    hasGenerated(event) {},
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
              pdf.internal.pageSize.getWidth(),
              pdf.internal.pageSize.getHeight()
            );
          }
        })
        .save();
    },
  },
};
</script>

<style>
.download-btn {
  position: fixed;
  top: 10px;
  right: 20px;
  z-index: 9999999;
}
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

