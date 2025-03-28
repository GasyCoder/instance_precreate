<template>
    <nav class="layout-navbar container shadow-none py-0">
        <div class="navbar navbar-expand-lg landing-navbar border-top-0 px-3 px-md-4">
            <!-- Logo -->
            <div class="navbar-brand app-brand demo d-flex py-0 py-lg-2 me-4">
                <button class="navbar-toggler border-0 px-0 me-2"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent"
                        aria-expanded="false"
                        aria-label="Toggle navigation">
                    <i class="tf-icons ri-menu-fill ri-24px align-middle"></i>
                </button>

                <a href="/" class="app-brand-link">
                    <span class="app-brand-logo demo">
                        <img src="/assets/img/front-pages/logo/logo.png"
                             alt="Logo ERP INNOV"
                             style="width: 40px; height: 40px;"
                             class="img-fluid">
                    </span>
                    <span class="app-brand-text demo menu-text fw-semibold ms-2">ERP INNOV</span>
                </a>
            </div>

            <!-- Menu principal -->
            <div class="collapse navbar-collapse landing-nav-menu" id="navbarSupportedContent">
                <button class="navbar-toggler border-0 position-absolute end-0 top-0 d-lg-none"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent">
                    <i class="tf-icons ri-close-fill"></i>
                </button>

                <ul class="navbar-nav mx-auto p-3 p-lg-0">
                    <li v-for="item in menuItems"
                        :key="item.href"
                        class="nav-item mx-2">
                        <a class="nav-link fw-medium px-3 d-flex align-items-center gap-2"
                           :href="item.href"
                           :class="{ 'active': activeSection === item.href }">
                            <i :class="['tf-icons', item.icon]"></i>
                            <span>{{ item.text }}</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Actions à droite -->
            <ul class="navbar-nav flex-row align-items-center ms-auto">
                <template v-if="!auth">
                    <li>
                        <a href="/login" class="btn btn-primary rounded-pill px-3 px-sm-4">
                            <i class="tf-icons ri-user-line me-md-1"></i>
                            <span class="d-none d-md-inline-block">Connexion</span>
                        </a>
                    </li>
                </template>
                <template v-else>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <img :src="auth.profile_photo_url || '/assets/img/avatars/1.png'"
                            class="rounded-circle fw-bold" width="40" :alt="auth.name">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="/client-espace/client"><i class="ri-dashboard-line me-2"></i>Dashboard</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form @submit.prevent="logout" method="POST">
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="ri-logout-box-line me-2"></i>Déconnexion
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </template>
            </ul>
        </div>
    </nav>
 </template>

 <script>
 export default {
    name: 'NavSection',
    data() {
        return {
            auth: window.Laravel.auth,
            activeSection: '',
            menuItems: [
                { href: '#landingHero', icon: 'ri-home-line', text: 'Accueil' },
                { href: '#landingPricing', icon: 'ri-price-tag-line', text: 'Tarifs' },
                { href: '#landingFAQ', icon: 'ri-questionnaire-line', text: 'FAQ' },
                { href: '#landingCTA', icon: 'ri-play-circle-line', text: 'Démo' }
            ]
        }
    },
    mounted() {
        this.handleScroll()
        window.addEventListener('scroll', this.handleScroll)
    },
    beforeDestroy() {
        window.removeEventListener('scroll', this.handleScroll)
    },
    methods: {
        handleScroll() {
            const sections = this.menuItems.map(item => item.href.substring(1))
            const scrollPosition = window.scrollY + 100

            for (const section of sections) {
                const element = document.getElementById(section)
                if (element) {
                    const { top, bottom } = element.getBoundingClientRect()
                    if (top <= 100 && bottom >= 100) {
                        this.activeSection = '#' + section
                        break
                    }
                }
            }
        },
        async logout() {
            try {
                await axios.post('/logout')
                window.location.reload()
            } catch (error) {
                console.error('Erreur de déconnexion:', error)
            }
        }
    }
 }
 </script>

 <style scoped>
 .nav-link {
    position: relative;
    transition: all 0.2s ease;
 }

 .nav-link span::after {
    content: '';
    position: absolute;
    width: 0;
    height: 2px;
    bottom: -4px;
    left: 0;
    background-color: #666cff;
    transition: width 0.2s ease;
    opacity: 0;
 }

 .nav-link:hover span::after,
 .nav-link.active span::after {
    width: 100%;
    opacity: 1;
 }

 .nav-link:hover {
    color: #666cff;
 }

 .nav-link:hover i {
    transform: translateY(-1px);
 }

 .nav-link i {
    transition: transform 0.2s ease;
 }

 @media (max-width: 991.98px) {
    .navbar-collapse {
        position: relative;
        background: white;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        padding-top: 1rem;
    }

    .navbar-collapse .navbar-toggler {
        z-index: 10;
        margin: 0.5rem;
    }
 }
 </style>
