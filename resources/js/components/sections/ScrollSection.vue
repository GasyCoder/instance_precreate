<template>
    <div class="back-to-top">
        <button class="btn btn-primary btn-icon scroll-top waves-effect waves-light"
                :class="{ 'show': isVisible, 'hide': !isVisible }"
                @click="scrollToTop">
            <i class="ri-arrow-up-line"></i>
        </button>
    </div>
</template>

<script>
export default {
    name: 'ScrollTop',
    data() {
        return {
            isVisible: false
        }
    },
    mounted() {
        window.addEventListener('scroll', this.handleScroll)
    },
    beforeUnmount() {
        window.removeEventListener('scroll', this.handleScroll)
    },
    methods: {
        handleScroll() {
            this.isVisible = window.pageYOffset > 100
        },
        scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            })
        }
    }
}
</script>

<style scoped>
.back-to-top {
    position: fixed;
    bottom: 2rem;
    right: 2rem;
    z-index: 999;
}

.scroll-top {
    width: 42px;
    height: 42px;
    padding: 0;
    border-radius: 50%;
    box-shadow: 0 2px 10px rgba(65, 88, 218, 0.763);
    transition: all 0.2s ease;
    opacity: 0;
    visibility: hidden;
}

.scroll-top:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.scroll-top.show {
    opacity: 1;
    visibility: visible;
}

.scroll-top.hide {
    opacity: 0;
    visibility: hidden;
}
</style>
