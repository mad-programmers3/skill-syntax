import DashboardComponent from "../views/DashboardComponent";
import categoriesComponent from "../views/courses/categoriesComponent";
import coursesComponent from "../views/courses/coursesComponent";
import subCategoriesComponent from "../views/courses/subCategoriesComponent";


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
    },
    {
        path: '/admin/subcategories',
        name:'subcategories',
        component:subCategoriesComponent,
        meta : {'pageTitle' : 'subCategory List', dataUrl : 'api/sub-categories'},
    },
    {
        path: '/admin/course/courses',
        name:'courses',
        component: coursesComponent,
        meta : {'pageTitle' : 'Course List', dataUrl : 'api/courses'},
    },
];
export default routes;
