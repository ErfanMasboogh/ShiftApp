<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                کنترل شیفت‌ها
            </h2>
        </template>
        <div class="grid gap-5 my-10 grid-cols-1">
            <div class="mx-auto gap-10 flex">
                <Link :href="route('admin.shifts.new')"
                    ><PrimaryButton class="w-36 h-10 justify-center"
                        >ایجاد شیفت</PrimaryButton
                    ></Link
                >
            </div>
            <div class="mx-auto gap-10 flex">
                <Link :href="route('admin.shifts.list')"
                    ><SecondaryButton class="w-36 h-10 justify-center"
                        >‌لیست شیفت‌ها</SecondaryButton
                    ></Link
                >
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
