import DashboardComponent from "../views/DashboardComponent";
import categoriesComponent from "../views/courses/categoriesComponent";


const routes =[
    {
        path: '/admin/dashboard',
        name:'home',
        component: DashboardComponent
    },
    {
        path: '/admin/categories',
        name:'categories',
        component:categoriesComponent
    }
];
export default routes;
