<template>
  <div class="request-help">
    <p>Hulp is gevraagd. Een ober komt zo snel mogelijk.</p>
  </div>
</template>

<script>
export default {
  props: {
    sessionId: {
      type: Number,
      required: true,
    },
  },
  mounted() {
    this.requestHelp();
  },
  methods: {
    requestHelp() {
      fetch(`/api/table-sessions/${this.sessionId}/request-help`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
      }).then(response => {
        if (!response.ok) {
          console.log(response);
        }
      }).catch(error => {
        console.error('Error:', error);
        alert(`An error occurred: ${error.message}`);
      });
    },
  },
};
</script>

<style scoped>
.request-help {
  text-align: center;
  margin-top: 20px;
}
</style>
