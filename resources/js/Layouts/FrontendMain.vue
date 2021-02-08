<template>
  <div class="min-h-screen bg-gray-100">
    <nav class="bg-white border-b border-gray-100">
      <!-- Primary Navigation Menu -->
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
          <div class="flex">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
              <inertia-link :href="route('createinvoice')">
                <jet-application-mark class="block h-9 w-auto" />
              </inertia-link>
            </div>

            <!-- Navigation Links -->
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
              <jet-nav-link
                :href="route('createinvoice')"
                :active="route().current('createinvoice')"
              >
                Create Invoice
              </jet-nav-link>
              <jet-nav-link
                :href="route('invoices.view')"
                :active="route().current('invoices.view')"
              >
                Invoices
              </jet-nav-link>
              <jet-nav-link
                :href="route('clients.view')"
                :active="route().current('clients.view')"
              >
                Clients
              </jet-nav-link>
            </div>
          </div>

          <!-- Settings Dropdown -->
          <div class="hidden sm:flex sm:items-center sm:ml-6">
            <div class="ml-3 relative">
              <jet-dropdown align="right" width="48">
                <template #trigger>
                  <button
                    class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out"
                  >
                    <div v-if="!$page.user">Login/Register</div>
                    <div v-if="$page.user">Account</div>

                    <div class="ml-1">
                      <svg
                        class="fill-current h-4 w-4"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                          clip-rule="evenodd"
                        />
                      </svg>
                    </div>
                  </button>
                </template>

                <template #content>
                  <!-- Account Management -->
                  <template v-if="!$page.user">
                    <div class="block px-4 py-2 text-xs text-gray-400">
                      Get Started
                    </div>

                    <jet-dropdown-link href="/sign-in">Login</jet-dropdown-link>
                    <jet-dropdown-link href="/sign-up"
                      >Register</jet-dropdown-link
                    >
                  </template>
                  <template v-if="$page.user">
                    <div class="block px-4 py-2 text-xs text-gray-400">
                      Manage Account
                    </div>

                    <jet-dropdown-link :href="route('user.profile')">
                      Profile
                    </jet-dropdown-link>

                    <div class="border-t border-gray-100"></div>

                    <!-- Authentication -->
                    <form @submit.prevent="logout">
                      <jet-dropdown-link as="button">
                        Logout
                      </jet-dropdown-link>
                    </form></template
                  >
                </template>
              </jet-dropdown>
            </div>
          </div>

          <!-- Hamburger -->
          <div class="-mr-2 flex items-center sm:hidden">
            <button
              @click="showingNavigationDropdown = !showingNavigationDropdown"
              class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
            >
              <svg
                class="h-6 w-6"
                stroke="currentColor"
                fill="none"
                viewBox="0 0 24 24"
              >
                <path
                  :class="{
                    hidden: showingNavigationDropdown,
                    'inline-flex': !showingNavigationDropdown,
                  }"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16"
                />
                <path
                  :class="{
                    hidden: !showingNavigationDropdown,
                    'inline-flex': showingNavigationDropdown,
                  }"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M6 18L18 6M6 6l12 12"
                />
              </svg>
            </button>
          </div>
        </div>
      </div>

      <!-- Responsive Navigation Menu -->
      <div
        :class="{
          block: showingNavigationDropdown,
          hidden: !showingNavigationDropdown,
        }"
        class="sm:hidden"
      >
        <div class="pt-2 pb-3 space-y-1">
          <jet-responsive-nav-link
            :href="route('createinvoice')"
            active="route().current('createinvoice')"
          >
            createinvoice
          </jet-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
          <div class="flex items-center px-4">
            <div class="ml-3">
              <div class="font-medium text-base text-gray-800">
                Account Menu
              </div>
            </div>
          </div>

          <div class="mt-3 space-y-1">
            <jet-responsive-nav-link
              :href="route('user.profile')"
              :active="route().current('user.profile')"
            >
              Profile
            </jet-responsive-nav-link>

            <!-- Authentication -->
            <form method="POST" @submit.prevent="logout">
              <jet-responsive-nav-link as="button">
                Logout
              </jet-responsive-nav-link>
            </form>
          </div>
        </div>
      </div>
    </nav>

    <!-- Page Heading -->
    <header class="bg-white shadow">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <slot name="header"></slot>
      </div>
    </header>

    <!-- Page Content -->
    <main>
      <slot></slot>
    </main>

    <!-- Modal Portal -->
    <portal-target name="modal" multiple> </portal-target>

    <!-- Notifications -->
    <notifications group="app" position="bottom right">
      <template slot="body" slot-scope="props">
        <div>
          <a class="title">
            {{ props.item.title }}
          </a>
          <a class="close" @click="props.close">
            <i class="fa fa-fw fa-close"></i>
          </a>
          <div v-html="props.item.text"></div>
        </div>
      </template>
    </notifications>

    <!-- Modals -->
    <!-- Clients List Modal -->
    <modal
      name="ClientsListModal"
      :scrollable="true"
      height="auto"
      :focusTrap="true"
      :reset="true"
    >
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Set the client for this invoice</h5>
        </div>
        <div
          class="modal-body d-flex user_selectable"
          v-for="(client, index) in $page.clients"
          @click="selectClient(index)"
          :key="index"
        >
          <div class="btn-rounded-circle badge-primary">
            <div class="ml-3 mt-2">
              {{ client.name.substring(0, 2) }}
            </div>
          </div>
          <div
            class="font-weight-bold ml-4 select-client"
            data-dismiss="modal"
            @click="selectClient(index)"
          >
            {{ client.name }}
            <div>
              {{ client.email }}
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button
            type="button"
            @click="openAddClientModal"
            class="btn btn-primary w-100"
          >
            Create New Client
          </button>
        </div>
      </div>
    </modal>
    <!-- Add Client Modal -->
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
            <!-- name* -->
            <div class="form-group">
              <label for="recipient-name" class="col-form-label text-muted"
                >Full Name*</label
              >
              <input
                type="text"
                v-model="addClientform.name"
                class="form-control"
                :class="{ 'is-invalid': addClientform.errors.has('name') }"
                id="recipient-name"
                required
              />
              <has-error :form="addClientform" field="name"></has-error>
            </div>

            <!-- email -->
            <div class="form-group">
              <label for="recipient-name" class="col-form-label text-muted"
                >E-mail address</label
              >
              <input
                type="email"
                v-model="addClientform.email"
                class="form-control"
                :class="{ 'is-invalid': addClientform.errors.has('email') }"
                id="recipient-name"
              />
              <has-error :form="addClientform" field="email"></has-error>
            </div>

            <!-- Company Name* -->
            <div class="form-group">
              <label for="company" class="col-form-label text-muted"
                >Company Name*</label
              >
              <input
                type="text"
                v-model="addClientform.company"
                class="form-control"
                :class="{ 'is-invalid': addClientform.errors.has('company') }"
                id="company"
                required
              />
              <has-error :form="addClientform" field="company"></has-error>
            </div>

            <!-- Company registration number -->
            <div class="form-group">
              <label
                for="company_registration_number"
                class="col-form-label text-muted"
                >Company registration number</label
              >
              <input
                type="text"
                v-model="addClientform.company_registration_number"
                class="form-control"
                :class="{
                  'is-invalid': addClientform.errors.has(
                    'company_registration_number'
                  ),
                }"
                id="company_registration_number"
              />
              <has-error
                :form="addClientform"
                field="company_registration_number"
              ></has-error>
            </div>

            <!-- Country* -->
            <div class="form-group">
              <label for="country" class="col-form-label text-muted"
                >Country*</label
              >
              <country-select
                class="form-control"
                :class="{ 'is-invalid': addClientform.errors.has('country') }"
                id="country"
                name="country"
                required
                v-model="addClientform.country"
                :country="addClientform.country"
                :countryName="true"
                topCountry="Pakistan"
              />
              <has-error :form="addClientform" field="country"></has-error>
            </div>

            <!-- city* -->
            <div class="form-group">
              <label for="city" class="col-form-label text-muted">city*</label>
              <input
                type="text"
                v-model="addClientform.city"
                class="form-control"
                :class="{ 'is-invalid': addClientform.errors.has('city') }"
                id="city"
                required
              />
              <has-error :form="addClientform" field="city"></has-error>
            </div>

            <!-- zipcode* -->
            <div class="form-group">
              <label for="zipcode" class="col-form-label text-muted"
                >Zip Code*</label
              >
              <input
                type="text"
                v-model="addClientform.zipcode"
                class="form-control"
                :class="{ 'is-invalid': addClientform.errors.has('zipcode') }"
                id="zipcode"
                required
              />
              <has-error :form="addClientform" field="zipcode"></has-error>
            </div>

            <!-- address* -->
            <div class="form-group">
              <label for="address" class="col-form-label text-muted"
                >Address*</label
              >
              <input
                type="text"
                v-model="addClientform.address"
                class="form-control"
                :class="{ 'is-invalid': addClientform.errors.has('address') }"
                id="address"
                required
              />
              <has-error :form="addClientform" field="address"></has-error>
            </div>

            <!-- vat_number -->
            <div class="form-group">
              <label for="vat_number" class="col-form-label text-muted"
                >VAT Number</label
              >
              <input
                type="number"
                v-model="addClientform.vat_number"
                class="form-control"
                id="vat_number"
                :class="{
                  'is-invalid': addClientform.errors.has('vat_number'),
                }"
              />
              <has-error :form="addClientform" field="vat_number"></has-error>
            </div>

            <!-- default_currency -->
            <div class="form-group">
              <label for="default_currency" class="col-form-label text-muted"
                >Default Currency</label
              >

              <select
                id="default_currency"
                class="form-control"
                :class="{
                  'is-invalid': addClientform.errors.has('default_currency'),
                }"
                v-model="addClientform.default_currency"
              >
                <option value="">Select Currency</option>
                <option
                  v-for="(item, index) in currencies"
                  :key="index"
                  :value="item"
                >
                  {{ item }}
                </option>
              </select>

              <has-error
                :form="addClientform"
                field="default_currency"
              ></has-error>
            </div>

            <!-- notes -->
            <div class="form-group">
              <label for="notes" class="col-form-label text-muted">Notes</label>
              <textarea
                v-model="addClientform.notes"
                class="form-control"
                id="notes"
                :class="{
                  'is-invalid': addClientform.errors.has('notes'),
                }"
              ></textarea>
              <has-error :form="addClientform" field="notes"></has-error>
            </div>

            <!-- bank_details -->
            <div class="form-group">
              <label for="bank_details" class="col-form-label text-muted"
                >Bank Details</label
              >
              <textarea
                v-model="addClientform.bank_details"
                class="form-control"
                id="bank_details"
                :class="{
                  'is-invalid': addClientform.errors.has('bank_details'),
                }"
              ></textarea>
              <has-error :form="addClientform" field="bank_details"></has-error>
            </div>

            <div class="modal-footer">
              <button
                type="submit"
                :disabled="addClientform.busy"
                class="btn btn-primary w-100"
              >
                Submit
              </button>
            </div>
          </form>
        </div>
      </div>
    </modal>
    <!-- Select Currency Modal -->
    <modal
      name="selectCurrencyModal"
      :scrollable="true"
      height="auto"
      :focusTrap="true"
      :reset="true"
    >
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Select Currency</h5>
        </div>
        <div
          class="modal-body d-flex"
          style="padding: 6px"
          v-for="(cur, index) in $page.currencies"
          :key="index"
        >
          <div
            class="font-weight-bold ml-4 select-client"
            data-dismiss="modal"
            @click="addCurrency(index)"
          >
            {{ cur.name }}
          </div>
        </div>
        <div class="modal-footer"></div>
      </div>
    </modal>

    <!-- vue modal dialogs -->
    <v-dialog />
  </div>
