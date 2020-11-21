<template>
<v-container fluid grid-list-md>
    <v-layout row wrap>
        <v-flex sm8>
           <question
           v-for="question in questions"
           :key="question.path"
           :question = question
           >
         
           </question>
        </v-flex>
          <v-flex sm4>
              <app-sidebar></app-sidebar>
          </v-flex>
    </v-layout>
</v-container>
</template>

<script>
import Question from '../Forum/Question'
import AppSidebar from '../Forum/AppSidebar'
export default {
   components: {Question , AppSidebar},

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