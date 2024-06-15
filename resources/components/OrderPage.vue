<template>
    <div class="container">
        <modal
            :isVisible="isModalVisible"
            message="Order succesvol toegevoegd!"
            @close="isModalVisible = false"
        ></modal>
        <div class="menu-list">
            <input
                type="text"
                v-model="searchQuery"
                placeholder="Search menu naam ..."
                class="search-input"
            />
            <ul>
                <li v-for="item in filteredMenuItems" :key="item.id">
                    <span class="menu-item"
                        >{{ item.number }} - {{ item.name }} - ${{
                            item.price.toFixed(2)
                        }}</span
                    >
                    <button @click="addToOrder(item)" class="add-button">
                        Voeg toe
                    </button>
                </li>
            </ul>
        </div>
        <div class="order-section">
            <div class="order-overview">
                <h3>Order Overview</h3>
                <ul>
                    <li v-for="(item, index) in groupedOrder" :key="index">
                        {{ item.name }} - ${{ item.price.toFixed(2) }} (x{{
                            item.quantity
                        }})
                        <button
                            @click="removeFromOrder(index)"
                            class="remove-button"
                        >
                            Verwijder
                        </button>
                    </li>
                </ul>
                <p class="total">Total: ${{ total.toFixed(2) }}</p>
            </div>
            <div class="note-field">
                <textarea
                    v-model="note"
                    placeholder="Optionele note..."
                    class="note-textarea"
                ></textarea>
            </div>
            <div class="submit-field">
                <button @click="clearOrder" class="clear-button">
                    Verwijder alles
                </button>
                <button @click="submitOrder" class="submit-button">
                    Verwerk order
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Modal from "./Modal.vue";

export default {
    components: {
        Modal,
    },
    props: {
        menuItems: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            searchQuery: "",
            order: [],
            note: "",
            isModalVisible: false,
        };
    },
    computed: {
        filteredMenuItems() {
            if (!this.menuItems) return [];
            return this.menuItems.filter((item) =>
                item.name.toLowerCase().includes(this.searchQuery.toLowerCase())
            );
        },
        groupedOrder() {
            const grouped = [];
            this.order.forEach((item) => {
                const existingItem = grouped.find((i) => i.id === item.id);
                if (existingItem) {
                    existingItem.quantity += 1;
                } else {
                    grouped.push({ ...item, quantity: 1 });
                }
            });
            return grouped;
        },
        total() {
            return this.order.reduce((sum, item) => sum + item.price, 0);
        },
    },
    methods: {
        addToOrder(item) {
            this.order.push(item);
        },
        removeFromOrder(index) {
            this.order.splice(index, 1);
        },
        clearOrder() {
            this.order = [];
            this.note = "";
        },
        submitOrder() {
            const orderData = {
                order: this.groupedOrder,
                note: this.note,
                total: this.total,
            };

            axios
                .post("/submit-order", orderData, {
                    headers: {
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),
                    },
                })
                .then((response) => {
                    this.clearOrder(); // Clear the order on successful submission
                    this.showModal();
                })
                .catch((error) => {
                    console.error(
                        "There was an error submitting the order:",
                        error
                    );
                });
        },
        showModal() {
            this.isModalVisible = true;
            setTimeout(() => {
                this.isModalVisible = false;
            }, 3000);
        },
    },
};
</script>

<style scoped>
.container {
    display: flex;
    padding: 20px;
    gap: 20px;
    font-family: Arial, sans-serif;
}

.menu-list {
    flex: 1 1 30%;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background-color: #f9f9f9;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.menu-list .search-input {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
    box-sizing: border-box;
}

.menu-list ul {
    list-style: none;
    padding: 0;
    max-height: 400px;
    overflow-y: auto;
}

.menu-list li {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 0;
    border-bottom: 1px solid #ddd;
}

.menu-item {
    flex: 1;
    font-size: 14px;
    color: #333;
}

.add-button {
    padding: 5px 10px;
    border: none;
    background-color: #007bff;
    color: white;
    border-radius: 4px;
    cursor: pointer;
    font-size: 12px;
}

.add-button:hover {
    background-color: #0056b3;
}

.order-section {
    flex: 1 1 60%;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.order-overview {
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background-color: #f9f9f9;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    flex: 1;
}

.order-overview ul {
    list-style: none;
    padding: 0;
    max-height: 200px;
    overflow-y: auto;
}

.order-overview li {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 0;
    border-bottom: 1px solid #ddd;
    font-size: 14px;
    color: #333;
}

.remove-button {
    padding: 5px 10px;
    border: none;
    background-color: #dc3545;
    color: white;
    border-radius: 4px;
    cursor: pointer;
    font-size: 12px;
}

.remove-button:hover {
    background-color: #c82333;
}

.total {
    font-weight: bold;
    text-align: right;
    margin-top: 10px;
    font-size: 16px;
    color: #333;
}

.note-field {
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background-color: #f9f9f9;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    flex: 1;
}

.note-field .note-textarea {
    width: 100%;
    height: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    resize: vertical;
    font-size: 14px;
    color: #333;
    box-sizing: border-box;
}
.submit-field {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background-color: #f9f9f9;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.submit-button {
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
    background-color: #007bff;
    color: white;
}
.clear-button {
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
    background-color: #dc3545;
    color: white;
}

.submit-button:hover {
    background-color: #0056b3;
}
.clear-button:hover {
    background-color: #c82333;
}
</style>
