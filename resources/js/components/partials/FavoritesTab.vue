<template>
    <div class="search-wrapper">
        <div class="container-fluid">
            <template v-if="!isLoading">
                <div class="row" v-for="row in results">
                    <div class="col-sm-3" v-for="gif in row">
                        <div :style="'background-image: url(' + gif.still_url + ')'"
                             class="gallery-img"
                             @click="openLightbox(gif, getIndex(gif))"></div>
                    </div>
                </div>

                <div class="text-center" v-if="hasNextPage()">
                    <button class="btn btn-primary" @click="loadMore" :disabled="isLoadingMore">
                        <template v-if="!isLoadingMore">GIB MORE !!!</template>
                        <img src="/img/loading.svg" style="width: 20px" v-else>
                    </button>
                </div>
            </template>
            <div class="text-center" v-else>
                <img src="/img/loading.svg" style="width: 75px">
            </div>
        </div>

        <lightbox ref="lightbox" v-on:loadNext="loadNext" v-on:loadPrevious="loadPrevious"></lightbox>
    </div>
</template>

<script>
  import Lightbox from './Lightbox';
  import MiscHelper from "../mixins/MiscHelper";

  export default {
    name: "FavoritesTab",
    data: function () {
      return {
        results: [],
        originalResponse: [],
        isLoading: true,
        isLoadingMore: false,
        page: 1,
        lastPage: 1
      };
    },
    components: {Lightbox},
    mixins: [ MiscHelper ],
    mounted: function () {
      this.$refs.lightbox.setShowFooter(false);
      this.getFavorites();
    },
    methods: {
      getFavorites: function () {
        axios.get('/api/favorites', {
          params: {
            api_token: apiToken,
            page: this.page
          }
        }).then(response => {
          let result = response.data.favorites;
          let data = result.data;

          this.originalResponse = this.originalResponse.concat(data);
          this.results = JSON.parse(JSON.stringify(this.originalResponse));
          this.results = this.chunkArray(this.results, 4);
          this.isLoading = false;
          this.isLoadingMore = false;
          this.lastPage = result.last_page;
          this.page = result.current_page;
        });
      },
      loadNext: function (index) {
        if (index >= this.originalResponse.length) {
          index = 0;
        }

        this.openLightbox(this.originalResponse[index], index);
      },
      loadPrevious: function (index) {
        if (index < 0) {
          index = this.originalResponse.length - 1;
        }

        this.openLightbox(this.originalResponse[index], index);
      },
      loadMore: function () {
        this.page++;
        this.isLoadingMore = true;

        this.getFavorites();
      },
      hasNextPage: function () {
        return this.page < this.lastPage;
      }
    }
  }
</script>
