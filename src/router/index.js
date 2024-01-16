import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import Login from "../views/auth/Login.vue";
import Register from "../views/auth/Register.vue";
import DashboardView from "../views/DashboardView.vue";
import Logout from "../views/auth/Logout.vue";
import Test from "../views/Test.vue";
import PlaceEdit from "../views/edit/PlaceEdit.vue";
import PlaceDetail from "../views/detail/PlaceDetail.vue";
import NotFound from "../views/errors/404.vue";
import PlaceAdd from "../views/add/PlaceAdd.vue";
import ProfileView from "../views/ProfileView.vue";
import ScheduleAdd from '../views/add/ScheduleAdd.vue'
import ScheduleDetail from '../views/detail/ScheduleDetail.vue'
import ScheduleEdit from '../views/edit/ScheduleEdit.vue'

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: "/:pathMatch(.*)*",
            name: "not-found",
            component: NotFound,
        },
        {
            path: "/",
            name: "home",
            component: HomeView,
        },
        {
            path: "/login",
            name: "Login Front End",
            component: Login,
        },
        {
            path: "/register",
            name: "Register Front End",
            component: Register,
        },
        {
            path: "/logout",
            name: "Logout Front End",
            component: Logout,
        },
        {
            path: "/dashboard",
            name: "Dashboard Front End",
            component: DashboardView,
        },
        {
            path: "/testt",
            name: "Test View",
            component: Test,
        },
        {
            path: "/place/:id/edit",
            name: "Place Edit",
            component: PlaceEdit,
        },
        {
            path: "/place/:id/detail",
            name: "Detail Place",
            component: PlaceDetail,
        },
        {
            path: "/place/add",
            name: "Tambah terminal",
            component: PlaceAdd,
        },
        {
            path: "/schedule/add",
            name: "Tambah jadwal",
            component: ScheduleAdd
        },
        {
            path: '/schedule/:id/detail',
            name: 'Detail Jadwal',
            component: ScheduleDetail
        },
        {
            path: '/schedule/:id/edit',
            name: 'Edit Jadwal',
            component: ScheduleEdit
        },
        {
            path: "/profile",
            name: "Halaman Profile",
            component: ProfileView
        },
    ],
});

router.beforeEach((to, from, next) => {
    document.title = to.name;
    next();
});

export default router;
