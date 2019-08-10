<template>
    <div class="top-navbar">
        <div class="container-fluid">
            <div :class="flexClasses"> <!-- flex-row-reverse -->
                <div class="p-2 bd-highlight logo-column" v-if="apiToken">
                    <a class="navbar-brand" href="/"><img src="/img/logo.png" class="logo" alt="Corgiphy"></a>
                </div>
                <div class="p-2 flex-grow-1 bd-highlight" v-if="apiToken">
                    <form action="">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                                <span class="input-group-text search-btn">
                                    <i class="fas fa-search"></i>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="p-2 bd-highlight">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="/register" class="btn btn-primary text-uppercase">Sign up</a>
                        <a href="/login" class="btn btn-secondary text-uppercase">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  export default {
    name: "Navbar",
    data: function () {
      return {
        apiToken: apiToken
      };
    },
    computed: {
      flexClasses: function () {
        let classes = ['d-flex', 'bd-highlight'];

        if (this.apiToken) {
          classes.push('align-items-center');
        } else {
          classes.push('flex-row-reverse');
        }

        return classes;
      }
    }
  }
</script>
