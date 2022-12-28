<template>
    <section>
        <div class="comment-block">
            <div class="container">
                <div class="content">
                    <img :src="PostImage" alt="Изображение" />
                </div>
                <div class="comments" v-for="(comment, commentIndex) in comments" :key="commentIndex">
                    <CommentList :data="comment" />
                </div>
                <div class="form">
                    <form class="comment-form">

                        <div class="row">
                            <div class="col">

                                <div>Ваше имя</div>
                                <input type="text" name="name" class="comment-form__input" v-bind:value="form.username"
                                    v-on:input="SET_FORM_FIELD({ field: 'username', value: $event.target.value })" />

                            </div>

                            <div class="col">

                                <div>Ваше сообщение</div>
                                <textarea name="message" v-bind:value="form.message"
                                    v-on:input="SET_FORM_FIELD({ field: 'message', value: $event.target.value })">
                                </textarea>

                            </div>


                            <div class="col">

                                <div class="capcha">
                                    <div class="capha__image">
                                        <img class="capcha__image_item" :src="`data:image/png;base64,${capcha}`"
                                            width="210px" alt="Капча">
                                        <div class="capcha__reload" @click="getCapcha"></div>
                                    </div>
                                    <input type="text" name="capcha" class="capcha__input" v-bind:value="form.capcha"
                                        v-on:input="SET_FORM_FIELD({ field: 'capcha', value: $event.target.value })">
                                </div>


                            </div>

                            <div class="col align-self-center">
                                <div class="comment-form__submit" @click="sendForm">Отправить</div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col">
                                <div class="error"></div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
</template>

<script>

// todo переименовать в comment
import { mapState, mapMutations, mapActions } from 'vuex';
import CommentList from '../components/CommentList.vue';
import PostImage from '../../../assets/img/Koala.jpg';

export default {
    name: 'PostPage',
    components: {
        CommentList,
    },
    data: () => ({
        PostImage,
    }),
    computed: {
        ...mapState([
            'comments',
            'capcha',
            'form',
        ]),
    },
    methods: {
        ...mapActions([
            'sendForm',
            'getCapcha',
        ]),
        ...mapMutations([
            'SET_FORM_FIELD',
        ]),
    },
}

</script>

<style scoped>
* {
    margin: 0;
    padding: 0;
}

img {
    width: 100%;
}

.container {
    width: 700px;
    max-width: 100%;
    display: flex;
    flex-direction: column;
    border: 3px solid rgb(61, 163, 241);
    border-top: none;
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
}

.comments {
    margin: 0 5px;
}



.comment-form {
    margin: 20px 0;
    padding: 0 20px;
}

.row {
    display: flex;
    width: 100%;
    margin-bottom: 10px;
    flex-wrap: wrap;
}

.col {
    display: flex;
    flex-direction: column;
    width: 45%;
    padding: 0 15px;
}

.align-self-center {
    align-self: center;
}

.comment-form input,
.comment-form textarea {
    border: 1px solid #ccc;
    border-radius: 5px;
    color: rgba(0, 0, 0, .8);
    padding: 5px 10px;
    margin-bottom: 10px;
    height: 100%;
}

.comment-form textarea {
    resize: none;
}

.comment-form__submit {
    width: 100%;
    max-width: 100%;
    height: 30px;
    background: rgb(241, 230, 107);
    border: none;
    cursor: pointer;
    transition: all .3s;
    border: 1px solid #ccc;
    border-radius: 10px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.comment-form__submit:hover {
    opacity: .6;
}

.capcha {
    display: flex;
    margin-bottom: 10px;
}

.capha__image {
    position: relative;
}

.capcha .capcha__image_item {
    width: 150px;
    height: 100%;
    margin-right: 10px;

}

.capcha .capcha__input {
    width: 100%;
    height: 35px;
    margin-bottom: 0;
}

.capcha__reload {
    position: absolute;
    background: url(../../../assets/img/refresh.png);
    background-size: contain;
    width: 20px;
    height: 20px;
    top: 5px;
    right: 15px;
}

.comment-block {
    width: 100%;
    display: flex;
    justify-content: center;
}

@media screen and (max-width: 570px) {
    .col {
        width: 100%;
    }

    .col:first-child {
        padding: 0;
    }

    .comment-form textarea {
        margin-bottom: 10px;
    }
}
</style>