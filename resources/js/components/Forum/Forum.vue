<template>
<v-container fluid grid-list-md>
    <v-layout row wrap>
        <v-flex xs8>
           <question
           v-for="question in questions"
           :key="question.path"
           :question = question
           >
         
           </question>
        </v-flex>
           Category Sidebar
    </v-layout>
</v-container>
</template>

<script>
import Question from '../Forum/Question'
export default {
   components: {Question},

     data() {
      return {
          questions : {}
      }
  },

  created(){
      axios.get('/api/question')
      .then(res => this.questions = res.data.data)
      .catch(err => err.response.data)
  }
}
</script>

<style>

</style>