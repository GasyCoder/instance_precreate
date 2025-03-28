<template>
    <section id="landingFunFacts" class="section-py landing-fun-facts py-12 my-3">
        <div class="container">
            <div class="row gx-0 gy-6 gx-sm-6 justify-content-center">
                <div class="container bg-icon-left position-relative">
                    <h5 class="text-center mb-2">
                        <span class="display-5 fs-4 fw-bold">Nos modules pour simplifier votre gestion</span> 
                    </h5>
                    <p class="text-center fw-medium mb-10">
                        Des outils adaptés pour gagner du temps et répondre à vos
                    </p>
                </div>
                <div v-for="fact in facts"
                     :key="fact.id"
                     class="col-md-4 col-sm-6 text-center"
                     data-aos="fade-up"
                     :data-aos-delay="fact.id * 100">
                     
                    <span :class="['badge', 'rounded-pill', fact.iconBgClass, 'fun-facts-icon', 'mb-6', 'p-5']">
                        <i :class="['tf-icons', fact.icon, 'ri-42px']"></i>
                    </span>

                    <h2 class="fw-bold mb-0 fun-facts-text">
                        {{ fact.suffix}}
                    </h2>

                    <h6 class="mb-0 text-body">{{ fact.label }}</h6>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { defineComponent } from 'vue'
import CountUp from 'vue-countup-v3'
import AOS from 'aos'
import 'aos/dist/aos.css'

export default defineComponent({
    name: 'ModuleSection',
    components: {
        CountUp
    },
    data() {
        return {
            facts: [
                {
                    id: 1,
                    numericValue: null,
                    suffix: 'CRM & Ventes',
                    label: 'Le CRM vous aide à gérer vos clients de manière efficace et personnalisée.',
                    icon: 'ri-macbook-line',
                    iconBgClass: 'bg-label-hover-primary',
                    options: {
                        useEasing: true,
                        useGrouping: true,
                        separator: ' ',
                        decimal: '.',
                    }
                },
                {
                    id: 2,
                    suffix: 'Marketing',
                    label: 'Bostez votre stratégie Marketing avec des outils performants',
                    icon: 'ri-account-circle-fill',
                    iconBgClass: 'bg-label-hover-success',
                    options: {
                        useEasing: true,
                        useGrouping: true,
                        separator: ' ',
                        decimal: '.',
                    }
                },
                {
                    id: 3,
                    suffix: 'Finance & Facturation',
                    label: 'Optimisez votre gestion financière. Paiement et Rapprochement bancaire',
                    icon: 'ri-bank-fill',
                    iconBgClass: 'bg-label-hover-success',
                    options: {
                        useEasing: true,
                        useGrouping: true,
                        separator: ' ',
                        decimal: '.',
                    }
                },
                {
                    id: 4,
                    suffix: 'Produit & Stock',
                    label: 'Gérer efficacement vos Produits, Services, Stocks, Achats et Expéditions',
                    icon: 'ri-product-hunt-line',
                    iconBgClass: 'bg-label-hover-warning',
                    options: {
                        useEasing: true,
                        useGrouping: true,
                        separator: ' ',
                        decimal: '.',
                    }
                },
                {
                    id: 5,
                    suffix: 'Ressources Humaines',
                    label: 'Noter solution simplifie la gestion de vos RH avec des outils intuitifs',
                    icon: 'ri-account-circle-fill',
                    iconBgClass: 'bg-label-hover-warning',
                    options: {
                        useEasing: true,
                        useGrouping: true,
                        separator: ' ',
                        decimal: '.',
                    }
                },
                {
                    id: 6,
                    suffix: 'Productivité',
                    label: 'Améliorez votre Productivité en gérant efficacement Projets et Tâches.',
                    icon: 'ri-line-chart-fill',
                    iconBgClass: 'bg-label-hover-warning',
                    options: {
                        useEasing: true,
                        useGrouping: true,
                        separator: ' ',
                        decimal: '.',
                    }
                }
            ]
        }
    },
    mounted() {
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });
    },
    methods: {
        onCountFinished(fact) {
            console.log(`Comptage terminé pour ${fact.label}`);
        }
    }
})
</script>

<style scoped>
#landingFunFacts {
    display: flex;
    place-items: center;
}

.fun-facts-icon {
    transition: transform 0.3s ease;
}

.fun-facts-icon:hover {
    transform: scale(1.1);
}

.fun-facts-text {
    background: linear-gradient(45deg, var(--bs-primary), #2563eb);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
}
</style>
