<template>
  <FrontendMain>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Clients</h2>
    </template>
    <div class="col-12 py-8">
      <div class="container">
        <div class="col-12 pb-6">
          <button @click="openAddClientModal" class="btn btn-primary lift">
            Add Client
          </button>
        </div>
        <div class="col-12">
          <data-table ref="datatable" :columns="columns" url="/user/clients">
          </data-table>
        </div>
      </div>
    </div>
  </FrontendMain>
</template>

<script>
import Axios from "axios";
import cellDeleteClient from "./cellDeleteClient";
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
          label: "Name",
          name: "name",
          orderable: true,
        },
        {
          label: "Email",
          name: "email",
          orderable: true,
        },
        {
          name: "phone_number",
          orderable: false,
          label: "Phone Number",
        },
        {
          name: "address",
          label: "Address",
        },
        {
          name: "country",
          label: "Country",
        },
        {
          name: "company",
          label: "Company",
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
          handler: this.displayRow,
          component: cellDeleteClient,
        },
      ],
    };
  },
  methods: {
    // other methods
    openAddClientModal() {
      this.$modal.show("addClientModal");
    },
    displayRow(data) {
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
