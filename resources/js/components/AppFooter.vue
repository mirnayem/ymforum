<template>
  <div>
      <v-footer
    color="grey"
    padless
    
  >
    <v-row
      justify="center"
      no-gutters
    >
     
      <v-col
        class="indigo py-4 text-center white--text"
        cols="12"
      >
        {{ new Date().getFullYear() }} — <strong>YMForum</strong>
      </v-col>
    </v-row>
  </v-footer>
  </div>
</template>

<script>
  export default {
      
  }
</script>

<style>

</style>