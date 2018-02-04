<template>
  <article class="card post-card  flex-md-row mb-4 box-shadow h-md-250">
    <img :if="post.img" class="card-img-left flex-auto" :src="post.img">
    <div class="card-body  card-body d-flex flex-column align-items-start">
      <h3>
        <router-link :to="{ path: path}">{{post.title}}</router-link>
        <!-- <a :href="path">{{post.title}}</a> -->
        </h3>
      <span v-for="tag in post.tags" :key="tag" class="tag">{{ tag }}</span>
      <p v-html="post.intro"></p>
    </div>
    <!-- <div class="post-image">
      <img src="http://via.placeholder.com/350x300">
    </div>
    <div class="post-intro">
      <header>
        <h3>Lorem Titlem dol or amet</h3>
        <span class="tag">Open Source</span>
      </header>
      <p>
        Monotonectally pursue backward-compatible ideas without empowered imperatives. Interactively predominate low-risk high-yield ROI rather than adaptive e-tailers....
      </p>
    </div> <!-- /.post-intro -->

  </article>
</template>

<script>

export default {
  name: 'PostCard',
  props: {
    post: {
      title: {
        type: String,
        required: true,
      },
      link: {
        type: String,
        required: true,
      },
      tags: {
        type: Array,
        required: true,
      },
      intro: {
        type: String,
        required: true,
      },
      img: {
        type: String,
        required: false,
      },
    },
  },
  computed: {
    path() {
      const url = new URL(this.post.link);
      return url.pathname;
    },
  },
};
</script>

<style lang="scss" scoped>
.post-card.card {
  height: 300px;
  overflow: hidden;

  .post-image {
    float: left;
    position: relative;
    width: 50%;
    img {
      object-fit: cover;
      max-height: 100%;
    }
  }

  p {
    // white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
}
</style>
