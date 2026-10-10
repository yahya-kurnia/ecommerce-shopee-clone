* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

:root {
    --primary: #ee4d2d;
    --primary-dark: #d93f22;
    --secondary: #f5f5f5;
    --text: #222;
    --muted: #666;
    --border: #e5e7eb;
    --white: #ffffff;
    --success: #16a34a;
    --error: #dc2626;
    --shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
}

html {
    scroll-behavior: smooth;
}

body {
    background: #f7f7f7;
    color: var(--text);
}

a {
    text-decoration: none;
    color: inherit;
}

img {
    max-width: 100%;
    display: block;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.navbar {
    background: var(--white);
    position: sticky;
    top: 0;
    z-index: 100;
    border-bottom: 1px solid var(--border);
}

.nav-inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    min-height: 70px;
    gap: 20px;
}

.logo {
    font-size: 1.8rem;
    font-weight: 800;
    color: var(--primary);
}

.logo span {
    color: #f59e0b;
}

.nav-links {
    display: flex;
    align-items: center;
    gap: 22px;
    color: var(--muted);
    font-weight: 600;
}

.nav-links a.active,
.nav-links a:hover {
    color: var(--primary);
}

.nav-actions {
    display: flex;
    align-items: center;
    gap: 15px;
}

.username {
    font-weight: 600;
    color: var(--muted);
}

.cart-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background: var(--primary);
    color: var(--white);
    font-size: 0.78rem;
    margin-left: 6px;
}

.primary-btn,
.secondary-btn,
.detail-btn,
.qty-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    cursor: pointer;
    transition: 0.2s ease;
}

.primary-btn {
    background: var(--primary);
    color: var(--white);
    padding: 12px 22px;
    font-weight: 700;
    border: none;
}

.primary-btn:hover {
    background: var(--primary-dark);
}

.secondary-btn {
    background: #fff;
    border: 1px solid var(--border);
    color: var(--text);
    padding: 11px 20px;
    font-weight: 600;
}

.secondary-btn:hover {
    border-color: #ccc;
}

.small {
    padding: 8px 14px;
    font-size: 0.9rem;
}

.full-width {
    width: 100%;
}

.hero {
    display: grid;
    grid-template-columns: 1.1fr 0.9fr;
    gap: 40px;
    max-width: 1200px;
    margin: 40px auto;
    padding: 0 20px;
    align-items: center;
}

.hero-content {
    padding: 30px 0;
}

.mini-label {
    display: inline-block;
    background: #fff2ed;
    color: var(--primary);
    padding: 7px 14px;
    border-radius: 999px;
    font-size: 0.85rem;
    font-weight: 700;
    margin-bottom: 16px;
}

.hero-content h1 {
    font-size: clamp(2.2rem, 4vw, 4rem);
    line-height: 1.1;
    margin-bottom: 18px;
}

.hero-content p {
    font-size: 1.1rem;
    color: var(--muted);
    margin-bottom: 25px;
    max-width: 520px;
}

.hero-actions {
    display: flex;
    gap: 16px;
    margin-bottom: 28px;
}

.stats {
    display: flex;
    gap: 28px;
    flex-wrap: wrap;
}

.stats div {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.stats strong {
    font-size: 1.6rem;
    color: var(--text);
}

.stats span {
    color: var(--muted);
}

.hero-banner img {
    border-radius: 24px;
    height: 470px;
    width: 100%;
    object-fit: cover;
    box-shadow: var(--shadow);
}

.categories,.products-section {
    max-width: 1200px;
    margin: 60px auto;
    padding: 0 20px;
}

.section-header {
    margin-bottom: 26px;
}

.section-header h2 {
    font-size: 2rem;
}

.category-grid {
    display: grid;
    grid-template-columns: repeat(6, minmax(0, 1fr));
    gap: 18px;
}

.category-item {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: 18px;
    padding: 22px 14px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
    min-height: 120px;
    justify-content: center;
    box-shadow: 0 4px 18px rgba(0,0,0,0.03);
}

.category-item i {
    font-size: 2rem;
    color: var(--primary);
}

.category-item span {
    font-weight: 600;
}

.product-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 22px;
}

