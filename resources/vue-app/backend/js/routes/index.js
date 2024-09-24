import DashboardComponent from "../views/DashboardComponent";
import categoriesComponent from "../views/courses/categoriesComponent";
import coursesComponent from "../views/courses/coursesComponent";
import subCategoriesComponent from "../views/courses/subCategoriesComponent";
import lessonsComponent from "../views/courses/lessonsComponent";
import reviewsComponent from "../views/Review/reviewsComponent";


const routes =[
    {
        path: '/admin/dashboard',
        name:'home',
        component: DashboardComponent
    },
    //Courses
    {
        path: '/admin/course/courses',
        name:'courses',
        component: coursesComponent,
        meta : {'pageTitle' : 'Course List', dataUrl : 'api/courses'},
    },
    {
        path: '/admin/course/lessons',
        name:'lesson',
        component:lessonsComponent,
        meta : {'pageTitle' : 'Lessons List', dataUrl : 'api/lessons'},
    },
    {
        path: '/admin/course/categories',
        name:'categories',
        component:categoriesComponent,
        meta : {'pageTitle' : 'Category List', dataUrl : 'api/categories'},
    },
    {
        path: '/admin/course/subcategories',
        name:'subcategories',
        component:subCategoriesComponent,
        meta : {'pageTitle' : 'subCategory List', dataUrl : 'api/sub-categories'},
    },


//    Review

    {
        path: '/admin/review/reviews',
        name:'reviews',
        component:reviewsComponent,
        meta : {'pageTitle' : 'reviews List', dataUrl : 'api/reviews'},
    },

];
export default routes;
