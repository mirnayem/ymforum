<template>
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
         <v-spacer>
             <new-reply :questionSlug="question.slug"></new-reply>
         </v-spacer>
 </div>
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
            beforeEditingTitle:'',
            beforeEditingBody:'',

        }
    },

    created(){
        
       this.getQuestion() 
       this.listen() 
    },

    methods: {
        listen(){
            EventBus.$on('startEditing' , ()=> {
               this.editing = true
               this.beforeEditingTitle = this.question.title
               this.beforeEditingBody = this.question.body
            })

            EventBus.$on('cancelEditing', (data)=>{
                 this.editing = false
                 if(data !== this.question.title || this.question.body){
                     this.question.title = this.beforeEditingTitle
                     this.question.body = this.beforeEditingBody
                     
                 }
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