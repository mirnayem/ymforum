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

    created(){
        Echo.channel('LikeChannel')
       .listen('LikeEvent', (e) => {
        if(this.content.id == e.id){
            e.type == 1 ? this.count ++ : this.count --
        }
    });
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