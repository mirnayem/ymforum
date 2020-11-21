<template>
  <div>
      <v-card>
          <vue-simplemde v-model="reply.reply" ref="markdownEditor" />
            <v-card-actions>
                <v-btn 
               @click="update"
                class="mx-2"
                fab
                small
                ><v-icon
                color="orange"
                >mdi-content-save</v-icon>
                </v-btn>

                   <v-btn 
                class="mx-2"
                fab
                small
                @click="cancel"
                ><v-icon
                color="red"
                >mdi-close</v-icon>
                </v-btn>
            </v-card-actions>
      </v-card>
  </div>
</template>

<script>
export default {

    props: ['reply'],
   

     methods:{
         cancel(reply){
            EventBus.$emit('cancelEditing', reply)
         },

         update(reply){
           axios.patch(`/api/question/${this.reply.question_slug}/reply/${this.reply.id}`, {body: this.reply.reply})
           .then(res => {
               this.cancel(this.reply.reply)
           })          
         }
     }

  

}
</script>

<style>

</style>