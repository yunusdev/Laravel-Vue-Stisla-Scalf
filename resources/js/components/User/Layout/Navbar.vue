
<template>

    <div>

        <div class="offcanvas-container" id="shop-categories">
            <div class="offcanvas-header">
                <h3 class="offcanvas-title">Shop Categories</h3>
            </div>
            <nav class="offcanvas-menu">
                <ul class="menu">
                    <li v-for="category in categories" :key="category.id" class="has-children">
                        <span><a :href="`/category/${category.slug}/products`">{{category.name}}</a>
                            <span class="sub-menu-toggle"></span>
                        </span>
                        <ul class="offcanvas-submenu">
                            <li v-for="sub_cat in category.sub_categories" :key="sub_cat.id">
                                <a :href="`/sub-category/${sub_cat.slug}/products`">{{ sub_cat.name }}</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="offcanvas-container" id="mobile-menu">
            <a class="account-link" href="account-orders.html">
                <div class="user-info" v-if="user">
                    <h6 class="user-name">{{user.name}}</h6>
                </div>
            </a>
            <nav class="offcanvas-menu">
                <ul class="menu">
                    <li class="has-children" :class="isActiveUrl('')">
                        <span>
                            <a href="/"><span>Home</span></a>
                        </span>
                    </li>
                    <li class="has-children" :class="isActiveUrl('/shop')">
                        <span>
                            <a href="/shop"><span>Shop</span></a>
                        </span>
                    </li>
                    <li  class="has-children" :class="isActiveUrl('/cart')">
                        <span>
                            <a href="/cart"><span>Cart</span></a>
                        </span>
                    </li>
                    <li v-if="user" class="has-children" :class="isActiveUrl('/account/orders')">
                        <span>
                            <a href="/account/orders"><span>Orders</span></a>
                        </span>
                    </li>

                    <li class="has-children"><span><a href="#"><span>Account</span></a><span class="sub-menu-toggle"></span></span>
                        <ul class="offcanvas-submenu">
                            <li :class="isActiveUrl('/login')" v-if="!user"><a href="/login">Login</a></li>
                            <li :class="isActiveUrl('/register')" v-if="!user"><a href="/register">Register</a></li>
                            <li :class="isActiveUrl('/account/wishlist')"  v-if="user"><a href="/account/wishlist">Wishlist</a></li>
                            <li :class="isActiveUrl('/account/profile')" v-if="user"><a href="/account/profile">Profile</a></li>
                            <li v-if="user" class="sub-menu-separator"></li>
                            <li v-if="user"><a href="/logout"> <i class="icon-unlock"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="topbar">
            <div class="topbar-column"><a class="hidden-md-down" href="mailto:support@unishop.com"><i class="icon-mail"></i>&nbsp; support@unishop.com</a><a class="hidden-md-down" href="tel:00331697720"><i class="icon-bell"></i>&nbsp; 00 33 169 7720</a><a class="social-button sb-facebook shape-none sb-dark" href="#" target="_blank"><i class="socicon-facebook"></i></a><a class="social-button sb-twitter shape-none sb-dark" href="#" target="_blank"><i class="socicon-twitter"></i></a><a class="social-button sb-instagram shape-none sb-dark" href="#" target="_blank"><i class="socicon-instagram"></i></a><a class="social-button sb-pinterest shape-none sb-dark" href="#" target="_blank"><i class="socicon-pinterest"></i></a>
            </div>
            <div class="topbar-column">
                <a v-if="!user" class="hidden-md-down" href="/login"><i class=""></i>&nbsp; Login</a>
                <a v-if="!user" class="hidden-md-down" href="/register"><i class=""></i>&nbsp; Register</a>
                <div class="lang-currency-switcher-wrap">
                    <div class="lang-currency-switcher dropdown-toggle"><span class="language"><img alt="English" src="/img/flags/GB.png"></span><span class="currency">$ USD</span></div>
                    <div class="dropdown-menu">
                        <div class="currency-select">
                            <select class="form-control form-control-rounded form-control-sm">
                                <option value="usd">$ USD</option>
                                <option value="usd">€ EUR</option>
                                <option value="usd">£ UKP</option>
                                <option value="usd">¥ JPY</option>
                            </select>
                        </div><a class="dropdown-item" href="#"><img src="/img/flags/FR.png" alt="Français">Français</a><a class="dropdown-item" href="#"><img src="img/flags/DE.png" alt="Deutsch">Deutsch</a><a class="dropdown-item" href="#"><img src="img/flags/IT.png" alt="Italiano">Italiano</a>
                    </div>
                </div>
            </div>
        </div>
        <header class="navbar navbar-sticky">
            <div class="site-branding">
                <div class="inner">
                    <a class="offcanvas-toggle cats-toggle" href="#shop-categories" data-toggle="offcanvas"></a>
                    <a class="offcanvas-toggle menu-toggle" href="#mobile-menu" data-toggle="offcanvas"></a>
                    <a class="site-logo" href="/">
                        <h3>MY WEARS</h3>
                    </a>
                </div>
            </div>
            <nav class="site-menu">
                <ul>
                    <li class="has-megamenu" :class="isActiveUrl('')">
                        <a href="/"><span>Home</span></a>
                    </li>
                    <li :class="isActiveUrl('/shop')"><a href="/shop" ><span>Shop</span></a>
                    </li>
                    <li class="has-megamenu" :class="isActiveUrl('/cart')">
                        <a href="/cart"><span>Cart</span></a>
                    </li>
                    <li v-if="user" class="has-megamenu" :class="isActiveUrl('/account/orders')">
                        <a href="/account/orders"><span>Orders</span></a>
                    </li>
                </ul>
            </nav>
            <!-- Toolbar-->
            <div class="toolbar">
                <div class="inner">
                    <div class="tools">
                        <div class="account"><a href="#"></a><i class="icon-head"></i>
                            <ul class="toolbar-dropdown">
                                <li v-if="user" class="sub-menu-user">
                                    <div class="user-ava"><img src="https://icotar.com/avatar/craig.png?s=200" :alt="user.name">
                                    </div>
                                    <div class="user-info">
                                        <h6 class="user-name">{{ user.name }}</h6><span class="text-xs text-muted">290 Reward points</span>
                                    </div>
                                </li>
                                <li :class="isActiveUrl('/login')" v-if="!user"><a href="/login">Login</a></li>
                                <li :class="isActiveUrl('/register')" v-if="!user"><a href="/register">Register</a></li>
                                <li :class="isActiveUrl('/account/wishlist')"  v-if="user"><a href="/account/wishlist">Wishlist</a></li>
                                <li :class="isActiveUrl('/account/profile')" v-if="user"><a href="/account/profile">Profile</a></li>
                                <li v-if="user" class="sub-menu-separator"></li>
                                <li v-if="user"><a href="/logout"> <i class="icon-unlock"></i>Logout</a></li>
                            </ul>
                        </div>
                        <div class="cart"><a href="/cart"></a><i class="icon-bag"></i><span class="count">{{totalQty}}</span><span class="subtotal">N{{subTotalAmount | formatMoney}}</span>
                            <div  class="toolbar-dropdown">
                                <div v-if="cartItems && cartItems.length > 0" v-for="item in cartItems" class="dropdown-product-item">
                                <span @click="removeItem(item)" class="cursor dropdown-product-remove">
                                    <i class="icon-cross"></i>
                                </span>
                                    <a class="dropdown-product-thumb" :href="'/product/' + item.product.slug">
                                        <img class="cart_image" :src="item.product.front_image" alt="Product">
                                    </a>
                                    <div class="dropdown-product-info">
                                        <a class="dropdown-product-title" :href="'/product/' + item.product.slug">{{item.product_name}} <span style="" class="text-muted dropdown-product-details">({{item.size}})</span></a>

                                        <span class="dropdown-product-details">{{item.quantity}} x N{{item.product_price | formatMoney}}</span>
                                    </div>
                                </div>
                                <div v-if="cartItems && cartItems.length > 0" class="toolbar-dropdown-group">
                                    <div class="column"><span class="text-lg">Total:</span></div>
                                    <div class="column text-right"><span class="text-lg text-medium">N{{subTotalAmount | formatMoney}}&nbsp;</span></div>
                                </div>
                                <div v-if="cartItems && cartItems.length > 0" class="toolbar-dropdown-group">
                                    <div class="column"><a class="btn btn-sm btn-block btn-secondary" href="/cart">View Cart</a></div>
                                    <div class="column"><a class="btn btn-sm btn-block btn-success" href="/checkout">Checkout</a></div>
                                </div>
                                <p class="text-center" style="margin-top: 10px" v-else>No Items in Cart</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>


    </div>

