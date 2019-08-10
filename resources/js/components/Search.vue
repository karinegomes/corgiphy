<template>
    <div class="search-wrapper">
        <div class="container-fluid mt-100">
            <template v-if="!isLoading">
                <div class="row" v-for="(row, index1) in results">
                    <div class="col-sm" v-for="(gif, index2) in row">
                        <div :style="'background-image: url(' + gif.still_url + ')'"
                             class="gallery-img"
                             @click="openLightbox(gif, getIndex(gif))"></div>
                    </div>
                </div>

                <div class="text-center">
                    <button class="btn btn-primary">GIB MORE !!!</button>
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
        offset: 0,
        results: [],
        images: [],
        lightboxLimit: 3,
        originalResponse: null
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
        this.isLoading = true;

        axios.get('/api/search', {
          params: {
            api_token: apiToken,
            query: this.query,
            offset: this.offset
          }
        }).then(response => {
          let data = response.data.data;

          this.originalResponse = data;

          this.results = JSON.parse(JSON.stringify(data));
          this.results = this.chunkArray(this.results, 4);

          for (let i = 0; i < data.length; i++) {
            if (i < this.lightboxLimit) {
              this.images.push({
                thumb: data[i].url,
                src: data[i].url,
                srcset: data[i].url
              });
            }
          }

          this.offset += 20;
          this.isLoading = false;
        }).catch(error => {
          this.isLoading = false;
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
        let length = this.originalResponse.length;

        if (this.lightboxLimit + 3 < length) {
          length = this.lightboxLimit + 3;
        }

        for (let i = this.lightboxLimit; i < length; i++) {
          this.images.push({
            thumb: this.originalResponse[i].url,
            src: this.originalResponse[i].url,
            srcset: this.originalResponse[i].url
          });
        }
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
