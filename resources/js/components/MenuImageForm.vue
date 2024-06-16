<template>
    <div class="max-w-3xl mx-auto p-4 bg-white rounded shadow-md">
        <h2 class="text-2xl font-bold mb-6">Beheer Menu Afbeeldingen</h2>
        <form @submit.prevent="submitForm" enctype="multipart/form-data">
            <div class="mb-6">
                <label
                    class="block text-gray-700 text-sm font-bold mb-2"
                    for="image1"
                >
                    Upload Afbeelding 1
                </label>
                <input
                    type="file"
                    ref="image1"
                    @change="previewImage('image1')"
                    class="hidden"
                    id="image1"
                />
                <div class="flex items-center mb-4">
                    <button
                        type="button"
                        @click="triggerFileInput('image1')"
                        class="bg-blue-500 text-white px-4 py-2 rounded"
                    >
                        Kies bestand
                    </button>
                    <span class="ml-3">{{
                        image1Name || "Geen bestand gekozen"
                    }}</span>
                </div>
                <div v-if="errors.image1" class="text-red-500 text-sm">
                    {{ errors.image1 }}
                </div>
                <div class="flex justify-between">
                    <div v-if="currentImage1" class="w-1/2 p-2">
                        <p class="text-center">Huidige Afbeelding</p>
                        <img :src="currentImage1" class="border rounded" />
                    </div>
                    <div v-if="image1Preview" class="w-1/2 p-2">
                        <p class="text-center">Nieuwe Afbeelding</p>
                        <img :src="image1Preview" class="border rounded" />
                    </div>
                </div>
            </div>
            <div class="mb-6">
                <label
                    class="block text-gray-700 text-sm font-bold mb-2"
                    for="image2"
                >
                    Upload Afbeelding 2
                </label>
                <input
                    type="file"
                    ref="image2"
                    @change="previewImage('image2')"
                    class="hidden"
                    id="image2"
                />
                <div class="flex items-center mb-4">
                    <button
                        type="button"
                        @click="triggerFileInput('image2')"
                        class="bg-blue-500 text-white px-4 py-2 rounded"
                    >
                        Kies bestand
                    </button>
                    <span class="ml-3">{{
                        image2Name || "Geen bestand gekozen"
                    }}</span>
                </div>
                <div v-if="errors.image2" class="text-red-500 text-sm">
                    {{ errors.image2 }}
                </div>
                <div class="flex justify-between">
                    <div v-if="currentImage2" class="w-1/2 p-2">
                        <p class="text-center">Huidige Afbeelding</p>
                        <img :src="currentImage2" class="border rounded" />
                    </div>
                    <div v-if="image2Preview" class="w-1/2 p-2">
                        <p class="text-center">Nieuwe Afbeelding</p>
                        <img :src="image2Preview" class="border rounded" />
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-end space-x-4">
                <button
                    type="button"
                    @click="cancel"
                    class="bg-gray-500 text-white px-4 py-2 rounded"
                >
                    Annuleren
                </button>
                <button
                    type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded"
                >
                    Opslaan
                </button>
            </div>
        </form>
        <div v-if="serverError" class="text-red-500 text-sm mt-4">
            {{ serverError }}
        </div>
    </div>
</template>

<script>
export default {
    props: {
        currentImage1: String,
        currentImage2: String,
    },
    data() {
        return {
            image1Preview: null,
            image2Preview: null,
            image1Name: "",
            image2Name: "",
            errors: {},
            serverError: "",
        };
    },
    methods: {
        triggerFileInput(imageRef) {
            this.$refs[imageRef].click();
        },
        previewImage(imageRef) {
            const file = this.$refs[imageRef].files[0];
            const reader = new FileReader();
            reader.onload = (e) => {
                if (imageRef === "image1") {
                    this.image1Preview = e.target.result;
                    this.image1Name = file.name;
                } else if (imageRef === "image2") {
                    this.image2Preview = e.target.result;
                    this.image2Name = file.name;
                }
            };
            reader.readAsDataURL(file);
        },
        async submitForm() {
            const formData = new FormData();
            formData.append("image1", this.$refs.image1.files[0]);
            formData.append("image2", this.$refs.image2.files[0]);

            try {
                await axios.post("/menu/storeOrUpdate", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                });
                window.location.href = "/menu/index";
            } catch (error) {
                if (error.response && error.response.data.errors) {
                    this.errors = {
                        image1: error.response.data.errors.image1
                            ? "Bestand 1: " +
                              this.translateError(
                                  error.response.data.errors.image1[0]
                              )
                            : null,
                        image2: error.response.data.errors.image2
                            ? "Bestand 2: " +
                              this.translateError(
                                  error.response.data.errors.image2[0]
                              )
                            : null,
                    };
                } else {
                    this.serverError =
                        "Er is een fout opgetreden bij het uploaden van de afbeeldingen.";
                }
                console.error(error);
            }
        },
        translateError(error) {
            const translations = {
                "validation.image": "Het bestand moet een afbeelding zijn.",
                "validation.mimes":
                    "Het bestand moet een type van: jpeg, png, jpg, gif, svg zijn.",
                "validation.max.file":
                    "Het bestand mag niet groter zijn dan 5120 kilobytes.",
            };
            return translations[error] || error;
        },
        cancel() {
            window.location.href = "/menu/index";
        },
    },
};
</script>
