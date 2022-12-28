<template>
    <section>
        <div class="comment-block">
            <div class="container">
                <div class="content">
                    <img src="assets/img/Koala.jpg" alt="Изображение" />
                </div>
                <div class="comments" v-for="(comment, commentIndex) in data" :key="commentIndex">
                    <CommentList :data="comment" />
                </div>
                <div class="form">
                    <form class="comment-form">

                        <div class="row">
                            <div class="col">

                                <div>Ваше имя</div>
                                <input type="text" name="name" class="comment-form__input" />

                            </div>

                            <div class="col">

                                <div>Ваше сообщение</div>
                                <textarea name="message"></textarea>

                            </div>


                            <div class="col">

                                <div class="capcha">
                                    <div class="capha__image">
                                        <img class="capcha__image_item" src="capcha.php" width="210px" alt="Капча">
                                        <div class="capcha__reload"></div>
                                    </div>
                                    <input type="text" name="capcha" class="capcha__input">
                                </div>


                            </div>

                            <div class="col align-self-end">
                                <input type="submit" value="Отправить" />
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

// todo переименовать в comment
import CommentList from '../commponents/CommentList.vue';

export default {
  name: 'PostPage',
  components: {
    CommentList,
  }
  props: {
    data: {
      type: Array,
      default: true,
    },
  }, 
}