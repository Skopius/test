<template>
  <section>
    <div class="comment">
      <div class="comment__content">
        <div class="comment__username">{{ data.username }}</div>
        <div class="comment__text">
          {{ data.message }}
        </div>
      </div>
      <div class="comment__additional-content">
        <div class="comment__remove" @click="deleteComment(data.id)">
          Удалить комментарий
        </div>
        <div class="comment__date">{{ getDate }}</div>
      </div>
    </div>
  </section>
</template>

<script>
import { mapActions } from 'vuex';

export default {
  name: 'CommentList',
  props: {
    data: {
      type: Object,
      default: true,
    },
  },
  computed: {
    getDate() {
      const date = new Date(this.data.postdate * 1000);
      return date.getDate() +
        '.' +
        (date.getMonth() + 1) +
        '.' +
        date.getFullYear() +
        ' ' +
        ("0" + date.getHours()).slice(-2) +
        ':' +
        ("0" + date.getMinutes()).slice(-2)
    }
  },
  methods: {
    ...mapActions([
      'deleteComment'
    ]),
  },
}
</script>

<style scoped>
.comment {
  display: flex;
  justify-content: space-between;
  border: 2px solid #ccc;
  border-radius: 5px;
  padding: 10px;
  margin-bottom: 5px;
}

.comment__content {
  flex: 2;
  margin: 0 10px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.comment__username {
  margin-bottom: 15px;
}

.comment__remove {
  margin-bottom: 15px;
  text-decoration: underline;
  cursor: pointer;
}

.comment__remove:hover {
  text-decoration: none;
}

.comment__additional-content {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}
</style>