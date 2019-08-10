<template>
    <div class="container">
        <div class="mt-250 mb-5">
            <img src="/img/logo.png" class="home-logo" alt="Corgiphy">
        </div>
        <form @submit.prevent="search">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search" aria-label="Search" v-model="query">
                <div class="input-group-append" @click="search">
                    <span class="input-group-text search-btn">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
  export default {
    name: "Home",
    data: function () {
      return {
        query: ''
      };
    },
    methods: {
      search: function () {
        if (this.query) {
          location.href = '/search?query=' + this.query;
        }
      }
    }
  }
</script>
