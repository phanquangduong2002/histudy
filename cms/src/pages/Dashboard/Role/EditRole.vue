<template>
  <div class="pt-10 pb-40">
    <div v-if="loading" class="min-h-[60vh] flex items-center justify-center text-primaryColor">
      <LoadingV1 />
    </div>

    <div v-if="!loading">
      <div class="mb-6 pb-5 flex items-end justify-between border-b-[1px] border-borderColor">
        <h4 class="text-xl text-headingColor font-extrabold">Roles</h4>
      </div>
      <router-link :to="{ name: 'roles' }"
        ><div
          class="inline-flex items-center gap-2 text-bodyColor relative transition-all duration-300 hover:text-primaryColor after:absolute after:content after:bottom-0 after:left-auto after:right-0 after:w-0 after:h-[1.5px] after:bg-primaryColor hover:after:left-0 hover:after:right-auto hover:after:w-full after:transition-all after:duration-300"
        >
          <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="16" height="16" viewBox="0 0 52 52" enable-background="new 0 0 52 52">
            <path
              d="M48.6,23H15.4c-0.9,0-1.3-1.1-0.7-1.7l9.6-9.6c0.6-0.6,0.6-1.5,0-2.1l-2.2-2.2c-0.6-0.6-1.5-0.6-2.1,0  L2.5,25c-0.6,0.6-0.6,1.5,0,2.1L20,44.6c0.6,0.6,1.5,0.6,2.1,0l2.1-2.1c0.6-0.6,0.6-1.5,0-2.1l-9.6-9.6C14,30.1,14.4,29,15.3,29  h33.2c0.8,0,1.5-0.6,1.5-1.4v-3C50,23.8,49.4,23,48.6,23z"
            />
          </svg>
          Back to role list
        </div></router-link
      >
      <div class="mt-4 mb-8">
        <h5 class="text-lg text-headingColor font-bold">Edit Role</h5>
        <form @submit.prevent="onSubmit" class="space-y-4 mt-4 w-full">
          <div class="input-group">
            <input type="text" v-model="name" placeholder="" />
          </div>
          <div v-if="errors?.name && errors?.name.length > 0">
            <p v-for="(err, index) in errors?.name" :key="index" class="mt-2 text-dangerColor">{{ err }}</p>
          </div>
          <div class="mt-4 text-headingColor font-bold">Choose Permissions:</div>
          <div class="grid grid-cols-12 mt-2 mb-6 gap-2">
            <div v-for="(permission, index) in permissions" :key="index" class="col-span-3 flex items-center">
              <div class="checkbox-wrapper">
                <input
                  type="checkbox"
                  :id="'cbx' + permission.id"
                  @change="togglePermission(permission.id)"
                  :checked="isChecked(permission.id)"
                  class="inp-cbx"
                />
                <label :for="'cbx' + permission.id" class="cbx">
                  <span>
                    <svg viewBox="0 0 12 10" height="10" width="12">
                      <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                    </svg>
                  </span>
                  <span>{{ permission.name }}</span>
                </label>
              </div>
            </div>
          </div>
          <div class="mt-4 flex items-center gap-x-2">
            <button
              :disabled="isSubmitting"
              type="submit"
              class="px-4 py-2 text-whiteColor bg-blackColor rounded-md"
              :class="isSubmitting && 'opacity-75 cursor-no-drop'"
            >
              Update
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent, onMounted, ref, watch } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import { useHomeStore, useUserStore } from '@/stores'
import { getRole, getAllPermission, updateRole } from '@/webServices/permissionService'

import LoadingV1 from '@/components/Loading/LoadingV1.vue'

