class AppStorage {
    storeToken(token){
       localStorage.setItem('token' , token)
    }

    storeUser(user){
        localStorage.setItem('user' , user)
    }

    store(user, token){
        this.storeUser(user)
        this.storeToken(token)
        
    }

    clear(){
        localStorage.removeItem('token')
        localStorage.removeItem('user')
    }

    getUser(){
       return localStorage.getItem('user')
    }

    getToken(){
       return localStorage.getItem('token')
    }
}


export default AppStorage = new AppStorage();