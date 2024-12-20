import { createApp } from 'vue'
import App from '@/App.vue'
import '@/style.css'
import 'animate.css'

import { createPinia } from 'pinia'
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate'

import router from '@/routes'

import VueVideoPlayer from '@videojs-player/vue'
import 'video.js/dist/video-js.css'

import '@/configs/firebaseConfig'

const pinia = createPinia()
pinia.use(piniaPluginPersistedstate)

const app = createApp(App)

app.use(router)
app.use(pinia)
app.use(VueVideoPlayer)

app.mount('#app')
