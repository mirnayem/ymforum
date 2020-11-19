<template>
    <v-container>

   
        <v-form
          @submit.prevent="signup"
        >
           <v-text-field
           v-model="form.name"
           label="Name"
           :type="text"
           required
           ></v-text-field>
           <span class="red--text"  v-if="errors.name"> {{errors.name[0]}} </span>
        

            <v-text-field
            v-model="form.email"
            :type="email"
            label="E-mail"
            required
            ></v-text-field>
             <span class="red--text"  v-if="errors.email"> {{errors.email[0]}} </span>

            <v-text-field
            v-model="form.password"
              :append-icon="value ? 'mdi-eye' : 'mdi-eye-off'"
            @click:append="() => (value = !value)"
            :type="value ? 'password' : 'text'"
            label="Password"
            required
            ></v-text-field>
             <span class="red--text"  v-if="errors.password"> {{errors.password[0]}} </span>

              <v-text-field
            v-model="form.password_confirmation"
            :append-icon="value ? 'mdi-eye' : 'mdi-eye-off'"
            @click:append="() => (value = !value)"
            :type="value ? 'password' : 'text'"
            label="Password Confirm"
            required
            ></v-text-field>
        
            <v-btn 
            color="green"
            type="submit"
            >
                Sign Up
            </v-btn>
               <router-link
            
             to="/login">
                <v-btn
                color="blue"
                >
                    Login
                </v-btn>
            </router-link>
        </v-form>
    </v-container>
</template>

<script>

export default {
     data(){
         return {
             form: {
                 name:null,
                 email:null,
                 password:null,
                 password_confirmation:null
             },
             errors: {},
             value:true
         }
     },

    created(){
           if(User.loggedIn()){
               this.$router.push({name:'forum'})
           }
       },

     methods: {
         signup(){
             const errors = this.errors
             axios.post('/api/signup', this.form)
             .then(res => {
                 User.responseAfterLogin(res)
                 this.$router.push({name:'forum'})
                 })
             .catch(error => this.errors = error.response.data.errors)
         }
     }
}
</script>

<style>

</style>