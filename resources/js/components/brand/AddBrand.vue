<template>
    <form @submit.prevent="addBrand()">
        <div class="container">
            <h2>Thêm thương hiệu</h2>
            <div>
                <p class="pt-4">
                    Tên thương hiệu <span class="text-danger">*</span>
                </p>
                <input
                    type="text"
                    class="px-4 py-2 rounded-3 w-50"
                    v-model="Brand.name"
                />
                <p v-if="Error.name" class="text-danger pt-1">
                    {{ Error.name[0] }}
                </p>
            </div>
            <div>
                <p class="pt-4">
                    Trạng thái <span class="text-danger">*</span>
                </p>
                <select v-model="Brand.status" class="px-4 py-2 rounded-3 w-50">
                    <option value="0">Không hoạt động</option>
                    <option value="1">Hoạt động</option>
                </select>
            </div>
            <div class="mt-4">
                <button class="btn btn-info">Thêm thương hiệu</button>
                <router-link :to="{ name: 'ListBrand' }">
                    <div class="btn btn-danger m-1">Hủy</div>
                </router-link>
            </div>
        </div>
    </form>
</template>
<script setup>
import axios from "axios";
import { ref, reactive } from "vue";
import { useRouter } from "vue-router";
const router = useRouter();
const Error = ref([]);
const Brand = reactive({
    name: "",
    status: "1",
});
const addBrand = async () => {
    await axios
        .post("/api/add_brands", Brand)
        .then(function (response) {
            if (response) {
                alert("Thêm thành công");
                router.push({ name: "ListBrand" });
            }
        })
        .catch(function (error) {
            Error.value = error.response.data.errors;
        });
};
</script>
