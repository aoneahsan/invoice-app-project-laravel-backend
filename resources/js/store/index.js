import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex); //https://vuex.vuejs.org/installation.html#yarn

const store = new Vuex.Store({
    state: {
        count: 0
    },
    mutations: {
        increment(state) {
            state.count++;
        }
    }
});

export default store;
