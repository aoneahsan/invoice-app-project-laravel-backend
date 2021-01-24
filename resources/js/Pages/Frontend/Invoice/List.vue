<template>
  <FrontendMain>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">User Invoices</h2>
    </template>
    <div class="col-12 py-8">
      <div class="container">
        <div class="col-12 pb-6">
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
          label: "User",
          name: "user.name",
          orderable: false,
        },
        {
          label: "Client",
          name: "client.name",
          orderable: false,
        },
        {
          name: "subtotal",
          orderable: true,
          label: "Subtotal",
        },
        {
          name: "total",
          label: "Total",
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
    deleteSelectedRow(data) {
      if (confirm("Do you want to delete '" + data.name + "' client?")) {
        axios
          .delete(`/user/clients/${data.id}`)
          .then((res) => {
            this.$notify({
              group: "app",
              type: "danger",
              title: "Request Successfull",
              text: "Client Deleted Successfully.",
              duration: 5000,
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
                duration: 5000,
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
