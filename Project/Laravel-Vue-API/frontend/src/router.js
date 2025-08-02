import { createRouter, createWebHistory } from "vue-router";
import DefaultLayout from "./components/DefaultLayout.vue";
// import Login from "../../backend/vendor/laravel/breeze/stubs/inertia-react/resources/js/Pages/Auth/Login.jsx";
import Home from "./pages/Home.vue";
import MyImages from "./pages/MyImages.vue";
import Login from "./pages/Login.vue";
import Signup from "./pages/Signup.vue";
import NotFound from "./pages/NotFound.vue";
import useUserStore from "./store/user";

const routes = [
  {
    path: "/",
    component: DefaultLayout,
    children: [
      { path: "/", name: "Home", component: Home },
      { path: "/images", name: "MyImages", component: MyImages }
    ],
    beforeEnter: async (to, from, next) => {
      try {
        const userStore = useUserStore();
        // Only fetch user if not already loaded
        if (!userStore.user) {
          await userStore.fetchUser();
        }
        next();
      } catch (error) {
        console.log("Failed to fetch user data: ", error);
        // Redirect to login if authentication fails
        next({ name: "Login" });
      }
    }
  },
  {
    path: "/login",
    name: "Login",
    component: Login
  },
  {
    path: "/signup",
    name: "Signup",
    component: Signup
  },
  {
    path: "/:pathMatch(.*)*",
    name: "NotFound",
    component: NotFound
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
