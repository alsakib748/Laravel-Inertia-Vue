import axios from "axios";
import router from "./router.js";
import useUserStore from "./store/user.js";

const axiosClient = axios.create({
  baseURL: import.meta.env.VITE_API_BASE_URL || "http://localhost:8000",
  withCredentials: true,
  withXSRFToken: true,
  headers: {
    Accept: "application/json",
    "Content-Type": "application/json"
  }
});

// Request interceptor to ensure CSRF token is set
axiosClient.interceptors.request.use((config) => {
  // For non-GET requests, ensure we have a CSRF token
  if (config.method !== "get") {
    // The CSRF token will be automatically included by withXSRFToken: true
    // but we need to ensure the cookie is set first
    if (!document.cookie.includes("XSRF-TOKEN")) {
      // If no CSRF token, we'll need to get one
      return axios
        .get(`${config.baseURL}/sanctum/csrf-cookie`, { withCredentials: true })
        .then(() => config);
    }
  }
  return config;
});

axiosClient.interceptors.response.use(
  (response) => {
    return response;
  },
  (error) => {
    if (error.response && error.response.status === 401) {
      // Clear any stored user data
      const userStore = useUserStore();
      userStore.clearUser();
      router.push({ name: "Login" });
    }

    throw error;
  }
);

export default axiosClient;
