<template>
<v-container fluid>
    <v-card class="mt-2">
        <v-card-title>
            <div>
             <h2>  {{data.user}} </h2>
            </div>
            <div class="pl-2 grey--text font-weight-light">
               said {{data.created_at}}
            </div>
            <v-spacer></v-spacer>
             <like
             :content= data
             > </like>
        </v-card-title>

        <edit-reply
         v-if="editing"
         :reply= data
         ></edit-reply>

        <v-card-text v-else v-html="reply"></v-card-text>
       
        <v-divider></v-divider>

        <div v-if="!editing">
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
        </div>
        <v-divider></v-divider>
    
    </v-card>
</v-container>
</template>

<script>
import EditReply from './EditReply'
import Like from '../Likes/like'
export default {
   props: ['data', 'index'],
   components:{EditReply , Like},
   data(){
       return{
           editing:false,
           beforeEditReplyBody : ''
       }
   },
   computed:{
       own(){
         return  User.own(this.data.user_id);
       },

      reply(){
           return md.parse(this.data.reply)
       } 

   },

    created(){
       this.listen()
    }, 

   methods: {
       destroy(){
           EventBus.$emit('deleteReply' ,this.index)
       },


       edit(){
          this.editing = true
          this.beforeEditReplyBody = this.data.reply

       },
       listen(){
        EventBus.$on('cancelEditing', (reply) => {
            this.editing = false 
            if(reply !== this.data.reply)
            {

              this.data.reply = this.beforeEditReplyBody

            }
        })
       }
   },

 


}
</script>

<style>

</style>