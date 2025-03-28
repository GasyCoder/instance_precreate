<template>
    <div>
      <nav-section />
      <div data-bs-spy="scroll" class="scrollspy-example">
        <hero-section />
        <pricing-section />
        <facts-section />
        <faq-section />
        <CTASection />
        <contact-section />
      </div>
      <footer-section />
      <scroll-section />
    </div>
</template>


<script>
import NavSection from './sections/NavSection.vue'
import HeroSection from './sections/HeroSection.vue'
import PricingSection from './sections/PricingSection.vue'
import FactsSection from './sections/FactsSection.vue'
import FaqSection from './sections/FaqSection.vue'
import CTASection from './sections/CTASection.vue'
// import ContactSection from './sections/ContactSection.vue'
import FooterSection from './sections/FooterSection.vue'
import ScrollSection from './sections/ScrollSection.vue'

export default {
    name: 'App',
    components: {
        NavSection,
        HeroSection,
        PricingSection,
        FactsSection,
        FaqSection,
        CTASection,
        // ContactSection,
        FooterSection,
        ScrollSection
    },
}
</script>
