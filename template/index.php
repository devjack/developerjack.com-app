<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link rel="app.developerjack.com" href="<?php echo get_theme_mod('app_baseurl');?>" />
    
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="robots" content="all" />

  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_theme_mod('app_baseurl');?>static/img/icons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_theme_mod('app_baseurl');?>static/img/icons/favicon-16x16.png">
  <!--[if IE]><link rel="shortcut icon" href="/static/img/icons/favicon.ico"><![endif]-->
  <!-- Add to home screen for Android and modern mobile browsers -->
  <link rel="manifest" href="<?php echo get_theme_mod('app_baseurl');?>static/manifest.json">
  <meta name="theme-color" content="#4DBA87">
  <!-- Add to home screen for Safari on iOS -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="developerjack.com">
  <link rel="apple-touch-icon" href="<?php echo get_theme_mod('app_baseurl');?>static/img/icons/apple-touch-icon-152x152.png">
  <link rel="mask-icon" href="<?php echo get_theme_mod('app_baseurl');?>static/img/icons/safari-pinned-tab.svg" color="#4DBA87">
  <!-- Add to home screen for Windows -->
  <meta name="msapplication-TileImage" content="<?php echo get_theme_mod('app_baseurl');?>static/img/icons/msapplication-icon-144x144.png">
  <meta name="msapplication-TileColor" content="#000000">


  <meta name="Description" content="<?php echo get_bloginfo('description');?>">

  <?php wp_head(); ?>
  <style>
  .spinner {
    width: 40px;
    height: 40px;
    position: relative;
    margin: 100px auto;
  }
  .double-bounce1, .double-bounce2 {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background-color: #333;
    opacity: 0.6;
    position: absolute;
    top: 0;
    left: 0;
    -webkit-animation: sk-bounce 2.0s infinite ease-in-out;
    animation: sk-bounce 2.0s infinite ease-in-out;
  }
  .double-bounce2 {
    -webkit-animation-delay: -1.0s;
    animation-delay: -1.0s;
  }
  @-webkit-keyframes sk-bounce {
    0%, 100% { -webkit-transform: scale(0.0) }
    50% { -webkit-transform: scale(1.0) }
  }
  @keyframes sk-bounce {
    0%, 100% { 
      transform: scale(0.0);
      -webkit-transform: scale(0.0);
    } 50% { 
      transform: scale(1.0);
      -webkit-transform: scale(1.0);
    }
  }
  </style>
</head>
<body <?php body_class(); ?>>
  <div id="app">
    <div class="spinner">
      <div class="double-bounce1"></div>
      <div class="double-bounce2"></div>
    </div>
  </div>
  
  <?php wp_footer(); ?>

  <!-- it wouldn't be developerjack.com if it didn't have an https://pride.codes asset! -->
  <link rel="stylesheet" href="https://cdn.pride.codes/css/bar_helpers.css" rel="preload" as="style" onload="this.rel='stylesheet'">
  
  <!-- Required for posts that embed twitter -->
  <script>window.twttr = (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0],
    t = window.twttr || {};
    if (d.getElementById(id)) return t;
    js = d.createElement(s);
    js.id = id;
    js.async='async';
    js.src = "https://platform.twitter.com/widgets.js";
    fjs.parentNode.insertBefore(js, fjs);

    t._e = [];
    t.ready = function(f) {
      t._e.push(f);
    };
    return t;
  }(document, "script", "twitter-wjs"));</script>
</body>
</html>