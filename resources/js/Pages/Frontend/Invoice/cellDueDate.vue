<template>
  <span>
    {{ data.due_date | moment("MMMM, Do YYYY") }}
  </span>
</template>
<script>
export default {
  props: {
    data: {},
    date: null,
  },
  created() {
    // console.log("data - ", this.data);
  },
};
</script>
