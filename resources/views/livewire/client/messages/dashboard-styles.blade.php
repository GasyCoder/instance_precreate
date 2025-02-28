<style>
    .app-wrapper {
        background-color: #f8f9fc;
        min-height: 100vh;
        padding: 1.5rem;
    }

    .card {
        background: #fff;
        border: none;
        box-shadow: 0 2px 6px rgba(0,0,0,.02);
    }

    .stat-box {
        padding: 1.25rem;
        border-radius: 12px;
        text-align: center;
        height: 100%;
        background: rgba(var(--bs-primary-rgb), 0.04);
    }

    .stat-box.primary { background: rgba(99, 102, 241, 0.04); }
    .stat-box.info { background: rgba(34, 211, 238, 0.04); }
    .stat-box.warning { background: rgba(251, 146, 60, 0.04); }
    .stat-box.success { background: rgba(16, 185, 129, 0.04); }

    .stat-icon {
        font-size: 1.5rem;
        margin-bottom: 0.75rem;
    }

    .stat-value {
        font-size: 1.75rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .stat-label {
        color: #6b7280;
        font-size: 0.875rem;
    }

    .plan-badge {
        background: #6366f1;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        display: inline-block;
        margin-bottom: 1rem;
    }

    .update-badge {
        background: rgba(0,0,0,.03);
        color: #6b7280;
        padding: 0.5rem 1rem;
        border-radius: 999px;
        font-size: 0.875rem;
    }

    .btn-primary {
        background: #6366f1;
        border: none;
        padding: 0.625rem 1.25rem;
        border-radius: 999px;
    }

    .btn-outline {
        background: transparent;
        border: 1px solid #6366f1;
        color: #6366f1;
        padding: 0.625rem 1.25rem;
        border-radius: 999px;
    }

    /* Animations et transitions */
    .hover-shadow-lg {
        transition: all 0.3s ease;
    }

    .hover-shadow-lg:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;
    }

    .stat-card {
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-3px);
    }

    .transition-all {
        transition: all 0.3s ease;
    }
</style>
