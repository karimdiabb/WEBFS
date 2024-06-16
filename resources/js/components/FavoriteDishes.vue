<template>
    <div>
      <ul>
        <li v-for="dish in sortedDishes" :key="dish.DishID" class="mb-4">
          <div class="flex justify-between items-center">
            <div>
              <span class="text-black">{{ dish.DishID }}</span>
              <span class="text-black">{{ dish.DishName }}</span>
            </div>
            <input type="checkbox" :checked="isFavorite(dish.DishID)" @change="toggleFavorite(dish.DishID)">
          </div>
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      dishes: {
        type: Array,
        required: true,
      },
    },
    data() {
      return {
        favorites: [],
      };
    },
    computed: {
      sortedDishes() {
        const sortedDishes = [...this.dishes];
        const favoriteDishes = sortedDishes.filter(dish => this.isFavorite(dish.DishID));
        const nonFavoriteDishes = sortedDishes.filter(dish => !this.isFavorite(dish.DishID));
        
        favoriteDishes.sort((a, b) => a.DishID - b.DishID);
        nonFavoriteDishes.sort((a, b) => a.DishID - b.DishID);
        
        return [...favoriteDishes, ...nonFavoriteDishes];
      },
    },
    methods: {
      isFavorite(dishId) {
        return this.favorites.includes(dishId);
      },
      toggleFavorite(dishId) {
        if (this.isFavorite(dishId)) {
          this.favorites = this.favorites.filter(id => id !== dishId);
        } else {
          this.favorites.push(dishId);
        }
        this.saveFavorites();
      },
      saveFavorites() {
        document.cookie = `favorites=${JSON.stringify(this.favorites)};path=/;`;
      },
      loadFavorites() {
        const match = document.cookie.match(new RegExp('(^| )favorites=([^;]+)'));
        if (match) {
          this.favorites = JSON.parse(match[2]);
        }
      },
    },
    created() {
      this.loadFavorites();
    },
  };
  </script>
  
  <style scoped>
  .btn {
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }
  
  .btn-primary {
    background-color: #007bff;
    color: white;
  }
  
  .text-black {
    color: black;
  }
  </style>
  