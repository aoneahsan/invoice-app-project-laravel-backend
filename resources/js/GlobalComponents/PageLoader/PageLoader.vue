<template>
  <!-- https://www.npmjs.com/package/vue-element-loading -->
  <vue-loading background-color="rgba(0,0,0,.45)" :active="loadingStatus">
    <!-- <img
      class="img-responsive page-loading-img"
      src="images/sitelogo.jpeg"
      width="80px"
      height="auto"
    /> -->
    <div class="lds-facebook"><div></div><div></div><div></div></div>
  </vue-loading>
</template>

<script>
export default {
  props: {
    show: Boolean,
    time: Number,
  },
  data() {
    return {
      loadingStatus: this.show,
    };
  },
  beforeMount() {},
  created() {
    setTimeout(() => {
      this.loadingStatus = false;
    }, this.time);
  },
};
</script>

<style>
.velmld-spinner {
  transform: none !important;
}
.page-loading-img {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  margin: auto;
  z-index: 11111111;
}
.lds-facebook {
  display: inline-block;
  position: relative;
  width: 80px;
  height: 80px;
}
.lds-facebook div {
  display: inline-block;
  position: absolute;
  left: 8px;
  width: 16px;
  background: #fff;
  animation: lds-facebook 1.2s cubic-bezier(0, 0.5, 0.5, 1) infinite;
}
.lds-facebook div:nth-child(1) {
  left: 8px;
  animation-delay: -0.24s;
}
.lds-facebook div:nth-child(2) {
  left: 32px;
  animation-delay: -0.12s;
}
.lds-facebook div:nth-child(3) {
  left: 56px;
  animation-delay: 0;
}
@keyframes lds-facebook {
  0% {
    top: 8px;
    height: 64px;
  }
  50%, 100% {
    top: 24px;
    height: 32px;
  }
}

</style>