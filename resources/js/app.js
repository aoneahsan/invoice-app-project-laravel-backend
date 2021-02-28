// require imports
require("./bootstrap");
require("moment");
const VueUploadComponent = require("vue-upload-component"); //https://lian-yue.github.io/vue-upload-component/#/en/documents

import Vue from "vue";
import { InertiaApp } from "@inertiajs/inertia-vue";
import { InertiaForm } from "laravel-jetstream";
import PortalVue from "portal-vue";
import { HasError, AlertError, AlertErrors, AlertSuccess } from "vform";//https://www.npmjs.com/package/vform
import VueHtml2pdf from "vue-html2pdf"; //https://www.npmjs.com/package/vue-html2pdf
import vueCountryRegionSelect from "vue-country-region-select"; //https://www.npmjs.com/package/vue-country-region-select
import VueCurrencyInput from "vue-currency-input"; //https://dm4t2.github.io/vue-currency-input/guide/#installation
import VModal from "vue-js-modal"; // https://euvl.github.io/vue-js-modal/
import Notifications from "vue-notification"; // https://github.com/euvl/vue-notification
import Icon from "vue-awesome/components/Icon"; //https://github.com/Justineo/vue-awesome
import DataTable from "laravel-vue-datatable"; //https://jamesdordoy.github.io/laravel-vue-datatable/

// CSS / STYLES IMPORTS
import "vue-awesome/icons"; // https://github.com/Justineo/vue-awesome
// Vuex Store Custom Imports
import store from "./store/index";

// custom global components
import FrontendMain from "./Layouts/FrontendMain";

Vue.mixin({ methods: { route } });
Vue.use(InertiaApp);
Vue.use(InertiaForm);
Vue.use(PortalVue);
Vue.component(HasError.name, HasError);//https://www.npmjs.com/package/vform
Vue.component(AlertError.name, AlertError);//https://www.npmjs.com/package/vform
Vue.component(AlertErrors.name, AlertErrors);//https://www.npmjs.com/package/vform
Vue.component(AlertSuccess.name, AlertSuccess);//https://www.npmjs.com/package/vform
Vue.component("v-icon", Icon); //https://github.com/Justineo/vue-awesome
Vue.use(vueCountryRegionSelect); //https://www.npmjs.com/package/vue-country-region-select
Vue.use(Notifications); // https://github.com/euvl/vue-notification
Vue.use(VModal, { dialog: true }); // https://euvl.github.io/vue-js-modal/
Vue.component("file-upload", VueUploadComponent); //https://lian-yue.github.io/vue-upload-component/#/en/documents
Vue.use(DataTable); //https://jamesdordoy.github.io/laravel-vue-datatable/
Vue.use(VueHtml2pdf); //https://www.npmjs.com/package/vue-html2pdf
const VueCurrencyInput_pluginOptions = {//https://dm4t2.github.io/vue-currency-input/guide/#installation
    /* see config reference */
    globalOptions: { currency: "USD" }
}; 
Vue.use(VueCurrencyInput, VueCurrencyInput_pluginOptions); //https://dm4t2.github.io/vue-currency-input/guide/#installation

// Custom Defined Components
Vue.component("FrontendMain", FrontendMain);

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
