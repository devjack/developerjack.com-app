<template>
  <div id="homepage"  class="container">
    <div class="row">
      <div v-for="post in posts" class="post" :key="post.id" v-bind:class="postSizeClass(post)">
        <post-card v-bind:post="post"></post-card>
      </div>
    </div>
  </div>
</template>

<script>
/* eslint-disable no-underscore-dangle */
import axios from 'axios';
import _ from 'lodash';
import PostCard from '@/components/PostCard';

export default {
  name: 'HomePage',
  components: {
    PostCard,
  },
  data() {
    return {
      posts: [
      ],
    };
  },
  created() {
    const self = this;
    const apiBase = this.apiBaseUrl;
    // eslint-disable-next-line no-console
    axios.get(`${apiBase}wp/v2/posts?categories_exclude=3&_embed=1`)
      .then((response) => {
        // JSON responses are automatically parsed.
        // eslint-disable-next-line no-console
        console.log(response.data);
        let apiPost = null;
        for (let p = 0; p < response.data.length; p += 1) {
          apiPost = response.data[p];
          const featuredMedia = _.has(apiPost, '_embedded.wp:featuredmedia')
            && apiPost._embedded['wp:featuredmedia'].length >= 1
            ? apiPost._embedded['wp:featuredmedia'][0].media_details
            : null;
          self.posts.push({
            id: apiPost.id,
            title: apiPost.title.rendered,
            tags: [],
            intro: apiPost.excerpt.rendered,
            img: _.has(featuredMedia, 'sizes.medium') ? featuredMedia.sizes.medium.source_url : null,
            link: apiPost.link,
          });
        }
      })
      .catch((e) => {
        // eslint-disable-next-line no-console
        console.log(e);
      });
  },
  methods: {
    postSizeClass: (post) => {
      if (_.has(post, 'img') && post.img != null) {
        return 'col-sm-12 col-md-12 col-lg-8';
      }
      return 'col-sm-12 col-md-6 col-lg-4';
    },
  },
};
</script>

<style lang="scss" scoped>

</style>
