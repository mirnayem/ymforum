<template>
  <v-card
    class="mx-auto mt-2"
    data-aos="fade-up" data-aos-duration="300"
  >
  <v-card-title>
    <div>
        <router-link :to="question.path">
            <h3 class="black--text">{{question.title}}</h3>
        </router-link>
        <v-spacer></v-spacer>
            <p class="pt-4">By {{question.user}} <span class="grey--text text-weight-thin"> {{question.created_at}} </span> </p>
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