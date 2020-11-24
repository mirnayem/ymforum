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

           <div class="text-center mt-4 pt-5">
            <v-pagination
             v-model="meta.current_page"
            :length="meta.total"
            @input = "pageChange"
            ></v-pagination>
          </div>
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
          questions : {},

          meta : {}
      }
  },

  created(){
     this.fetchQuestions()
  },

  methods: {
    
    fetchQuestions(page){
        let url = page ? `/api/question/?page=${page}` : '/api/question'
         axios.get(url)
      .then(res => {
          this.questions = res.data.data
          this.meta = res.data.meta
      })
      .catch(err => err.response.data)
      },
      pageChange(page){
       this.fetchQuestions(page)
      }
  }
}
</script>

<style>

</style>