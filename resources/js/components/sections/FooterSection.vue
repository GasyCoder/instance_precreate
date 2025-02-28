<template>
    <footer class="landing-footer">
        <!-- Footer Top -->
        <div class="footer-top position-relative overflow-hidden">
            <img :src="`/assets/img/front-pages/backgrounds/footer-bg.png`"
                 alt="footer bg"
                 class="footer-bg banner-bg-img" />
            <div class="container position-relative">
                <div class="row gx-0 gy-7 gx-sm-6 gx-lg-12">
                    <!-- Logo et Newsletter -->
                    <div class="col-lg-5">
                        <a href="/" class="app-brand-link mb-6">
                            <span class="app-brand-logo demo me-2">
                                <!-- Logo -->
                            </span>
                            <span class="app-brand-text demo footer-link fw-semibold ms-1">ERP INNOV</span>
                        </a>
                        <p class="footer-text footer-logo-description mb-6">
                            {{ description }}
                        </p>
                        <form @submit.prevent="subscribeNewsletter">
                            <div class="d-flex mt-2 gap-4">
                                <div class="form-floating form-floating-outline w-px-250">
                                    <input type="email"
                                           class="form-control bg-transparent rounded-3"
                                           id="newsletter-1"
                                           v-model="newsletterEmail"
                                           placeholder="Votre email" />
                                    <label for="newsletter-1">S'inscrire à la newsletter</label>
                                </div>
                                <button type="submit" class="btn btn-primary">S'abonner</button>
                            </div>
                        </form>
                    </div>

                    <!-- Menu ERP INNOV -->
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <h6 class="footer-title mb-4 mb-lg-6">ERP INNOV</h6>
                        <ul class="list-unstyled mb-0">
                            <li v-for="(link, index) in erpLinks"
                                :key="index"
                                class="mb-4">
                                <a :href="link.url" class="footer-link">{{ link.text }}</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Menu Légal -->
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <h6 class="footer-title mb-4 mb-lg-6">Légal</h6>
                        <ul class="list-unstyled mb-0">
                            <li v-for="(link, index) in legalLinks"
                                :key="index"
                                class="mb-4">
                                <a :href="link.url" class="footer-link">{{ link.text }}</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Contact -->
                    <div class="col-lg-3 col-md-4">
                        <h6 class="footer-title mb-4 mb-lg-6">Contact</h6>
                        <ul class="list-unstyled mb-0">
                            <li v-for="(contact, index) in contactInfo"
                                :key="index"
                                class="mb-4">
                                <i :class="['me-2', contact.icon]"></i>
                                <a v-if="contact.isLink"
                                   :href="contact.href"
                                   class="footer-link">{{ contact.text }}</a>
                                <span v-else class="footer-text">{{ contact.text }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom py-5">
            <div class="container d-flex flex-wrap justify-content-between flex-md-row flex-column text-center text-md-start">
                <div class="mb-2 mb-md-0">
                    <span class="footer-text">© {{ currentYear }} ERP INNOV. Tous droits réservés.</span>
                </div>
                <div>
                    <a v-for="(social, index) in socialLinks"
                       :key="index"
                       :href="social.url"
                       class="footer-link me-4"
                       target="_blank">
                        <i :class="social.icon"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>
</template>

<script>
export default {
    name: 'FooterSection',
    data() {
        return {
            description: 'La solution ERP complète pour gérer et développer votre entreprise. Accessible, performante et adaptée à vos besoins.',
            newsletterEmail: '',
            erpLinks: [
                { url: '#landingFeatures', text: 'Fonctionnalités' },
                { url: '#landingPricing', text: 'Tarifs' },
                { url: '#landingFAQ', text: 'FAQ' },
                { url: '#landingContact', text: 'Contact' },
                { url: '/demo', text: 'Démonstration' }
            ],
            legalLinks: [
                { url: '/mentions-legales', text: 'Mentions légales' },
                { url: '/confidentialite', text: 'Confidentialité' },
                { url: '/cgv', text: 'CGV' },
                { url: '/centre-aide', text: "Centre d'aide" },
                { url: '/connexion', text: 'Connexion' }
            ],
            contactInfo: [
                {
                    icon: 'ri-mail-line',
                    text: 'contact@erpinnov.com',
                    isLink: true,
                    href: 'mailto:contact@erpinnov.com'
                },
                {
                    icon: 'ri-phone-line',
                    text: '+261 34 00 000 00',
                    isLink: true,
                    href: 'tel:+261340000000'
                },
                {
                    icon: 'ri-map-pin-line',
                    text: 'Madagascar',
                    isLink: false
                }
            ],
            socialLinks: [
                { url: '#', icon: 'ri-facebook-circle-fill' },
                { url: '#', icon: 'ri-linkedin-fill' },
                { url: '#', icon: 'ri-instagram-line' }
            ]
        }
    },
    computed: {
        currentYear() {
            return new Date().getFullYear()
        }
    },
    methods: {
        async subscribeNewsletter() {
            if (!this.newsletterEmail) return

            try {
                // Ici vous pouvez ajouter la logique pour envoyer l'email à votre backend
                console.log('Newsletter subscription:', this.newsletterEmail)
                this.newsletterEmail = ''
            } catch (error) {
                console.error('Error subscribing to newsletter:', error)
            }
        }
    }
}
</script>

