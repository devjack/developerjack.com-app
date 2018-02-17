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
import axios from 'axios';
import PostCard from '@/components/PostCard';

export default {
  name: 'HomePage',
  components: {
    PostCard,
  },
  data() {
    return {
      posts: [
        {
          title: 'Foobar1',
          tags: ['open source'],
          intro: 'Lorem blogum and some content to match...',
          img: '/static/img/profile/profile_sq_small.png',
          link: 'https://foo.bar/blogum-ipsum',
        },
      ],
    };
  },
  created() {
    const self = this;
    const apiBase = this.apiBaseUrl;
    // eslint-disable-next-line no-console
    axios.get(`${apiBase}wp/v2/posts?categories_exclude=3`)
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
            link: apiPost.link,
          });
        }

        // eslint-disable-next-line no-console
        console.log(self.posts);
        // this.posts = response.data
      })
      .catch((e) => {
        // eslint-disable-next-line no-console
        console.log(e);
      });
  },
  methods: {
    postSizeClass: (post) => {
      if ('img' in post) {
        return 'col-md-8';
      }
      return 'col-md-4';
    },
  },
};
</script>

<style lang="scss" scoped>

</style>
