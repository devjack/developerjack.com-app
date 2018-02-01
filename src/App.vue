<template>
  <div id="app">
    <app-header title="Ramblings of an Engineer" :social="social"></app-header>
    <div class="container">
      <div class="row">
        <div v-for="post in posts" class="post" :key="post.title" v-bind:class="postSizeClass(post)">
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

export default {
  name: 'app',
  components: {
    PostCard,
    AppHeader,
  },
  data() {
    return {
      social: [
        {
          name: 'instagram',
          href: 'https://instagram.com/developerjack',
        },
        {
          name: 'instagram',
          href: 'https://instagram.com/developerjack',
        },
        {
          name: 'instagram',
          href: 'https://instagram.com/developerjack',
        },
        {
          name: 'instagram',
          href: 'https://instagram.com/developerjack',
        },
      ],
      posts: [
        {
          title: 'Foobar1',
          tags: ['open source'],
          intro: 'Lorem blogum and some content to match...',
          img: 'http://via.placeholder.com/350x300',
        },
        {
          title: 'Foobar2',
          tags: ['open source'],
          intro: 'Lorem blogum and some content to match...',
        },
        {
          title: 'Foobar3',
          tags: ['open source'],
          intro: 'Lorem blogum and some content to match...',
        },
        {
          title: 'Foobar4',
          tags: ['open source'],
          intro: 'Lorem blogum and some content to match...',
          img: 'http://via.placeholder.com/350x300',
        },
        {
          title: 'Foobar5',
          tags: ['open source'],
          intro: 'Lorem blogum and some content to match...',
        },
        {
          title: 'Foobar6',
          tags: ['open source'],
          intro: 'Lorem blogum and some content to match...',
        },
        {
          title: 'Foobar7',
          tags: ['open source'],
          intro: 'Lorem blogum and some content to match...',
        },
        {
          title: 'Foobar8',
          tags: ['open source'],
          intro: 'Lorem blogum and some content to match...',
        },
        {
          title: 'Foobar9',
          tags: ['open source'],
          intro: 'Lorem blogum and some content to match...',
        },
        {
          title: 'Foobar10',
          tags: ['open source'],
          intro: 'Lorem blogum and some content to match...',
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
  created: () => {
    const API = 'http://vagrant.local';
    axios.get(`${API}/wp-json/wp/v2/posts?categories_exclude=3`)
      .then((response) => {
        // JSON responses are automatically parsed.
        // eslint-disable-next-line no-console
        console.log(response.data);
        // this.posts = response.data
      })
      .catch((e) => {
        this.errors.push(e);
      });
  },
};
</script>

<style lang="scss">
@import "~bootstrap/scss/bootstrap";

</style>
