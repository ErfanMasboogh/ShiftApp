<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                مدیریت پرداخت‌ها
            </h2>
        </template>
        <div class="grid grid-cols-1 gap-5 my-10">
            <div class="grid grid-cols-2 gap-3">
                <div class="justify-self-end">
                    <Link :href="route('admin.payments.pending')"
                        ><PrimaryButton class="w-36 h-10 justify-center"
                            >در انتظار پرداخت</PrimaryButton
                        ></Link
                    >
                </div>

                <div class="justify-self-start">
                    <Link :href="route('admin.payments.paid')"
                        ><PrimaryButton class="w-36 h-10 justify-center"
                            >پرداخت شده‌ها</PrimaryButton
                        ></Link
                    >
                </div>
            </div>
            <div class="mx-auto">
                <Link :href="route('admin.payments.details')"
                    ><SecondaryButton class="w-36 h-10 justify-center"
                        >ریز جزئیات</SecondaryButton
                    ></Link
                >
            </div>
        </div></AuthenticatedLayout
    >
</template>

<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Link } from "@inertiajs/vue3";
</script>
