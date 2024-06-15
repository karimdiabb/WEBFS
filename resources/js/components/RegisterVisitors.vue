<template>
    <div>
      <form @submit.prevent="submitForm">
        <div>
          <label for="table">Tafel</label>
          <select v-model="tableId">
            <option v-for="table in tables" :key="table.TableID" :value="table.TableID">
              {{ table.TableID }}
            </option>
          </select>
        </div>
  
        <div>
          <label for="persons">Aantal Personen</label>
          <select v-model="numberOfPersons">
            <option v-for="n in 8" :key="n" :value="n">{{ n }}</option>
          </select>
        </div>
  
        <div v-for="n in numberOfPersons" :key="n">
          <label :for="'age-' + n">Persoon {{ n }} Leeftijd</label>
          <input type="number" :id="'age-' + n" v-model="personAges[n - 1]" min="0">
        </div>
  
        <div>
          <label for="extra-deluxe">Deluxe Menu</label>
          <input type="checkbox" v-model="extraDeluxe">
        </div>
  
        <button type="submit">Creëer</button>
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
  
        fetch('/table-sessions', {
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
                alert(data.message);
                window.location.href = '/table-sessions';  // Redirect to the index page
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
  