@props([
    'redcliffcartitems' => collect(),
])

<style>
/* Floating Rectangular Cart */
.floating-cart_redcliff {
    position: fixed;
    bottom: 88px;
    right: 20px;
    min-width: 140px;
    height: 56px;
    background: #0d6efd; /* Bootstrap primary */
    color: #fff;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 0 14px;
    cursor: pointer;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
    z-index: 9999;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.floating-cart:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 25px rgba(0, 0, 0, 0.35);
}

/* Cart Icon */
.floating-cart i 
{
    font-size: 22px;
}

/* Cart Text */
.cart-text 
{
    font-size: 15px;
    font-weight: 600;
    letter-spacing: 0.3px;
}

/* Cart Badge */
.cart_badge_redcliff 
{
    background: #dc3545; /* Bootstrap danger */
    color: #fff;
    font-size: 12px;
    font-weight: 600;
    min-width: 22px;
    height: 22px;
    padding: 0 6px;
    border-radius: 11px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.display_none {
    display: none !important;
}
</style>

<a href="{{ route('retailer.redcliffcartview') }}" class="floating-cart_redcliff  redcliff_cart text-decoration-none {{ $redcliffcartitems->count() == 0 ? 'display_none' : '' }}">
    <i class="bi bi-cart3"></i>

    <span class="cart-text_redcliff">Redcliffcart</span>

        <span class="cart_badge_redcliff">
            {{ $redcliffcartitems->count() }}
        </span>

    </a>
