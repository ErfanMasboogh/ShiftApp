<template>
    <select
        class="rounded-md h-12 w-52 border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
        v-if="props.value"
        v-model="form.selectedOption"
        :value="form.selectedOption"
        @change="sendEmit"
    >
        <option v-if="name" disabled value="999999999">
            یک {{ name }} را انتخاب کنید!
        </option>

        <option v-else disabled value="999999999">
            یک مورد را انتخاب کنید!
        </option>
        <option v-for="item in props.array" :value="item.id">
            {{ item.name }}
        </option>
    </select>
    <select
        class="rounded-md h-12 w-52 border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
        v-model="selectedOption"
        v-else
        @change="sendEmit"
    >
        <option v-if="name" selected disabled value="999999999">
            یک {{ name }} را انتخاب کنید!
        </option>

        <option v-else selected disabled value="999999999">
            یک مورد را انتخاب کنید!
        </option>
        <option v-for="item in props.array" :value="item.id">
            {{ item.name }}
        </option>
    </select>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps({
    array: Object,
    name: String,
    value: {
        type: Number,
        default: 999999999,
    },
});

const form = useForm({
    selectedOption: props.value,
});

// const selectedOption = ref(props.value);
const emit = defineEmits(["change:option"]);
function sendEmit() {
    emit("change:option", form.selectedOption);
}
</script>