export default defineComponent({
  components: { LoadingV1 },
  setup() {
    const route = useRoute()
    const router = useRouter()
    const homeStore = useHomeStore()
    const userStore = useUserStore()

    const permissions = ref([])
    const id = ref(route.params.id)
    const chossePerms = ref([])
    const name = ref(null)
    const errors = ref(null)
    const loading = ref(false)
    const isSubmitting = ref(false)

    const togglePermission = id => {
      const index = chossePerms.value.indexOf(id)

      if (index === -1) {
        chossePerms.value.push(id)
      } else {
        chossePerms.value.splice(index, 1)
      }
    }

    const isChecked = id => {
      return chossePerms.value.some(permission => permission === id)
    }

    const onSubmit = async () => {
      isSubmitting.value = true
      errors.value = null

      const res = await updateRole(id.value, { name: name.value, permissions: chossePerms.value })

      if (!res.success) {
        errors.value = res.data.errors
        isSubmitting.value = false
      }

      if (res.success) {
        homeStore.onChangeToast({ show: true, type: 'success', message: 'Role updated Successfully !' })
        router.push({ name: 'roles' })
      }
    }

    const checkUserRole = async () => {
      if (!userStore.user?.roles.includes('admin')) {
        router.push({ name: 'dashboard' })
        return false
      }
      return true
    }

    const fetchData = async () => {
      loading.value = true

      const [roleData, permissionData] = await Promise.all([getRole(id.value), getAllPermission()])

      if (!roleData.success) {
        router.push({ name: 'roles' })
      }

      if (roleData.success) {
        name.value = roleData.role.name
        roleData.role.permissions.forEach(permission => {
          chossePerms.value.push(permission.id)
        })
      }

      if (permissionData.success) permissions.value = permissionData.permissions

      loading.value = false
    }

    watch(
      () => route.params.id,
      newId => {
        id.value = newId
        fetchData()
      }
    )

    onMounted(async () => {
      const hasRole = await checkUserRole()
      if (hasRole) {
        await fetchData()
      }
    })
    return {
      homeStore,
      loading,
      permissions,
      chossePerms,
      id,
      name,
      errors,
      isSubmitting,
      isChecked,
      onSubmit,
      togglePermission
    }
  },
  methods: {
    scrollToTop() {
      window.scrollTo({ top: 0 })
    }
  },
  created() {
    this.scrollToTop()
  }
})
</script>

<style scoped>
.input-group > input {
  width: 50%;
  border-radius: 0.375rem;
  border: 1.5px solid;
  outline: 0;
  padding: 0.5rem 1rem;
  @apply text-headingColor bg-whiteColor border-borderColor;
}

.input-group > input:focus {
  @apply border-primaryColor;
}

.checkbox-wrapper input[type='checkbox'] {
  display: none;
  visibility: hidden;
}

.checkbox-wrapper .cbx {
  margin: auto;
  -webkit-user-select: none;
  user-select: none;
  cursor: pointer;
}
.checkbox-wrapper .cbx span {
  display: inline-block;
  vertical-align: middle;
  transform: translate3d(0, 0, 0);
}
.checkbox-wrapper .cbx span:first-child {
  position: relative;
  width: 18px;
  height: 18px;
  border-radius: 3px;
  transform: scale(1);
  vertical-align: middle;
  border: 1px solid #9098a9;
  transition: all 0.2s ease;
}
.checkbox-wrapper .cbx span:first-child svg {
  position: absolute;
  top: 3px;
  left: 2px;
  fill: none;
  stroke: #ffffff;
  stroke-width: 2;
  stroke-linecap: round;
  stroke-linejoin: round;
  stroke-dasharray: 16px;
  stroke-dashoffset: 16px;
  transition: all 0.3s ease;
  transition-delay: 0.1s;
  transform: translate3d(0, 0, 0);
}
/* .checkbox-wrapper .cbx span:first-child:before {
    content: '';
    width: 100%;
    height: 100%;
    background: #506eec;
    display: block;
    transform: scale(0);
    opacity: 1;
    border-radius: 50%;
  } */

.checkbox-wrapper .cbx span:last-child {
  padding-left: 8px;
}
.checkbox-wrapper .cbx:hover span:first-child {
  border-color: #506eec;
}

.checkbox-wrapper .inp-cbx:checked + .cbx span:first-child {
  background: #506eec;
  border-color: #506eec;
  animation: wave-46 0.4s ease;
}
.checkbox-wrapper .inp-cbx:checked + .cbx span:first-child svg {
  stroke-dashoffset: 0;
}
.checkbox-wrapper .inp-cbx:checked + .cbx span:first-child:before {
  transform: scale(3.5);
  opacity: 0;
  transition: all 0.6s ease;
}

@keyframes wave {
  50% {
    transform: scale(0.9);
  }
}
</style>
