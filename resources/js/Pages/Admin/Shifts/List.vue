<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                لیست شیفت‌ها
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
                            <th class="justify-self-center m-1">شروع</th>
                            <th class="justify-self-center m-1">پایان</th>
                            <th class="justify-self-center m-1">حقوق ساعتی</th>
                        </div>
                        <hr class="py-1 w-[95%] mx-auto"/>
                        <div v-for="item in props.context.shifts" :key="item.id"
                             class="p-6 grid grid-cols-5 my-2 text-gray-900">

                            <td class="justify-self-center m-1">{{ item.name }}</td>
                            <td class="justify-self-center m-1">{{ item.start }}</td>
                            <td class="justify-self-center m-1">{{ item.end }}</td>
                            <td class="justify-self-center m-1">{{ item.wage_per_hour }}</td>
                            <div
                                class="grid grid-cols-2 gap-2 justify-self-center m-1"
                            >
                                <div>
                                    <Link
                                    >
                                        <SecondaryButton
                                        >
                                            <TrashIcon></TrashIcon>
                                        </SecondaryButton
                                        >
                                    </Link>
                                </div>
                                <div>
                                    <Link
                                    >
                                        <SecondaryButton
                                        >
                                            <EditIcon></EditIcon>
                                        </SecondaryButton
                                        >
                                    </Link>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import EditIcon from "@/Components/EditIcon.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TrashIcon from "@/Components/TrashIcon.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    context: Object
})
</script>
