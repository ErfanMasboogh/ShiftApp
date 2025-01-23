<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                لیست تردد
            </h2>
        </template>
        <div>
            <div class="py-12">
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div
                        class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                    >
                        <div class="p-6 grid grid-cols-4 text-gray-900">
                            <th class="justify-self-center m-1">نام</th>
                            <th class="justify-self-center m-1">نوع</th>
                            <th class="justify-self-center m-1">زمان</th>
                            <th class="justify-self-center m-1">تاریخ</th>
                        </div>
                        <hr class="py-1 w-[95%] mx-auto" />
                        <template v-for="item in Commutes">
                            <div
                                class="p-6 grid grid-cols-4 my-2 text-gray-900"
                            >
                                <td class="justify-self-center m-1">
                                    <template
                                        v-for="user in props.context.users"
                                    >
                                        <span v-if="item.user_id == user.id">{{
                                            user.name
                                        }}</span>
                                    </template>
                                </td>
                                <td class="justify-self-center m-1">
                                    <span v-if="item.is_exit == 0">ورود</span
                                    ><span v-else>خروج</span>
                                </td>
                                <td class="justify-self-center m-1">
                                    {{ item.time }}
                                </td>
                                <td class="justify-self-center m-1">
                                    {{ item.date }}
                                </td>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
const props = defineProps({
    context: Object,
});
const Commutes = props.context.commutes.reverse();
</script>
