<template>
  <FrontendMain>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Clients</h2>
    </template>
    <!-- <vuetable ref="vuetable"
    api-url="https://vuetable.ratiw.net/api/users"
    :fields="['name', 'nickname', 'email', 'gender']"
    data-path=""
    pagination-path=""
  ></vuetable> -->
    <!-- <vuetable
      ref="vuetable"
      :fields="['name', 'nickname', 'email', 'gender']"
      :api-mode="false"
      :data="tableData"
    ></vuetable> -->
    <div class="col-12 py-8">
      <div class="container">
        <div class="col-12 pb-6">
          <button @click="openAddClientModal" class="btn btn-primary lift">
            Add Client
          </button>
        </div>
        <div class="col-12">
          <vuetable
            ref="vuetable"
            :fields="tableFields"
            :api-mode="false"
            :api-url="'/user/clients'"
            :data="tableData"
            @vuetable:pagination-data="onPaginationData"
          ></vuetable>
        </div>
      </div>
    </div>
  </FrontendMain>
</template>

<script>
export default {
  data() {
    return {
      tableFields: [
        {
          name: "id",
          title: "ID",
          sortField: "id",
        },
        {
          name: "name",
          title: "Name",
          sortField: "name",
        },
        {
          name: "email",
          title: "Email Address",
          sortField: "email",
        },
        {
          name: "phone_number",
          sortField: "phone_number",
          title: "Phone Number",
          // titleClass: "center aligned",
          // dataClass: "center aligned",
        },
        {
          name: "address",
          title: "Address",
        },
        {
          name: "country",
          title: "Country",
        },
        {
          name: "company",
          title: "Company",
        },
      ],
      tableData: null,
    };
  },
  components: {},
  watch: {},
  created() {
    axios
      .get("/user/clients")
      .then((res) => {
        this.tableData = res.data.data;
      })
      .catch((err) => {
        console.log(
          "client list component === loading clients data == err = ",
          err
        );
      });
  },
  mounted() {
    axios
      .get("/user/clients")
      .then((res) => {
        if (res) {
          this.tableData = res.data.data;
        }
      })
      .catch((err) => {
        if (err) {
          this.$notify({
            group: "app",
            type: "error",
            title: "Request Faild",
            text: err.message,
            duration: 10000,
            speed: 1000,
          });
        }
      });

    // Listen for events
  },
  methods: {
    // other methods
    openAddClientModal() {
      this.$modal.show("addClientModal");
    },
    onPaginationData(paginationData) {
      this.$refs.pagination.setPaginationData(paginationData);
    },
    // when the user click something that causes the page to change,
    // call "changePage" method in Vuetable, so that that page will be
    // requested from the API endpoint.
    onChangePage(page) {
      this.$refs.vuetable.changePage(page);
    },
  },
  mounted() {
    EventBus.$on("customEvent", () => {
      this.$refs.vuetable.reload();
    });
  },
};
</script>

<style>
</style>
