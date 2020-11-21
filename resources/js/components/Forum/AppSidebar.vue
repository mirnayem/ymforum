<template>
  <v-card class="mt-2">
      <v-toolbar
      color="indigo"
      dark
      dense
      >Category
      </v-toolbar>
      <v-list-item
      v-for="category in categories"
      :key = category.id
      ><v-list-item-content>
              {{category.name}}
          </v-list-item-content>
      </v-list-item>
      
  </v-card>
</template>

<script>
export default {
       data(){
           return {
               categories : {}
           }
       },

       created(){
           axios.get('/api/category')
           .then(res => this.categories = res.data.data)
       }
}
</script>

<style>

</style>