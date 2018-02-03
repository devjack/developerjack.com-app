<template>
  <div id="post" class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="loading" v-if="loading">
          Loading...
        </div>

        <div v-if="error" class="error">
          {{ error }}
        </div>

        <article v-if="post" class="content">
          <header>
            <h1 v-html="post.title.rendered"></h1>
          </header>
          <main v-html="post.content.rendered"></main>

        </article>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'Post',
  props: ['slug'],
  data() {
    return {
      loading: false,
      post: null,
      error: null,
    };
  },
  created() {
    // fetch the data when the view is created and the data is
    // already being observed
    this.fetchData();
  },
  watch: {
    // call again the method if the route changes
    $route: 'fetchData',
  },
  methods: {
    fetchData() {
      this.error = null;
      this.post = null;
      this.loading = true;

      const API = 'http://vagrant.local';
      // eslint-disable-next-line no-unused-vars
      const slug = this.slug;
      // TODO: This assumes no posts of the same slug in different categories.
      // In the event of two duplicate slugs in different categories,
      //   the post shown is undefined (using the first result from the API impl.)
      axios.get(`${API}/wp-json/wp/v2/posts?slug=${slug}`)
        .then((response) => {
          this.loading = false;
          // eslint-disable-next-line no-console
          console.log(response.data);
          if (response.data.length === 0) {
            this.error = '404 post not found';
          } else if (response.data.length > 1) {
            this.error = '400 Slugs galore!';
            // eslint-disable-next-line no-console
            console.log('Slugs galore! Jack promised himself this would never happen!');
          } else {
            // For the 1x post that is returned...
            this.post = response.data[0];
          }
        })
        .catch((e) => {
          this.error = true;
          // eslint-disable-next-line no-console
          console.log(e);
        });
    },
  },
};
</script>

<style lang="scss" scoped>

</style>
