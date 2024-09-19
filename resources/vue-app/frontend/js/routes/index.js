import homeComponent from "../views/homeComponent";
import aboutComponent from "../views/aboutComponent";
import coursesComponent from "../views/coursesComponent";

const route = [
    {
        path : '/',
        name : 'home',
        component : homeComponent,
        meta : {'pageTitle' : 'Home'},
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
        meta : {'pageTitle' : 'Courses'},
    },
];
export default route;