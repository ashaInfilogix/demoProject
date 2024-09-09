<template>
    <div>
        <h1>Product Listing</h1>

        <!-- Loading and Error States -->
        <div v-if="loading">Loading products...</div>
        <div v-if="error" class="error">{{ error }}</div>

        <!-- Filters -->
        <div v-if="categories.length">
            <label for="category">Category:</label>
            <select v-model="selectedCategory" @change="onCategoryChange">
                <option value="">All Categories</option>
                <option v-for="category in categories" :key="category.id" :value="category.id">
                    {{ category.name }}
                </option>
            </select>

            <label v-if="filteredSubcategories.length" for="subcategory">Subcategory:</label>
            <select v-model="selectedSubcategory">
                <option value="">All Subcategories</option>
                <option v-for="subcategory in filteredSubcategories" :key="subcategory.id" :value="subcategory.id">
                    {{ subcategory.name }}
                </option>
            </select>
        </div>

        <!-- Product Table -->
        <table v-if="filteredProducts.length" class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Category Name</th>
                    <th>Subcategory Name</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="product in filteredProducts" :key="product.id">
                    <td>{{ product.id }}</td>
                    <td>{{ product.name }}</td>
                    <td>{{ product.subcategory.name }}</td>
                    <td>{{ product.subcategory.name }}</td>
                    <td>{{ formatPrice(product.price) }}</td>
                </tr>
            </tbody>
        </table>

        <!-- No Products Message -->
        <div v-if="!loading && !filteredProducts.length">No products available.</div>
    </div>
</template>

<script>
export default {
    name: 'ProductList',
    data() {
        return {
            products: [],
            categories: [],
            subcategories: [],
            selectedCategory: '',
            selectedSubcategory: '',
            loading: true,
            error: null,
        };
    },
    mounted() {
        this.fetchProducts();
        this.fetchCategories();
    },
    computed: {
        filteredProducts() {
            return this.products.filter(product => {
                const matchesCategory = !this.selectedCategory || product.subcategory.category_id === this.selectedCategory;
                const matchesSubcategory = !this.selectedSubcategory || product.subcategory.id === this.selectedSubcategory;
                return matchesCategory && matchesSubcategory;
            });
        },
        filteredSubcategories() {
            if (!this.selectedCategory) {
                return [];
            }

            return this.subcategories.filter(subcategory => subcategory.category_id === this.selectedCategory);
        },
    },
    methods: {
        async fetchProducts() {
            try {
                const response = await fetch('/get-products');
                if (!response.ok) {
                    throw new Error('Network response was not ok.');
                }
                const data = await response.json();
                this.products = data.products;
                this.subcategories = data.subcategories; // Subcategories included in the response
            } catch (error) {
                this.error = 'An error occurred while fetching products: ' + error.message;
            } finally {
                this.loading = false;
            }
        },
        async fetchCategories() {
            try {
                const response = await fetch('/get-categories');
                if (!response.ok) {
                    throw new Error('Network response was not ok.');
                }
                const data = await response.json();
                this.categories = data;
            } catch (error) {
                this.error = 'An error occurred while fetching categories: ' + error.message;
            }
        },
        onCategoryChange() {
            this.selectedSubcategory = ''; // Reset subcategory when category changes
        },
        formatPrice(price) {
            const formatter = new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD',
                minimumFractionDigits: 2,
            });
            return formatter.format(price);
        },
    },
};
</script>

<style scoped>
.table {
    width: 100%;
    border-collapse: collapse;
}

.table th,
.table td {
    border: 1px solid #ddd;
    padding: 8px;
}

.table th {
    background-color: #f2f2f2;
}

.error {
    color: red;
}
</style>
