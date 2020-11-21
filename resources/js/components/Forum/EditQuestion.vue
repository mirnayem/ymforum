<template>
  <v-container fluid>
      <v-card>
   
        <v-form
          @submit.prevent="updatequestion"
        >
              <v-text-field
              v-model="form.title"
              label="Title"
              required
            ></v-text-field>


             <vue-simplemde v-model="form.body" ref="markdownEditor" />
            <v-card-actions>
                <v-btn 
                type="submit"
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
                @click="cancelquestion"
                ><v-icon
                color="red"
                >mdi-close</v-icon>
                </v-btn>
            </v-card-actions>
        </v-form>

           </v-card> 
    </v-container>
</template>

<script>
export default {

       props: ['data'],
       data() {
           return {
               form: {
                   title: null,
                   body: null
               },

              
           }
       },



       methods: {
           cancelquestion(data){
               EventBus.$emit('cancelEditing', data)
           },

           updatequestion(){
              
               axios.patch(`/api/question/${this.form.slug}` , this.form)
               .then(res => this.cancel(this.data.title , this.data.body))
           }
       },

        created(){
           this.form = this.data
       }
}
</script>

<style>

</style>