<template>
      <section id="landingContact" class="section-py bg-body landing-contact">
        <div class="container bg-icon-left position-relative">
            <img src="/assets/img/front-pages/icons/bg-left-icon-light.png"
                 alt="icône section"
                 class="position-absolute top-0 start-0"
                 data-speed="1" />

            <!-- Section Header -->
            <h6 class="text-center d-flex justify-content-center align-items-center mb-6">
                <img src="/assets/img/front-pages/icons/section-tilte-icon.png"
                     alt="icône titre section"
                     class="me-3" />
                <span class="text-uppercase">Contactez-nous</span>
            </h6>

            <h5 class="text-center mb-2">
                <span class="display-5 fs-4 fw-bold">Parlons de votre projet</span>
            </h5>

            <p class="text-center fw-medium mb-4 mb-md-12 pb-3">
                Une question ? Un besoin spécifique ? Notre équipe est là pour vous répondre
            </p>

            <div class="row gy-6">
                <!-- Left Card -->
                <div class="col-lg-5">
                    <div class="card h-100">
                        <div class="bg-primary rounded-4 text-white card-body p-8">
                            <p class="fw-medium mb-1_5 tagline">Expertise ERP à votre service</p>
                            <h4 class="text-white mb-5 title">
                                Nos experts vous accompagnent dans la digitalisation de votre entreprise
                            </h4>
                            <img src="/assets/img/front-pages/chat.png"
                                 alt="let's contact"
                                 class="w-100 mb-5" />
                            <p class="mb-0 description">
                                Besoin d'une fonctionnalité sur mesure ? D'une intégration spécifique ?
                                Notre équipe d'experts est là pour vous accompagner dans tous vos projets
                                et répondre à vos besoins spécifiques.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-6">Envoyez-nous un message</h5>
                            <form @submit.prevent="submitForm" class="contact-form">
                                <div class="row g-4">
                                    <!-- Nom complet -->
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline custom-input">
                                            <input type="text"
                                                class="form-control form-control-lg rounded-3 border-2"
                                                id="basic-default-fullname"
                                                v-model="formData.fullname"
                                                :class="{ 'is-valid': formData.fullname }"
                                                placeholder="Jean Dupont" />
                                            <label for="basic-default-fullname" class="text-muted">
                                                <i class="ri-user-line me-2"></i>Nom complet
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline custom-input">
                                            <input type="email"
                                                class="form-control form-control-lg rounded-3 border-2"
                                                id="basic-default-email"
                                                v-model="formData.email"
                                                :class="{ 'is-valid': isValidEmail }"
                                                placeholder="jean.dupont@entreprise.fr" />
                                            <label for="basic-default-email" class="text-muted">
                                                <i class="ri-mail-line me-2"></i>Adresse email
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Entreprise -->
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline custom-input">
                                            <input type="text"
                                                class="form-control form-control-lg rounded-3 border-2"
                                                id="basic-default-company"
                                                v-model="formData.company"
                                                placeholder="Votre entreprise" />
                                            <label for="basic-default-company" class="text-muted">
                                                <i class="ri-building-line me-2"></i>Entreprise
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Téléphone -->
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline custom-input">
                                            <input type="tel"
                                                class="form-control form-control-lg rounded-3 border-2"
                                                id="basic-default-phone"
                                                v-model="formData.phone"
                                                placeholder="+261 34 00 000 00" />
                                            <label for="basic-default-phone" class="text-muted">
                                                <i class="ri-phone-line me-2"></i>Téléphone
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Message -->
                                    <div class="col-12">
                                        <div class="form-floating form-floating-outline custom-input">
                                            <textarea class="form-control form-control-lg rounded-3 border-2 h-px-250"
                                                    v-model="formData.message"
                                                    :class="{ 'is-valid': formData.message.length > 10 }"
                                                    placeholder="Message"
                                                    id="basic-default-message"></textarea>
                                            <label for="basic-default-message" class="text-muted">
                                                <i class="ri-message-2-line me-2"></i>Votre message
                                            </label>
                                        </div>
                                    </div>

                                    <!-- RGPD Checkbox -->
                                    <div class="col-12 mt-3">
                                        <div class="form-check custom-checkbox">
                                            <input class="form-check-input rounded-2 border-2"
                                                type="checkbox"
                                                id="basic-default-rgpd"
                                                v-model="formData.rgpdConsent" />
                                            <label class="form-check-label ms-2" for="basic-default-rgpd">
                                                J'accepte que mes données soient traitées pour le suivi de ma demande
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="col-12 mt-4">
                                        <button type="submit"
                                                class="btn btn-primary btn-lg w-100 rounded-3 d-flex align-items-center justify-content-center gap-2"
                                                :class="{ 'btn-pulse': isFormValid }"
                                                :disabled="!isFormValid">
                                            <span>Envoyer le message</span>
                                            <i class="ri-send-plane-line transition-transform"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: 'ContactSection',
    data() {
        return {
            formData: {
                fullname: '',
                email: '',
                company: '',
                phone: '',
                message: '',
                rgpdConsent: false
            }
        }
    },
    computed: {
        isFormValid() {
            return this.formData.fullname &&
                   this.formData.email &&
                   this.formData.message &&
                   this.formData.rgpdConsent
        },
        isValidEmail() {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.formData.email);
        }
    },
    methods: {
        async submitForm() {
            if (!this.isFormValid) return

            try {
                // Ici vous pouvez envoyer les données à votre backend
                // Par exemple avec axios ou fetch
                console.log('Form submitted:', this.formData)
                // Réinitialiser le formulaire après envoi
                this.resetForm()
            } catch (error) {
                console.error('Error submitting form:', error)
            }
        },
        resetForm() {
            this.formData = {
                fullname: '',
                email: '',
                company: '',
                phone: '',
                message: '',
                rgpdConsent: false
            }
        }
    }
}
</script>

<style scoped>
.custom-input {
    position: relative;
    transition: all 0.3s ease;
}

.form-control {
    transition: all 0.3s ease;
    border-color: #e5e7eb;
}

.form-control:focus {
    box-shadow: 0 0 0 4px rgba(102, 108, 255, 0.1);
    border-color: #666CFF;
}

.form-control.is-valid {
    border-color: #71DD37;
    background-image: none;
}

.form-check-input:checked {
    background-color: #666CFF;
    border-color: #666CFF;
}

.btn-pulse {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% {
        box-shadow: 0 0 0 0 rgba(102, 108, 255, 0.4);
    }
    70% {
        box-shadow: 0 0 0 10px rgba(102, 108, 255, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(102, 108, 255, 0);
    }
}

.transition-transform {
    transition: transform 0.3s ease;
}

button:hover .transition-transform {
    transform: translateX(5px);
}

/* Animation d'apparition des champs */
.form-floating {
    opacity: 0;
    transform: translateY(20px);
    animation: fadeInUp 0.5s forwards;
}

@keyframes fadeInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Délai d'animation pour chaque champ */
.col-md-6:nth-child(1) .form-floating { animation-delay: 0.1s; }
.col-md-6:nth-child(2) .form-floating { animation-delay: 0.2s; }
.col-md-6:nth-child(3) .form-floating { animation-delay: 0.3s; }
.col-md-6:nth-child(4) .form-floating { animation-delay: 0.4s; }
.col-12 .form-floating { animation-delay: 0.5s; }
</style>
