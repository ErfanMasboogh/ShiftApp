<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                گزارش تردد
            </h2>
        </template>
        <div class="grid grid-cols-1 gap-5 my-10">
            <div class="grid grid-cols-2 gap-3">
                <div class="justify-self-end">
                    <Link :href="route('admin.commutes.enter')"
                        ><PrimaryButton class="w-36 h-10 justify-center"
                            >ثبت ورود</PrimaryButton
                        ></Link
                    >
                </div>

                <div class="justify-self-start">
                    <Link :href="route('admin.commutes.exit')"
                        ><PrimaryButton class="w-36 h-10 justify-center"
                            >ثبت خروج</PrimaryButton
                        ></Link
                    >
                </div>
            </div>
            <div class="mx-auto">
                <Link :href="route('admin.commutes.list')"
                    ><SecondaryButton class="w-36 h-10 justify-center"
                        >لیست تردد</SecondaryButton
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
