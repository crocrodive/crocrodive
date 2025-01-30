import axios from "axios";

let token : string | null = null; 
const apiURL = "https://dev-aitazzo221.users.info.unicaen.fr/api"

export const api = axios.create({
    baseURL: apiURL,
    timeout: 5000,
    headers: {
      "Content-Type": "application/json",
    },
  }
);

api.interceptors.request.use(request => {
    if(token) {
        request.headers.Authorization = `Bearer ${token}`;
    }
    return request;
});

export function setToken( data_token : string){
    token = data_token
};
