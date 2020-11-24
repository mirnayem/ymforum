import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)
import Parallax from '../components/Parallax'
import Login from '../components/Login/Login';
import Signup from '../components/Login/Signup'
import Forum from '../components/Forum/Forum'
import Read from '../components/Forum/Read'
import Logout from '../components/Login/Logout'
import Create from '../components/Forum/Create'
import CreateCategory from '../components/Category/CreateCategory'

const routes = [
    { path: '/' , component: Parallax},
    { path: '/login', component: Login },
    { path: '/signup', component: Signup },
    { path: '/forum', component: Forum, name:'forum' },
    { path: '/logout', component: Logout },
    { path: '/question/:slug', component: Read, name:'read' },
    { path: '/ask' , component: Create },
    { path: '/category', component: CreateCategory},

  ]
  
  // 3. Create the router instance and pass the `routes` option
  // You can pass in additional options here, but let's
  // keep it simple for now.
  const router = new VueRouter({
    routes, // short for `routes: routes`
    mode: 'history',
  })
  

  export default router