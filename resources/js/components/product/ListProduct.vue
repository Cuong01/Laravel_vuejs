<template>
    <div class="container">
        <h2 class="mb-4">Danh sách sản phẩm</h2>
        <router-link :to="{ name: 'AddProduct' }">
            <div class="btn btn-primary">Thêm mới</div>
        </router-link>
        <table class="table text-center">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Ảnh</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Thương hiệu</th>
                    <th scope="col">Danh mục</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in products" :key="index">
                    <th scope="row">{{ item.id }}</th>
                    <td>{{ item.name }}</td>
                    <td>
                        <img
                            :src="`/storage/${item.image}`"
                            alt="img"
                            style="width: 100px"
                        />
                    </td>
                    <td>{{ formatPrice(item.price) }} VNĐ</td>
                    <td>{{ item.count }}</td>
                    <td>
                        <div v-for="(item2, index2) in Brand" :key="index2">
                            <p v-if="item.brand_id === item2.id">
                                {{ item2.name }}
                            </p>
                        </div>
                    </td>
                    <td>
                        <div v-for="(item3, index3) in Category" :key="index3">
                            <p v-if="item.category_id === item3.id">
                                {{ item3.name }}
                            </p>
                        </div>
                    </td>
                    <td @click="changeStatus(item.id)">
                        <p v-if="item.status === 1" class="btn text-primary">
                            Hoạt động
                        </p>
                        <p v-if="item.status === 0" class="btn text-danger">
                            Không hoạt động
                        </p>
                    </td>
                    <td>
                        <router-link
                            :to="{
                                name: 'EditProduct',
                                params: { id: item.id },
                            }"
                        >
                            <div class="btn btn-success">
                                <i class="fa-solid fa-file-pen"> </i>
                            </div>
                        </router-link>
                        <div
                            class="btn btn-danger mx-2"
                            @click="deleteProduct(item.id)"
                        >
                            <i class="fa-solid fa-trash-can"> </i>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import axios from "axios";
import { onMounted, ref } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();

const products = ref({});
const Brand = ref({});
const Category = ref({});

const formatPrice = (value) => {
    let val = (value / 1).toFixed(0).replace(".");
    return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
};

const changeStatus = async (id) => {
    await axios.post("/api/change_status_Pro/" + id).then(function (response) {
        if (response) {
            alert("Cập nhật thành công");
            location.reload();
        }
    });
};

const deleteProduct = async (id) => {
    let ChangeConfirm = confirm("Bạn có muốn xóa ?");
    if (ChangeConfirm == true) {
        await axios.post("/api/delete_product/" + id).then(function (response) {
            if (response) {
                alert("Xóa thành công");
                location.reload();
            }
        });
    }
};

onMounted(async () => {
    getProduct();
});

const getProduct = async () => {
    await axios.get("/api/get_products").then(function (response) {
        if (response) {
            Brand.value = response.data.brands;
            products.value = response.data.products;
            Category.value = response.data.categoris;
        }
    });
};
</script>
