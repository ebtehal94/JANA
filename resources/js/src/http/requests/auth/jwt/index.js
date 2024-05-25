import axios from "../../../axios/index.js";
import store from "../../../../store/store.js";

// Token Refresh
let isAlreadyFetchingAccessToken = false;
let subscribers = [];

function onAccessTokenFetched(access_token) {
    console.log(access_token);
}

function addSubscriber(callback) {
    subscribers.push(callback);
}

export default {
    init() {
        axios.interceptors.response.use(
            function(response) {
                return response;
            },
            function(error) {
                // const { config, response: { status } } = error
                const { config, response } = error;
                const originalRequest = config;
                if (response && response.status === 401) {
                    if (!isAlreadyFetchingAccessToken) {
                        isAlreadyFetchingAccessToken = true;
                        store
                            .dispatch("auth/tryRefreshingToken")
                            .then(access_token => {
                                isAlreadyFetchingAccessToken = false;
                                onAccessTokenFetched(access_token);
                            });
                    }
                }
                return Promise.reject(error);
            }
        );
    },
    login(email, pwd) {
        return axios.post("/api/auth/login", { email: email, password: pwd });
    }, 
    registerUser(user, settings, shifts) {
        return axios.post("https://basmtak.com/api/auth/register", {
            user: user,
            settings: settings,
            shifts: shifts
        });
    },
    refreshToken() {
        return axios.post("/api/auth/refresh", {
            accessToken: localStorage.getItem("accessToken")
        });
    }
};
