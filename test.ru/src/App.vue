<template>
    <div id="app">
        <PostPage class="post" />
    </div>
</template>

<script>
import { mapActions } from 'vuex';
import PostPage from './components/post/pages/PostPage.vue';

export default {
    name: 'App',
    components: {
        PostPage,
    },
    async mounted() {

        await this.getComments();
        await this.getCapcha();

    },
    methods: {
        ...mapActions([
            'getComments',
            'getCapcha'
        ]),
    }
}
</script>

<style>
#app {
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
}

body {
    margin: 0;
}
</style>
