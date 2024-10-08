import api from '@/configs/endpoints'
import connectServer from '@/configs/connectServer'

export const registerUser = dataPost => {
  return connectServer[api.REGISTER_USER_API.method](api.REGISTER_USER_API.url, dataPost)
}

export const loginUser = dataPost => {
  return connectServer[api.LOGIN_USER_API.method](api.LOGIN_USER_API.url, dataPost)
}

export const loginWithGoogle = dataPost => {
  return connectServer[api.LOGIN_GOOGLE_API.method](api.LOGIN_GOOGLE_API.url, dataPost)
}

export const refreshToken = dataPost => {
  return connectServer[api.REFRESH_TOKEN_API.method](api.REFRESH_TOKEN_API.url, dataPost)
}

export const getUserProfile = dataPost => {
  return connectServer[api.GET_USER_PROFILE_API.method](api.GET_USER_PROFILE_API.url, dataPost)
}

export const updateProfile = dataPost => {
  return connectServer[api.UPDATE_PROFILE_API.method](api.UPDATE_PROFILE_API.url, dataPost)
}

export const updateAvatar = dataPost => {
  const config = {
    headers: {
      'Content-Type': 'multipart/form-data'
    }
  }
  return connectServer[api.UPDATE_AVATAR_API.method](api.UPDATE_AVATAR_API.url, dataPost, config)
}

export const updateBackgroundImage = dataPost => {
  const config = {
    headers: {
      'Content-Type': 'multipart/form-data'
    }
  }
  return connectServer[api.UPDATE_BGIMAGE_API.method](api.UPDATE_BGIMAGE_API.url, dataPost, config)
}

export const changePassword = dataPost => {
  return connectServer[api.CHANGE_PASSWORD_API.method](api.CHANGE_PASSWORD_API.url, dataPost)
}

export const forgotPassword = dataPost => {
  return connectServer[api.FORGOT_PASSWORD_API.method](api.FORGOT_PASSWORD_API.url, dataPost)
}

export const checkPasswordResetToken = dataPost => {
  return connectServer[api.CHECK_PASSWORD_RESET_TOKEN_API.method](api.CHECK_PASSWORD_RESET_TOKEN_API.url, dataPost)
}

export const resetPassword = dataPost => {
  return connectServer[api.RESET_PASSWORD_API.method](api.RESET_PASSWORD_API.url, dataPost)
}

export const logoutUser = dataPost => {
  return connectServer[api.LOGOUT_USER_API.method](api.LOGOUT_USER_API.url, dataPost)
}
