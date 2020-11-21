<template>
  <v-card
    class="mx-auto mt-2"
  >
  <v-card-title>
    <div>
        <router-link :to="question.path">
            <h3 class="black--text">{{question.title}}</h3>
        </router-link>
       
             <p class="grey--text">{{question.created_at}}</p>
    </div>

  </v-card-title>
    <v-card-text class="">
    <p>
         {{question.body}}
    </p>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  
  props: ['question']

  
}
</script>

<style>

</style>