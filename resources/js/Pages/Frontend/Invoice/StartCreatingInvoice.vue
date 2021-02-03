<template>
  <PageLoader :show="true" :time="1000000" />
</template>

<script>
export default {
  mounted() {
    if (this.$page.user) {
        this.createInvoice();
    } else {
      alert("Kindly Login to continue!");
      this.$inertia.visit("/sign-in");
    }
  },
  beforeMount() {},
  methods: {
    createInvoice() {
      axios
        .post("/user/invoices")
        .then((res) => {
          const invoice = res.data.data;
          this.$inertia.visit("/invoices/" + invoice.invoice_unique_id);
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
  },
};
</script>

<style>
</style>