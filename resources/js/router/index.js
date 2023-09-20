import { createRouter,createWebHistory } from "vue-router";

import ListProduct from '../components/product/ListProduct.vue';
import AddProduct from '../components/product/AddProduct.vue';
import EditProduct from '../components/product/EditProduct.vue';
import Admin from '../components/layouts/Admin.vue';
import ListBrand from '../components/brand/ListBrand.vue';
import AddBrand from '../components/brand/AddBrand.vue';
import EditBrand from '../components/brand/EditBrand.vue';
import Customer from '../components/customer/customer.vue';
import ListCustomer from '../components/customer/ListCustomer.vue';
import ListCategory from '../components/category/ListCategory.vue';
import AddCategory from '../components/category/AddCategory.vue';
import EditCategory from '../components/category/EditCategory.vue';
import LoginAdmin from '../components/login/login_admin.vue';

const routes = [
    {
        path:'/',
        component: () => import("../components/Hello.vue"),
    },
    {
        path:'/login_admin',
        name:'LoginAdmin',
        component: LoginAdmin,
    },
    {      
        path:'/admin',
        component: Admin,
        children:[
            {
                path:'products',
                name:'ListProduct',
                component: ListProduct,
            },
            {
                path:'add-product',
                name:'AddProduct',
                component: AddProduct,
            },
            {
                path: "edit-product/:id",
                name: "EditProduct",
                component: EditProduct,
            },
            {
                path:'brands',
                name:'ListBrand',
                component: ListBrand,
            },
            {
                path:'add-brand',
                name:'AddBrand',
                component: AddBrand,
            },
            {
                path: "edit-brand/:id",
                name: "EditBrand",
                component: EditBrand,
            },
            {
                path:'customer',
                name:'Customer',
                component: Customer,
            },
            {
                path:'list-customer',
                name:'ListCustomer',
                component: ListCustomer,
            },
            {
                path:'categoris',
                name:'ListCategory',
                component: ListCategory,
            },
            {
                path:'add-category',
                name:'AddCategory',
                component: AddCategory,
            },
            {
                path: "edit-category/:id",
                name: "EditCategory",
                component: EditCategory,
            },
        ]
    },
    
    {
        path:'/:pathMatch(.*)',
        name:'NotFound',
        component: () => import("../components/NotFound.vue"),
    },
    
]

const router = createRouter(
    {
        history: createWebHistory(),
        routes,
    }
);

export default router 