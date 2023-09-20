<template>
    <div class="container">
        <h2 class="mb-4">Danh sách khách hàng</h2>
        <div @click="sendCustomer()" class="btn btn-primary">
            Gửi mail cho tất cả khách hàng
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên khách hàng</th>
                    <th>Email</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in Cust" :key="index">
                    <td>{{ item.id }}</td>
                    <td>{{ item.name }}</td>
                    <td>{{ item.email }}</td>
                    <td>
                        <div
                            class="btn btn-danger mx-2"
                            @click="deleteCustomer(item.id)"
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

const Cust = ref({});

const deleteCustomer = async (id) => {
    await axios.post("/api/delete_customer/" + id).then(function (response) {
        if (response) {
            alert("Xóa thành công");
            location.reload();
        }
    });
};
const sendCustomer = async () => {
    await axios.post("/api/send_email").then(function (response) {
        if (response) {
            alert("Gửi thành công");
            location.reload();
        }
    });
};

onMounted(async () => {
    getCustomer();
});

const getCustomer = async () => {
    await axios.get("/api/get_customers").then(function (response) {
        if (response) {
            Cust.value = response.data.customers;
        }
    });
};
</script>
