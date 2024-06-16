<template>
    <div>
        <form @submit.prevent="submitForm">
            <div class="mb-5">
                <label for="title" class="block text-gray-700">Titel</label>
                <input
                    type="text"
                    v-model="form.title"
                    id="title"
                    class="w-full p-2 border border-gray-300 rounded"
                    required
                />
                <div v-if="errors.title" class="text-red-500 text-sm mt-1">
                    {{ errors.title[0] }}
                </div>
            </div>

            <div class="mb-5">
                <label for="slug" class="block text-gray-700">URL Slug</label>
                <div class="flex">
                    <span class="bg-gray-200 p-2 rounded-l">{{ domain }}/</span>
                    <input
                        type="text"
                        v-model="form.slug"
                        id="slug"
                        class="w-full p-2 border border-gray-300 rounded-r"
                        required
                    />
                </div>
                <div v-if="errors.slug" class="text-red-500 text-sm mt-1">
                    {{ errors.slug[0] }}
                </div>
            </div>

            <div class="mb-5">
                <label for="content" class="block text-gray-700">Inhoud</label>
                <ckeditor
                    :editor="editor"
                    v-model="form.content"
                    class="w-full p-2 border border-gray-300 rounded"
                    required
                ></ckeditor>
                <div v-if="errors.content" class="text-red-500 text-sm mt-1">
                    {{ errors.content[0] }}
                </div>
            </div>

            <div class="flex justify-start space-x-2">
                <button
                    type="button"
                    @click="cancel"
                    class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-700"
                >
                    Annuleren
                </button>
                <button
                    type="submit"
                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700"
                >
                    {{ pageId ? "Pagina Bijwerken" : "Pagina Aanmaken" }}
                </button>
            </div>
        </form>

        <modal
            :is-visible="isModalVisible"
            :message="modalMessage"
            @close="isModalVisible = false"
        ></modal>
    </div>
</template>

<script>
import axios from "axios";
import { CKEditor } from "@ckeditor/ckeditor5-vue";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import Modal from "./Modal.vue";

export default {
    components: {
        CKEditor,
        Modal,
    },
    props: {
        pageId: {
            type: [Number, String],
            default: null,
        },
        pageTitle: {
            type: String,
            default: "",
        },
        pageSlug: {
            type: String,
            default: "",
        },
        pageContent: {
            type: String,
            default: "",
        },
    },
    data() {
        return {
            form: {
                title: this.pageTitle,
                slug: this.pageSlug,
                content: this.pageContent,
            },
            errors: {}, // Initialize errors as an empty object
            editor: ClassicEditor,
            domain: window.location.origin, // Assuming the domain is the origin of the current location
            isModalVisible: false,
            modalMessage: "",
        };
    },
    methods: {
        submitForm() {
            const url = this.pageId ? `/pages/${this.pageId}` : "/pages";
            const method = this.pageId ? "put" : "post";

            axios({
                method,
                url,
                data: this.form,
            })
                .then((response) => {
                    this.modalMessage = response.data.message;
                    this.isModalVisible = true;
                    setTimeout(() => {
                        window.location.href = "/pages";
                    }, 2000);
                })
                .catch((error) => {
                    if (error.response && error.response.data.errors) {
                        this.errors = error.response.data.errors; // Set errors to the response errors
                    } else {
                        this.modalMessage =
                            "Er is een fout opgetreden bij het verzenden van het formulier.";
                        this.isModalVisible = true;
                    }
                });
        },
        cancel() {
            window.location.href = "/pages";
        },
    },
};
</script>

<style scoped></style>