</template>

<script>
import store from '../../../store/index'
import { mapActions, mapGetters } from 'vuex'

export default {
    name: "Navbar",

    props: ['raw_user', 'raw_url'],

    data(){

        return {

            user: this.raw_user ? JSON.parse(this.raw_user) : null,
            url: JSON.parse(this.raw_url)

        }

    },
    async mounted() {

        await this.getUserCartItems()
        await this.getCategories({})

    },

    computed: {
        ...mapGetters({
            cartItems: 'cart/items',
            subTotalAmount: 'cart/subTotalAmount',
            categories: 'shop/categories',
            totalQty: 'cart/totalQty'

        }),
    },

    methods: {

        ...mapActions({
            getUserCartItems: 'cart/getUserCartItems',
            getCategories: 'shop/getCategories',
            removeItemFromCart: 'cart/removeItemFromCart',

        }),

        removeItem(item){
            this.removeItemFromCart(item.id).then((data) => {
                this.notifSuceess('Item Deleted successfully');
            }).catch((err) => {
                this.notifError( err.message || 'An error occurred')
            })
        },

        isActiveUrl(url){
            return this.url.base + url === this.url.current ? 'active' : ''
        },


    }


}
</script>

<style scoped>

.cart_image{
    height: 50px;
    width: 35px;
}

</style>
