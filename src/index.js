import './style.scss';

import Router from './util/Router';
import common from './routes/common';


/**
 * Populate Router instance with DOM routes
 * @type {Router} routes - An instance of our router
 */
const routes = new Router({
  /** All pages */
  common
});

/** Load Events */
document.addEventListener("DOMContentLoaded", function(){
  routes.loadEvents()
})
