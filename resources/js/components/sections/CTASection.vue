<template>
    <section id="landingCTA" class="section-py landing-cta p-lg-4 pb-4 position-relative">
        <img src="/assets/img/front-pages/backgrounds/cta-bg.png"
             class="position-absolute bottom-0 end-0 scaleX-n1-rtl h-100 w-100 z-n1"
             alt="cta image" />
             
        <!-- Modal Vidéo -->
        <div class="modal fade" id="videoModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content bg-transparent border-0">
                    <div class="modal-header border-0 p-0">
                        <button type="button" 
                                class="btn-close btn-close-white" 
                                data-bs-dismiss="modal" 
                                aria-label="Close"
                                @click="stopVideo"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="ratio ratio-16x9">
                            <iframe 
                                ref="youtubeIframe"
                                :src="currentVideoUrl"
                                title="YouTube video"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row align-items-center gy-5 gy-lg-0">
                <div class="col-lg-6 text-center text-lg-start">
                    <h3 class="display-5 text-primary fw-bold mb-1 h3">{{ title }}</h3>
                    <p class="fw-medium mb-6 mb-md-8">{{ subtitle }}</p>
                    <div class="d-flex gap-3 justify-content-center justify-content-lg-start">
                        <a :href="primaryButton.link" class="btn btn-primary">
                            {{ primaryButton.text }}
                            <i class="ri-arrow-right-line ri-16px ms-2 scaleX-n1-rtl"></i>
                        </a>
                        <a :href="secondaryButton.link" class="btn btn-outline-primary">
                            {{ secondaryButton.text }}
                            <i class="ri-price-tag-3-line ri-16px ms-2"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 pt-lg-12">
                    <div class="video-preview-container" @click="openVideoModal">
                        <img src="/assets/img/front-pages/landing-page/cta-dashboard.png"
                             alt="aperçu du tableau de bord"
                             class="img-fluid video-thumbnail" />
                        <div class="video-overlay">
                            <button class="play-button">
                                <i class="ri-play-circle-line"></i>
                            </button>
                            <span class="play-text">Voir la démo</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: 'CTASection',
    data() {
        return {
            title: 'Prêt à digitaliser votre entreprise ?',
            subtitle: 'Essayez gratuitement pendant 14 jours notre solution ERP tout-en-un',
            primaryButton: {
                text: 'Demander un devis',
                link: '/login'
            },
            secondaryButton: {
                text: 'Voir les offres',
                link: '#landingPricing'
            },
            videoId: 'GJ8-r9bHyB8',
            currentVideoUrl: ''
        }
    },
    computed: {
        videoEmbedUrl() {
            return `https://www.youtube.com/embed/${this.videoId}?autoplay=1&rel=0`
        }
    },
    methods: {
        openVideoModal() {
            // Mettre à jour l'URL avec autoplay avant d'ouvrir la modal
            this.currentVideoUrl = this.videoEmbedUrl
            const modal = new bootstrap.Modal(document.getElementById('videoModal'))
            modal.show()
        },
        stopVideo() {
            // Réinitialiser l'URL pour arrêter la vidéo
            this.currentVideoUrl = `https://www.youtube.com/embed/${this.videoId}?rel=0`
        }
    },
    mounted() {
        // Initialiser l'URL sans autoplay au chargement
        this.currentVideoUrl = `https://www.youtube.com/embed/${this.videoId}?rel=0`
    }
}
</script>

<style scoped>
.video-preview-container {
    position: relative;
    border-radius: 8px;
    overflow: hidden;
    cursor: pointer;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
}

.video-thumbnail {
    display: block;
    width: 100%;
    transition: transform 0.3s ease;
}

.video-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.3);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.play-button {
    background: rgba(255, 255, 255, 0.9);
    border: none;
    border-radius: 50%;
    width: 80px;
    height: 80px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    margin-bottom: 1rem;
}

.play-button i {
    font-size: 40px;
    color: #0d6efd;
}

.play-text {
    color: white;
    font-size: 1.1rem;
    font-weight: 500;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.video-preview-container:hover .video-overlay {
    background: rgba(0, 0, 0, 0.4);
}

.video-preview-container:hover .play-button {
    transform: scale(1.1);
    background: rgba(255, 255, 255, 1);
}

/* Modal styles */
.modal-dialog {
    max-width: 800px;
    margin: 30px auto;
}

.modal-content {
    background-color: transparent;
}

.btn-close-white {
    position: absolute;
    right: -30px;
    top: -30px;
    z-index: 999;
    background-color: white;
    padding: 0.5rem;
    border-radius: 50%;
    opacity: 1;
}

.modal-body {
    position: relative;
    padding: 0;
}

@media (max-width: 768px) {
    .play-button {
        width: 60px;
        height: 60px;
    }

    .play-button i {
        font-size: 30px;
    }

    .play-text {
        font-size: 1rem;
    }
    
    .btn-close-white {
        right: 0;
        top: -40px;
    }
}
</style>