<template>
    <div id="app">
        <PostPage :data="comments" />
    </div>
</template>

<script>
import axios from 'axios';
import PostPage from './components/post/pages/PostPage.vue';

export default {
    name: 'App',
    components: {
        PostPage,
    },
    data: () => ({
        comments: [],
    }),
    // beforeMount: async () => {
    //     await this.getComments();

    // },
    methods: {
        async getComments() {
            const { data } = await axios.get(
                'http://localhost:80/ajax/getComments.php'
            )
            this.comments = data;
            await this.$nextTick();
        }
    }
}
</script>

<style>
#app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
    margin-top: 60px;
}
</style>
