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
                                  <SecondaryButton
                                      @click="deleteModalShowF(item)"
                                  >
                                      <TrashIcon></TrashIcon
                                      >
                                  </SecondaryButton>
                                  <div v-if="deleteModalItem">
                                      <ConfirmModalAutoId
                                          :route="
                                                route(
                                                    'admin.shifts.list.delete',
                                                    deleteModalItem.id
                                                )
                                            "
                                          @no="deleteModalShowF(item)"
                                          :show="deleteModalShow"
                                      >
                                          <div class="my-3 mx-auto">
                                              آیا از حذف این شیفت مطمئن
                                              هستید؟
                                          </div>
                                      </ConfirmModalAutoId>
                                  </div>
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
import ConfirmModalAutoId from "@/Components/DependedComponents/ConfirmModalAutoId.vue";
import {ref} from "vue";

const props = defineProps({
    context: Object
})
const deleteModalShow = ref(false);
const deleteModalItem = ref("");

function deleteModalShowF(item) {
    deleteModalItem.value = item;
    deleteModalShow.value = !deleteModalShow.value;
}
</script>
