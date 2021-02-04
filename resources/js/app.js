// require imports
require("./bootstrap");
require("moment");
const VueUploadComponent = require("vue-upload-component"); //https://lian-yue.github.io/vue-upload-component/#/en/documents

import Vue from "vue";
import { InertiaApp } from "@inertiajs/inertia-vue";
import { InertiaForm } from "laravel-jetstream";
import PortalVue from "portal-vue";
import VueLoading from "vue-element-loading";
import VueYoutube from "vue-youtube";
// import Toasted from "vue-toasted";
// import { InertiaProgress } from "@inertiajs/progress";
import { HasError, AlertError, AlertErrors, AlertSuccess } from "vform";
import Popover from "vue-js-popover"; //https://github.com/euvl/vue-js-popover
import Clipboard from "v-clipboard"; //https://github.com/euvl/v-clipboard
import ToggleButton from "vue-js-toggle-button"; //https://github.com/euvl/vue-js-toggle-button
import Notifications from "vue-notification"; // https://github.com/euvl/vue-notification
import VModal from "vue-js-modal"; // https://euvl.github.io/vue-js-modal/
import Icon from "vue-awesome/components/Icon"; //https://github.com/Justineo/vue-awesome
// import Vuetable from "vuetable-2"; // https://www.vuetable.com/guide/getting-started.html
import SvgTransition from "vue-svg-transition"; //https://github.com/kai-oswald/vue-svg-transition
// import { AgGridVue } from "ag-grid-vue"; //https://www.ag-grid.com/documentation/vue/getting-started/
// import Vuesax from "vuesax"; // https://github.com/lusaxweb/vuesax
// import vSelect from "vue-select"; //https://vue-select.org/guide/install.html#yarn-npm
import DataTable from "laravel-vue-datatable"; //https://jamesdordoy.github.io/laravel-vue-datatable/
import VueHtml2pdf from "vue-html2pdf"; //https://www.npmjs.com/package/vue-html2pdf
import vueCountryRegionSelect from "vue-country-region-select"; //https://www.npmjs.com/package/vue-country-region-select
// import Vuex from "vuex"; //https://vuex.vuejs.org/installation.html#yarn
import VueCurrencyInput from "vue-currency-input"; //https://dm4t2.github.io/vue-currency-input/guide/#installation

// other packages imports
import "es6-promise/auto"; //https://github.com/stefanpenner/es6-promise

// CSS / STYLES IMPORTS
import "vue-awesome/icons"; // https://github.com/Justineo/vue-awesome
// import "./../../node_modules/ag-grid-community/dist/styles/ag-grid.css"; //https://www.ag-grid.com/documentation/vue/getting-started/
// import "./../../node_modules/ag-grid-community/dist/styles/ag-theme-alpine.css"; //https://www.ag-grid.com/documentation/vue/getting-started/
// import "vuesax/dist/vuesax.css"; // https://github.com/lusaxweb/vuesax
// import "vue-select/dist/vue-select.css"; //https://vue-select.org/guide/install.html#yarn-npm

// Vuex Store Custom Imports
import store from "./store/index";

// custom global components
import FrontendMain from "./Layouts/FrontendMain";
import PageLoader from "./GlobalComponents/PageLoader/PageLoader";

Vue.mixin({ methods: { route } });
Vue.use(InertiaApp);
Vue.use(InertiaForm);
Vue.use(PortalVue);
Vue.component("VueLoading", VueLoading); // https://www.npmjs.com/package/vue-element-loading
Vue.use(VueYoutube, { global: true, componentId: "youtube" }); // https://www.npmjs.com/package/vue-youtube
// Vue.use(Toasted); // https://www.npmjs.com/package/vue-toasted
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
Vue.component(AlertErrors.name, AlertErrors);
Vue.component(AlertSuccess.name, AlertSuccess);
Vue.use(Popover); //https://github.com/euvl/vue-js-popover
Vue.use(Clipboard); //https://github.com/euvl/v-clipboard
Vue.use(Notifications); // https://github.com/euvl/vue-notification
Vue.use(VModal, { dialog: true }); // https://euvl.github.io/vue-js-modal/
Vue.use(ToggleButton);
ToggleButton;
Vue.component("v-icon", Icon); //https://github.com/Justineo/vue-awesome
Vue.use(SvgTransition); //https://github.com/kai-oswald/vue-svg-transition
// Vue.component("AgGridVue", AgGridVue);
// Vue.use(Vuesax);
// Vue.component("v-select", vSelect); //https://vue-select.org/guide/install.html#yarn-npm
Vue.use(DataTable); //https://jamesdordoy.github.io/laravel-vue-datatable/
Vue.use(VueHtml2pdf); //https://www.npmjs.com/package/vue-html2pdf
Vue.use(vueCountryRegionSelect); //https://www.npmjs.com/package/vue-country-region-select
Vue.component("file-upload", VueUploadComponent); //https://lian-yue.github.io/vue-upload-component/#/en/documents
const VueCurrencyInput_pluginOptions = {//https://dm4t2.github.io/vue-currency-input/guide/#installation
    /* see config reference */
    globalOptions: { currency: "USD" }
}; 
Vue.use(VueCurrencyInput, VueCurrencyInput_pluginOptions); //https://dm4t2.github.io/vue-currency-input/guide/#installation

// Custom Defined Components
Vue.component("FrontendMain", FrontendMain);
Vue.component("PageLoader", PageLoader);
const app = document.getElementById("app");

// Inertia Page Loader Progress bar
// InertiaProgress.init();

new Vue({
    render: h =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: name => require(`./Pages/${name}`).default
            }
        }),
    store: store
}).$mount(app);
