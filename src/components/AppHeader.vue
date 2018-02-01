<template>
  <div class="container">
    <nav id="navbar" class="navbar">
      <a class="navbar-brand" href="#">
        {{title}}
      </a>
      <ul id="social">
        <li v-for="network in social" :key="network.name">
          <a v-bind:href="network.href" :title="network.name" target="_blank">
              <font-awesome-icon :icon="faIconFromName(network.name)" size="lg" />
          </a>
        </li>
      </ul>
    </nav>
    <div id="rainbow" class="pride-strip"></div>
    
    <div id="menu">
      <ul class="menu">
        <li><a href="#" class="menu-link">Home</a></li>
        <li><a href="#" class="menu-link">Blog</a></li>
        <li><a href="#" class="menu-link">The Weekly</a></li>
        <li><a href="#" class="menu-link">Press</a></li>
      </ul>
    </div>
  </div>
</template>

<script>
import FontAwesomeIcon from '@fortawesome/vue-fontawesome';
import {
  faFacebook,
  faTwitter,
  faPinterest,
  faGithub,
  faLinkedinIn,
  faFlickr,
  faGooglePlusG,
  faInstagram,
} from '@fortawesome/fontawesome-free-brands';
import {
  faCoffee,
} from '@fortawesome/fontawesome-pro-light';


export default {
  name: 'AppHeader',
  components: {
    FontAwesomeIcon,
  },
  methods: {
    faIconFromName: (icon) => {
      switch (icon) {
        case 'coffee': return faCoffee;
        case 'twitter': return faTwitter;
        case 'instagram': return faInstagram;
        case 'pinterest': return faPinterest;
        case 'github': return faGithub;
        case 'facebook': return faFacebook;
        case 'linkedin': return faLinkedinIn;
        case 'flickr': return faFlickr;
        case 'gplus': return faGooglePlusG;
        default: return faCoffee;
      }
    },
  },
  props: {
    title: {
      type: String,
      required: true,
    },
    social: {
      type: Array,
      required: false,
    },
  },
};
</script>

<style lang="scss">
nav#navbar {
  padding: 1em 0;
  align-items: baseline;
  justify-content: space-between;

  // Center the wrap for smaller screens
  @media only screen and (max-width: 500px) {
    & {
      justify-content: center;
      & > *,
      & > ul#social {
        padding: 0 1em;
      }
    }
  }
  
  a, a:visited {
    &.navbar-brand {
      margin-right:0;
    }
    text-decoration: none;
    color: var(--gray-dark);
  }  
}


ul#social {
  margin:0;
  padding:0;
  display: inherit;
  li {
    list-style-type: none;
    float: left;
    padding: 0.5em;
    a, a:visited {
      text-decoration: none;
      color: var(--gray-dark);
    }
    &:last-child{
      padding-right:0;
    }
  }
}


#rainbow.pride-strip {
  margin: auto;
  height: 2px;
}


div#menu {
  display: table;
  margin: 0 auto;
  ul {
    list-style: none;
	  margin: 0;
    padding: 1em 0 0 0;
    li {
      list-style-type: none;
      display: inline;
      padding: 1em;
      a, a:visited {
        text-decoration: none;
        color: var(--gray-dark);
      }
    }
  }
  margin-bottom: 1em;
}

</style>
