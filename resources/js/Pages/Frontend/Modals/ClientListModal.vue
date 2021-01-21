<template>
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">
        Set the client for this invoice
      </h5>
    </div>
    <div
      class="modal-body d-flex"
      v-for="(client, index) in clients"
      :key="index"
    >
      <div class="btn-rounded-circle badge-primary">
        <div class="ml-3 mt-2">
          {{ client.full_name.substring(0, 2) }}
        </div>
      </div>
      <div
        class="font-weight-bold ml-4 select-client"
        data-dismiss="modal"
        @click="addClient(index)"
      >
        {{ client.full_name }}
        <div>
          {{ client.email }}
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" @click="openAddClientModal" class="btn btn-primary w-100">
        Create New Client
      </button>
    </div>
  </div>
</template>

<script>
import AddClientModal from "./../Modals/AddClientModal";
export default {
  props: ["clients"],
  data() {
    return {};
  },
  methods: {
    openAddClientModal() {
      this.$modal.show(
        AddClientModal,
        {},
        {
          height: "auto",
          // adaptive: true,
          scrollable: true,
          focusTrap: true,
          reset: true,
          classes: "",
        },
        {}
      );
    },
  },
};
</script>

<style>
</style>