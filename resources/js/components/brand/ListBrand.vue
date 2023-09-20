<template>
    <div class="container">
        <h2 class="mb-4">Danh sách thương hiệu</h2>
        <router-link :to="{ name: 'AddBrand' }">
            <div class="btn btn-primary">Thêm mới</div>
        </router-link>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên thương hiệu</th>
                    <th>Trạng thái</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in Brand" :key="index">
                    <td>{{ item.id }}</td>
                    <td>{{ item.name }}</td>
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
                            :to="{ name: 'EditBrand', params: { id: item.id } }"
                        >
                            <div class="btn btn-success">
                                <i class="fa-solid fa-file-pen"> </i>
                            </div>
                        </router-link>
                        <div
                            class="btn btn-danger mx-2"
                            @click="deleteBrand(item.id)"
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

const Brand = ref({});

const changeStatus = async (id) => {
    await axios
        .post("/api/change_status_Brand/" + id)
        .then(function (response) {
            if (response) {
                alert("Cập nhật thành công");
                location.reload();
            }
        });
};

const deleteBrand = async (id) => {
    let ChangeConfirm = confirm("Bạn có muốn xóa ?");
    if (ChangeConfirm == true) {
        await axios.post("/api/delete_brand/" + id).then(function (response) {
            if (response) {
                alert("Xóa thành công");
                location.reload();
            }
        });
    }
};

onMounted(async () => {
    getBrand();
});

const getBrand = async () => {
    await axios.get("/api/get_brands").then(function (response) {
        if (response) {
            Brand.value = response.data.brands;
        }
    });
};
</script>
