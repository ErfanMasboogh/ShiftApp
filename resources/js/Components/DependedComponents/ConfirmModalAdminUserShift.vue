<script setup>
import { computed, onMounted, onUnmounted, ref, watch } from "vue";
import SecondaryButton from "../SecondaryButton.vue";
import axios from "axios";
import TextInput from "../TextInput.vue";
import { useForm } from "@inertiajs/vue3";
import InputLabel from "../InputLabel.vue";
import NumberInput from "../NumberInput.vue";

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    maxWidth: {
        type: String,
        default: "2xl",
    },
    closeable: {
        type: Boolean,
        default: true,
    },
    item: Object,
});
const emit = defineEmits(["no"]);
const form = useForm({
    id: props.item.id,
    name: props.item.name,
    start: props.item.start,
    end: props.item.end,
    wage_per_hour: props.item.wage_per_hour,
});
watch(
    () => props.show,
    () => {
        if (props.show) {
            document.body.style.overflow = "hidden";
        } else {
            document.body.style.overflow = null;
        }
    }
);

const no = () => {
    if (props.closeable) {
        emit("no");
    }
};
const yes = () => {
    if (props.closeable) {
        form.post(route('admin.shifts.list.update',props.item.id));
        no();
    }
};

const closeOnEscape = (e) => {
    if (e.key === "Escape" && props.show) {
        no();
    }
};

onMounted(() => document.addEventListener("keydown", closeOnEscape));

onUnmounted(() => {
    document.removeEventListener("keydown", closeOnEscape);
    document.body.style.overflow = null;
});

const maxWidthClass = computed(() => {
    return {
        sm: "sm:max-w-sm",
        md: "sm:max-w-md",
        lg: "sm:max-w-lg",
        xl: "sm:max-w-xl",
        "2xl": "sm:max-w-2xl",
    }[props.maxWidth];
});
</script>

<template>
    <Teleport to="body">
        <Transition leave-active-class="duration-200">
            <div
                v-show="show"
                class="fixed inset-0 z-50 overflow-y-auto my-36 px-4 py-6 sm:px-0"
                scroll-region
            >
                <Transition
                    enter-active-class="ease-out duration-300"
                    enter-from-class="opacity-0"
                    enter-to-class="opacity-100"
                    leave-active-class="ease-in duration-200"
                    leave-from-class="opacity-100"
                    leave-to-class="opacity-0"
                >
                    <div
                        v-show="show"
                        class="fixed inset-0 transform transition-all"
                        @click="no"
                    >
                        <div class="absolute inset-0 bg-gray-700 opacity-60" />
                    </div>
                </Transition>
                <Transition
                    enter-active-class="ease-out duration-300"
                    enter-from-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    enter-to-class="opacity-100 translate-y-0 sm:scale-100"
                    leave-active-class="ease-in duration-200"
                    leave-from-class="opacity-100 translate-y-0 sm:scale-100"
                    leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                >
                    <div
                        v-show="show"
                        class="mb-6 grid grid-cols-1 transform overflow-hidden rounded-lg bg-white shadow-xl transition-all sm:mx-auto sm:w-full"
                        :class="maxWidthClass"
                    >
                        <template class="text-center m-5" v-if="show"
                        ><div class="grid grid-cols-1">
                            <div class="my-3 gap-2 justify-self-center">
                                آیا از تغییرات ایجاد شده بر این شیفت، مطمئن
                                هستید؟
                            </div>
                            <div class="justify-self-center">
                                <InputLabel>نام شیفت</InputLabel>
                                <TextInput
                                    name="name"
                                    v-model="form.name"
                                ></TextInput>
                            </div>
                            <div class="my-2 justify-self-center">
                                <InputLabel
                                >حقوق ساعتی شیفت(هزارتومان)</InputLabel
                                >
                                <NumberInput
                                    name="number"
                                    v-model="form.wage_per_hour"
                                ></NumberInput>
                            </div>
                            <div class="flex mx-auto gap-5" >
                                <div class="justify-self-center">
                                    <InputLabel>زمان شروع شیفت</InputLabel>
                                    <TextInput
                                        name="start"
                                        type="time"
                                        v-model="form.start"
                                    ></TextInput>
                                </div><div class="justify-self-center">
                                <InputLabel>زمان پایان شیفت</InputLabel>
                                <TextInput
                                    type="time"
                                    name="end"
                                    v-model="form.end"
                                ></TextInput>
                            </div>
                            </div>
                            </div
                        ></template>
                        <div class="mx-auto">
                            <SecondaryButton
                                class="mx-2 justify-center m-3"
                                @click="no"
                            ><span class="text-red-600"
                            >خیر</span
                            ></SecondaryButton
                            >
                            <SecondaryButton
                                class="mx-2 justify-center my-3"
                                @click="yes"
                            ><span class="text-green-600"
                            >بله
                                </span></SecondaryButton
                            >
                        </div>
                    </div>
                </Transition>
            </div>
        </Transition>
    </Teleport>
</template>
