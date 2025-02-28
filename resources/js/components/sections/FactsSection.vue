<template>
    <section id="landingFunFacts" class="section-py landing-fun-facts py-12 my-4">
        <div class="container">
            <div class="row gx-0 gy-6 gx-sm-6">
                <div v-for="fact in facts"
                     :key="fact.id"
                     class="col-md-3 col-sm-6 text-center"
                     data-aos="fade-up"
                     :data-aos-delay="fact.id * 100">
                    <span :class="['badge', 'rounded-pill', fact.iconBgClass, 'fun-facts-icon', 'mb-6', 'p-5']">
                        <i :class="['tf-icons', fact.icon, 'ri-42px']"></i>
                    </span>
                    <h2 class="fw-bold mb-0 fun-facts-text">
                        <count-up
                            :startVal="0"
                            :endVal="fact.numericValue"
                            :duration="2.5"
                            :options="fact.options"
                            @end="onCountFinished(fact)"
                        >
                            <template #suffix>{{ fact.suffix }}</template>
                        </count-up>
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
    name: 'FactsSection',
    components: {
        CountUp
    },
    data() {
        return {
            facts: [
                {
                    id: 1,
                    numericValue: 1000,
                    suffix: '+',
                    label: 'Entreprises actives',
                    icon: 'ri-building-line',
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
                    numericValue: 5,
                    suffix: 'M+',
                    label: 'Documents traités',
                    icon: 'ri-file-list-3-line',
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
                    numericValue: 10000,
                    suffix: '+',
                    label: 'Utilisateurs satisfaits',
                    icon: 'ri-group-line',
                    iconBgClass: 'bg-label-hover-warning',
                    options: {
                        useEasing: true,
                        useGrouping: true,
                        separator: ' ',
                        decimal: '.',
                    }
                },
                {
                    id: 4,
                    numericValue: 99.9,
                    suffix: '%',
                    label: 'Disponibilité cloud',
                    icon: 'ri-cloud-line',
                    iconBgClass: 'bg-label-hover-info',
                    options: {
                        useEasing: true,
                        useGrouping: true,
                        separator: ' ',
                        decimal: '.',
                        decimals: 1
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
