<template>
    <div class="spinner" v-if="isLoading">
      <div class="dot"></div>
      <div class="dot"></div>
      <div class="dot"></div>
    </div>
</template>

<script setup>
const props = defineProps({
isLoading: {
    type: Boolean,
    required: true
}
});
</script>

<style scoped>
.spinner {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 50px;
}

.dot {
    width: 15px;
    height: 15px;
    margin: 5px;
    border-radius: 50%;
    background-color: #f97316;
    animation: bounce 0.6s infinite alternate;
}

.dot:nth-child(2) {
    animation-delay: 0.2s;
}

.dot:nth-child(3) {
    animation-delay: 0.4s;
}

@keyframes bounce {
    to {
        transform: translateY(-20px);
        opacity: 0.7;
    }
}
</style>
  