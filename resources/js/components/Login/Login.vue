<template>
    <v-container>

   
        <v-form
          @submit.prevent="login"
        >
            <v-text-field
            v-model="form.email"
            label="E-mail"
            type="email"
            required
            ></v-text-field>


            <v-text-field
            v-model="form.password"
          
            label="Password"
            :append-icon="value ? 'mdi-eye' : 'mdi-eye-off'"
            @click:append="() => (value = !value)"
            :type="value ? 'password' : 'text'"
            
            required
            ></v-text-field>
            <v-btn 
            color="green"
            type="submit"
            :disabled="disabled"
            >
                Login
            </v-btn>
            <router-link
             color="blue"
             to="/signup">
               <v-btn color="blue"> 
                   Sign Up
               </v-btn>
            </router-link>
        </v-form>
    </v-container>
</template>

<script>
export default {
       data() {
           return {
               form: {
                   email: null,
                   password: null,
                
               },
                value: true,
           }
       },

       created(){
           if(User.loggedIn()){
               this.$router.push({name:'forum'})
           }
       },

       methods: {
          login(){
              User.login(this.form)
            
          }
       },

       computed: {
           disabled(){
               return !(this.form.email && this.form.password)
           }
       }
}
</script>

<style>

</style>