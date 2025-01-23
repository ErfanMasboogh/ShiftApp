<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                نقش‌ها
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
                                @click="newRoleModalF"
                                class="w-36 h-10 justify-center"
                                >افزودن نقش</PrimaryButton
                            >
                            <div>
                                <ConfirmModalAdminUserRoleNew
                                    :show="newRoleModal"
                                    @no="newRoleModalF"
                                ></ConfirmModalAdminUserRoleNew>
                            </div>
                        </div>
                        <div class="p-6 grid grid-cols-3 text-gray-900">
                            <th class="justify-self-center m-1">نام</th>
                            <th class="justify-self-center m-1">
                                اضافه پرداخت(هزارتومان)
                            </th>
                        </div>
                        <hr class="py-1 w-[95%] mx-auto" />
                        <div
                            v-for="item in roles"
                            :key="item.id"
                            class="p-6 grid grid-cols-3 my-2 text-gray-900"
                        >
                            <td class="justify-self-center m-1">
                                {{ item.name }}
                            </td>
                            <td class="justify-self-center m-1">
                                {{ item.over_payment }}
                            </td>
                            <div
                                v-if="item.name !== 'ساده'"
                                class="grid grid-cols-2 gap-2 justify-self-center m-1"
                            >
                                <div>
                                    <SecondaryButton
                                        @click="deleteModalShowF(item)"
                                        ><TrashIcon></TrashIcon
                                    ></SecondaryButton>
                                    <div v-if="deleteModalItem">
                                        <ConfirmModalAutoId
                                            :route="
                                                route(
                                                    'admin.users.roles.delete',
                                                    deleteModalItem.id
                                                )
                                            "
                                            @no="deleteModalShowF(item)"
                                            :show="deleteModalShow"
                                            ><div class="my-3 mx-auto">
                                                آیا از حذف این نقش مطمئن هستید؟
                                            </div>
                                            <div
                                                class="text-sm font-semibold mx-auto"
                                            >
                                                (با حذف نقش، تمامی کاربران حاوی
                                                آن، تبدیل به کاربر ساده خواهند
                                                شد و اضافه پرداختی نخواهند داشت)
                                            </div>
                                        </ConfirmModalAutoId>
                                    </div>
                                </div>
                                <div>
                                    <SecondaryButton
                                        @click="editModalShowF(item)"
                                        ><EditIcon></EditIcon
                                    ></SecondaryButton>
                                    <div v-if="editModalShow">
                                        <ConfirmModalAdminUserRole
                                            :show="true"
                                            :item="editModalItem"
                                            @no="editModalShowF(item)"
                                        ></ConfirmModalAdminUserRole>
                                    </div>
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
import ConfirmModalAdminUserRole from "@/Components/DependedComponents/ConfirmModalAdminUserRole.vue";
import ConfirmModalAdminUserRoleNew from "@/Components/DependedComponents/ConfirmModalAdminUserRoleNew.vue";
import ConfirmModalAutoId from "@/Components/DependedComponents/ConfirmModalAutoId.vue";
import EditIcon from "@/Components/EditIcon.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TrashIcon from "@/Components/TrashIcon.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { ref } from "vue";

// import { Link } from "@inertiajs/vue3";

const props = defineProps({
    context: Object,
});
const roles = props.context.roles.reverse();
const deleteModalShow = ref(false);
const deleteModalItem = ref("");
const editModalShow = ref(false);
const editModalItem = ref("");
function deleteModalShowF(item) {
    deleteModalItem.value = item;
    deleteModalShow.value = !deleteModalShow.value;
}
function editModalShowF(item) {
    editModalItem.value = item;
    editModalShow.value = !editModalShow.value;
}

const newRoleModal = ref(false);
function newRoleModalF() {
    newRoleModal.value = !newRoleModal.value;
}
</script>
