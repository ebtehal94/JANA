/*=========================================================================================
  File Name: moduleAuthActions.js
  Description: Auth Module Actions
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

import jwt from "../../http/requests/auth/jwt/index.js"


// import firebase from 'firebase/app'
// import 'firebase/auth'
import router from '@/router'

export default {

    // JWT
    loginJWT({ commit }, payload) {

      return new Promise((resolve,reject) => {
        jwt.login(payload.userDetails.email, payload.userDetails.password)
          .then(response => {

            // If there's user data in response
            if(response.data.userData) {
              // Navigate User to homepage
              // router.push(router.currentRoute.query.to || '/')

              // Set accessToken

              localStorage.setItem("accessToken", response.data.accessToken)

              let timeObject = new Date();
              let seconds = response.data.expires_in * 1000; // milliseconds
              timeObject = new Date(timeObject.getTime() + seconds);

              localStorage.setItem("tokenExpirey", timeObject.toString() )


              // Update user details
              commit('UPDATE_USER_INFO', response.data.userData, {root: true})

              // Set bearer token in axios
              commit("SET_BEARER", response.data.accessToken, {root: true})
              //
              // store.dispatch('updateUserRole', 'admin')
              // router.push('/')

              resolve(response)
            }else {
              reject({message: "Wrong Email or Password"})
            }

          })
          .catch(error => { reject({message: "Error!"}) })
      })
    },
    registerUserJWT({ commit }, payload) {

      // const { displayName, email, password, confirmPassword } = payload.userDetails

      return new Promise((resolve,reject) => {

        // Check confirm password
        // if(password !== confirmPassword) {
        //   reject({message: "Password doesn't match. Please try again."})
        // }

        jwt.registerUser(payload)
          .then(response => {
            // Redirect User
            // router.push('/')

            // Update data in localStorage
            if(response.data.userData) {
              // Navigate User to homepage
              // router.push(router.currentRoute.query.to || '/')

              // Set accessToken

              localStorage.setItem("accessToken", response.data.accessToken)

              let timeObject = new Date();
              let seconds = response.data.expires_in * 1000; // milliseconds
              timeObject = new Date(timeObject.getTime() + seconds);

              localStorage.setItem("tokenExpirey", timeObject.toString() )


              // Update user details
              commit('UPDATE_USER_INFO', response.data.userData, {root: true})

              // Set bearer token in axios
              commit("SET_BEARER", response.data.accessToken, {root: true})
              //
              // store.dispatch('updateUserRole', 'admin')
              // router.push('/')

              resolve(response)
            }else{
              resolve(response)
            }
          })
          .catch(error => { reject(error) })
      })
    },
    fetchAccessToken() {
      return new Promise((resolve) => {
        jwt.refreshToken().then(response => { resolve(response) })
      })
    }
}
