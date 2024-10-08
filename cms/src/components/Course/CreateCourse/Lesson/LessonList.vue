<template>
  <div v-if="lessons.length > 0">
    <draggable v-model="lessons" ghost-class="ghost" @start="drag = true" @end="onDragEnd" @change="onChange" itemKey="id">
      <template #item="{ element: lesson }">
        <div
          class="px-3 py-3 flex items-center justify-between gap-x-3 border text-headingColor rounded-md mb-3 text-sm cursor-pointer"
          :class="{
            'bg-slate-200 border-slate-300': !lesson.is_published,
            'bg-primaryOpacityColor border-primaryColor text-primaryColor': lesson.is_published
          }"
        >
          <div class="flex items-center gap-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none">
              <path d="M3.5 3.5H10.5V10.5H3.5V3.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M3.5 13.5H10.5V20.5H3.5V13.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M13.5 3.5H20.5V10.5H13.5V3.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M13.5 13.5H20.5V20.5H13.5V13.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <span class="line-clamp-1">{{ lesson.title }}</span>
          </div>
          <div class="flex items-center gap-x-2">
            <div v-if="lesson.is_free" class="px-3 py-1 rounded-full bg-primaryColor text-whiteColor text-xs leading-none">Free</div>
            <div class="px-3 py-1 rounded-full text-whiteColor text-xs leading-none" :class="lesson.is_published ? 'bg-primaryColor' : 'bg-slate-500'">
              {{ lesson.is_published ? 'Published' : 'Draft' }}
            </div>
            <button @click.prevent="onEditLesson(chapterId, lesson.id)" class="px-2 py-1 hover:opacity-75">
              <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="18" height="18" viewBox="0 0 24 24">
                <path
                  d="M17.764,2A4.2,4.2,0,0,0,14.77,3.241L3.155,14.855a1,1,0,0,0-.28.55l-.863,5.438a1,1,0,0,0,1.145,1.145L8.6,21.125a1,1,0,0,0,.55-.28L20.759,9.23a4.236,4.236,0,0,0-3-7.23ZM7.96,19.2,4.2,19.8l.6-3.757,8.39-8.391,3.162,3.162ZM19.345,7.816,17.765,9.4,14.6,6.235l1.581-1.58a2.289,2.289,0,0,1,3.161,0,2.234,2.234,0,0,1,0,3.161Z"
                />
              </svg>
            </button>
          </div>
        </div>
      </template>
    </draggable>
  </div>
</template>

<script>
import { defineComponent, ref, watch } from 'vue'
import draggable from 'vuedraggable'

export default defineComponent({
  components: { draggable },
  props: {
    chapterId: Number,
    lessons: Array,
    onEditLesson: Function,
    onReorderLesson: Function
  },
  setup(props) {
    const lessons = ref(props.lessons)
    const bulkUpdateData = ref([])
    const isMounted = ref(false)

    const onChange = event => {
      if (event.moved) {
        const { newIndex, oldIndex, element } = event.moved

        if (newIndex === oldIndex) {
          isMounted.value = false
          return
        }

        isMounted.value = true

        const startIndex = Math.min(oldIndex, newIndex)
        const endIndex = Math.max(oldIndex, newIndex)

        const updatedLessons = lessons.value.slice(startIndex, endIndex + 1)

        bulkUpdateData.value = updatedLessons.map(lesson => ({
          id: lesson.id,
          position: lessons.value.findIndex(item => item.id === lesson.id) + 1
        }))
      }
    }

    const onDragEnd = () => {
      if (!isMounted.value || bulkUpdateData.value.length === 0) return

      props.onReorderLesson(props.chapterId, bulkUpdateData.value)
      isMounted.value = false
    }

    return {
      lessons,
      bulkUpdateData,
      onChange,
      onDragEnd
    }
  }
})
</script>

<style></style>
