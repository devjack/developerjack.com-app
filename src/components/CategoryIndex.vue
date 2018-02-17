<template>
  <div id="category-index" class="container">
    <div class="row">
      <div v-if="category" class="col-md-12">
        <h1 v-html="category.title"></h1>
      </div>
    </div>
    <div class="row">
      <div v-for="post in this.posts" class="post" :key="post.id" v-bind:class="postSizeClass(post)">
        <post-card v-bind:post="post"></post-card>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import PostCard from '@/components/PostCard';

export default {
  name: 'CategoryIndex',
  components: {
    PostCard,
  },
  props: {
    categorySlug: {
      type: String,
      required: true,
    },
    page: {
      type: Number,
      required: false,
      default: 1,
    },
  },
  data() {
    return {
      posts: [],
      category: null,
      loading: true,
    };
  },
  watch: {
    // whenever question changes, this function will run
    category(newCategory) {
      this.posts = [];
      this.loading = true;
      this.setPostsFromCategory(newCategory.id);
    },
  },
  // eslint-disable-next-line no-unused-vars
  beforeRouteUpdate(to, from, next) {
    this.setCategoryBySlug(to.params.categorySlug);
    next();
  },
  created() {
    this.setCategoryBySlug(this.categorySlug);
    // Note: this.category is watched to subsequently update posts.
  },
  methods: {
    postSizeClass: (post) => {
      if ('img' in post) {
        return 'col-md-8';
      }
      return 'col-md-4';
    },
    setCategoryBySlug(categorySlug) {
      const self = this;
      return axios.get(`${self.apiBaseUrl}wp/v2/categories?slug=${categorySlug}`)
        .then((response) => {
          self.category = response.data[0]; // Assume the first and only category
        })
        .catch((e) => {
          // eslint-disable-next-line no-console
          console.log(e);
        });
    },
    setPostsFromCategory(categoryId) {
      const self = this;
      axios.get(`${self.apiBaseUrl}wp/v2/posts?categories=${categoryId}`)
        .then((response) => {
          let apiPost = null;
          const posts = [];
          for (let p = 0; p < response.data.length; p += 1) {
            apiPost = response.data[p];
            posts.push({
              id: apiPost.id,
              title: apiPost.title.rendered,
              tags: [],
              intro: apiPost.excerpt.rendered,
              // img: apiPost._embedded["wp:featuredmedia"][0].source_url
              link: apiPost.link,
            });
          }
          self.posts = posts;
          // callback(posts);
        })
        .catch((e) => {
          // eslint-disable-next-line no-console
          console.log(e);
          return [];
        });
    },
    setPosts(posts) {
      // eslint-disable-next-line no-console
      console.log('Setting posts...');
      this.posts = posts;
    },
    setCategory(category) {
      this.category = category;
    },
  },
};
</script>

<style lang="scss" scoped>

</style>
