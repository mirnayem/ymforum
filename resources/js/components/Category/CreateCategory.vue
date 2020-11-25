<template>
    <v-container fluid >

       <v-alert
      dense
      outlined
      type="error"
      :value = "true"
      v-show="errors"
      v-for="err in errors"
      :key= err.id
    >
     {{err}}
    </v-alert>
        <v-form
          @submit.prevent="submit"
        >
            <v-text-field
            v-model="form.name"
          
            label="Category Name" 
            required
            ></v-text-field>

              <v-btn 
            color="orange"
            type="submit"
            
            v-if="editSlug"
            >
              Update
            </v-btn>
            <v-btn 
            color="green"
           
            type="submit"
            v-else
            >
               Create
            </v-btn>
        
        </v-form>

        <v-card>
               <v-toolbar
      color="indigo"
      dark
      dense
      class="mt-2"
    >

      <v-toolbar-title>Categories</v-toolbar-title>

    </v-toolbar>
    <div v-for="(category ,index) in categories"
             :key="category.id">
            <v-list-item>
               <v-icon
               color="orange"
               class="pr-2"
                @click="edit(index)"
               > mdi-pencil </v-icon>
               <v-list-item-title>{{category.name}}</v-list-item-title>
                 <v-icon
                 color="red"

                 @click="destroy(category.slug ,index)"
                 > mdi-delete </v-icon>
            </v-list-item>
        <v-divider></v-divider>
    </div>
        </v-card>
    </v-container>
</template>

<script>
export default {
       data() {
           return {
               form: {
                   name: null,
               },
               categories: {},
               editSlug:null,
               errors:null,
           }
       },

          created(){
          if( !User.admin()){
              this.$router.push('/forum')
          }
          axios.get('/api/category')
          .then(res => this.categories = res.data.data)
      },
    
   
   

       methods: {

        submit(){
            this.editSlug ? this.update() : this.create()
        },

        create(){
            axios.post('/api/category', this.form)
            .then(res =>  {
               this.categories.unshift(res.data)
               this.form.name = null
               })
               .catch(error => this.errors = error.response.data.errors.name)
        },

          update(){
            axios.patch(`/api/category/${this.editSlug}`, this.form)
            .then(res =>  {
               this.categories.unshift(res.data)
               this.form.name = null
               })
        },

        destroy(slug ,index){
            axios.delete(`/api/category/${slug}`)
            .then(res => this.categories.splice( index , 1))
        },

        edit(index){
           this.form.name = this.categories[index].name
           this.editSlug = this.categories[index].slug
           this.categories.splice(index ,1)
        }
       },

       computed: {
        //  disabled(){
        //    return !this.form.name 
        //  }
       }
}
</script>

<style>

</style>