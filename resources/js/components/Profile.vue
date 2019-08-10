<template>
    <div>
        <account-options active-tab="profile"></account-options>
        <div class="container">
            <div class="row">
                <div class="col-sm-7 m-auto">
                    <form class="text-left" id="form" @submit.prevent="submitForm" v-if="!isLoading">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" :class="['form-control', invalidClass('username')]" v-model="user.username">
                            <div class="invalid-feedback" v-if="hasError('username')">
                                {{ requestErrors.username[0] }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" name="email" id="email" :class="['form-control', invalidClass('email')]" v-model="user.email">
                            <div class="invalid-feedback" v-if="hasError('email')">
                                {{ requestErrors.email[0] }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password">Current password</label>
                            <input type="password" name="password" id="password" :class="['form-control', invalidClass('password')]">
                            <div class="invalid-feedback" v-if="hasError('password')">
                                {{ requestErrors.password[0] }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="new-password">New password</label>
                            <input type="password" name="new_password" id="new-password" :class="['form-control', invalidClass('new_password')]">
                            <div class="invalid-feedback" v-if="hasError('new_password')">
                                {{ requestErrors.new_password[0] }}
                            </div>
                        </div>
                        <button type="submit" class="btn btn-pink btn-lg btn-block mt-5" :disabled="isLoadingForm">
                            <template v-if="!isLoadingForm">
                                Save Changes
                            </template>
                            <img src="/img/loading.svg" style="width: 30px" v-else>
                        </button>
                    </form>
                    <div class="text-center" v-else>
                        <img src="/img/loading.svg" style="width: 75px">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  import AccountOptions from "./partials/AccountOptions";

  export default {
    name: "Profile",
    data: function () {
      return {
        user: null,
        isLoading: true,
        isLoadingForm: false,
        requestErrors: {}
      };
    },
    components: { AccountOptions },
    mounted: function () {
      this.getUser();
    },
    methods: {
      getUser: function () {
        axios.get('/api/user', {
          params: {
            api_token: apiToken
          }
        }).then(response => {
          this.user = response.data.user;

          this.isLoading = false;
        }).catch(error => {
          this.isLoading = false;
        });
      },
      submitForm: function () {
        this.isLoadingForm = true;
        this.requestErrors = {};

        let formData = new FormData(document.getElementById('form'));

        formData.append('api_token', apiToken);

        axios.post('/api/update-user', formData).then(response => {
          this.isLoadingForm = false;

          location.href = '/profile';
        }).catch(error => {
          if (error.response.status === 422) {
            this.requestErrors = error.response.data.errors;
          }

          this.isLoadingForm = false;
        });
      },
      hasError: function (fieldName) {
        let data = this.requestErrors[fieldName];

        return (data !== undefined && data.length > 0);
      },
      invalidClass: function (field) {
        return this.hasError(field) ? 'is-invalid' : '';
      }
    }
  }
</script>
