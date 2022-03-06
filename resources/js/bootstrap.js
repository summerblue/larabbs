window._ = require('lodash');

try {

  // 加载 jQuery
  window.$ = window.jQuery = require('jquery');

  require('bootstrap');
} catch (e) {}