.product-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 6px 22px rgba(0,0,0,0.03);
}

.product-image-wrap {
    position: relative;
    height: 220px;
    overflow: hidden;
    background: #f3f4f6;
}

.product-image-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.discount-tag {
    position: absolute;
    top: 16px;
    left: 16px;
    background: #ffedd5;
    color: #c2410c;
    font-weight: 700;
    padding: 6px 10px;
    border-radius: 8px;
    font-size: 0.75rem;
}

.product-body {
    padding: 18px;
}

.product-meta {
    display: flex;
    justify-content: space-between;
    gap: 10px;
    margin-bottom: 10px;
    color: var(--muted);
    font-size: 0.82rem;
}

.product-body h3 {
    font-size: 1.08rem;
    margin-bottom: 12px;
    min-height: 52px;
}

.price-box {
    display: flex;
    flex-direction: column;
    gap: 6px;
    margin-bottom: 16px;
}

.price-old {
    color: #9ca3af;
    text-decoration: line-through;
    font-size: 0.82rem;
}

.price-now {
    color: var(--primary);
    font-weight: 800;
    font-size: 1.35rem;
}

.product-foot {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    color: var(--muted);
}

.detail-btn {
    background: #fff2ed;
    color: var(--primary);
    padding: 9px 14px;
    font-weight: 700;
}

.page-container {
    max-width: 1200px;
    margin: 40px auto;
    padding: 0 20px;
}

.auth-body {
    background: linear-gradient(135deg, #fff5f1 0%, #f9fafb 100%);
}

.auth-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 30px 20px;
}

.auth-card {
    background: var(--white);
    width: min(100%, 500px);
    border-radius: 22px;
    box-shadow: var(--shadow);
    padding: 36px 28px;
}

.auth-card h2 {
    text-align: center;
    margin-bottom: 25px;
    font-size: 2rem;
}

.auth-form {
    display: flex;
    flex-direction: column;
    gap: 18px;
}

.field-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.field-group label {
    font-weight: 700;
    color: var(--text);
}

.field-group input,
.field-group textarea {
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 12px 14px;
    font-size: 1rem;
    resize: vertical;
}

.field-group input:focus,
.field-group textarea:focus {
    outline: 2px solid rgba(238, 77, 45, 0.2);
    border-color: var(--primary);
}

.auth-link {
    text-align: center;
    margin-top: 18px;
    color: var(--muted);
}

.alert {
    padding: 12px 14px;
    border-radius: 12px;
    margin-bottom: 18px;
    font-weight: 600;
}

.alert-success {
    background: #ecfdf5;
    color: var(--success);
    border: 1px solid #a7f3d0;
}

.alert-error {
    background: #fef2f2;
    color: var(--error);
    border: 1px solid #fecaca;
}

.product-detail {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: 24px;
    padding: 28px;
}

.product-detail-image img {
    border-radius: 18px;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.product-tag {
    display: inline-block;
    background: #fff2ed;
    color: var(--primary);
    padding: 7px 12px;
    border-radius: 999px;
    font-size: 0.8rem;
    font-weight: 700;
    margin-bottom: 14px;
}

.product-detail-info h1 {
    font-size: clamp(2rem, 2vw, 2.6rem);
    margin-bottom: 18px;
}

.product-rating-row {
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
    color: var(--muted);
    margin-bottom: 18px;
}

.detail-price-box {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 14px;
    margin-bottom: 18px;
}

.old-price {
    color: #9ca3af;
    text-decoration: line-through;
    font-size: 1.1rem;
}

.new-price {
    color: var(--primary);
    font-weight: 800;
    font-size: 2rem;
}

.discount-pill {
    background: #ffedd5;
    color: #c2410c;
    padding: 8px 12px;
    border-radius: 999px;
    font-weight: 700;
}

.product-description {
    color: var(--muted);
    line-height: 1.8;
    margin-bottom: 24px;
}

.product-actions {
    display: flex;
    gap: 14px;
    flex-wrap: wrap;
}

.related-products {
    margin-top: 50px;
}

.cart-layout {
    display: grid;
    grid-template-columns: 1.4fr 0.6fr;
    gap: 24px;
    align-items: start;
}

.cart-items {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.cart-item,
.checkout-card,
.cart-summary,
.order-card,
.empty-box {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: 20px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.03);
}

.cart-item {
    display: grid;
    grid-template-columns: 160px 1.3fr 0.5fr;
    gap: 18px;
    padding: 18px;
    align-items: center;
}

.cart-item img {
    width: 160px;
    height: 160px;
    object-fit: cover;
    border-radius: 16px;
}

.cart-info h3 {
    margin-bottom: 8px;
}

.cart-info p {
    color: var(--muted);
    margin-bottom: 10px;
}

.cart-price-row {
    margin-bottom: 14px;
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--primary);
}

