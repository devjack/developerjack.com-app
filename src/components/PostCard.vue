<template>
  <router-link :to="{ path: path}" class="card post-card flex-md-row mb-4 box-shadow h-md-250">
      <img v-if="post.img" class="col-sm-12 col-md-6 card-img card-img-left flex-auto" :src="post.img">
      <div class="card-body card-body d-flex flex-column align-items-start">
        <h3 v-html="post.title"></h3>
        <span v-for="tag in post.tags" :key="tag" class="tag">{{ tag }}</span>
        <p v-html="post.intro"></p>
      </div>
  </router-link>
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
  &:link, &:active, &:hover &:visited {
    text-decoration: none;
    color: var(--gray-dark);
  }
  &:hover {
    border-color:var(--gray);
  }
  min-height: 300px;
  overflow: hidden;
  img.card-img {
    object-fit: cover;
    max-height: 100%;
    border-radius:0;
    padding:0;
  }

  .post-image {
    float: left;
    position: relative;
    width: 50%;
  }

  p {
    overflow: hidden;
    text-overflow: ellipsis;
    font-size: 1rem;
    color: var(--gray-dark);
  }
}
</style>
