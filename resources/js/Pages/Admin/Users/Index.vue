<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                تنظیمات کاربران
            </h2>
        </template>
        <div class="grid grid-cols-1 gap-5 my-10">
            <div class="mx-auto gap-10 flex">
                <div class="mx-auto">
                    <Link :href="route('admin.users.list')"
                        ><SecondaryButton class="w-36 h-10 justify-center"
                            >لیست کاربران</SecondaryButton
                        ></Link
                    >
                </div>
                <div class="mx-auto">
                    <Link :href="route('admin.users.new')"
                        ><PrimaryButton class="w-36 h-10 justify-center"
                            >افزودن کاربر</PrimaryButton
                        ></Link
                    >
                </div>
            </div>
            <div class="mx-auto gap-10 flex">
                <div class="mx-auto">
                    <Link :href="route('admin.users.admins')"
                        ><PrimaryButton class="w-36 h-10 justify-center"
                            >ادمین‌ها</PrimaryButton
                        ></Link
                    >
                </div>
                <div class="mx-auto">
                    <Link :href="route('admin.users.roles')"
                        ><SecondaryButton class="w-36 h-10 justify-center"
                            >نقش‌ها</SecondaryButton
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
