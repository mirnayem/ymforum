<template>
   <v-container fluid>

   
        <v-form
          @submit.prevent="create"
        >    
              <span class="red--text" v-if="errors.title"> {{errors.title[0]}} </span>
              <v-text-field
              v-model="form.title"
              label="Title"
              required
            ></v-text-field>

              <span class="red--text" v-if="errors.category_id"> {{errors.category_id[0]}} </span>
               <v-autocomplete
                v-model="form.category_id"
                :items="categories"
                item-text= name
                item-value= id
                dense
                filled
                label="Category"
            ></v-autocomplete>

             <span class="red--text" v-if="errors.body"> {{errors.body[0]}} </span>
             <vue-simplemde v-model="form.body" ref="markdownEditor" />

            <v-btn 
            color="green"
            type="submit"
            :disabled="disabled"
            >
                Ask Question
            </v-btn>
            
        </v-form>
    </v-container>
</template>

<script>
export default {

    data() {
        return {
            form:{
                title: null,
                body: null,
                category_id: null
                
            },

            categories : [],
            errors:{}
        }
    },

    created(){
        axios.get('/api/category')
        .then(res => this.categories = res.data.data)
    },

    methods: {
        create(){
            axios.post('/api/question' , this.form)
            .then(res => this.$router.push(res.data.path))
            .catch(err => this.errors = err.response.data.errors)
        }
    },

    computed: {
        disabled(){
            // return !(this.form.title && this.form.body && this.form.category_id) || (this.form.title.length < 10) || (this.form.body.length < 20)
        }
    }

}
</script>

<style>

</style>