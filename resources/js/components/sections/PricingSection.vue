<template>
    <section id="landingPricing" class="section-py bg-body landing-pricing">
      <div class="container bg-icon-left position-relative">
        <img src="/assets/img/front-pages/icons/bg-left-icon-light.png"
             alt="section icon"
             class="position-absolute top-0 start-0"
             data-speed="1" />

        <!-- Header Original -->
        <h6 class="text-center d-flex justify-content-center align-items-center mb-2">
          <img src="/assets/img/front-pages/icons/section-tilte-icon.png"
               alt="section title icon"
               class="me-3" />
          <span class="text-uppercase">Nos offres</span>
        </h6>
        <h5 class="text-center mb-2">
          <span class="display-5 fs-4 fw-bold">Des solutions sur mesure</span> pour votre entreprise
        </h5>
        <p class="text-center fw-medium mb-10">
          Toutes nos offres incluent une suite complète d'outils pour gérer votre activité.<br />
          Choisissez le plan qui correspond le mieux à vos besoins.
        </p>

        <!-- Le reste du contenu reste identique -->
        <div class="row g-4">
          <div v-for="plan in pricingPlans"
               :key="plan.id"
               class="col-lg-4">
            <div :class="['pricing-card', 'card', 'border-0', 'h-100',
                         {'featured': plan.featured}]">
              <div class="floating-title">
                <h4 class="plan-name">{{ plan.name }}</h4>
              </div>

              <div class="card-body p-5 d-flex flex-column">
                <div class="pricing-header text-center">
                <div class="price-container mb-4">
                    <span class="currency">€</span>
                    <span class="price">{{ plan.price }}</span>
                    <span class="period">/mois</span>
                </div>
                <p class="text-muted mb-5 fw-bold">{{ plan.priceLocal }}</p>
                </div>

                <ul class="feature-list flex-grow-1">
                <li v-for="(feature, index) in plan.features"
                    :key="index"
                    class="feature-item">
                    <img src="/assets/img/front-pages/icons/list-arrow-icon.png"
                        alt="list arrow icon"
                        class="me-2 pe-1 scaleX-n1-rtl" />
                    {{ feature }}
                </li>
                </ul>

                    <div class="button-wrapper">
                    <a href="/login" :class="['btn', 'w-100', plan.featured ?
                                    'btn-primary' : 'btn-outline-primary']">
                        {{ plan.buttonText }}
                    </a>
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
  name: 'PricingSection',
  data() {
    return {
      pricingPlans: [
        {
          id: 1,
          name: 'Solo Basic',
          price: '5,25',
          priceLocal: '25 500 MGA',
          featured: false,
          features: [
            'Gestion des tiers',
            'Gestion des produits',
            'Gestion des stocks',
            'CRM',
            'Devis et facturation',
            'Comptabilité'
          ],
          description: "Idéal pour les indépendants ou petites entreprises avec des besoins simples.",
          buttonText: 'Essayer gratuitement'
        },
        {
          id: 2,
          name: 'Solo Standard',
          price: '15,50',
          priceLocal: '77 500 MGA',
          featured: true,
          features: [
            'Modules Artisan',
            'Gestion avancée des utilisateurs',
            'Rapports et statistiques'
          ],
          description: "Pour les petites entreprises nécessitant une gestion avancée.",
          buttonText: 'Démarrer maintenant'
        },
        {
          id: 3,
          name: 'Premium',
          price: '45,00',
          priceLocal: '225 000 MGA',
          featured: false,
          features: [
            'Modules Standard',
            'Email intégré',
            'Calculs automatisés des coûts et marges',
            'Suivi de temps',
            'Gestion multi-devises',
            'Support prioritaire'
          ],
          description: "Offre complète pour les entreprises ayant des besoins avancés et une gestion d\u0027équipe.",
          buttonText: 'Contacter un commercial'
        }
      ]
    }
  }
}
</script>


  <style scoped>
  .scaleX-n1-rtl {
    transform: scaleX(1);
  }

  .feature-item img {
    width: 20px;
    height: auto;
 }

 .card-body {
  display: flex;
  flex-direction: column;
  height: 100%;
}

.feature-list {
  flex-grow: 1;
  margin-bottom: 2rem;
}

.button-wrapper {
  margin-top: auto;
}
  .pricing-section {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
  }

  .section-icon {
    font-size: 1.5rem;
    color: #0d6efd;
  }

  .pricing-card {
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    position: relative;
    overflow: visible;
    margin-top: 3rem;
  }

  .pricing-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.15);
  }

  .pricing-card.featured {
    border: 2px solid #0d6efd;
  }

  /* Titre flottant */
  .floating-title {
    position: absolute;
    top: -25px;
    left: 50%;
    transform: translateX(-50%);
    background: white;
    padding: 10px 25px;
    border-radius: 25px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    animation: float 3s ease-in-out infinite;
  }

  .plan-name {
    margin: 0;
    font-size: 1.5rem;
    font-weight: bold;
    color: #0d6efd;
  }

  .price-container {
    position: relative;
    display: inline-block;
    margin-top: 2rem;
  }

  .currency {
    position: relative;
    top: -20px;
    font-size: 1.5rem;
    font-weight: bold;
  }

  .price {
    font-size: 3.5rem;
    font-weight: bold;
    color: #0d6efd;
  }

  .period {
    font-size: 1rem;
    color: #6c757d;
  }

  /* Liste avec flèches */
  .feature-list {
    list-style: none;
    padding: 0;
    margin: 2rem 0;
  }

  .feature-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 1rem;
    line-height: 1.4;
  }

  .arrow-icon {
    color: #0d6efd;
    margin-right: 10px;
    font-size: 0.9em;
  }

  @keyframes float {
    0% {
      transform: translateX(-50%) translateY(0);
    }
    50% {
      transform: translateX(-50%) translateY(-10px);
    }
    100% {
      transform: translateX(-50%) translateY(0);
    }
  }

  /* Responsive adjustments */
  @media (max-width: 992px) {
    .pricing-card {
      margin-top: 4rem;
    }
  }
  </style>
