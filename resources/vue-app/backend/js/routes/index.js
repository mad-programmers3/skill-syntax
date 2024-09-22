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
        component:categoriesComponent,
        meta : {'pageTitle' : 'Category List', dataUrl : 'api/categories'},
    }
];
export default routes;
