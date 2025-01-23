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
                        <div class="p-6 grid grid-cols-3 text-gray-900">
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
                                class="p-6 grid grid-cols-3 my-2 text-gray-900"
                            >
                                <td class="justify-self-center m-1">
                                    {{ item.name }}
                                </td>

                                <td class="justify-self-center m-1">
                                    {{ item.salary }}
                                </td>
                                <div class="justify-self-center">
                                    <SecondaryButton
                                        @click="checkModalShowF(item.id)"
                                        ><CheckIcon></CheckIcon
                                    ></SecondaryButton>
                                    <div v-if="checkModalShow">
                                        <ConfirmModalAutoIdPost
                                            :show="true"
                                            :item_id="checkModalItemId"
                                            :route="
                                                route('admin.payments.pending')
                                            "
                                            @no="checkModalShowF(item.id)"
                                            ><div class="my-3 mx-auto">
                                                آیا از ثبت پرداخت شدن حقوق این
                                                کاربر مطمئن هستید؟
                                            </div>
                                        </ConfirmModalAutoIdPost>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import CheckIcon from "@/Components/CheckIcon.vue";
import ConfirmModalAutoIdPost from "@/Components/DependedComponents/ConfirmModalAutoIdPost.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { ref } from "vue";

const props = defineProps({
    context: Object,
});

const checkModalShow = ref(false);
const checkModalItemId = ref("");
function checkModalShowF(itemId) {
    checkModalItemId.value = itemId;
    checkModalShow.value = !checkModalShow.value;
}
</script>
