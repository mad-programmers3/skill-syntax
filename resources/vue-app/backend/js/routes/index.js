import DashboardComponent from "../views/DashboardComponent";
import categoriesComponent from "../views/courses/categoriesComponent";
import coursesComponent from "../views/courses/coursesComponent";
import subCategoriesComponent from "../views/courses/subCategoriesComponent";
import lessonsComponent from "../views/courses/lessonsComponent";
import reviewsComponent from "../views/Review/reviewsComponent";
import courseReviewComponent from "../views/Review/courseReviewComponent";
import lessonReviewComponent from "../views/Review/lessonReviewComponent";
import testimonialComponent from "../views/Review/testimonialComponent";
import RoleComponent from "../views/RolesPermission/RoleComponent";
import PermissionComponent from "../views/RolesPermission/PermissionComponent";
import ModuleComponent from "../views/RolesPermission/ModuleComponent";
import RoleModuleComponent from "../views/RolesPermission/RoleModuleComponent";
import RolePermissionComponent from "../views/RolesPermission/RolePermissionComponent";


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
        component:testimonialComponent,
        meta : {'pageTitle' : 'testimonials List', dataUrl : 'api/review/testimonials'},
    },


    //Roles And Permissions
    {
        path: '/admin/roles',
        name: 'roles',
        component:RoleComponent
    },
    {
        path: '/admin/permissions',
        name: 'permission',
        component:PermissionComponent
    },
    {
        path: '/admin/modules',
        name: 'module',
        component: ModuleComponent
    },
    {
        path: '/admin/roleModules',
        name: 'roleModule',
        component: RoleModuleComponent
    },
    {
        path: '/admin/rolePermissions',
        name: 'rolePermissions',
        component: RolePermissionComponent,
        meta : {'pageTitle' : 'Role Permission'},
    }



];
export default routes;
