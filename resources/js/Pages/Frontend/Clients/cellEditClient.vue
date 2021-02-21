<template>
  <button :class="classes" @click="click(data)" title="Update" class="btn-min">
    <v-icon name="edit"></v-icon>
    {{ name }}
  </button>
</template>
<script>
export default {
  props: {
    data: {},
    name: {},
    click: {
      type: Function,
      default: () => {},
    },
    classes: {
      type: Object,
      default: () => ({
        btn: true,
        "btn-info": true,
        "btn-sm": true,
        lift: true,
      }),
    },
  },
};
</script>