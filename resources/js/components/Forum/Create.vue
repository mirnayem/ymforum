<template>
   <v-container fluid>

   
        <v-form
          @submit.prevent="create"
        >
              <v-text-field
              v-model="form.title"
              label="Title"
              required
            ></v-text-field>


               <v-autocomplete
                v-model="form.category_id"
                :items="categories"
                item-text= name
                item-value= id
                dense
                filled
                label="Category"
            ></v-autocomplete>


             <vue-simplemde v-model="form.body" ref="markdownEditor" />

            <v-btn 
            color="green"
            type="submit"
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
            .catch(err => this.errors = err.response.data.error)
        }
    }

}
</script>

<style>

</style>