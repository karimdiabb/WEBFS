<template>
    <div
        v-if="isVisible"
        class="fixed inset-0 flex justify-center items-center bg-black bg-opacity-40 z-50"
    >
        <div
            class="bg-white m-auto p-5 border border-gray-400 w-4/5 max-w-lg text-center rounded-lg"
        >
            <span
                class="text-gray-500 float-right text-2xl font-bold cursor-pointer"
                @click="closeModal"
                >&times;</span
            >
            <p>{{ message }}</p>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        isVisible: {
            type: Boolean,
            default: false,
        },
        message: {
            type: String,
            default: "",
        },
    },
    methods: {
        closeModal() {
            this.$emit("close");
        },
    },
};
</script>
