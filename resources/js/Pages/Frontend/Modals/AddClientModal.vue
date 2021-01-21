<template>
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Add New Client</h5>
    </div>
    <div class="modal-body">
      <form>
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
          <button
            @click="createClient()"
            data-dismiss="modal"
            class="btn btn-primary w-100"
          >
            Submit
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { Form } from "vform";
export default {
  data() {
    return {
      clientform: new Form({
        full_name: "",
        email: "",
        address: "",
        company: "",
        country: "",
        phone: "",
      }),
    };
  },
  methods: {
  }
};
</script>

<style>
</style>