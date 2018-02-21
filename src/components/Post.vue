<template>
  <div id="post" class="container">
    <div class="row justify-content-md-center">
      <div class="col-md-10 col-">
        <div class="loading" v-if="loading">
          Loading...
        </div>

        <div v-if="error" class="error">
          {{ error }}
        </div>

        <article v-if="post" class="content">
          <header>
            <h1 v-html="post.title.rendered"></h1>
            <ul>
              <li v-html="displayDate"></li>
              <li v-html="readingTime"></li>
            </ul>
          </header>
          <main v-html="post.content.rendered"></main>

        </article>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import moment from 'moment';
import readingTime from 'reading-time';

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
  computed: {
    displayDate() {
      if (!this.post) {
        return null;
      }
      return moment().format('D MMMM YYYY');
    },
    readingTime() {
      if (!this.post) {
        return null;
      }
      return readingTime(this.post.content.rendered).text;
    },
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
  updated() {
    // Once the post is rendered, check for embedded tweets.
    if (this.$el.querySelector('.twitter-tweet')) {
      // eslint-disable-next-line no-underscore-dangle
      window.twttr.widgets.load(
        document.getElementById('post'),
      );
    }
  },
  methods: {
    fetchData() {
      const self = this;
      this.error = null;
      this.post = null;
      this.loading = true;

      // eslint-disable-next-line no-unused-vars
      const slug = this.slug;
      // TODO: This assumes no posts of the same slug in different categories.
      // In the event of two duplicate slugs in different categories,
      //   the post shown is undefined (using the first result from the API impl.)
      axios.get(`${self.apiBaseUrl}wp/v2/posts?slug=${slug}`)
        .then((response) => {
          this.loading = false;
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

<style lang="scss">
header {
  ul {
    list-style-type: none;
    li {
      display: inline;
      padding: auto 1rem;
      &:after {
        content: " | ";
      }
      &:last-child:after {
        content: "";
      }
    }
  }
}
.alignleft {
    width: 50%;
    float: left;
    margin-right: 1.5em;
}
.alignright {
    width: 50%;
    float: right;
    margin-left: 1.5em;
}
.wp-block-image {
  text-align: center;
}

figure.wp-block-embed.aligncenter twitterwidget {
  // Yeah ok whatever its ahack.
    margin-left: auto;
    margin-right: auto;
}

@import "../scss/_weekly";

</style>
