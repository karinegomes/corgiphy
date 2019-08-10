<script>
  export default {
    name: "MiscHelper",
    methods: {
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
