<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                صفحه اصلی
            </h2>
        </template>
        <div class="grid grid-cols-1 gap-5 my-10">
            <div class="mx-auto gap-10 flex">
                <div class="mx-auto">
                    <Link :href="route('paid')"
                        ><SecondaryButton class="w-36 h-10 justify-center"
                            >پرداختی‌ها</SecondaryButton
                        ></Link
                    >
                </div>
                <div class="mx-auto">
                    <Link :href="route('pending')"
                        ><PrimaryButton class="w-36 h-10 justify-center"
                            >در انتظار پرداخت</PrimaryButton
                        ></Link
                    >
                </div>
            </div>
            <div class="mx-auto gap-10 flex">
                <div class="mx-auto">
                    <Link :href="route('details')"
                        ><PrimaryButton class="w-36 h-10 justify-center"
                            >ریز جزئیات</PrimaryButton
                        ></Link
                    >
                </div>
                <div class="mx-auto">
                    <Link :href="route('commutes')"
                        ><SecondaryButton class="w-36 h-10 justify-center"
                            >گزارش تردد</SecondaryButton
                        ></Link
                    >
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Link } from "@inertiajs/vue3";
</script>
