<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                پنل ادمین
            </h2>
        </template>
        <div class="grid grid-cols-1 gap-5 my-10">
            <div class="mx-auto gap-10 flex">
                <div class="mx-auto">
                    <SecondaryButton
                        @click="usersModalShowF"
                        class="w-36 h-10 justify-center"
                        >تنظیمات کاربران</SecondaryButton
                    >
                    <div>
                        <Modal :show="usersModalShow" @close="usersModalShowF"
                            ><div class="grid grid-cols-1 gap-5 my-4">
                                <div class="justify-self-center">
                                    <h2
                                        class="text-xl font-semibold leading-tight text-gray-800"
                                    >
                                        تنظیمات کاربران
                                    </h2>
                                </div>
                                <div class="mx-auto gap-10 flex">
                                    <div class="mx-auto">
                                        <Link :href="route('admin.users.list')"
                                            ><PrimaryButton
                                                class="w-36 h-10 justify-center"
                                                >لیست کاربران</PrimaryButton
                                            ></Link
                                        >
                                    </div>
                                    <div class="mx-auto">
                                        <Link :href="route('admin.users.new')"
                                            ><PrimaryButton
                                                class="w-36 h-10 justify-center"
                                                >افزودن کاربر</PrimaryButton
                                            ></Link
                                        >
                                    </div>
                                </div>
                                <div class="mx-auto gap-10 flex">
                                    <div class="mx-auto">
                                        <Link
                                            :href="route('admin.users.admins')"
                                            ><PrimaryButton
                                                class="w-36 h-10 justify-center"
                                                >ادمین‌ها</PrimaryButton
                                            ></Link
                                        >
                                    </div>
                                    <div class="mx-auto">
                                        <Link :href="route('admin.users.roles')"
                                            ><PrimaryButton
                                                class="w-36 h-10 justify-center"
                                                >نقش‌ها</PrimaryButton
                                            ></Link
                                        >
                                    </div>
                                </div>
                            </div></Modal
                        >
                    </div>
                </div>
                <div class="mx-auto">
                    <SecondaryButton
                        @click="paymentModalShowF"
                        class="w-36 h-10 justify-center"
                        >مدیریت پرداخت‌ها</SecondaryButton
                    >
                    <div>
                        <Modal
                            :show="paymentModalShow"
                            @close="paymentModalShowF"
                            ><div class="grid grid-cols-1 gap-5 my-4">
                                <div class="justify-self-center">
                                    <h2
                                        class="text-xl font-semibold leading-tight text-gray-800"
                                    >
                                        مدیریت پرداخت‌ها
                                    </h2>
                                </div>
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="justify-self-end">
                                        <Link
                                            :href="
                                                route('admin.payments.pending')
                                            "
                                            ><PrimaryButton
                                                class="w-36 h-10 justify-center"
                                                >در انتظار پرداخت</PrimaryButton
                                            ></Link
                                        >
                                    </div>

                                    <div class="justify-self-start">
                                        <Link
                                            :href="route('admin.payments.paid')"
                                            ><PrimaryButton
                                                class="w-36 h-10 justify-center"
                                                >پرداختی‌ها</PrimaryButton
                                            ></Link
                                        >
                                    </div>
                                </div>
                                <div class="mx-auto">
                                    <Link
                                        :href="route('admin.payments.details')"
                                        ><PrimaryButton
                                            class="w-36 h-10 justify-center"
                                            >ریز جزئیات</PrimaryButton
                                        ></Link
                                    >
                                </div>
                            </div></Modal
                        >
                    </div>
                </div>
            </div>
            <div class="mx-auto gap-10 flex">
                <div class="mx-auto">
                    <SecondaryButton
                        @click="commuteModalShowF"
                        class="w-36 h-10 justify-center"
                        >گزارش تردد</SecondaryButton
                    >
                    <div>
                        <Modal
                            :show="commuteModalShow"
                            @close="commuteModalShowF"
                            ><div class="grid grid-cols-1 gap-5 my-4">
                                <div class="justify-self-center">
                                    <h2
                                        class="text-xl font-semibold leading-tight text-gray-800"
                                    >
                                        گزارش تردد
                                    </h2>
                                </div>
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="justify-self-end">
                                        <Link
                                            :href="
                                                route('admin.commutes.enter')
                                            "
                                            ><PrimaryButton
                                                class="w-36 h-10 justify-center"
                                                >ثبت ورود</PrimaryButton
                                            ></Link
                                        >
                                    </div>

                                    <div class="justify-self-start">
                                        <Link
                                            :href="route('admin.commutes.exit')"
                                            ><PrimaryButton
                                                class="w-36 h-10 justify-center"
                                                >ثبت خروج</PrimaryButton
                                            ></Link
                                        >
                                    </div>
                                </div>
                                <div class="mx-auto">
                                    <Link :href="route('admin.commutes.list')"
                                        ><PrimaryButton
                                            class="w-36 h-10 justify-center"
                                            >لیست تردد</PrimaryButton
                                        ></Link
                                    >
                                </div>
                            </div>
                        </Modal>
                    </div>
                </div>
                <div class="mx-auto">
                    <SecondaryButton
                        @click="shiftModalShowF"
                        class="w-36 h-10 justify-center"
                        >کنترل شیفت‌ها</SecondaryButton
                    ><Modal :show="shiftModalShow" @close="shiftModalShowF"
                        ><div class="grid gap-5 my-4 grid-cols-1">
                            <div class="justify-self-center">
                                <h2
                                    class="text-xl font-semibold leading-tight text-gray-800"
                                >
                                    کنترل شیفت‌ها
                                </h2>
                            </div>
                            <div class="mx-auto gap-10 flex">
                                <Link :href="route('admin.shifts.new')"
                                    ><PrimaryButton
                                        class="w-36 h-10 justify-center"
                                        >ایجاد شیفت</PrimaryButton
                                    ></Link
                                >
                            </div>
                            <div class="mx-auto gap-10 flex">
                                <Link :href="route('admin.shifts.list')"
                                    ><PrimaryButton
                                        class="w-36 h-10 justify-center"
                                        >‌لیست شیفت‌ها</PrimaryButton
                                    ></Link
                                >
                            </div>
                        </div></Modal
                    >
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import Modal from "@/Components/Modal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";

const usersModalShow = ref(false);
function usersModalShowF() {
    usersModalShow.value = !usersModalShow.value;
}
const paymentModalShow = ref(false);
function paymentModalShowF() {
    paymentModalShow.value = !paymentModalShow.value;
}
const commuteModalShow = ref(false);
function commuteModalShowF() {
    commuteModalShow.value = !commuteModalShow.value;
}
const shiftModalShow = ref(false);
function shiftModalShowF() {
    shiftModalShow.value = !shiftModalShow.value;
}
</script>
