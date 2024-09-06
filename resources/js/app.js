import './bootstrap';
import { createApp, ref } from 'vue';
import ExampleComponent from './components/ExampleComponent.vue';
import UserProfile from './components/UserProfile.vue';

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

app.component('example-component', ExampleComponent);

app.mount('#app');
