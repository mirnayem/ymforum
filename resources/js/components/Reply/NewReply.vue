<template>
  <v-container class="mt-4" fluid>
      <vue-simplemde v-model="body" ref="markdownEditor" />

            <v-btn 
            fab
            small
            color="indigo"
            dark
            @click="submit"
            >
                <v-icon >
                    mdi-reply
                </v-icon>
            </v-btn>
  </v-container>
</template>

<script>
export default {

     props: ['questionSlug'],
      data(){
          return{
              body: null
          }
      },

      methods: {
          submit(){
              axios.post(`/api/question/${this.questionSlug}/reply`, {body: this.body})
              .then(res => {
                  this.body = null
                  EventBus.$emit('newReply' , res.data.reply)
           
  
              })
          }
      }
}
</script>

<style>

</style>