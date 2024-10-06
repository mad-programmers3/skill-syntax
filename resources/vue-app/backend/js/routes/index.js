import DashboardComponent from "../views/DashboardComponent";
import categoriesComponent from "../views/courses/categoriesComponent";
import coursesComponent from "../views/courses/coursesComponent";
import subCategoriesComponent from "../views/courses/subCategoriesComponent";
import lessonsComponent from "../views/courses/lessonsComponent";
import reviewsComponent from "../views/Review/reviewsComponent";
import courseReviewComponent from "../views/Review/courseReviewComponent";
import lessonReviewComponent from "../views/Review/lessonReviewComponent";
import TestimonialComponent from "../views/Review/testimonialComponent";
import RolesComponent from "../views/RolesPermission/RolesComponent";
import ModulesComponent from "../views/RolesPermission/ModulesComponent";
import RoleConfigsComponent from "../views/RolesPermission/RoleConfigsComponent";


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


   // Reviews
    {
        path: '/admin/review/reviews',
        name:'reviews',
        component:reviewsComponent,
        meta : {'pageTitle' : 'reviews List', dataUrl : 'api/reviews'},
    },
    {
        path: '/admin/review/course-review',
        name:'course-review',
        component:courseReviewComponent,
        meta : {'pageTitle' : 'course-review List', dataUrl : 'api/review/course-reviews'},
    },
    {
        path: '/admin/review/lesson-review',
        name:'lesson-review',
        component:lessonReviewComponent,
        meta : {'pageTitle' : 'lesson-review List', dataUrl : 'api/review/lesson-reviews'},
    },
    {
        path: '/admin/review/testimonials',
        name:'testimonials',
        component:TestimonialComponent,
        meta : {'pageTitle' : 'testimonials List', dataUrl : 'api/review/testimonials'},
    },


    // Configs
    {
        path: '/admin/config/roles',
        name: 'roles',
        component:RolesComponent,
        meta : {'pageTitle' : 'Roles', dataUrl : 'api/config/roles'},
    },
    {
        path: '/admin/config/modules',
        name: 'modules',
        component: ModulesComponent
    },
    {
        path: '/admin/config/manage-roles',
        name: 'manageRoles',
        component: RoleConfigsComponent,
        meta : {'pageTitle' : 'Manage Roles'},
    }



];
export default routes;
