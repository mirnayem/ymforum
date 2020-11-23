<template>
  <v-card>
      <v-container fluid>
      <v-card-title>
          <div>

     
            <div class="headline">
                {{data.title}}
            </div>

            <span class="grey--text"> {{data.user}} said {{data.created_at}} </span>

        </div>

        <v-spacer></v-spacer>
        <v-btn color="indigo" class="white--text"> {{replyCount}} Replies </v-btn>
      </v-card-title>

      <v-card-text v-html="body"></v-card-text>

      <v-spacer></v-spacer>
      <v-card-actions v-if="own">
     <v-btn
      class="mx-2"
      fab
      small
      @click="edit"
    ><v-icon color="orange">
        mdi-pencil
      </v-icon>
    </v-btn>

     <v-btn
      class="mx-2"
      fab
      small
      @click="destroy"
    ><v-icon color="red">
        mdi-delete
      </v-icon>
    </v-btn>

      </v-card-actions>

      </v-container>   
  </v-card>
</template>

<script>
export default {
  data() {
      return {
          own : User.own(this.data.user_id),
          replyCount: this.data.replies_count,
      }
  },

   props: ['data'],

   computed:{
       body(){
           return md.parse(this.data.body)
       }
   },

   created(){
       EventBus.$on('newReply' , ()=> {
         this.replyCount++
       })

        EventBus.$on('deleteReply' , ()=> {
         this.replyCount--
       })

         Echo.private('App.Models.User.' + User.id())
        .notification((notification) => {
            this.replyCount++
        });

        Echo.channel('deleteReplyChannel')
        .listen('DeleteReplyEvent', (e)=> {
            this.replyCount--
        })
   },

   methods: {
       destroy(){
           axios.delete(`/api/question/${this.data.slug}`)
           .then(res => this.$router.push('/forum'))
           .catch(err => console.log(err))
       },

       edit(){
           EventBus.$emit('startEditing')
          
       }
   }
}
</script>

<style>

</style>