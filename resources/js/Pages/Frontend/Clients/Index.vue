<template>
  <FrontendMain>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Clients
      </h2>
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
    <vuetable
      ref="vuetable"
      :fields="tableFields"
      :api-mode="false"
      :data="tableData"
    ></vuetable>
  </FrontendMain>
</template>

<script>
export default {
  data() {
    return {
      tableFields: [
        {
          name: "name",
          sortField: "name",
        },
        {
          name: "email",
          title: "Email Address",
        },
        {
          name: "birthdate",
          sortField: "birthdate",
          titleClass: "center aligned",
          dataClass: "center aligned",
        },
        {
          name: "gender",
          sortField: "gender",
          titleClass: "center aligned",
          dataClass: "center aligned",
          formatter(value) {
            return value === "M" ? "Male" : "Female";
          },
        },
      ],
      tableData: null,
    };
  },
  components: {},
  watch: {},
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
  },
};
</script>

<style>
</style>
