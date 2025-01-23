<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                ادمین‌ها
            </h2>
        </template>
        <div>
            <div class="py-12">
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div
                        class="overflow-hidden grid grid-cols-1 bg-white shadow-sm sm:rounded-lg"
                    >
                        <div class="m-5 justify-self-center">
                            <PrimaryButton
                                @click="newModalShowF"
                                class="w-36 h-10 justify-center"
                                >افزودن ادمین</PrimaryButton
                            >
                            <div>
                                <ConfirmModalAdminUserAdmin
                                    :users="props.context.users"
                                    :show="newModalShow"
                                    @no="newModalShowF"
                                ></ConfirmModalAdminUserAdmin>
                            </div>
                        </div>
                        <div class="p-6 grid grid-cols-2 text-gray-900">
                            <th class="justify-self-center m-1">نام</th>
                        </div>
                        <hr class="py-1 w-[95%] mx-auto" />
                        <template
                            v-for="item in props.context.admins"
                            :key="item.id"
                        >
                            <div
                                class="p-6 grid grid-cols-2 my-2 text-gray-900"
                            >
                                <td class="justify-self-center m-1">
                                    {{ item.name }}
                                </td>
                                <div
                                    class="grid grid-cols-1 gap-2 justify-self-center m-1"
                                >
                                    <div>
                                        <SecondaryButton
                                            @click="deleteModalShowF(item)"
                                            ><TrashIcon></TrashIcon
                                        ></SecondaryButton>
                                    </div>
                                    <div v-if="deleteModalItem">
                                        <ConfirmModalAutoId
                                            :route="
                                                route(
                                                    'admin.users.admins.delete',
                                                    deleteModalItem.id
                                                )
                                            "
                                            :show="deleteModalShow"
                                            @no="deleteModalShowF(item)"
                                            ><div class="my-3 mx-auto">
                                                آیا از گرفتن دسترسی های ادمین از
                                                این کاربر مطمئن هستید؟
                                            </div>
                                            <div></div
                                        ></ConfirmModalAutoId>
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
import ConfirmModalAdminUserAdmin from "@/Components/DependedComponents/ConfirmModalAdminUserAdmin.vue";
import ConfirmModalAutoId from "@/Components/DependedComponents/ConfirmModalAutoId.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TrashIcon from "@/Components/TrashIcon.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { ref } from "vue";

const props = defineProps({
    context: Object,
});
const deleteModalShow = ref(false);
const deleteModalItem = ref("");
function deleteModalShowF(item) {
    deleteModalItem.value = item;
    deleteModalShow.value = !deleteModalShow.value;
}

const newModalShow = ref(false);
function newModalShowF() {
    newModalShow.value = !newModalShow.value;
}
</script>
