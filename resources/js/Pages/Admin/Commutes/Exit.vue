<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                ثبت خروج
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
                            <th class="justify-self-center m-1">زمان ورود</th>
                        </div>
                        <hr class="py-1 w-[95%] mx-auto" />
                        <template v-for="item in props.context.commutes">
                            <div
                                class="p-6 grid grid-cols-3 my-2 text-gray-900"
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
                                    {{ item.enter }}
                                </td>

                                <div class="justify-self-center">
                                    <SecondaryButton
                                        @click="exitModalShowF(item.id)"
                                        ><ExitIcon></ExitIcon
                                    ></SecondaryButton>
                                    <div v-if="exitModalShow">
                                        <ConfirmModalAutoIdPost
                                            :show="true"
                                            :route="
                                                route('admin.commutes.exit')
                                            "
                                            :item_id="exitModalItemId"
                                            @no="exitModalShowF(item)"
                                            ><div class="my-3 mx-auto">
                                                آیا از ثبت خروج این کاربر مطمئن
                                                هستید؟
                                            </div></ConfirmModalAutoIdPost
                                        >
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
import ConfirmModalAutoIdPost from "@/Components/DependedComponents/ConfirmModalAutoIdPost.vue";
import ExitIcon from "@/Components/ExitIcon.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { ref } from "vue";
const props = defineProps({
    context: Object,
});

const exitModalShow = ref(false);
const exitModalItemId = ref("");
function exitModalShowF(item_id) {
    exitModalItemId.value = item_id;
    exitModalShow.value = !exitModalShow.value;
}
</script>
