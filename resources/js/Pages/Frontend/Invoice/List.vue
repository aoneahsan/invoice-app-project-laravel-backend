<template>
  <FrontendMain>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">User Invoices</h2>
    </template>
    <div class="py-8 col-12">
      <div class="container">
        <div class="pb-6 col-12">
          <inertia-link :href="route('createinvoice')" class="btn btn-primary lift">
            Create Invoice
          </inertia-link>
        </div>
        <div class="col-12">
          <data-table ref="datatable" :columns="columns" url="/user/invoices">
          </data-table>
        </div>
      </div>
    </div>
  </FrontendMain>
</template>

<script>
import cellDeleteInvoice from "./cellDeleteInvoice";
import cellViewInvoice from "./cellViewInvoice";
import cellDueDate from "./cellDueDate";
export default {
  data() {
    return {
      columns: [
        {
          label: "ID",
          name: "id",
          orderable: true,
        },
        {
          label: "Invoice Number",
          name: "invoice_no",
          orderable: true,
        },
        // {
        //   label: "Invoice Date",
        //   name: "date",
        //   orderable: false,
        // },
        {
          label: "Due Date",
          name: "due_date",
          orderable: false,
          component: cellDueDate
        },
        {
          label: "Currency",
          name: "selected_currency",
          orderable: true,
        },
        // {
        //   label: "Invoice VAT",
        //   name: "vat_value",
        //   orderable: false,
        // },
        // {
        //   label: "Is VAT Applied",
        //   name: "is_invoice_vat_applied",
        //   orderable: false,
        // },
        {
          name: "sub_total",
          orderable: true,
          label: "Subtotal",
        },
        {
          name: "total",
          label: "Total",
        },
        {
          label: "",
          name: "View",
          orderable: false,
          classes: {
            btn: true,
            "btn-primary": true,
            "btn-sm": true,
            lift: true,
          },
          event: "click",
          handler: this.viewSelectedRow,
          component: cellViewInvoice,
        },
        {
          label: "",
          name: "Delete",
          orderable: false,
          classes: {
            btn: true,
            "btn-danger": true,
            "btn-sm": true,
            lift: true,
          },
          event: "click",
          handler: this.deleteSelectedRow,
          component: cellDeleteInvoice,
        },
      ],
    };
  },
  methods: {
    // other methods
    openAddClientModal() {
      this.$modal.show("addClientModal");
    },
    viewSelectedRow(data) {
      this.$inertia.visit("/invoices/" + data.invoice_unique_id);
    },
    deleteSelectedRow(data) {
      if (confirm("Do you want to delete '" + data.name + "' client?")) {
        axios
          .delete(`/user/invoices/${data.id}`)
          .then((res) => {
            this.$notify({
              group: "app",
              type: "danger",
              title: "Request Successfull",
              text: "Client Deleted Successfully.",
              duration: 7000,
              speed: 1000,
              closeOnClick: true,
            });
            this.$refs.datatable.getData();
          })
          .catch((err) => {
            if (err) {
              this.$notify({
                group: "app",
                type: "error",
                title: "Request Faild",
                text: err.message,
                duration: 7000,
                speed: 1000,
                closeOnClick: true,
              });
            }
          });
      }
    },
  },
  mounted() {
    EventBus.$on("event_clientAdded", () => {
      this.$refs.datatable.getData();
    });
  },
};
</script>

<style>
</style>
