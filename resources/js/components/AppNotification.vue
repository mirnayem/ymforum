<template>
  <div class="text-center">
    <v-menu offset-y>
      <template v-slot:activator="{ on, attrs }">
        <v-btn
         
          v-bind="attrs"
          v-on="on"
        >
          <v-icon
          :color="color"
          >
              mdi-bell
          </v-icon>
          <span>{{unreadsCount}}</span>
        </v-btn>
      </template>
      <v-list>
        <v-list-item
         v-for="item in unreads"
        :key="item.id"
        >
        <router-link :to="item.path">
              <v-list-item-title @click="readIt(item)">{{item.question}}</v-list-item-title> 
        </router-link>
        
        </v-list-item>
        <v-divider></v-divider>
         <v-list-item
         v-for="item in reads"
        :key="item.id"
        >
          <v-list-item-title>{{item.question}}</v-list-item-title>
        </v-list-item>
       
      </v-list>
    </v-menu>
  </div>


 
</template>

<script>
  export default {
      data(){

         
          return{
            reads: {},
            unreads: {},
            unreadsCount: 0
          }
      },
     
     computed :{
        color(){
         return this.unreadsCount > 0 ? 'red' : 'red lighten-4'
        }
     },
   

      methods: {
          getNotifications(){
              axios.post('/api/notifications')
              .then(res => {
                  this.reads = res.data.read
                  this.unreads = res.data.unread
                  this.unreadsCount = res.data.unread.length

                 
              })

           
          },

          readIt(notification){
            axios.post('/api/markedAsRead', {id:notification.id})
            .then(res => {
              this.unreads.splice(notification ,1)
              this.reads.push(notification)
              this.unreadsCount--
            })
          }
      },

         created(){
          if(User.loggedIn()){
              this.getNotifications()
          }


           Echo.private('App.Models.User.' + User.id())
        .notification((notification) => {
            this.unreads.unshift(notification)
            this.unreadsCount++
        });
        
      }
  }
</script>

<style>

</style>