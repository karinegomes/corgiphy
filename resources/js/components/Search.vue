<template>
    <div class="search-wrapper">
        <div class="container-fluid mt-100">
            <template v-if="!isLoading">
                <h1 class="mb-5">{{ query }}</h1>
                <div class="row" v-for="(row, index1) in results">
                    <div class="col-sm" v-for="(gif, index2) in row">
                        <div :style="'background-image: url(' + gif.still_url + ')'"
                             class="gallery-img"
                             @click="openLightbox(gif, getIndex(gif))"></div>
                    </div>
                </div>

                <div class="text-center">
                    <button class="btn btn-primary" @click="loadMore" :disabled="isLoadingMore">
                        <template v-if="!isLoadingMore">GIB MORE !!!</template>
                        <img src="/img/loading.svg" style="width: 20px" v-else>
                    </button>
                </div>
            </template>
            <div class="text-center" v-else>
                <img src="/img/loading.svg" style="width: 150px">
            </div>
        </div>

        <lightbox ref="lightbox" v-on:loadNext="loadNext" v-on:loadPrevious="loadPrevious"></lightbox>
    </div>
</template>

<script>
  import Lightbox from './partials/Lightbox';

  export default {
    name: "Profile",
    data: function () {
      return {
        query: '',
        isLoading: true,
        isLoadingMore: false,
        offset: 0,
        results: [],
        originalResponse: []
      };
    },
    components: {Lightbox},
    mounted: function () {
      if (this.$route.query.query !== undefined && this.$route.query.query !== '') {
        this.query = this.$route.query.query;
      } else {
        location.href = '/';
      }

      this.search();
    },
    methods: {
      search: function () {
        if (this.originalResponse.length === 0) {
          this.isLoading = true;
        } else {
          this.isLoadingMore = true;
        }

        axios.get('/api/search', {
          params: {
            query: this.query,
            offset: this.offset
          }
        }).then(response => {
          let data = response.data.data;

          this.originalResponse = this.originalResponse.concat(data);
          this.results = JSON.parse(JSON.stringify(this.originalResponse));
          this.results = this.chunkArray(this.results, 4);
          this.offset += 20;
          this.isLoading = false;
          this.isLoadingMore = false;
        }).catch(error => {
          this.isLoading = false;
          this.isLoadingMore = false;
        });
      },
      chunkArray: function (array, chunkSize) {
        let results = [];

        while (array.length) {
          results.push(array.splice(0, chunkSize));
        }

        return results;
      },
      openLightbox: function (gif, index) {
        this.$refs.lightbox.showImage(gif, index);
      },
      loadMore: function () {
        this.search();
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
      getIndex: function (gif) {
        for (let i = 0; i < this.originalResponse.length; i++) {
          if (gif.id == this.originalResponse[i].id) {
            return i;
          }
        }
      }
    }
  }
</script>
