<template>
  <div>
    <div class="mt-4 md:mt-8 p-4 md:p-6 bg-whiteColor shadow-shadow01 rounded-md overflow-hidden">
      <h4 class="text-xl text-headingColor font-extrabold pb-4 mb-5 border-b-[1px] border-borderColor">Review</h4>
      <div class="grid grid-cols-12 gap-x-8">
        <div class="col-span-12 md:col-span-3 mt-8">
          <div class="p-4 pb-6 flex flex-col items-center justify-center bg-warningOpacityColor">
            <div class="text-center text-6xl font-black text-headingColor">{{ formatAvgStar }}</div>
            <div class="mt-2 mb-1 flex items-center justify-center gap-1">
              <StarRating :averageStar="averageStar" :size="16" />
            </div>
            <span class="text-warningColor text-base font-bold">Course Rating</span>
          </div>
        </div>
        <div class="col-span-12 md:col-span-9 mt-8">
          <div class="flex flex-col gap-2">
            <div v-for="(r, index) in starPercentages" :key="index" class="flex flex-wrap items-center justify-start">
              <StarRating :averageStar="r.rating" :size="16" class="w-full sm:w-auto" />
              <div class="flex-1 flex items-center">
                <div class="ml-0 sm:ml-4 lg:ml-8 mr-3 w-[75%] sm:w-auto sm:flex-1 bg-progressColor h-[6px]">
                  <div class="h-full bg-warningColor" :style="{ width: `${r.percent}%` }"></div>
                </div>
                <span class="font-semibold">{{ r.percent }}%</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="mt-8 p-7 bg-whiteColor shadow-shadow01 rounded-md overflow-hidden">
      <h4 class="text-xl text-headingColor font-extrabold pb-4 mb-5 border-b-[1px] border-borderColor">Featured review</h4>
      <div v-if="reviews?.length > 0">
        <div
          v-for="(review, index) in reviews"
          :key="review.id"
          :class="{ 'py-6': true, 'border-b-[1px]': index < reviews.length - 1, 'border-borderColor': index < reviews.length - 1 }"
        >
          <ReviewCard :review="review" />
        </div>
      </div>
      <div v-else class="italic">No reviews yet</div>
    </div>
  </div>
</template>

<script>
import { defineComponent, ref, computed } from 'vue'
import { formatNumber } from '@/utils'

import StarRating from '@/components/StarRating/StarRating.vue'
import ReviewCard from '@/components/Review/ReviewCard.vue'
import Pagination from '@/components/Pagination/Pagination.vue'

export default defineComponent({
  components: { StarRating, ReviewCard, Pagination },
  props: {
    average_star: Number,
    review_count: Number,
    reviews: Array
  },
  setup(props) {
    const averageStar = ref(props.average_star || 5)
    const reviewCount = ref(props.review_count || 0)

    const formatAvgStar = computed(() => formatNumber(averageStar.value, 1))

    const starPercentages = computed(() => {
      const totalReviews = reviewCount.value
      if (totalReviews === 0) return []

      const starCounts = {
        5: props.reviews.filter(review => review.rating === 5).length,
        4: props.reviews.filter(review => review.rating === 4).length,
        3: props.reviews.filter(review => review.rating === 3).length,
        2: props.reviews.filter(review => review.rating === 2).length,
        1: props.reviews.filter(review => review.rating === 1).length
      }

      const percentages = [5, 4, 3, 2, 1].map(star => ({
        rating: star,
        percent: Math.round((starCounts[star] / totalReviews) * 100)
      }))

      return percentages
    })

    return { averageStar, reviewCount, formatAvgStar, starPercentages }
  }
})
</script>

<style></style>
