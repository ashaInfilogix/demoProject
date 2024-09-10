<template>
  <div>
    <Filter
      :categories="categories"
      :subcategories="subcategories"
      @filter="updateFilter"
    />
    <ProductSection :products="filteredProducts" />
  </div>
</template>

<script>
import Filter from './Filter.vue';
import ProductSection from './ProductSection.vue';

export default {
  components: {
    Filter,
    ProductSection
  },
  data() {
    return {
      categories: [],
      subcategories: [],
      products: [],
      filteredProducts: []
    };
  },
  created() {
    this.fetchData();
  },
  methods: {
    async fetchData() {
      try {
        const response = await fetch('/product-data');
        const data = await response.json();
        this.categories = data.categories;
        this.subcategories = data.subcategories;
        this.products = data.products;
        this.filteredProducts = data.products;
      } catch (error) {
        console.error('Error fetching data:', error);
      }
    },
    updateFilter(selectedFilters) {
      this.filteredProducts = this.products.filter(product => {
        const categoryMatch = selectedFilters.categories.length === 0 || selectedFilters.categories.includes(product.category_id);
        const subcategoryMatch = selectedFilters.subcategories.length === 0 || selectedFilters.subcategories.includes(product.subcategory_id);
        return categoryMatch && subcategoryMatch;
      });
    }
  }
}
</script>
