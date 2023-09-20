<template>
    <form @submit.prevent="editProduct()" enctype="multipart/form-data">
        <div class="container">
            <h1>Thêm sản phẩm</h1>
            <div>
                <p class="pt-4">
                    Tên sản phẩm <span class="text-danger">*</span>
                </p>
                <input
                    type="text"
                    class="px-4 py-2 rounded-3 w-50"
                    v-model="Product.name"
                />
                <p v-if="Error.name" class="text-danger pt-1">
                    {{ Error.name[0] }}
                </p>
            </div>
            <div class="d-flex justify-content-between">
                <div>
                    <p class="pt-4">
                        Ảnh sản phẩm <span class="text-danger">*</span>
                    </p>
                    <input type="file" id="image" @change="handleImage" />
                    <div class="pt-2">
                        <img :src="ImageUrl" alt="" style="width: 400px" />
                    </div>
                    <p v-if="Error.image" class="text-danger pt-1">
                        {{ Error.image[0] }}
                    </p>
                </div>
                <div>
                    <p class="pt-4">Ảnh đang sử dụng</p>
                    <div class="pt-2">
                        <td>
                            <img
                                :src="`/storage/${Product.image}`"
                                alt="img"
                                style="width: 400px"
                            />
                        </td>
                    </div>
                </div>
            </div>
            <div>
                <p class="pt-4">
                    Giá sản phẩm <span class="text-danger">*</span>
                </p>
                <input
                    type="text"
                    class="px-4 py-2 rounded-3 w-50"
                    v-model="Product.price"
                />
                <p v-if="Error.price" class="text-danger pt-1">
                    {{ Error.price[0] }}
                </p>
            </div>
            <div>
                <p class="pt-4">
                    Số lượng sản phẩm <span class="text-danger">*</span>
                </p>
                <input
                    type="text"
                    class="px-4 py-2 rounded-3 w-50"
                    v-model="Product.count"
                />
                <p v-if="Error.count" class="text-danger pt-1">
                    {{ Error.count[0] }}
                </p>
            </div>
            <div>
                <p class="pt-4">
                    Nội dung sản phẩm <span class="text-danger">*</span>
                </p>
                <input
                    type="text"
                    class="px-4 py-2 rounded-3 w-50"
                    v-model="Product.content"
                />
                <p v-if="Error.content" class="text-danger pt-1">
                    {{ Error.content[0] }}
                </p>
            </div>
            <div>
                <p class="pt-4">
                    Thương hiệu sản phẩm <span class="text-danger">*</span>
                </p>
                <select
                    v-model="Product.brand_id"
                    class="px-4 py-2 rounded-3 w-50"
                >
                    <option value="" multiple>-----Chọn-----</option>
                    <option
                        v-for="(item, index) in Brand"
                        :key="index"
                        :value="item.id"
                    >
                        {{ item.name }}
                    </option>
                </select>
                <p v-if="Error.brand_id" class="text-danger pt-1">
                    {{ Error.brand_id[0] }}
                </p>
            </div>
            <div>
                <p class="pt-4">
                    Danh mục sản phẩm <span class="text-danger">*</span>
                </p>
                <select
                    v-model="Product.category_id"
                    class="px-4 py-2 rounded-3 w-50"
                >
                    <option value="" multiple>-----Chọn-----</option>
                    <option
                        v-for="(item, index) in Category"
                        :key="index"
                        :value="item.id"
                    >
                        {{ item.name }}
                    </option>
                </select>
                <p v-if="Error.category_id" class="text-danger pt-1">
                    {{ Error.category_id[0] }}
                </p>
            </div>
            <div>
                <p class="pt-4">
                    Trạng thái <span class="text-danger">*</span>
                </p>
                <select
                    v-model="Product.status"
                    class="px-4 py-2 rounded-3 w-50"
                >
                    <option value="0">Không hoạt động</option>
                    <option value="1">Hoạt động</option>
                </select>
            </div>

            <div class="mt-4">
                <button class="btn btn-info">Cập nhật sản phẩm</button>
                <router-link :to="{ name: 'ListProduct' }">
                    <div class="btn btn-danger m-1">Hủy</div>
                </router-link>
            </div>
        </div>
    </form>
</template>
<script setup>
import axios from "axios";
import { ref, reactive, onMounted, watch } from "vue";
import { useRouter } from "vue-router";
import { useRoute } from "vue-router";

const router = useRouter();
const route = useRoute();

const Product = reactive({
    name: "",
    price: "",
    count: "",
    content: "",
    brand_id: "",
    category_id: "",
    status: "",
    image: "",
});

const Error = ref([]);
const Brand = ref({});
const Category = ref({});
const ImageFile = ref("");
const ImageUrl = ref("");

const handleImage = (e) => {
    if (e.target.files.length == 0) {
        ImageFile.value = "";
        ImageUrl.value = "";
        return;
    }

    ImageFile.value = e.target.files[0];
};

watch(ImageFile, (ImageFile) => {
    if (!(ImageFile instanceof File)) {
        return;
    }
    let fileReader = new FileReader();
    fileReader.readAsDataURL(ImageFile);
    fileReader.addEventListener("load", () => {
        ImageUrl.value = fileReader.result;
    });
});

const editProduct = async () => {
    let data = new FormData();
    data.append("name", Product.name);
    data.append("price", Product.price);
    data.append("count", Product.count);
    data.append("content", Product.content);
    data.append("brand_id", Product.brand_id);
    data.append("category_id", Product.category_id);
    data.append("status", Product.status);
    if (ImageFile.value) {
        data.append("image", ImageFile.value);
    } else {
        data.append("image", Product.image);
    }

    await axios
        .post("/api/edit_product/" + route.params.id, data)
        .then(function (response) {
            if (response) {
                alert("Sửa thành công");
                router.push({ name: "ListProduct" });
            }
        })
        .catch(function (error) {
            console.log(error.response.data.errors);
            Error.value = error.response.data.errors;
        });
};

onMounted(async () => {
    getBrand();
    showProduct();
    getCategory();
});
const getBrand = async () => {
    await axios.get("/api/get_brands").then(function (response) {
        if (response) {
            Brand.value = response.data.brands;
        }
    });
};
const getCategory = async () => {
    await axios.get("/api/get_categoris").then(function (response) {
        if (response) {
            Category.value = response.data.category;
        }
    });
};
const showProduct = () => {
    axios
        .get("/api/show_product/" + route.params.id)
        .then(function (response) {
            console.log(response);
            Product.name = response.data.product.name;
            Product.price = response.data.product.price;
            Product.count = response.data.product.count;
            Product.content = response.data.product.content;
            Product.brand_id = response.data.product.brand_id;
            Product.category_id = response.data.product.category_id;
            Product.status = response.data.product.status;
            Product.image = response.data.product.image;
        })
        .catch(function (error) {});
};
</script>
