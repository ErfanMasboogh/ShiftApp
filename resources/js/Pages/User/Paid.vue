<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                پرداختی‌ها
            </h2>
        </template>
        <div>
            <div class="py-12">
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div
                        class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                    >
                        <div class="p-6 grid grid-cols-3 text-gray-900">
                            <th class="justify-self-center m-1">نام</th>
                            <th class="justify-self-center m-1">مبلغ</th>
                            <th class="justify-self-center m-1">تاریخ</th>
                        </div>
                        <hr class="py-1 w-[95%] mx-auto" />
                        <template v-for="item in payments">
                            <div
                                class="p-6 grid grid-cols-3 my-2 text-gray-900"
                            >
                                <template v-for="user in props.context.users">
                                    <td
                                        v-if="user.id == item.user_id"
                                        class="justify-self-center m-1"
                                    >
                                        {{ user.name }}
                                    </td>
                                </template>
                                <td class="justify-self-center m-1">
                                    {{ item.amount }}
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
const payments = props.context.payments.reverse();
</script>
