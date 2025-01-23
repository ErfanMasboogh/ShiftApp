<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                ریز جزئیات
            </h2>
        </template>
        <div>
            <div class="py-12">
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div
                        class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                    >
                        <div class="p-6 grid grid-cols-5 text-gray-900">
                            <th class="justify-self-center m-1">نام</th>
                            <th class="justify-self-center m-1">ورود</th>
                            <th class="justify-self-center m-1">خروج</th>
                            <th class="justify-self-center m-1">
                                حقوق(هزارتومان)
                            </th>
                            <th class="justify-self-center m-1">وضعیت</th>
                        </div>
                        <hr class="py-1 w-[95%] mx-auto" />
                        <template v-for="item in commutes">
                            <div
                                class="p-6 grid grid-cols-5 my-2 text-gray-900"
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
                                    {{ item.enter }}
                                </td>
                                <td class="justify-self-center m-1">
                                    {{ item.exit }}
                                </td>
                                <td class="justify-self-center m-1">
                                    {{ item.salary }}
                                </td>
                                <td class="justify-self-center m-1">
                                    <span v-if="item.is_paid">پرداخت شده</span>
                                    <span v-else>پرداخت نشده</span>
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
const commutes = props.context.commutes.reverse();
</script>
