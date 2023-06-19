<script setup>
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'

const page = usePage()

const user = computed(() => page.props.auth.user)
const alert = computed(() => usePage().props.value.flash.alert);
</script>


<template>
  <main>
    <header></header>
    <content>
      <div v-if="$page.props.flash.message" class="alert">
        {{ $page.props.flash.message }}
      </div>
      <slot />
    </content>
    <footer></footer>
  </main>
  {{ $page.props.flash }}
</template>