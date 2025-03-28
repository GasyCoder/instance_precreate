<template>
    <section id="landingHero" class="min-vh-100 d-flex align-items-center position-relative overflow-hidden bg-light">
        <!-- Background Animation -->
        <div class="hero-bg">
            <div class="gradient-blob blob-1"></div>
            <div class="gradient-blob blob-2"></div>
            <div class="gradient-blob blob-3"></div>
        </div>

        <div class="container position-relative">
            <div class="row align-items-center min-vh-100">
                <!-- Text Content -->
                <div class="col-lg-6 hero-content" data-aos="fade-up">
                    <!-- Title -->
                    <h1 class="hero-title" data-aos="fade-up" data-aos-delay="300">
                        <span class="gradient-text">Solution SaaS</span>
                        complète pour
                        <span class="highlight-text">votre entreprise</span>
                    </h1>

                    <!-- Description -->
                    <p class="hero-description" data-aos="fade-up" data-aos-delay="400">
                        <span class="text-emphasis">Transformez votre business</span>
                        sans coder. Notre plateforme offre toutes les fonctionnalités
                        marketing dont vous avez besoin, avec une
                        <span class="text-primary">personnalisation en temps réel</span>.
                    </p>

                    <!-- CTA Buttons -->
                    <div class="hero-buttons" data-aos="fade-up" data-aos-delay="500">
                        <a href="/login" class="btn-primary">
                            <span>Commencer maintenant</span>
                            <i class="ri-arrow-right-line ms-2"></i>
                        </a>
                        <a href="#landingCTA" class="btn-secondary">
                            <span>Voir la démo</span>
                            <i class="ri-play-circle-line ms-2"></i>
                        </a>
                    </div>
                </div>

                <!-- Dashboard Preview -->
                <div class="col-lg-6 hero-dashboard" data-aos="fade-left" data-aos-delay="300">
                    <div class="dashboard-wrapper" ref="dashboardPreview">
                        <img src="/assets/img/front-pages/landing-page/hero-dashboard-light.png"
                             alt="Dashboard Preview"
                             class="dashboard-image">

                        <!-- Stats Cards -->
                        <div class="stats-card stats-card-1">
                            <div class="stats-indicator success"></div>
                            <span>+24% Croissance</span>
                        </div>

                        <div class="stats-card stats-card-2">
                            <div class="stats-indicator primary"></div>
                            <span>98% Satisfaction</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { onMounted, ref, onUnmounted } from 'vue'
import AOS from 'aos'
import 'aos/dist/aos.css'

export default {
    name: 'HeroSection',
    setup() {
        const dashboardPreview = ref(null)

        const handleMouseMove = (e) => {
            if (!dashboardPreview.value) return
            const { clientX, clientY } = e
            const { innerWidth, innerHeight } = window

            const x = (clientX - innerWidth / 2) / 25
            const y = (clientY - innerHeight / 2) / 25

            dashboardPreview.value.style.transform =
                `perspective(1000px) rotateY(${x}deg) rotateX(${-y}deg)`
        }

        onMounted(() => {
            AOS.init({
                duration: 1000,
                easing: 'ease-out',
                once: true
            })

            window.addEventListener('mousemove', handleMouseMove)
        })

        onUnmounted(() => {
            window.removeEventListener('mousemove', handleMouseMove)
        })

        return {
            dashboardPreview
        }
    }
}
</script>

<style scoped>
.hero-section {
    position: relative;
    overflow: hidden;
    background: #f8fafc;
    min-height: 100vh;
    padding: 6rem 0;
}

/* Background Animation */
.hero-bg {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    overflow: hidden;
}

.gradient-blob {
    position: absolute;
    border-radius: 50%;
    filter: blur(80px);
    opacity: 0.4;
    animation: float 20s ease-in-out infinite;
}

.blob-1 {
    width: 600px;
    height: 600px;
    background: linear-gradient(135deg, #60a5fa30, #3b82f630);
    top: -20%;
    left: -10%;
}

.blob-2 {
    width: 400px;
    height: 400px;
    background: linear-gradient(135deg, #818cf830, #6366f130);
    top: 40%;
    right: -5%;
    animation-delay: -5s;
}

.blob-3 {
    width: 300px;
    height: 300px;
    background: linear-gradient(135deg, #34d39930, #2563eb30);
    bottom: -10%;
    left: 50%;
    animation-delay: -10s;
}

/* Hero Content Styles */
.hero-content {
    position: relative;
    z-index: 2;
}

.hero-badge {
    display: inline-flex;
    align-items: center;
    padding: 0.5rem 1rem;
    background: linear-gradient(135deg, #3b82f610, #60a5fa10);
    border: 1px solid #60a5fa30;
    border-radius: 100px;
    font-weight: 500;
    color: #2563eb;
    margin-bottom: 2rem;
    transition: transform 0.3s ease;
}

.hero-badge:hover {
    transform: translateY(-2px);
}

.badge-icon {
    margin-right: 0.5rem;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 1.5rem;
}

.gradient-text {
    background: linear-gradient(135deg, #2563eb, #3b82f6);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.highlight-text {
    color: #1e40af;
}

.hero-description {
    font-size: 1.25rem;
    line-height: 1.7;
    color: #64748b;
    margin-bottom: 2.5rem;
}

/* Buttons */
.hero-buttons {
    display: flex;
    gap: 1rem;
}

.btn-primary, .btn-secondary {
    display: inline-flex;
    align-items: center;
    padding: 1rem 2rem;
    border-radius: 100px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-primary {
    background: linear-gradient(135deg, #2563eb, #3b82f6);
    color: white;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.15);
}

.btn-secondary {
    background: white;
    color: #2563eb;
    border: 1px solid #60a5fa30;
}

.btn-primary:hover, .btn-secondary:hover {
    transform: translateY(-2px);
}

/* Dashboard Preview */
.dashboard-wrapper {
    position: relative;
    transition: transform 0.3s ease-out;
}

.dashboard-image {
    width: 100%;
    border-radius: 1rem;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}

.stats-card {
    position: absolute;
    background: white;
    padding: 1rem 1.5rem;
    border-radius: 1rem;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-weight: 600;
    animation: float 6s ease-in-out infinite;
}

.stats-card-1 {
    top: 5%;
    right: -5%;
}

.stats-card-2 {
    bottom: 10%;
    left: -5%;
    animation-delay: -3s;
}

.stats-indicator {
    width: 10px;
    height: 10px;
    border-radius: 50%;
}

.success { background: #22c55e; }
.primary { background: #2563eb; }

@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-20px); }
}

/* Responsive Design */
@media (max-width: 992px) {
    .hero-title {
        font-size: 2.5rem;
    }

    .hero-content {
        text-align: center;
        margin-bottom: 3rem;
    }

    .hero-buttons {
        justify-content: center;
    }
}
</style>
