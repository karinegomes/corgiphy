<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Search</div>

                    <div class="card-body">
                        <form @submit="search">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Search" v-model="query">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" v-for="row in results">
            <div class="col-sm" v-for="(gif, index) in row">
                <div>
                    <img :src="gif.still_url" alt="" style="width: 100%" class="pointer"
                         @click="openLightbox(index)">
                </div>
                <div>
                    <button class="btn btn-primary" @click="addToFavorites(gif)">Favorite</button>
                </div>
            </div>
        </div>

        <div>
            <button type="button" class="btn btn-primary" v-if="results.length > 0" @click="loadMore">Load more</button>
        </div>

        <LightBox :images="images" :show-light-box="false" :show-thumbs="false" ref="lightbox"></LightBox>
    </div>
</template>

<script>
  require('vue-image-lightbox/dist/vue-image-lightbox.min.css');

  import LightBox from 'vue-image-lightbox';

  export default {
    data: function () {
      return {
        query: '',
        results: [],
        images: [],
        offset: 0
      };
    },
    components: {LightBox},
    mounted() {
      console.log('Component mounted.')
    },
    methods: {
      search: function (e) {
        e.preventDefault();

        axios.get('/api/search', {
          params: {
            api_token: apiToken,
            query: this.query,
            offset: this.offset
          }
        }).then(response => {
          let data = response.data.data;

          this.results = JSON.parse(JSON.stringify(data));
          this.results = this.chunkArray(this.results, 3);

          for (let i = 0; i < data.length; i++) {
            this.images.push({
              thumb: data[i].url,
              src: data[i].url,
              srcset: data[i].url
            });
          }

          this.offset += 20;
        });
      },
      chunkArray: function (array, chunkSize) {
        let results = [];

        while (array.length) {
          results.push(array.splice(0, chunkSize));
        }

        return results;
      },
      addToFavorites: function (gif) {
        axios.post('/api/favorites', {
          giphy_id: gif.id,
          api_token: apiToken
        }).then(response => {
          console.log(response);
        });
      },
      openLightbox: function (index) {
        this.$refs.lightbox.showImage(index);
      },
      loadMore: function () {
        alert('test');
      }
    }
  }
</script>
