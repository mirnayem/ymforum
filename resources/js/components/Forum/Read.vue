<template>
<v-container fluid>


 <div v-if="question">
     <edit-question 
     v-if="editing"
     :data = question
     ></edit-question>
          <show-question 
            v-else
            :data = question
         
            ></show-question>
         <replies
         :question="question"
         ></replies>
         <v-spacer> </v-spacer>

         <new-reply :questionSlug="question.slug" v-if="loggedIn"></new-reply>

         <div class="pl-4 mt-4" v-else >
             <router-link to="/login">
                 Log in to reply
             </router-link>
         </div>
         
 </div>
</v-container> 
</template>

<script>
import ShowQuestion from './ShowQuestion'
import EditQuestion from './EditQuestion'
import Replies from '../Reply/Replies'
import NewReply from '../Reply/NewReply'
export default {
    components: {ShowQuestion , EditQuestion,Replies , NewReply},

    data() {
        return {
            question:null,
            editing : false,

        }
    },

    created(){
        
       this.getQuestion() 
       this.listen() 
    },

    computed: {
        loggedIn(){
           return  User.loggedIn();
        }
    },

    methods: {
        listen(){
            EventBus.$on('startEditing' , ()=> {
               this.editing = true
         
            });

            EventBus.$on('cancelEditing', ()=>{
                 this.editing = false
                //  if(data !== this.question.title || this.question.body){
                //      this.question.title = this.beforeEditingTitle
                //      this.question.body = this.beforeEditingBody
                     
                //  }
            })
        },

        getQuestion(){
             axios.get(`/api/question/${this.$route.params.slug}`)
            .then(res => this.question = res.data.data)

        }
    }
}
</script>

<style>

</style>