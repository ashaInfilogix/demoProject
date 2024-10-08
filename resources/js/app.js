import './bootstrap';
import { createApp, ref } from 'vue';
import UserProfile from './components/UserProfile.vue';
import ProductList from './components/ProductList.vue';
import Main from './components/Main.vue';

const app = createApp({
    components: {
        UserProfile
    },
    setup() {
        const showUserProfile = ref(false);

        function toggleUserProfile() {
            showUserProfile.value = !showUserProfile.value;
        }

        return { showUserProfile, toggleUserProfile };
    }
});

app.component('product-list', ProductList);
app.component('main-component', Main);


app.mount('#app');
