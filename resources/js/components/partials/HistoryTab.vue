<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-7 m-auto">
                <table class="table" v-if="!isLoading">
                    <tr class="clickable" v-for="item in history" @click="search(item.query)">
                        <td>{{ item.query }}</td>
                        <td>{{ item.searched_at }}</td>
                    </tr>
                </table>
                <div class="text-center" v-else>
                    <img src="/img/loading.svg" style="width: 75px">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  export default {
    name: "HistoryTab",
    data: function () {
      return {
        history: [],
        isLoading: true
      };
    },
    mounted: function () {
      this.getHistory();
    },
    methods: {
      getHistory: function () {
        axios.get('/api/history', {
          params: {
            api_token: apiToken
          }
        }).then(response => {
          this.history = response.data.history;
          this.isLoading = false;
        });
      },
      search: function (query) {
        location.href = '/search?query=' + query;
      }
    }
  }
</script>
