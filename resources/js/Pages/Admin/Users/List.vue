<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                لیست کاربران
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
                            <th class="justify-self-center m-1">نقش</th>
                        </div>
                        <hr class="py-1 w-[95%] mx-auto" />
                        <div
                            v-for="item in users"
                            :key="item.id"
                            class="p-6 grid grid-cols-3 my-2 text-gray-900"
                        >
                            <td class="justify-self-center m-1">
                                {{ item.name }}
                            </td>
                            <td class="justify-self-center m-1">
                                <template v-if="item.role_id == null"
                                    >ساده</template
                                >
                                <template v-if="item.role_id !== null"
                                    ><template
                                        v-for="role in props.context.roles"
                                    >
                                        <template
                                            v-if="role.id == item.role_id"
                                        >
                                            {{ role.name }}
                                        </template>
                                    </template>
                                </template>
                            </td>
                            <div
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
                                                    'admin.users.list.delete',
                                                    deleteModalItem.id
                                                )
                                            "
                                            @no="deleteModalShowF(item)"
                                            :show="deleteModalShow"
                                            ><div class="my-3 mx-auto">
                                                آیا از حذف این کاربر مطمئن
                                                هستید؟
                                            </div>
                                            <div
                                                class="text-sm font-semibold mx-auto"
                                            >
                                                (با حذف کاربر، تمامی اطلاعات
                                                مربوط به آن از جمله گزارشات
                                                تردد، ریز جزئیات و ... هم حذف
                                                خواهند شد!)
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
                                        <ConfirmModalAdminUserList
                                            :show="true"
                                            :item="editModalItem"
                                            :roles="props.context.roles"
                                            @no="editModalShowF(item)"
                                        ></ConfirmModalAdminUserList>
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
import ConfirmModalAdminUserList from "@/Components/DependedComponents/ConfirmModalAdminUserList.vue";
import ConfirmModalAutoId from "@/Components/DependedComponents/ConfirmModalAutoId.vue";
import EditIcon from "@/Components/EditIcon.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TrashIcon from "@/Components/TrashIcon.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { ref } from "vue";

const props = defineProps({
    context: Object,
});
const users = props.context.users.reverse();
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
</script>