</template>

<script>
import JetApplicationMark from "@/Jetstream/ApplicationMark";
import JetDropdown from "@/Jetstream/Dropdown";
import JetDropdownLink from "@/Jetstream/DropdownLink";
import JetNavLink from "@/Jetstream/NavLink";
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink";

// Modals Imports
import { Form } from "vform";

export default {
  components: {
    JetApplicationMark,
    JetDropdown,
    JetDropdownLink,
    JetNavLink,
    JetResponsiveNavLink,
  },

  data() {
    return {
      showingNavigationDropdown: false,
      // Modals Data
      addClientform: new Form({
        name: "",
        email: "",
        address: "",
        company: "",
        country: "",
        phone_number: "",
        notes: "",
        company: "",
        company_registration_number: "",
        city: "",
        zipcode: "",
        vat_number: "",
        default_currency: "",
        bank_details: "",
      }),
      editClientform: new Form({
        id: "",
        name: "",
        email: "",
        address: "",
        company: "",
        country: "",
        phone_number: "",
        notes: "",
        company: "",
        company_registration_number: "",
        city: "",
        zipcode: "",
        vat_number: "",
        default_currency: "",
        bank_details: "",
      }),
      editUserForm: new Form({
        username: "",
        name: "",
        email: "",
        address: "",
        state: "",
        country: "",
        phone_number: "",
        logo: "",
        notes: "",
        company: "",
        company_registration_number: "",
        city: "",
        zipcode: "",
        vat_number: "",
        default_currency: "",
      }),
      currencies: ["USD", "EUR", "GBP", "YEN", "INR", "IDR"],
    };
  },

  methods: {
    logout() {
      axios.post(route("logout").url()).then((response) => {
        window.location = "/";
      });
    },

    // Modals Methods
    selectClient(index) {
      if (this.$page.clients[index]) {
        EventBus.$emit("event_clientSelected", this.$page.clients[index]);
        this.$modal.hide("ClientsListModal");
      } else {
        alert("Invalid Client Selected.");
      }
    },
    addClient() {
      this.addClientform
        .post("/user/clients")
        .then((res) => {
          if (res) {
            // this.$notify({
            //   group: "app",
            //   type: "success",
            //   title: "Request Successfull",
            //   text: "Client Added Successfully.",
            //   duration: 70000,
            //   speed: 1000,
            // });
            this.addClientform.reset();
            this.$modal.hide("addClientModal");
            EventBus.$emit("event_clientAdded", res.data.data);
          }
        })
        .catch((err) => {
          if (err) {
            // this.$notify({
            //   group: "app",
            //   type: "error",
            //   title: "Request Faild",
            //   text: err.message,
            //   duration: 70000,
            //   speed: 1000,
            // });
          }
        });
    },
    editClient() {
      this.editClientform
        .put("/user/clients")
        .then((res) => {
          if (res) {
            // this.$notify({
            //   group: "app",
            //   type: "success",
            //   title: "Request Successfull",
            //   text: "Client Added Successfully.",
            //   duration: 70000,
            //   speed: 1000,
            // });
            this.addClientform.reset();
            this.$modal.hide("addClientModal");
            EventBus.$emit("event_clientAdded", res.data.data);
          }
        })
        .catch((err) => {
          if (err) {
            // this.$notify({
            //   group: "app",
            //   type: "error",
            //   title: "Request Faild",
            //   text: err.message,
            //   duration: 70000,
            //   speed: 1000,
            // });
          }
        });
    },
    openAddClientModal() {
      this.$modal.hide("ClientsListModal");
      this.$modal.show("addClientModal");
    },
    updateUserInfo() {
      this.editUserForm
        .put("/user")
        .then(({ res }) => {
          console.log(res), (this.$page.user = res);
        })
        .catch((err) => {
          if (err) {
            this.$notify({
              group: "app",
              type: "error",
              title: "Request Faild",
              text: err.message,
              duration: 5000,
              speed: 1000,
              closeOnClick: true,
            });
          }
        });
    },
  },
};
</script>

<style>
.user_selectable {
  cursor: pointer;
}
</style>