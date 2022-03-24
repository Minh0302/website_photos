import Vue from 'vue';
import Router from 'vue-router';
Vue.use(Router);

// import homePage from './components/HomePage';
import detailsPage from './components/DetailPage';
import profilePage from './components/ProfilePage';
import mainPage from './components/MainPage';
import loginPage from './components/LoginPage';
import registerPage from './components/RegisterPage';
import store from './store';

// const routes = [
//     { 
//         path: '/home', 
//         component: mainPage,
//         // meta: {requireAuth: false}
//     },
//     { 
//         path: '/details/:id', 
//         component: detailsPage,
//     },
//     { 
//         path: '/profile/:id', 
//         component: profilePage,
//     },
//     { 
//         path: '/login', 
//         component: loginPage,
//         // meta: {guest: true}
//     },
//     { 
//         path: '/register', 
//         component: registerPage,
//         // meta: {guest: true}
//     },
// ]
// // middleware
// // const router = new Router();
// // router.beforeEach((to, from, next) => {
// //     if(to.matched.some((record) => record.meta.requireAuth)){
// //         if(store.getters.isLoggedIn){
// //             next();
// //             return;
// //         }
// //         next('/login');
// //     }else{
// //         next();
// //     }  
// // });
// // router.beforeEach((to, from, next) =>{
// //     if(to.matched.some((record) => record.meta.guest)){
// //         if(store.getters.isLoggedIn){
// //             next('/home');
// //             return;
// //         }
// //         next();
// //     }else{
// //         next();
// //     }
// // });

// export default new Router({
//     mode: 'history',
//     routes
// })	
const router = new Router({
    routes: [
        { 
            path: '/', 
            component: mainPage,
            // meta: {requireAuth: false}
        },
        { 
            path: '/details/:id', 
            component: detailsPage,
        },
        { 
            path: '/profile/:id', 
            component: profilePage,
        },
        { 
            path: '/login', 
            component: loginPage,
            // meta: {guest: true}
        },
        { 
            path: '/register', 
            component: registerPage,
            // meta: {guest: true}
        },
    ]
})
// middleware
// const router = new Router();
// router.beforeEach((to, from, next) => {
//     if(to.matched.some((record) => record.meta.requireAuth)){
//         if(store.getters.isLoggedIn){
//             next();
//             return;
//         }
//         next('/login');
//     }else{
//         next();
//     }  
// });
// router.beforeEach((to, from, next) =>{
//     if(to.matched.some((record) => record.meta.guest)){
//         if(store.getters.isLoggedIn){
//             next('/home');
//             return;
//         }
//         next();
//     }else{
//         next();
//     }
// });

export default router;	