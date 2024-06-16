<template>
    <div class="flex justify-center mt-4">
      <button @click="downloadPdf" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
        Download Menu PDF
      </button>
    </div>
</template>
  
<script>
  export default {
    methods: {
      downloadPdf() {
        window.location.href = '/menu/download';
      }
    }
  };
</script>
  