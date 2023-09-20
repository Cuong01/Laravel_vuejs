<template>
    <div class="container-fluid">
        <Header />
        <div class="d-flex">
            <div class="d-flex bg-light p-2">
                <div class="pe-3" :class="{ 'd-none': open == false }">
                    <h3>Quản lý</h3>
                    <router-link :to="{ name: 'ListProduct' }">
                        <p class="pt-3">Sản phẩm</p>
                    </router-link>

                    <router-link :to="{ name: 'ListBrand' }">
                        <p class="pt-3">Thương hiệu</p>
                    </router-link>

                    <router-link :to="{ name: 'ListCategory' }">
                        <p class="pt-3">Danh mục</p>
                    </router-link>

                    <router-link :to="{ name: 'Customer' }">
                        <p class="pt-3">Thêm khách hàng</p>
                    </router-link>

                    <router-link :to="{ name: 'ListCustomer' }">
                        <p class="pt-3">Danh sách khách hàng</p>
                    </router-link>
                </div>
                <div class="d-flex align-items-center">
                    <div
                        class="bg-warning py-1 px-2 rounded-circle"
                        @click="open = !open"
                    >
                        <i
                            v-if="open == false"
                            class="fa-solid fa-chevron-right"
                        >
                        </i>
                        <i v-if="open == true" class="fa-solid fa-chevron-left">
                        </i>
                    </div>
                </div>
            </div>
            <div class="w-100 p-2">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>
<script setup>
import Header from "../layouts/Header.vue";
import { ref } from "vue";
const open = ref(true);
</script>
<style>
a {
    text-decoration: none;
    color: black;
}
</style>
