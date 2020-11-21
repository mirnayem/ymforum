<template>
  <div>
     
          <v-icon
          :color="color"
          @click="likedIt"
          >mdi-heart
          </v-icon>
          <span>{{count}}</span>
  </div>
</template>

<script>
export default {
    props: ['content'],
    data(){
        return {
            liked: this.content.liked,
            count: this.content.like_count
        }
    },

    computed: {
        color(){
          return  this.liked ? 'red' : 'blue lighten-4'
        }
    },

    methods: {
        likedIt(){
            if(User.loggedIn()){
                this.liked ? this.decr() : this.incr()
                this.liked = !this.liked
            }
            else{
                this.$router.push('/login')
            }
        },

        incr(){
            axios.post(`/api/like/${this.content.id}`)
            .then(res => this.count ++)
        },

        decr(){
            axios.delete(`/api/like/${this.content.id}`)
            .then(res => this.count --)
        }
    }
}
</script>

<style>

</style>