import { defineStore } from "pinia";
import axiosClient from "../axios.js";

const useUserStore = defineStore("user", {
  state: () => ({
    user: null
  }),
  actions: {
    fetchUser() {
      return axiosClient.get("/api/user").then(({ data }) => {
        console.log("User data:", data);
        this.user = data;
        return data;
      });
    },
    clearUser() {
      this.user = null;
    }
  }
});

export default useUserStore;
