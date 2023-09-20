<template>
    <form @submit.prevent="Customer()" enctype="multipart/form-data">
        <div class="container">
            <div>
                <p class="pt-4">Tên <span class="text-danger">*</span></p>
                <input
                    type="text"
                    class="px-4 py-2 rounded-3 w-50"
                    v-model="Cust.name"
                />
                <p v-if="Error.name" class="text-danger pt-1">
                    {{ Error.name[0] }}
                </p>
            </div>
            <div>
                <p class="pt-4">Email <span class="text-danger">*</span></p>
                <input
                    type="email"
                    class="px-4 py-2 rounded-3 w-50"
                    v-model="Cust.email"
                />
                <p v-if="Error.email" class="text-danger pt-1">
                    {{ Error.email[0] }}
                </p>
            </div>
            <div>
                <p class="pt-4">
                    Số điện thoại <span class="text-danger">*</span>
                </p>
                <input
                    type="number"
                    class="px-4 py-2 rounded-3 w-50"
                    v-model="Cust.phone"
                />
                <p v-if="Error.phone" class="text-danger pt-1">
                    {{ Error.phone[0] }}
                </p>
            </div>
            <div>
                <p class="pt-4">Nội dung <span class="text-danger">*</span></p>
                <input
                    type="text"
                    class="px-4 py-2 rounded-3 w-50"
                    v-model="Cust.comment"
                />
                <p v-if="Error.comment" class="text-danger pt-1">
                    {{ Error.comment[0] }}
                </p>
            </div>

            <div class="mt-4">
                <button class="btn btn-info">Gửi thông tin</button>
            </div>
        </div>
    </form>
</template>

<script setup>
import axios from "axios";
import { ref, reactive, onMounted } from "vue";

const Cust = reactive({
    name: "",
    email: "",
    phone: "",
    comment: "",
});

const Error = ref([]);

const Customer = async () => {
    console.log(Cust);
    await axios
        .post("/api/test_mail", Cust)
        .then(function (response) {
            if (response) {
                alert("Gửi thành công");
                location.reload();
            }
        })
        .catch(function (error) {
            console.log(error.response.data.errors);
            Error.value = error.response.data.errors;
        });
};
</script>
