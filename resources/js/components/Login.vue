<template>
    <div class="container mt-150 text-center">
        <h1 class="text-custom">Woof!</h1>
        <h1 class="mb-5">Welcome back hooman!</h1>

        <div class="row mb-5">
            <div class="col-sm-7 m-auto">
                <form class="text-left" @submit.prevent="login" id="form">
                    <div class="form-group">
                        <label for="login">Enter username or email address</label>
                        <input type="text" name="login" :class="['form-control', hasError('login') ? 'is-invalid' : '']" id="login">
                        <div class="invalid-feedback" v-if="hasError('login')">
                            {{ requestErrors.login[0] }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Enter password</label>
                        <input type="password" name="password" :class="['form-control', hasError('password') ? 'is-invalid' : '']" id="password">
                        <div class="invalid-feedback" v-if="hasError('password')">
                            {{ requestErrors.password[0] }}
                        </div>
                    </div>
                    <button type="submit" class="btn btn-pink btn-lg btn-block mt-5" :disabled="isLoading">
                        <template v-if="!isLoading">Log in</template>
                        <img src="/img/loading.svg" style="width: 30px" v-else>
                    </button>
                </form>
            </div>
        </div>

        <a href="/register" class="text-bigger-13">Don't have an account?</a>
    </div>
</template>

<script>
  export default {
    name: "Login",
    data: function () {
      return {
        requestErrors: {},
        isLoading: false
      };
    },
    methods: {
      login: function () {
        this.isLoading = true;

        let formData = new FormData(document.getElementById('form'));

        axios.post('/login', formData).then(response => {
          location.href = '/';
        }).catch(error => {
          console.log(error.response);

          if (error.response.status === 422) {
            this.requestErrors = error.response.data.errors;
          }

          console.log(this.requestErrors);

          this.isLoading = false;
        });
      },
      hasError: function (fieldName) {
        let data = this.requestErrors[fieldName];

        return (data !== undefined && data.length > 0);
      }
    }
  }
</script>
