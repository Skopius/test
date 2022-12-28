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
            <div class="comment__remove" data-id="{{ data.id }}">Удалить комментарий</div>
            <div class="comment__date">{{ Date(data.postdate) }}</div>
        </div>
    </div>
  </section>
</template>

export default {
  name: 'CommentList',
  props: {
    data: {
      type: Object,
      default: true,
    },
  },
}