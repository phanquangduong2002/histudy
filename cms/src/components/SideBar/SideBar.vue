<template>
  <nav class="sidebar">
    <div class="h-full px-4 py-10 overflow-y-auto custom-scrollbar">
      <div class="logo">
        <img src="@/assets/images/logo.jpg" class="max-h-12 object-cover object-center" alt="Logo" />
      </div>
      <ul class="sidebar-list">
        <li class="sidebar-item" :class="{ active: isActive('dashboard') }">
          <router-link :to="{ name: 'dashboard' }">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="20"
              height="20"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <rect x="3" y="3" width="7" height="9" />
              <rect x="14" y="3" width="7" height="5" />
              <rect x="14" y="12" width="7" height="9" />
              <rect x="3" y="16" width="7" height="5" />
            </svg>
            Dashboard
          </router-link>
        </li>
      </ul>
      <div v-if="isInstructor" class="sidebar-title">Data</div>
      <ul class="sidebar-list">
        <li v-if="isInstructor" class="sidebar-item" :class="{ active: isActive('customers') }">
          <router-link :to="{ name: 'customers' }">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="20" height="20" viewBox="0 -64 640 640">
              <path
                d="M96 224c35.3 0 64-28.7 64-64s-28.7-64-64-64-64 28.7-64 64 28.7 64 64 64zm448 0c35.3 0 64-28.7 64-64s-28.7-64-64-64-64 28.7-64 64 28.7 64 64 64zm32 32h-64c-17.6 0-33.5 7.1-45.1 18.6 40.3 22.1 68.9 62 75.1 109.4h66c17.7 0 32-14.3 32-32v-32c0-35.3-28.7-64-64-64zm-256 0c61.9 0 112-50.1 112-112S381.9 32 320 32 208 82.1 208 144s50.1 112 112 112zm76.8 32h-8.3c-20.8 10-43.9 16-68.5 16s-47.6-6-68.5-16h-8.3C179.6 288 128 339.6 128 403.2V432c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48v-28.8c0-63.6-51.6-115.2-115.2-115.2zm-223.7-13.4C161.5 263.1 145.6 256 128 256H64c-35.3 0-64 28.7-64 64v32c0 17.7 14.3 32 32 32h65.9c6.3-47.4 34.9-87.3 75.2-109.4z"
              />
            </svg>
            Customers
          </router-link>
        </li>
        <li v-if="isInstructor" class="sidebar-item" :class="{ active: isActive('invoices') }">
          <router-link :to="{ name: 'invoices' }">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 1024 1024">
              <path
                d="M829.06 73.14h-6.48c-30.41 0-58.57 17.11-75.34 45.75-6.14 10.41-22.29 11.71-29.96 2.43-25.52-31.07-59.41-48.18-95.64-48.18-35.98 0-69.86 17.11-95.41 48.18-6.98 8.48-21.25 8.54-28.27-0.02-25.55-31.05-59.43-48.16-95.41-48.16s-69.86 17.11-95.41 48.18c-7.66 9.38-23.79 8.09-29.95-2.43-16.8-28.64-44.96-45.75-75.36-45.75h-7.23c-46.89 0-85.05 38.16-85.05 85.05V865.8c0 46.89 38.16 85.05 85.05 85.05h7.23c30.39 0 58.55-17.11 75.38-45.79 6.07-10.43 22.21-11.79 29.93-2.38 25.55 31.05 59.43 48.16 95.41 48.16s69.86-17.11 95.41-48.18c7.02-8.52 21.29-8.5 28.27 0.02 25.55 31.05 59.43 48.16 95.66 48.16 35.98 0 69.88-17.11 95.38-48.14 7.77-9.36 23.89-8 29.96 2.36 16.79 28.68 44.95 45.79 75.36 45.79h6.48c46.89 0 85.05-38.16 85.05-85.05V158.2c0-46.9-38.17-85.06-85.06-85.06z m11.91 792.66c0 6.57-5.34 11.91-11.91 11.91h-6.48c-6.14 0-10.91-7.34-12.23-9.61-16.36-27.91-46.61-45.25-78.93-45.25-27.43 0-53.16 12.16-70.64 33.39-6.59 8.02-20.41 21.46-39.14 21.46-18.48 0-32.32-13.46-38.91-21.46-34.84-42.45-106.39-42.46-141.27-0.02-6.59 8.02-20.43 21.48-38.91 21.48s-32.32-13.46-38.91-21.46c-17.43-21.23-43.18-33.39-70.62-33.39-32.36 0-62.61 17.36-78.93 45.25-1.32 2.25-6.11 9.61-12.25 9.61h-7.23c-6.57 0-11.91-5.34-11.91-11.91V158.2c0-6.57 5.34-11.91 11.91-11.91h7.23c6.14 0 10.93 7.36 12.23 9.57 16.34 27.93 46.59 45.29 78.95 45.29 27.45 0 53.2-12.16 70.62-33.38 6.59-8.02 20.43-21.48 38.91-21.48s32.32 13.46 38.91 21.46c34.88 42.48 106.43 42.43 141.27 0.02 6.59-8.02 20.43-21.48 39.16-21.48 18.48 0 32.3 13.45 38.91 21.5 17.46 21.2 43.2 33.36 70.62 33.36 32.32 0 62.57-17.34 78.95-45.29 1.3-2.23 6.07-9.57 12.21-9.57h6.48c6.57 0 11.91 5.34 11.91 11.91v707.6z"
                fill="currentColor"
              />
              <path
                d="M255.93 438.95h365.71v73.14H255.93zM255.92 292.67h511.82v73.14H255.92zM767.83 658.36v-73.15H584.97v182.86h73.15v-58l83.85 83.86 51.72-51.72-83.86-83.85z"
                fill="currentColor"
              />
            </svg>
            Invoices
          </router-link>
        </li>
      </ul>
      <div v-if="isInstructor" class="sidebar-title">Content</div>
      <ul class="sidebar-list">
        <li v-if="isInstructor" class="sidebar-item" :class="{ active: isActive('courses') }">
          <router-link :to="{ name: 'courses' }">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="20" height="20" viewBox="0 0 1920 1920">
              <path
                d="M1801.441 0v1920H219.03v-439.216h-56.514c-31.196 0-56.515-25.299-56.515-56.47 0-31.172 25.319-56.47 56.515-56.47h56.514V1029.02h-56.514c-31.196 0-56.515-25.3-56.515-56.471 0-31.172 25.319-56.47 56.515-56.47h56.514V577.254h-56.514c-31.196 0-56.515-25.299-56.515-56.47 0-31.172 25.319-56.471 56.515-56.471h56.514V0h1582.412Zm-521.714 1389.706H640.288v112.94h639.439v-112.94Zm109.172-214.83H640.288v112.94h748.611v-112.94Zm-109.172-534.845H640.288v112.94h639.439v-112.94Zm109.172-214.83H640.288v112.94h748.611v-112.94Z"
                fill-rule="evenodd"
              />
            </svg>
            Courses
          </router-link>
        </li>
        <li v-if="isInstructor" class="sidebar-item" :class="{ active: isActive('create-course') }">
          <router-link :to="{ name: 'create-course' }">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="20" height="20" viewBox="0 0 24 24">
              <path
                d="M17 10.5V7C17 6.73478 16.8946 6.48043 16.7071 6.29289C16.5196 6.10536 16.2652 6 16 6H4C3.73478 6 3.48043 6.10536 3.29289 6.29289C3.10536 6.48043 3 6.73478 3 7V17C3 17.2652 3.10536 17.5196 3.29289 17.7071C3.48043 17.8946 3.73478 18 4 18H16C16.2652 18 16.5196 17.8946 16.7071 17.7071C16.8946 17.5196 17 17.2652 17 17V13.5L21 17.5V6.5L17 10.5ZM8 15V9L12.5 12L8 15Z"
              />
            </svg>
            Create Course
          </router-link>
        </li>
      </ul>
      <div class="sidebar-title">Customization</div>
      <ul class="sidebar-list">
        <li v-if="isAdmin" class="sidebar-item" :class="{ active: isActive('categories') }">
          <router-link :to="{ name: 'categories' }">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="20" height="20" viewBox="0 0 32 32" version="1.1">
              <path
                d="M0 26.016v-20q0-2.496 1.76-4.256t4.256-1.76h20q2.464 0 4.224 1.76t1.76 4.256v20q0 2.496-1.76 4.224t-4.224 1.76h-20q-2.496 0-4.256-1.76t-1.76-4.224zM4 26.016q0 0.832 0.576 1.408t1.44 0.576h20q0.8 0 1.408-0.576t0.576-1.408v-20q0-0.832-0.576-1.408t-1.408-0.608h-20q-0.832 0-1.44 0.608t-0.576 1.408v20zM8 24v-4h4v4h-4zM8 18.016v-4h4v4h-4zM8 12v-4h4v4h-4zM14.016 24v-4h9.984v4h-9.984zM14.016 18.016v-4h9.984v4h-9.984zM14.016 12v-4h9.984v4h-9.984z"
              />
            </svg>
            Categories</router-link
          >
        </li>
        <li v-if="isInstructor" class="sidebar-item" :class="{ active: isActive('quiz') }">
          <router-link :to="{ name: 'quiz' }">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="20" height="20" viewBox="0 0 24 24">
              <path
                d="M12,22A10,10,0,1,0,2,12,10,10,0,0,0,12,22Zm0-2a1.5,1.5,0,1,1,1.5-1.5A1.5,1.5,0,0,1,12,20ZM8,8.994a3.907,3.907,0,0,1,2.319-3.645,4.061,4.061,0,0,1,3.889.316,4,4,0,0,1,.294,6.456,3.972,3.972,0,0,0-1.411,2.114,1,1,0,0,1-1.944-.47,5.908,5.908,0,0,1,2.1-3.2,2,2,0,0,0-.146-3.23,2.06,2.06,0,0,0-2.006-.14,1.937,1.937,0,0,0-1.1,1.8A1,1,0,0,1,8,9Z"
              />
            </svg>
            Quiz</router-link
          >
        </li>
        <li v-if="isInstructor" class="sidebar-item" :class="{ active: isActive('certs') }">
          <router-link :to="{ name: 'certs' }">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="20"
              height="20"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <circle cx="12" cy="8" r="7" />
              <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88" />
            </svg>
            Certs</router-link
          >
        </li>
      </ul>
      <div v-if="isAdmin" class="sidebar-title">Controllers</div>
      <ul class="sidebar-list">
        <li v-if="isAdmin" class="sidebar-item" :class="{ active: isActive('users') }">
          <router-link :to="{ name: 'users' }">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
              <path
                d="M7.5,5C5.6,5,4,6.6,4,8.5S5.6,12,7.5,12S11,10.4,11,8.5S9.4,5,7.5,5z M16.5,5C14.6,5,13,6.6,13,8.5s1.6,3.5,3.5,3.5  S20,10.4,20,8.5S18.4,5,16.5,5z M7.5,14C2.6,14,1,18,1,18v2h13v-2C14,18,12.4,14,7.5,14z M16.5,14c-1.5,0-2.7,0.4-3.6,0.9  c1.4,1.2,2,2.6,2.1,2.7l0.1,0.2V20h8v-2C23,18,21.4,14,16.5,14z"
              />
              <rect fill="none" width="20" height="20" />
            </svg>
            Users
          </router-link>
        </li>
        <li v-if="isAdmin" class="sidebar-item" :class="{ active: isActive('roles') }">
          <router-link :to="{ name: 'roles' }">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="20" height="20" viewBox="0 0 52 52">
              <path
                d="M38.3,27.2A11.4,11.4,0,1,0,49.7,38.6,11.46,11.46,0,0,0,38.3,27.2Zm2,12.4a2.39,2.39,0,0,1-.9-.2l-4.3,4.3a1.39,1.39,0,0,1-.9.4,1,1,0,0,1-.9-.4,1.39,1.39,0,0,1,0-1.9l4.3-4.3a2.92,2.92,0,0,1-.2-.9,3.47,3.47,0,0,1,3.4-3.8,2.39,2.39,0,0,1,.9.2c.2,0,.2.2.1.3l-2,1.9a.28.28,0,0,0,0,.5L41.1,37a.38.38,0,0,0,.6,0l1.9-1.9c.1-.1.4-.1.4.1a3.71,3.71,0,0,1,.2.9A3.57,3.57,0,0,1,40.3,39.6Z"
              />
              <circle cx="21.7" cy="14.9" r="12.9" />
              <path
                d="M25.2,49.8c2.2,0,1-1.5,1-1.5h0a15.44,15.44,0,0,1-3.4-9.7,15,15,0,0,1,1.4-6.4.77.77,0,0,1,.2-.3c.7-1.4-.7-1.5-.7-1.5h0a12.1,12.1,0,0,0-1.9-.1A19.69,19.69,0,0,0,2.4,47.1c0,1,.3,2.8,3.4,2.8H24.9C25.1,49.8,25.1,49.8,25.2,49.8Z"
              />
            </svg>
            Roles
          </router-link>
        </li>
        <li v-if="isAdmin" class="sidebar-item" :class="{ active: isActive('permissions') }">
          <router-link :to="{ name: 'permissions' }">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="20" height="20" viewBox="0 0 1920 1920">
              <path
                d="M1600 1066.667c117.653 0 213.333 95.68 213.333 213.333v106.667H1920V1760c0 88.213-71.787 160-160 160h-320c-88.213 0-160-71.787-160-160v-373.333h106.667V1280c0-117.653 95.68-213.333 213.333-213.333ZM800 0c90.667 0 179.2 25.6 254.933 73.6 29.867 18.133 58.667 40.533 84.267 66.133 49.067 49.067 84.8 106.88 108.053 169.814 11.307 30.4 20.8 61.44 25.814 94.08l2.24 14.613 3.626 20.16-.533.32v.213l-52.693 32.427c-44.694 28.907-95.467 61.547-193.067 61.867-.427 0-.747.106-1.173.106-24.534 0-46.08-2.133-65.28-5.653-.64-.107-1.067-.32-1.707-.427-56.32-10.773-93.013-34.24-126.293-55.68-9.6-6.293-18.774-12.16-28.16-17.6-27.947-16-57.92-27.306-108.16-27.306h-.32c-57.814.106-88.747 15.893-121.387 36.266-4.48 2.88-8.853 5.44-13.44 8.427-3.093 2.027-6.72 4.16-9.92 6.187-6.293 4.053-12.693 8.106-19.627 12.16-4.48 2.666-9.493 5.013-14.293 7.573-6.933 3.627-13.973 7.147-21.76 10.453-6.613 2.987-13.76 5.547-21.12 8.107-6.933 2.347-14.507 4.267-22.187 6.293-8.96 2.347-17.813 4.587-27.84 6.187-1.173.213-2.133.533-3.306.747v57.6c0 17.066 1.066 34.133 4.266 50.133C454.4 819.2 611.2 960 800 960c195.2 0 356.267-151.467 371.2-342.4 48-14.933 82.133-37.333 108.8-54.4v23.467c0 165.546-84.373 311.786-212.373 398.08h4.906a1641.19 1641.19 0 0 1 294.08 77.76C1313.28 1119.68 1280 1195.733 1280 1280h-106.667v480c0 1.387.427 2.667.427 4.16-142.933 37.547-272.427 49.173-373.76 49.173-345.493 0-612.053-120.32-774.827-221.333L0 1576.32v-196.373c0-140.054 85.867-263.04 218.667-313.28 100.373-38.08 204.586-64.96 310.186-82.347h4.8C419.52 907.413 339.2 783.787 323.2 640c-2.133-17.067-3.2-35.2-3.2-53.333V480c0-56.533 9.6-109.867 27.733-160C413.867 133.333 592 0 800 0Zm800 1173.333c-58.773 0-106.667 47.894-106.667 106.667v106.667h213.334V1280c0-58.773-47.894-106.667-106.667-106.667Z"
                fill-rule="evenodd"
              />
            </svg>
            Permissions
          </router-link>
        </li>
      </ul>
      <div v-if="isInstructor" class="sidebar-title">Analytics</div>
      <ul class="sidebar-list">
        <li v-if="isInstructor" class="sidebar-item" :class="{ active: isActive('course-analytics') }">
          <router-link :to="{ name: 'course-analytics' }">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
              <path
                d="M7,12v9a1,1,0,0,1-1,1H3a1,1,0,0,1-1-1V12a1,1,0,0,1,1-1H6A1,1,0,0,1,7,12ZM21,6H18a1,1,0,0,0-1,1V21a1,1,0,0,0,1,1h3a1,1,0,0,0,1-1V7A1,1,0,0,0,21,6ZM13.5,2h-3a1,1,0,0,0-1,1V21a1,1,0,0,0,1,1h3a1,1,0,0,0,1-1V3A1,1,0,0,0,13.5,2Z"
                fill="currentColor"
              />
            </svg>
            Course Analytics
          </router-link>
        </li>
      </ul>
    </div>
  </nav>
</template>

<script>
import { defineComponent, computed } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { useUserStore } from '@/stores'
export default defineComponent({
  setup() {
    const route = useRoute()
    const router = useRouter()

    const userStore = useUserStore()

    const isActive = name => {
      return route.name === name
    }

    const isInstructor = computed(() => {
      return userStore.user?.roles.includes('instructor')
    })

    const isAdmin = computed(() => {
      return userStore.user?.roles.includes('admin')
    })

    return {
      userStore,
      isActive,
      isInstructor,
      isAdmin
    }
  }
})
</script>

<style scoped>
.sidebar {
  @apply fixed top-0 left-0 bottom-0 w-60 text-whiteColor bg-thirtyColor;
}

.logo {
  @apply mb-8;
}

.sidebar-title {
  @apply my-4 text-lg font-bold;
}

.sidebar-list {
  @apply flex flex-col gap-1;
}

.sidebar-item a {
  @apply rounded-md px-3 py-[6px] flex items-center justify-start;
}

.sidebar-item.active a {
  @apply bg-primaryOpacityColor;
}

.sidebar-item a:hover {
  @apply bg-primaryOpacityColor;
}

.sidebar-item svg {
  margin-right: 8px;
  width: 20px;
  height: 20px;
}
</style>
