<template>
  <div class="checkbox-wrapper">
    <input id="cbtest" type="checkbox" :checked="modelValue" @change="updateValue($event.target.checked)" />
    <label class="check-box" for="cbtest"> </label>
  </div>
</template>

<script>
import { defineComponent } from 'vue'

export default defineComponent({
  props: {
    modelValue: {
      type: Boolean,
      default: false
    }
  },
  setup(props, { emit }) {
    const updateValue = value => {
      emit('update:modelValue', value)
    }

    return {
      updateValue
    }
  }
})
</script>

<style scoped>
.checkbox-wrapper {
  display: flex;
  align-items: center;
  justify-content: center;
  box-sizing: border-box;
  --background-color: #fff;
  --checkbox-height: 16px;
}

@-moz-keyframes dothabottomcheck {
  0% {
    height: 0;
  }

  100% {
    height: calc(var(--checkbox-height) / 2);
  }
}

@-webkit-keyframes dothabottomcheck {
  0% {
    height: 0;
  }

  100% {
    height: calc(var(--checkbox-height) / 2);
  }
}

@keyframes dothabottomcheck {
  0% {
    height: 0;
  }

  100% {
    height: calc(var(--checkbox-height) / 2);
  }
}

@keyframes dothatopcheck {
  0% {
    height: 0;
  }

  50% {
    height: 0;
  }

  100% {
    height: calc(var(--checkbox-height) * 1.2);
  }
}

@-webkit-keyframes dothatopcheck {
  0% {
    height: 0;
  }

  50% {
    height: 0;
  }

  100% {
    height: calc(var(--checkbox-height) * 1.2);
  }
}

@-moz-keyframes dothatopcheck {
  0% {
    height: 0;
  }

  50% {
    height: 0;
  }

  100% {
    height: calc(var(--checkbox-height) * 1.2);
  }
}

.checkbox-wrapper input[type='checkbox'] {
  display: none;
}

.checkbox-wrapper .check-box {
  height: var(--checkbox-height);
  width: var(--checkbox-height);
  background-color: transparent;
  border: calc(var(--checkbox-height) * 0.1) solid;
  border-radius: 5px;
  position: relative;
  display: inline-block;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  -moz-transition: border-color ease 0.2s;
  -o-transition: border-color ease 0.2s;
  -webkit-transition: border-color ease 0.2s;
  transition: border-color ease 0.2s;
  cursor: pointer;

  @apply border-headingOpacityColor;
}

.checkbox-wrapper .check-box::before,
.checkbox-wrapper .check-box::after {
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  position: absolute;
  height: 0;
  width: calc(var(--checkbox-height) * 0.2);
  display: inline-block;
  -moz-transform-origin: left top;
  -ms-transform-origin: left top;
  -o-transform-origin: left top;
  -webkit-transform-origin: left top;
  transform-origin: left top;
  border-radius: 5px;
  content: ' ';
  -webkit-transition: opacity ease 0.5;
  -moz-transition: opacity ease 0.5;
  transition: opacity ease 0.5;

  @apply bg-primaryColor;
}

.checkbox-wrapper .check-box::before {
  top: calc(var(--checkbox-height) * 0.72);
  left: calc(var(--checkbox-height) * 0.41);
  box-shadow: 0 0 0 calc(var(--checkbox-height) * 0.05) var(--background-color);
  -moz-transform: rotate(-135deg);
  -ms-transform: rotate(-135deg);
  -o-transform: rotate(-135deg);
  -webkit-transform: rotate(-135deg);
  transform: rotate(-135deg);
}

.checkbox-wrapper .check-box::after {
  top: calc(var(--checkbox-height) * 0.37);
  left: calc(var(--checkbox-height) * 0.05);
  -moz-transform: rotate(-45deg);
  -ms-transform: rotate(-45deg);
  -o-transform: rotate(-45deg);
  -webkit-transform: rotate(-45deg);
  transform: rotate(-45deg);
}

.checkbox-wrapper input[type='checkbox']:checked + .check-box,
.checkbox-wrapper .check-box.checked {
  @apply border-primaryColor;
}

.checkbox-wrapper input[type='checkbox']:checked + .check-box::after,
.checkbox-wrapper .check-box.checked::after {
  height: calc(var(--checkbox-height) / 2);
  -moz-animation: dothabottomcheck 0.2s ease 0s forwards;
  -o-animation: dothabottomcheck 0.2s ease 0s forwards;
  -webkit-animation: dothabottomcheck 0.2s ease 0s forwards;
  animation: dothabottomcheck 0.2s ease 0s forwards;
}

.checkbox-wrapper input[type='checkbox']:checked + .check-box::before,
.checkbox-wrapper .check-box.checked::before {
  height: calc(var(--checkbox-height) * 1.2);
  -moz-animation: dothatopcheck 0.4s ease 0s forwards;
  -o-animation: dothatopcheck 0.4s ease 0s forwards;
  -webkit-animation: dothatopcheck 0.4s ease 0s forwards;
  animation: dothatopcheck 0.4s ease 0s forwards;
}
</style>
