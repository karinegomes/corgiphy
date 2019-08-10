<template>
    <div>
        <account-options active-tab="history"></account-options>
        <div class="container">
            <div class="row">
                <div class="col-sm-7 m-auto">
                    <div v-if="!isLoading">
                        <table class="table">
                            <tr class="clickable" v-for="item in history" @click="search(item.query)">
                                <td>{{ item.query }}</td>
                                <td>{{ item.searched_at }}</td>
                            </tr>
                        </table>
                        <div class="text-center" v-if="hasNextPage()">
                            <button class="btn btn-primary" @click="loadMore" :disabled="isLoadingMore">
                                <template v-if="!isLoadingMore">GIB MORE !!!</template>
                                <img src="/img/loading.svg" style="width: 20px" v-else>
                            </button>
                        </div>
                    </div>
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
    name: "History",
    data: function () {
      return {
        history: [],
        isLoading: true,
        isLoadingMore: false,
        page: 1,
        lastPage: 1
      };
    },
    components: { AccountOptions },
    mounted: function () {
      this.getHistory();
    },
    methods: {
      getHistory: function () {
        axios.get('/api/history', {
          params: {
            api_token: apiToken,
            page: this.page
          }
        }).then(response => {
          let result = response.data.history;

          console.log(result);

          this.history = this.history.concat(result.data);
          this.isLoading = false;
          this.isLoadingMore = false;
          this.page = result.current_page;
          this.lastPage = result.last_page;
        });
      },
      search: function (query) {
        location.href = '/search?query=' + query;
      },
      loadMore: function () {
        this.page++;
        this.isLoadingMore = true;

        this.getHistory();
      },
      hasNextPage: function () {
        return this.page < this.lastPage;
      }
    }
  }
</script>
