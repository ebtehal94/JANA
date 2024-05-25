/*=========================================================================================
  File Name: moduleAuthState.js
  Description: Auth Module State
  ----------------------------------------------------------------------------------------
  Project Name: Basmtak
  Author: Ahmed Khairy
  Author URL: http://www.clouds-line.com
==========================================================================================*/


// import auth from "@/auth/authService";
// import firebase from 'firebase/app'
// import 'firebase/auth'

export default {
    isUserLoggedIn: () => {
        if(localStorage.getItem("accessToken") && localStorage.getItem("userInfo") ) {
          return true;
        }else{
          return false
        }
    },
}
