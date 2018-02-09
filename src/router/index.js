import Vue from 'vue';
import Router from 'vue-router';
import HomePage from '@/components/HomePage';
import Post from '@/components/Post';
import CategoryIndex from '@/components/CategoryIndex';

Vue.use(Router);

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'Hello',
      component: HomePage,
    },
    {
      path: '/:categorySlug/',
      // @TODO: path param filtering (year/day etc)
      alias: [
        // '/:categorySlug/:year/:month/:day/', // Sculpin routes.
      ],
      name: 'CategoryIndex',
      component: CategoryIndex,
      props: true,
    },
    {
      path: '/:category/:slug', // WP+Hugo routes (The Weekly)
      alias: [
        '/:category/:year/:month/:day/:slug', // Sculpin routes.
        '/:category/:year/:slug', // Hugo routes
      ],
      name: 'Post',
      component: Post,
      props: true,
    },
  ],
});

// Paths:
// format: {category}/{year}/{month}/{day}/{slug} => /blog/2016/01/07/open-source-croudsourcing
// format: {category}/{year}/{slug} => /blog/2018/welcome-to-the-jungle
// format: {category}/{slug} => /weekly/12

// @TODO: WP will write /weekly/the-weekly-xx as the new slug.
// @TODO: Implement /weekly/:id => the-weekly-:id   as a rewrite...

