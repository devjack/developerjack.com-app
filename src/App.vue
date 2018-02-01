<template>
  <div id="app">
    <app-header title="Ramblings of an Engineer" :social="social"></app-header>
    <div class="container">
      <div class="row">
        <div v-for="post in posts" class="post" :key="post.id" v-bind:class="postSizeClass(post)">
          <post-card v-bind:post="post"></post-card>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import PostCard from './components/PostCard';
import AppHeader from './components/AppHeader';

const socialData = require('./../data/social.json');

export default {
  name: 'app',
  components: {
    PostCard,
    AppHeader,
  },
  data() {
    return {
      social: socialData,
      posts: [
        {
          title: 'Foobar1',
          tags: ['open source'],
          intro: 'Lorem blogum and some content to match...',
          img: '/static/img/profile/profile_sq_small.png',
        },
      ],
    };
  },
  methods: {
    postSizeClass: (post) => {
      if ('img' in post) {
        return 'col-md-8';
      }
      return 'col-md-4';
    },
  },
  created() {
    const self = this;
    const API = 'http://vagrant.local';
    axios.get(`${API}/wp-json/wp/v2/posts?categories_exclude=3`)
      .then((response) => {
        // JSON responses are automatically parsed.
        // eslint-disable-next-line no-console
        console.log(response.data);
        let apiPost = null;
        for (let p = 0; p < response.data.length; p += 1) {
          apiPost = response.data[p];
          self.posts.push({
            id: apiPost.id,
            title: apiPost.title.rendered,
            tags: [],
            intro: apiPost.excerpt.rendered,
            // img: apiPost._embedded["wp:featuredmedia"][0].source_url
          });
        }

        // eslint-disable-next-line no-console
        console.log(self.posts);
        // this.posts = response.data
      })
      .catch((e) => {
        // eslint-disable-next-line no-console
        console.log(e);
        // this.errors.push(e);
      });
  },
};
</script>

<style lang="scss">
@import "./scss/_theme";
@import "~bootstrap/scss/bootstrap";

</style>
