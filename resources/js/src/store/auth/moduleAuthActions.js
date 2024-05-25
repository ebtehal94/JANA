/*=========================================================================================
  File Name: moduleAuthActions.js
  Description: Auth Module Actions
  ----------------------------------------------------------------------------------------
  Project Name: Basmtak
  Author: Ahmed Khairy
  Author URL: http://www.clouds-line.com
==========================================================================================*/

import jwt from "../../http/requests/auth/jwt/index.js";

// import firebase from 'firebase/app'
// import 'firebase/auth'
import router from "@/router";
import Echo from "laravel-echo";
window.Pusher = require("pusher-js");

export default {
    // JWT
    loginJWT({ commit }, payload) {
        return new Promise((resolve, reject) => {
            jwt.login(payload.userDetails.email, payload.userDetails.password)
                .then(response => {
                    // If there's user data in response
                    if (response.data.userData) {
                        // Navigate User to homepage
                        // router.push(router.currentRoute.query.to || '/')
                        // router.push(router.currentRoute.query.to || '/dashboard')

                        // Set accessToken

                        localStorage.setItem(
                            "accessToken",
                            response.data.accessToken
                        );

                        localStorage.setItem(
                            "userPerms",
                            JSON.stringify(response.data.userData.perms)
                        );
                        if (response.data.userData.account.color != null) {
                            localStorage.setItem(
                                "mainColor",
                                response.data.userData.account.color
                            );
                        }

                        localStorage.setItem(
                            "homeItems",
                            JSON.stringify(response.data.homeItems)
                        );

                        let timeObject = new Date();
                        let seconds = response.data.expires_in * 1000; // milliseconds
                        timeObject = new Date(timeObject.getTime() + seconds);

                        localStorage.setItem(
                            "tokenExpirey",
                            timeObject.toString()
                        );

                        // Update user details
                        commit("UPDATE_USER_INFO", response.data.userData, {
                            root: true
                        });

                        // Set bearer token in axios
                        commit("SET_BEARER", response.data.accessToken, {
                            root: true
                        });

                        resolve(response);
                    } else {
                        // if (response.data.statusCode == 401){
                        reject({ message: response.data.message });
                        // }else if(response.data.statusCode == 401){
                        // }
                    }
                })
                .catch(error => {
                    reject({ message: "Error!" });
                });
        });
    },
    registerUserJWT({ commit }, payload) {
        // const { user, account } = payload

        return new Promise((resolve, reject) => {
            // Check confirm password
            // if(password !== confirmPassword) {
            // reject({message: "Password doesn't match. Please try again."})
            // }

            jwt.registerUser(payload.user, payload.settings, payload.shifts)
                .then(response => {
                    if (response.data.userData) {
                        // Update data in localStorage
                        localStorage.setItem(
                            "accessToken",
                            response.data.accessToken
                        );

                        localStorage.setItem(
                            "userPerms",
                            JSON.stringify(response.data.userData.perms)
                        );

                        localStorage.setItem(
                            "homeItems",
                            JSON.stringify(response.data.homeItems)
                        );

                        let timeObject = new Date();
                        let seconds = response.data.expires_in * 1000; // milliseconds
                        timeObject = new Date(timeObject.getTime() + seconds);

                        localStorage.setItem(
                            "tokenExpirey",
                            timeObject.toString()
                        );

                        // Update user details
                        commit("UPDATE_USER_INFO", response.data.userData, {
                            root: true
                        });

                        // Set bearer token in axios
                        commit("SET_BEARER", response.data.accessToken, {
                            root: true
                        });

                        // Redirect User
                        // router.push(router.currentRoute.query.to || '/dashboard')

                        resolve(response);
                    } else {
                        reject(response.data.message);
                    }
                })
                .catch(error => {
                    reject(error);
                });
        });
    },
    tryRefreshingToken({ commit }) {
        return new Promise((resolve, reject) => {
            jwt.refreshToken()
                .then(response => {
                    if (response.data.statusCode == 200) {
                        localStorage.setItem(
                            "accessToken",
                            response.data.accessToken
                        );
                        // Set bearer token in axios
                        commit("SET_BEARER", response.data.accessToken, {
                            root: true
                        });

                        let timeObject = new Date();
                        let seconds = response.data.expires_in * 1000; // milliseconds
                        timeObject = new Date(timeObject.getTime() + seconds);

                        localStorage.setItem(
                            "tokenExpirey",
                            timeObject.toString()
                        );

                        router.go();
                        resolve(response);
                    }
                })
                .catch(error => {
                    console.log("token refresh failed");
                    localStorage.removeItem("accessToken");
                    localStorage.removeItem("tokenExpirey");
                    localStorage.removeItem("homeItems");
                    localStorage.removeItem("userInfo");
                    router.push("/login");
                    reject(error);
                });
        });
    }
};
