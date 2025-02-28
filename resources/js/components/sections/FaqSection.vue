<template>
    <section id="landingFAQ" class="section-py bg-body landing-faq">
        <div class="container bg-icon-right">
            <img src="/assets/img/front-pages/icons/bg-right-icon-light.png"
                 alt="section icon"
                 class="position-absolute top-0 end-0"
                 data-speed="1" />

            <!-- Section Header -->
            <h6 class="text-center d-flex justify-content-center align-items-center mb-6">
                <img src="/assets/img/front-pages/icons/section-tilte-icon.png"
                     alt="section title icon"
                     class="me-3" />
                <span class="text-uppercase">Questions fréquentes</span>
            </h6>

            <h5 class="text-center mb-2">
                <span class="display-5 fs-4 fw-bold">Les réponses à vos questions</span>
            </h5>

            <p class="text-center fw-medium mb-4 mb-md-12 pb-4">
                Découvrez les réponses aux questions les plus fréquentes sur notre solution ERP
            </p>

            <div class="row gy-5">
                <!-- Image Column -->
                <div class="col-lg-5">
                    <div class="text-center">
                        <img src="/assets/img/front-pages/landing-page/sitting-girl-with-laptop.png"
                             alt="sitting girl with laptop"
                             class="faq-image scaleX-n1-rtl" />
                    </div>
                </div>

                <!-- FAQ Accordion -->
                <div class="col-lg-7">
                    <div class="accordion" id="accordionFront">
                        <div v-for="(faq, index) in faqs"
                             :key="index"
                             class="accordion-item">
                            <h2 class="accordion-header" :id="'head-' + faq.id">
                                <button type="button"
                                        class="accordion-button"
                                        :class="{ collapsed: !faq.isOpen }"
                                        @click="toggleFaq(index)"
                                        :data-bs-toggle="'collapse'"
                                        :data-bs-target="'#accordion' + faq.id">
                                    {{ faq.question }}
                                </button>
                            </h2>
                            <div :id="'accordion' + faq.id"
                                 class="accordion-collapse collapse"
                                 :class="{ show: faq.isOpen }"
                                 data-bs-parent="#accordionFront">
                                <div class="accordion-body">
                                    {{ faq.answer }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: 'FaqSection',
    data() {
        return {
            faqs: [
                {
                    id: 'One',
                    question: "Qu'est-ce qu'un ERP SaaS ?",
                    answer: "Un ERP SaaS (Software as a Service) est une solution de gestion d'entreprise accessible via internet. Notre solution vous permet de gérer l'ensemble de votre activité (clients, stocks, facturation, comptabilité) sans installation logicielle, avec une simple connexion internet.",
                    isOpen: false
                },
                {
                    id: 'Two',
                    question: "Comment débuter avec ERPINNOV ?",
                    answer: "Il suffit de créer un compte gratuit pour commencer. Vous aurez accès à tous les modules de base immédiatement. Notre équipe vous accompagne dans la prise en main avec une formation initiale et une documentation complète.",
                    isOpen: true
                },
                {
                    id: 'Three',
                    question: "Mes données sont-elles sécurisées ?",
                    answer: "La sécurité est notre priorité. Vos données sont hébergées en France, sauvegardées quotidiennement et protégées par un chiffrement avancé. Nous respectons strictement le RGPD et garantissons la confidentialité de vos informations.",
                    isOpen: false
                },
                {
                    id: 'Four',
                    question: "Puis-je changer d'offre à tout moment ?",
                    answer: "Oui, vous pouvez facilement upgrader ou downgrader votre abonnement à tout moment. Vos données sont conservées et vous ne payez que la différence de prix au prorata temporis.",
                    isOpen: false
                },
                {
                    id: 'Five',
                    question: "Quel support est inclus ?",
                    answer: "Chaque offre inclut un niveau de support adapté. De l'assistance par email pour l'offre Solo au support prioritaire avec accompagnement personnalisé pour l'offre Premium. Notre équipe technique est basée à Madagascar et disponible pour vous aider.",
                    isOpen: false
                }
            ]
        }
    },
    methods: {
        toggleFaq(index) {
            this.faqs = this.faqs.map((faq, i) => ({
                ...faq,
                isOpen: i === index ? !faq.isOpen : false
            }))
        }
    }
}
</script>
