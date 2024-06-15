<template>
    <div class="flex justify-center p-5">
        <div class="container flex w-full max-w-6xl gap-5">
            <modal
                :isVisible="isModalVisible"
                :message="modalMessage"
                @close="isModalVisible = false"
            ></modal>
            <div
                class="menu-list flex-1 p-5 border border-gray-300 rounded-lg bg-gray-100 shadow-md max-h-128 overflow-y-auto"
            >
                <input
                    type="text"
                    v-model="searchQuery"
                    placeholder="Zoek menu naam ..."
                    class="w-full p-2 mb-3 border border-gray-400 rounded-lg"
                />
                <div
                    v-for="group in filteredMenuItems"
                    :key="group.type"
                    class="mb-5"
                >
                    <h3 class="font-bold mb-2">{{ group.type }}</h3>
                    <ul>
                        <li
                            v-for="item in group.items"
                            :key="item.id"
                            class="flex justify-between items-center py-2 border-b border-gray-300"
                        >
                            <span class="flex-1 text-gray-700"
                                >{{ item.number
                                }}{{
                                    item.extraIdentifier
                                        ? ` - ${item.extraIdentifier}`
                                        : ""
                                }}
                                - {{ item.name }} - €{{
                                    item.price.toFixed(2)
                                }}</span
                            >
                            <button
                                @click="addToOrder(item)"
                                class="px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-700"
                            >
                                Voeg toe
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="order-section flex-1 flex flex-col gap-5">
                <div
                    class="order-overview flex-1 p-5 border border-gray-300 rounded-lg bg-gray-100 shadow-md"
                >
                    <h3 class="text-lg font-semibold mb-3">
                        Bestelling Overview
                    </h3>
                    <ul class="max-h-64 overflow-y-auto">
                        <li
                            v-for="(item, index) in groupedOrder"
                            :key="index"
                            class="flex justify-between items-center py-2 border-b border-gray-300"
                        >
                            {{ item.name }} - €{{ item.price.toFixed(2) }} (x{{
                                item.quantity
                            }})
                            <button
                                @click="removeFromOrder(index)"
                                class="px-3 py-1 bg-red-500 text-white rounded-lg hover:bg-red-700"
                            >
                                Verwijder
                            </button>
                        </li>
                    </ul>
                    <p class="mt-3 font-bold text-right text-gray-700">
                        Totaal: €{{ total.toFixed(2) }}
                    </p>
                </div>
                <div
                    class="note-field flex-1 p-5 border border-gray-300 rounded-lg bg-gray-100 shadow-md"
                >
                    <textarea
                        v-model="note"
                        placeholder="Optionele note..."
                        class="w-full h-full p-2 border border-gray-400 rounded-lg resize-vertical"
                    ></textarea>
                </div>
                <div
                    class="submit-field p-5 border border-gray-300 rounded-lg bg-gray-100 shadow-md flex flex-col gap-3"
                >
                    <select
                        v-model="selectedTable"
                        class="w-full p-2 border border-gray-400 rounded-lg"
                    >
                        <option disabled value="">Selecteer een tafel</option>
                        <option
                            v-for="table in tables"
                            :key="table.TableID"
                            :value="table.TableID"
                        >
                            {{ table.Name }}
                        </option>
                    </select>
                    <div class="flex justify-between items-center">
                        <button
                            @click="clearOrder"
                            class="px-5 py-2 bg-red-500 text-white rounded-lg hover:bg-red-700"
                        >
                            Verwijder alles
                        </button>
                        <button
                            @click="submitOrder"
                            class="px-5 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700"
                        >
                            Verwerk bestelling
                        </button>
                    </div>
                </div>
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
        tables: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            searchQuery: "",
            order: [],
            note: "",
            selectedTable: "",
            isModalVisible: false,
            modalMessage: "",
        };
    },
    computed: {
        filteredMenuItems() {
            if (!this.menuItems) return [];
            return this.menuItems.map((group) => {
                return {
                    type: group.type,
                    items: group.items.filter((item) =>
                        item.name
                            .toLowerCase()
                            .includes(this.searchQuery.toLowerCase())
                    ),
                };
            });
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
            return this.order.reduce(
                (sum, item) => sum + parseFloat(item.price) * item.quantity,
                0
            );
        },
    },
    methods: {
        addToOrder(item) {
            this.order.push({ ...item, quantity: 1 });
        },
        removeFromOrder(index) {
            this.order.splice(index, 1);
        },
        clearOrder() {
            this.order = [];
            this.note = "";
            this.selectedTable = "";
        },
        submitOrder() {
            if (!this.selectedTable) {
                this.modalMessage = "Selecteer een tafel.";
                this.showModal();
                return;
            }

            const orderData = {
                tableID: this.selectedTable,
                order: this.groupedOrder.map((item) => ({
                    MenuItemID: item.id,
                    Quantity: item.quantity,
                    ItemPrice: item.price,
                })),
                TotalPrice: this.total,
                Notes: this.note,
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
                    this.modalMessage = "Bestelling succesvol toegevoegd!";
                    this.showModal();
                })
                .catch((error) => {
                    console.error(
                        "There was an error submitting the order:",
                        error
                    );
                    this.modalMessage =
                        "Er was een fout bij het indienen van de bestelling.";
                    this.showModal();
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
