<template>
  <div>
    <h2>Filter</h2>
    
    <div>
      <h3>Categories</h3>
      <div v-for="category in categories" :key="category.id">
        <label>
          <input
            type="checkbox"
            :value="category.id"
            v-model="selectedCategories"
          />
          {{ category.name }}
        </label>
      </div>
    </div>

    <div>
      <h3>Subcategories</h3>
      <div v-for="subcategory in subcategories" :key="subcategory.id">
        <label>
          <input
            type="checkbox"
            :value="subcategory.id"
            v-model="selectedSubcategories"
          />
          {{ subcategory.name }}
        </label>
      </div>
    </div>

    <button @click="applyFilters">Apply Filters</button>
  </div>
</template>

<script>
export default {
  props: ['categories', 'subcategories'],
  data() {
    return {
      selectedCategories: [],
      selectedSubcategories: []
    };
  },
  methods: {
    applyFilters() {
      this.$emit('filter', {
        categories: this.selectedCategories,
        subcategories: this.selectedSubcategories
      });
    }
  }
}
</script>

<style scoped>
/* Basic styling for checkboxes and labels */
label {
  display: block;
  margin-bottom: 5px;
}
</style>
