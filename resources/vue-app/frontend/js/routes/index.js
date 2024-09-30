import homeComponent from "../views/homeComponent";
import aboutComponent from "../views/aboutComponent";
import coursesComponent from "../views/coursesComponent";
import courseDetailsComponent from "../views/courseDetailsComponent";
import elementsComponent from "../views/elementsComponent";
import blogComponent from "../views/blogComponent";
import blogDetailsComponent from "../views/blogDetailsComponent";
import contactComponent from "../views/contactComponent";

const route = [
    {
        path : '/',
        name : 'home',
        component : homeComponent,
        meta : {'pageTitle' : 'Home', dataUrl : 'api/pages/index'},
    },
    {
        path : '/about',
        name : 'about us',
        component : aboutComponent,
        meta : {'pageTitle' : 'About'},
    },
    {
        path : '/courses',
        name : 'courses',
        component : coursesComponent,
        meta : {'pageTitle' : 'Courses', dataUrl : 'api/pages/courses'},
    },
    {
        path : '/courses/:id',
        name : 'courseDetails',
        component : courseDetailsComponent,
        props: true,
        meta : {'pageTitle' : 'CourseDetails', dataUrl : 'api/pages/courses'},
    },
    {
        path : '/elements',
        name : 'elements',
        component :elementsComponent,
        meta : {'pageTitle' : 'Elements'},
    },
    {
        path : '/blog',
        name : 'blog',
        component :blogComponent,
        meta : {'pageTitle' : 'Blog'},
    },
    {
        path : '/blogDetails',
        name : 'blogDetails',
        component :blogDetailsComponent,
        meta : {'pageTitle' : 'BlogDetails'},
    },
    {
        path : '/contact',
        name : 'contact',
        component: contactComponent,
        meta : {'pageTitle' : 'Contact'},
    },
];
export default route;