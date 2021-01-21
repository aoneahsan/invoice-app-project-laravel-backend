require("./bootstrap");

require("moment");

import Vue from "vue";

import { InertiaApp } from "@inertiajs/inertia-vue";
import { InertiaForm } from "laravel-jetstream";
import PortalVue from "portal-vue";
import VueLoading from "vue-element-loading";
import VueYoutube from "vue-youtube";
import Toasted from "vue-toasted";
import { InertiaProgress } from "@inertiajs/progress";
import { HasError, AlertError, AlertErrors, AlertSuccess } from "vform";
import Popover from "vue-js-popover"; //https://github.com/euvl/vue-js-popover
import Clipboard from "v-clipboard"; //https://github.com/euvl/v-clipboard
import ToggleButton from "vue-js-toggle-button"; //https://github.com/euvl/vue-js-toggle-button
import Notifications from "vue-notification"; // https://github.com/euvl/vue-notification
import VModal from "vue-js-modal"; // https://euvl.github.io/vue-js-modal/
import Icon from "vue-awesome/components/Icon"; //https://github.com/Justineo/vue-awesome
import Vuetable from "vuetable-2"; // https://www.vuetable.com/guide/getting-started.html
import SvgTransition from "vue-svg-transition"; //https://github.com/kai-oswald/vue-svg-transition
// import { AgGridVue } from "ag-grid-vue"; //https://www.ag-grid.com/documentation/vue/getting-started/
// import Vuesax from "vuesax"; // https://github.com/lusaxweb/vuesax
// import vSelect from "vue-select"; //https://vue-select.org/guide/install.html#yarn-npm

// CSS / STYLES IMPORTS
import "vue-awesome/icons"; // https://github.com/Justineo/vue-awesome
// import "./../../node_modules/ag-grid-community/dist/styles/ag-grid.css"; //https://www.ag-grid.com/documentation/vue/getting-started/
// import "./../../node_modules/ag-grid-community/dist/styles/ag-theme-alpine.css"; //https://www.ag-grid.com/documentation/vue/getting-started/
// import "vuesax/dist/vuesax.css"; // https://github.com/lusaxweb/vuesax
// import "vue-select/dist/vue-select.css"; //https://vue-select.org/guide/install.html#yarn-npm

// custom global components
import FrontendMain from "./Layouts/FrontendMain";
import PageLoader from "./GlobalComponents/PageLoader/PageLoader";

Vue.mixin({ methods: { route } });
Vue.use(InertiaApp);
Vue.use(InertiaForm);
Vue.use(PortalVue);
Vue.component("VueLoading", VueLoading); // https://www.npmjs.com/package/vue-element-loading
Vue.use(VueYoutube, { global: true, componentId: "youtube" }); // https://www.npmjs.com/package/vue-youtube
Vue.use(Toasted); // https://www.npmjs.com/package/vue-toasted
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
Vue.component(AlertErrors.name, AlertErrors);
Vue.component(AlertSuccess.name, AlertSuccess);
Vue.use(Popover);
Vue.use(Clipboard);
Vue.use(Notifications);
Vue.use(VModal);
Vue.use(ToggleButton);
Vue.component("v-icon", Icon);
Vue.component("vuetable", Vuetable);
Vue.use(SvgTransition);
// Vue.component("AgGridVue", AgGridVue);
// Vue.use(Vuesax);
// Vue.component("v-select", vSelect); //https://vue-select.org/guide/install.html#yarn-npm

// Custom Defined Components
Vue.component("FrontendMain", FrontendMain);
Vue.component("PageLoader", PageLoader);
const app = document.getElementById("app");

// default toasts
Vue.toasted.register("successM", "Request Successfully Completed.", {
    closeOnSwipe: true,
    position: "bottom-right", //['top-right', 'top-center', 'top-left', 'bottom-right', 'bottom-center', 'bottom-left']
    duration: 5000,
    keepOnHover: true,
    fullWidth: false,
    fitToScreen: false,
    // className: "", //Custom css class name of the toast
    // containerClass: "", // Custom css classes for toast container
    iconPack: "fontawesome", // ['material', 'fontawesome', 'mdi', 'custom-class', 'callback']
    icon: "fa-user", // for icons got to   "https://shakee93.github.io/vue-toasted/"
    type: "success",
    theme: "toasted-primary", //['toasted-primary', 'outline', 'bubble']
    // onComplete: () => {},
    singleton: false // Only allows one toast at a time.
});
Vue.toasted.register("warningM", "You are not allowed to do this action.", {
    closeOnSwipe: true,
    position: "bottom-right", //['top-right', 'top-center', 'top-left', 'bottom-right', 'bottom-center', 'bottom-left']
    duration: 5000,
    keepOnHover: true,
    fullWidth: false,
    fitToScreen: false,
    // className: "", //Custom css class name of the toast
    // containerClass: "", // Custom css classes for toast container
    iconPack: "fontawesome", // ['material', 'fontawesome', 'mdi', 'custom-class', 'callback']
    icon: "warning", // for icons got to   "https://shakee93.github.io/vue-toasted/"
    type: "warning",
    theme: "toasted-primary", //['toasted-primary', 'outline', 'bubble']
    // onComplete: () => {},
    singleton: false // Only allows one toast at a time.
});
Vue.toasted.register("errorM", "Oops.. Something Went Wrong..", {
    closeOnSwipe: true,
    position: "bottom-right", //['top-right', 'top-center', 'top-left', 'bottom-right', 'bottom-center', 'bottom-left']
    duration: 5000,
    keepOnHover: true,
    fullWidth: false,
    fitToScreen: false,
    // className: "", //Custom css class name of the toast
    // containerClass: "", // Custom css classes for toast container
    iconPack: "material", // ['material', 'fontawesome', 'mdi', 'custom-class', 'callback']
    icon: "error", // for icons got to   "https://shakee93.github.io/vue-toasted/"
    type: "error",
    theme: "toasted-primary", //['toasted-primary', 'outline', 'bubble']
    // onComplete: () => {},
    singleton: false // Only allows one toast at a time.
});

// Inertia Page Loader Progress bar
// InertiaProgress.init();

new Vue({
    render: h =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: name => require(`./Pages/${name}`).default
            }
        })
}).$mount(app);
