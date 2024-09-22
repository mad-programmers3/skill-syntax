import DashboardComponent from "../views/DashboardComponent";
import categoryComponent from "../../../../views/courses/categoryComponent";


const routes =[
    {
        path: '/admin/dashboard',
        name:'home',
        component: DashboardComponent
    },
    {
        path: '/admin/categories',
        name:'categories',
        component:categoryComponent
    }
];
export default routes;
