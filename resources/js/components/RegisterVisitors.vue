<template>
    <div class="container mx-auto p-4 bg-white rounded-lg shadow-md">
      <form @submit.prevent="submitForm" class="space-y-6">
        <div>
          <label for="table" class="block text-sm font-medium text-gray-700">Tafel</label>
          <select v-model="tableId" id="table" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            <option v-for="table in tables" :key="table.TableID" :value="table.TableID">
              {{ table.TableID }}
            </option>
          </select>
        </div>
  
        <div>
          <label for="persons" class="block text-sm font-medium text-gray-700">Aantal Personen</label>
          <select v-model="numberOfPersons" id="persons" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            <option v-for="n in 8" :key="n" :value="n">{{ n }}</option>
          </select>
        </div>
  
        <div v-for="n in numberOfPersons" :key="n" class="mt-4">
          <label :for="'age-' + n" class="block text-sm font-medium text-gray-700">Persoon {{ n }} Leeftijd</label>
          <input type="number" :id="'age-' + n" v-model="personAges[n - 1]" min="0" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
        </div>
  
        <div class="mt-4">
          <label for="extra-deluxe" class="block text-sm font-medium text-gray-700">Deluxe Menu</label>
          <input type="checkbox" id="extra-deluxe" v-model="extraDeluxe" class="mt-1">
        </div>
  
        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
          Creëer
        </button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        tables: [],
        tableId: null,
        numberOfPersons: 1,
        personAges: [],
        extraDeluxe: false
      };
    },
    created() {
      fetch('/api/tables')
        .then(response => response.json())
        .then(data => {
          this.tables = data;
        });
    },
    methods: {
      submitForm() {
        // Validate ages to ensure they are not negative
        for (let age of this.personAges) {
          if (age < 0) {
            alert('Leeftijd kan niet negatief zijn.');
            return;
          }
        }
  
        const payload = {
          table_id: this.tableId,
          person_ages: this.personAges.slice(0, this.numberOfPersons),
          extra_deluxe: this.extraDeluxe
        };
  
        fetch('/tables', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify(payload)
        }).then(response => {
          if (response.ok) {
            response.json().then(data => {
              if (data.success) {
                window.location.href = '/tables';  // Redirect to the index page
              } else {
                alert('Failed to create table session.');
              }
            });
          } else {
            alert('Failed to create table session.');
          }
        }).catch(error => {
          console.error('Error:', error);
          alert(`An error occurred: ${error.message}`);
        });
      }
    }
  };
  </script>
  
  <style scoped>
  .container {
    max-width: 600px;
    margin-top: 20px;
  }
  .space-y-6 > :not([hidden]) ~ :not([hidden]) {
    --space-y-reverse: 0;
    margin-top: calc(1.5rem * calc(1 - var(--space-y-reverse)));
    margin-bottom: calc(1.5rem * var(--space-y-reverse));
  }
  </style>
  