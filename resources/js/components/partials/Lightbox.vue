<template>
    <div :style="'display: ' + (show ? 'block' : 'none')" v-if="gif">
        <div class="vue-lb-container" style="">
            <div class="vue-lb-content">
                <div class="vue-lb-header" @click="onClose">
                    <span></span>
                    <button type="button" title="Close (Esc)" class="vue-lb-button-close">
                    <span>
                        <svg fill="#FF983D" x="0px" y="0px" width="100%" height="100%" viewBox="0 0 512 512">
                            <path d="M443.6,387.1L312.4,255.4l131.5-130c5.4-5.4,5.4-14.2,0-19.6l-37.4-37.6c-2.6-2.6-6.1-4-9.8-4c-3.7,0-7.2,1.5-9.8,4 L256,197.8L124.9,68.3c-2.6-2.6-6.1-4-9.8-4c-3.7,0-7.2,1.5-9.8,4L68,105.9c-5.4,5.4-5.4,14.2,0,19.6l131.5,130L68.4,387.1 c-2.6,2.6-4.1,6.1-4.1,9.8c0,3.7,1.4,7.2,4.1,9.8l37.4,37.6c2.7,2.7,6.2,4.1,9.8,4.1c3.5,0,7.1-1.3,9.8-4.1L256,313.1l130.7,131.1 c2.7,2.7,6.2,4.1,9.8,4.1c3.5,0,7.1-1.3,9.8-4.1l37.4-37.6c2.6-2.6,4.1-6.1,4.1-9.8C447.7,393.2,446.2,389.7,443.6,387.1z"></path>
                        </svg>
                    </span>
                    </button>
                </div>
                <div class="vue-lb-figure">
                    <img :src="gif.url" :srcset="imageUrl" class="vue-lb-modal-image">
                    <div :class="['vue-lb-footer', favoriteClass()]" @click="addToFavorites(gif)" v-if="showFooter">
                        <i class="fas fa-heart" v-if="gif.is_favorite"></i>
                        <i class="far fa-heart" v-else></i>
                    </div>
                </div>
            </div>
            <button type="button" title="Previous" class="vue-lb-arrow vue-lb-left" @click="loadPrevious">
                <span>
                    <svg fill="#FF983D" x="0px" y="0px" width="100%" height="100%" viewBox="0 0 512 512">
                        <path d="M213.7,256L213.7,256L213.7,256L380.9,81.9c4.2-4.3,4.1-11.4-0.2-15.8l-29.9-30.6c-4.3-4.4-11.3-4.5-15.5-0.2L131.1,247.9 c-2.2,2.2-3.2,5.2-3,8.1c-0.1,3,0.9,5.9,3,8.1l204.2,212.7c4.2,4.3,11.2,4.2,15.5-0.2l29.9-30.6c4.3-4.4,4.4-11.5,0.2-15.8 L213.7,256z"></path>
                    </svg>
                </span>
            </button>
            <button type="button" title="Next" class="vue-lb-arrow vue-lb-right" @click="loadNext">
                <span>
                    <svg fill="#FF983D" x="0px" y="0px" width="100%" height="100%" viewBox="0 0 512 512" xml:space="preserve">
                        <path d="M298.3,256L298.3,256L298.3,256L131.1,81.9c-4.2-4.3-4.1-11.4,0.2-15.8l29.9-30.6c4.3-4.4,11.3-4.5,15.5-0.2l204.2,212.7 c2.2,2.2,3.2,5.2,3,8.1c0.1,3-0.9,5.9-3,8.1L176.7,476.8c-4.2,4.3-11.2,4.2-15.5-0.2L131.3,446c-4.3-4.4-4.4-11.5-0.2-15.8 L298.3,256z"></path>
                    </svg>
                </span>
            </button>
        </div>
    </div>
</template>

<script>
  export default {
    name: "Lightbox",
    data: function () {
      return {
        show: false,
        imageUrl: '',
        gif: null,
        index: 0,
        apiToken: apiToken,
        showFooter: true
      };
    },
    mounted: function () {
      this.showFooter = this.apiToken !== '';
    },
    methods: {
      onClose: function () {
        this.show = false;
      },
      showImage: function (gif, index) {
        this.show = true;
        this.gif = gif;
        this.index = index;
      },
      favoriteClass: function () {
        if (this.gif.is_favorite) {
          return 'is-favorite';
        }

        return '';
      },
      addToFavorites: function (gif) {
        this.gif.is_favorite = !this.gif.is_favorite;

        axios.post('/api/favorites', {
          giphy_id: gif.id,
          url: gif.url,
          still_url: gif.still_url,
          api_token: apiToken
        });
      },
      loadNext: function () {
        let index = this.index + 1;

        this.$emit('loadNext', index);
      },
      loadPrevious: function () {
        let index = this.index - 1;

        this.$emit('loadPrevious', index);
      },
      setShowFooter: function (value) {
        this.showFooter = value;
      }
    }
  }
</script>
