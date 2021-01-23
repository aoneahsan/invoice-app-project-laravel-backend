<template>
  <modal
    name="addClientModal"
    :scrollable="true"
    height="auto"
    :focusTrap="true"
    :reset="true"
  >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add New Client</h5>
      </div>
      <div class="modal-body">
        <form @submit.prevent="addClient">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label text-muted"
              >Full Name (required)</label
            >
            <input
              type="text"
              v-model="clientform.full_name"
              class="form-control"
              id="recipient-name"
              required
            />
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label text-muted"
              >E-mail address (required)</label
            >
            <input
              type="email"
              v-model="clientform.email"
              class="form-control"
              id="recipient-name"
              required
            />
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label text-muted"
              >Client's Address (required)</label
            >
            <input
              type="text"
              v-model="clientform.address"
              class="form-control"
              id="recipient-name"
              required
            />
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-form-label text-muted"
              >Client's Company</label
            >
            <input
              type="text"
              v-model="clientform.company"
              class="form-control"
              id="recipient-name"
              required
            />
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label text-muted"
              >Country</label
            >
            <input
              type="text"
              v-model="clientform.country"
              class="form-control"
              id="recipient-name"
              required
            />
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label text-muted"
              >Phone:</label
            >
            <input
              type="number"
              v-model="clientform.phone"
              class="form-control"
              id="recipient-name"
              required
            />
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary w-100">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </modal>
</template>

<script>
import { Form } from "vform";
export default {
  name: "addClientModal",
  data() {
    return {
      clientform: new Form({
        full_name: "as",
        email: "as@as.as",
        address: "as",
        company: "as",
        country: "as",
        phone: "12",
      }),
    };
  },
  methods: {
    addClient() {
      this.$modal.hide("addClientModal");
      console.log("event fired");
      // this.clientform
      //   .post("/clients")
      //   .then((res) => {
      //     if (res) {
      //       this.$notify({
      //         group: "app",
      //         type: "success",
      //         title: "Request Successfull",
      //         text: "Client Added Successfully.",
      //         duration: 70000,
      //         speed: 1000,
      //       });
      //       this.$emit("event_clientAdded");
      //     }
      //   })
      //   .catch((err) => {
      //   if (err) {
      //     this.$notify({
      //       group: "app",
      //       type: "error",
      //       title: "Request Faild",
      //       text: err.message,
      //       duration: 70000,
      //       speed: 1000,
      //     });
      //   }
      // });
    },
  },
};
</script>

<style>
</style>