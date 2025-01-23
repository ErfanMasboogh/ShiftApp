<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                در انتظار پرداخت
            </h2>
        </template>
        <div>
            <div class="py-12">
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div
                        class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                    >
                        <div class="p-6 grid grid-cols-2 text-gray-900">
                            <th class="justify-self-center m-1">نام</th>
                            <th class="justify-self-center m-1">
                                مبلغ(هزارتومان)
                            </th>
                        </div>
                        <hr class="py-1 w-[95%] mx-auto" />
                        <template
                            v-for="item in props.context.users"
                            :key="item.id"
                        >
                            <div
                                class="p-6 grid grid-cols-2 my-2 text-gray-900"
                            >
                                <td class="justify-self-center m-1">
                                    {{ item.name }}
                                </td>
                                <td class="justify-self-center m-1">
                                    {{ item.salary }}
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
</script>
