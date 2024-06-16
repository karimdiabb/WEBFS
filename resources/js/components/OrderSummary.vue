<template>
    <div class="max-w-3xl mx-auto p-6">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">
            Nieuwste Samenvatting
        </h2>
        <div
            class="bg-white border border-blue-500 p-6 rounded-lg shadow mb-8"
            v-if="newestSummary"
        >
            <a
                :href="`/order/download/${newestSummary.split('/').pop()}`"
                class="text-blue-600 hover:underline font-medium"
            >
                {{ newestSummary.split("/").pop() }}
            </a>
        </div>

        <h2 class="text-2xl font-bold mb-6 text-gray-800">
            Dagelijkse Samenvattingen
        </h2>
        <div class="bg-gray-50 p-6 rounded-lg shadow">
            <div
                v-for="(files, date) in groupedSummaries"
                :key="date"
                class="mb-6"
            >
                <h3 class="text-lg font-semibold mb-4 text-gray-700">
                    {{ date }}
                </h3>
                <ul class="space-y-2">
                    <li
                        v-for="file in files"
                        :key="file"
                        class="py-2 border-b border-gray-300 last:border-none"
                    >
                        <a
                            :href="`/order/download/${file.split('/').pop()}`"
                            class="text-blue-600 hover:underline font-medium"
                        >
                            {{ file.split("/").pop() }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["groupedSummaries", "newestSummary"],
    mounted() {
        console.log("Nieuwste Samenvatting:", this.newestSummary);
        console.log("Gegroupeerde Samenvattingen:", this.groupedSummaries);
    },
};
</script>

<style scoped>
.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

.text-blue-600 {
    color: #1d4ed8;
}

.text-gray-800 {
    color: #1f2937;
}

.text-gray-700 {
    color: #374151;
}
</style>
