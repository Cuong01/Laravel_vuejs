<template>
    <div class="container-fluid d-flex justify-content-center bgfont">
        <div class="login_admin">
            <div class="text-center">
                <h2>Đăng nhập</h2>
            </div>
            <div class="mt-4">
                <p>Email:</p>
                <input type="text" class="px-3 py-2 rounded-3" />
            </div>
            <div class="mt-2">
                <p>Mật khẩu:</p>
                <input type="text" class="px-3 py-2 rounded-3" />
            </div>
            <div
                class="btn btn-primary mt-4 w-100 text-white border-none shadow-sm"
            >
                Đăng nhập
            </div>
        </div>
    </div>
</template>
<style>
.bgfont {
    background-image: linear-gradient(
        to left top,
        rgb(128, 251, 196),
        rgb(253, 255, 118)
    );
}
.login_admin {
    width: 500px;
    background-image: linear-gradient(
        to bottom right,
        rgb(23, 252, 241),
        yellow
    );
    border: 1px solid;
    box-shadow: 2px 2px 2px 2px rgb(255, 60, 0);
    margin: 98px 0;
    padding: 80px;
    border-radius: 30px;
}
input {
    width: 100%;
}
p {
    margin-bottom: 10px;
}
</style>