.qty-control {
    display: flex;
    align-items: center;
    gap: 10px;
}

.qty-btn {
    width: 32px;
    height: 32px;
    background: #f3f4f6;
    color: var(--text);
    font-weight: 700;
}

.cart-actions {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 12px;
}

.remove-link {
    color: var(--error);
    font-weight: 700;
}

.cart-summary {
    padding: 22px;
    position: sticky;
    top: 90px;
}

.cart-summary h3,
.checkout-card h3,
.checkout-summary-box h3 {
    margin-bottom: 18px;
    font-size: 1.5rem;
}

.summary-row,
.summary-item {
    display: flex;
    justify-content: space-between;
    gap: 12px;
    padding: 10px 0;
    border-bottom: 1px solid var(--border);
}

.summary-total {
    display: flex;
    justify-content: space-between;
    margin: 18px 0;
    font-size: 1.2rem;
    font-weight: 800;
}

.checkout-page {
    display: block;
}

.checkout-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
    margin-bottom: 24px;
}

.checkout-card,
.checkout-summary-box {
    padding: 24px;
}

.courier-options,
.payment-methods {
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.courier-item,
.payment-option {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 16px 16px;
    background: #fafafa;
}

.checkout-form {
    display: grid;
    grid-template-columns: 1.2fr 0.8fr;
    gap: 24px;
    align-items: start;
}

.payment-card {
    grid-column: 1 / 2;
}

.checkout-summary-box {
    grid-column: 2 / 3;
}

.empty-box {
    padding: 30px 20px;
    text-align: center;
}

.orders-list {
    display: flex;
    flex-direction: column;
    gap: 18px;
}

.order-card {
    padding: 20px 22px;
}

.order-head,
.order-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
}

.status-badge {
    display: inline-block;
    padding: 8px 12px;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
}

.status-pending {
    background: #fff7ed;
    color: #c2410c;
}

.status-paid {
    background: #ecfdf5;
    color: var(--success);
}

.footer {
    background: #111827;
    color: #e5e7eb;
    margin-top: 50px;
    padding: 34px 0;
}

.footer-content {
    display: grid;
    grid-template-columns: 1.2fr 0.8fr 1fr;
    gap: 30px;
}

.footer h3,
.footer h4 {
    margin-bottom: 12px;
}

.footer ul {
    list-style: none;
    display: flex;
    flex-direction: column;
    gap: 10px;
    color: #d1d5db;
}

@media (max-width: 980px) {
    .product-grid,
    .category-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .hero,
    .cart-layout,
    .checkout-form,
    .checkout-grid,
    .product-detail {
        grid-template-columns: 1fr;
    }

    .checkout-card,
    .checkout-summary-box {
        grid-column: auto;
    }

    .nav-inner {
        flex-wrap: wrap;
        justify-content: center;
        padding: 14px 0;
    }
}

@media (max-width: 640px) {
    .category-grid,
    .product-grid,
    .footer-content {
        grid-template-columns: 1fr;
    }

    .hero-actions,
    .product-actions,
    .nav-actions {
        flex-direction: column;
        align-items: stretch;
    }

    .cart-item {
        grid-template-columns: 1fr;
    }

    .cart-item img {
        width: 100%;
        height: 220px;
    }

    .section-header h2 {
        font-size: 1.6rem;
    }
}
