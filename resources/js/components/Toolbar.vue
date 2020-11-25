<template>
<div>


    <v-toolbar color="indigo" dark>

      <v-toolbar-title>
        
       <router-link 
       class="white--text text-decoration-none headline"
       to="/">
         YMForum
       </router-link>
        
        </v-toolbar-title>

      <v-spacer></v-spacer>
      <app-notification v-if="loggedIn" ></app-notification>
      <div class="hidden-sm-and-down">
    
         <router-link
         v-for="item in items"
         :key='item.title'
         :to="item.to"
         v-show="item.show"
       
         ><v-btn text>{{item.title}}</v-btn>
         </router-link>
       
       </div>

       <v-app-bar-nav-icon 
       class="d-md-none"
       @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
        

    </v-toolbar>
  
<v-navigation-drawer
      v-model="drawer"
      absolute
      right
      temporary
    >
    <v-list
        nav
      >
        <v-list-item-group
          v-model="group"
          
        >
          <v-list-item
          
         v-for="item in items"
         :key='item.title'
          v-show="item.show"
         >
            <v-list-item-title>
              <router-link 
              :to="item.to"
              class="text-decoration-none indigo--text"
             
              >
               {{item.title}}
              </router-link>
            </v-list-item-title>

            
          </v-list-item>



        </v-list-item-group>
        
      </v-list>
    </v-navigation-drawer>

 

</div>

</template>

<script>
import AppNotification from './AppNotification'
export default {
  components : {AppNotification},
   data() {
     return {
       loggedIn : User.loggedIn(),  
       items: [
          {title:'Forum', to:'/forum', show:true},
          {title:'Ask Question', to:'/ask',show:User.loggedIn()},
          {title:'Category', to:'/category',show:User.admin()},
          {title:'Login', to:'/login',show:!User.loggedIn()},
          {title:'Logout', to:'/logout',show:User.loggedIn()},
       ],
       drawer : false,
       group : null
     }
   },

   created(){
     EventBus.$on('logout' ,  ()=> {
        User.logout()
     })
   },

      watch: {
      group () {
        this.drawer = false
      },
    },
}
</script>

<style>

</style>