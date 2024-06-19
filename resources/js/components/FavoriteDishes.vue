<template>
    <div>
        <h2 v-if="favorites.length" class="text-2xl font-bold mb-4">
            Favorieten
        </h2>
        <ul>
            <li
                v-for="dish in favoriteDishes"
                :key="dish.DishID"
                class="mb-4 p-4 border rounded-lg shadow cursor-pointer"
                @click="toggleFavorite(dish.DishID)"
            >
                <div class="flex justify-between items-center">
                    <div>
                        <span class="text-lg font-bold text-black">{{
                            dish.DishID
                        }}</span>
                        <span class="text-lg text-black ml-2">{{
                            dish.DishName
                        }}</span>
                    </div>
                    <div class="text-indigo-600">✔</div>
                </div>
            </li>
        </ul>
        <h2 class="text-2xl font-bold mb-4">Alle Gerechten</h2>
        <ul>
            <li
                v-for="dish in nonFavoriteDishes"
                :key="dish.DishID"
                class="mb-4 p-4 border rounded-lg shadow cursor-pointer"
                @click="toggleFavorite(dish.DishID)"
            >
                <div class="flex justify-between items-center">
                    <div>
                        <span class="text-lg font-bold text-black">{{
                            dish.DishID
                        }}</span>
                        <span class="text-lg text-black ml-2">{{
                            dish.DishName
                        }}</span>
                    </div>
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
        favoriteDishes() {
            return this.dishes.filter((dish) => this.isFavorite(dish.DishID));
        },
        nonFavoriteDishes() {
            return this.dishes.filter((dish) => !this.isFavorite(dish.DishID));
        },
    },
    methods: {
        isFavorite(dishId) {
            return this.favorites.includes(dishId);
        },
        toggleFavorite(dishId) {
            if (this.isFavorite(dishId)) {
                this.favorites = this.favorites.filter((id) => id !== dishId);
            } else {
                this.favorites.push(dishId);
            }
            this.saveFavorites();
        },
        saveFavorites() {
            document.cookie = `favorites=${JSON.stringify(
                this.favorites
            )};path=/;`;
        },
        loadFavorites() {
            const match = document.cookie.match(
                new RegExp("(^| )favorites=([^;]+)")
            );
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
.text-black {
    color: #000000;
}
.cursor-pointer {
    cursor: pointer;
}
</style>
