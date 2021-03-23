<template>
    <div class="grid-item">
        <div class="product-card">
            <a class="product-thumb" :href="'/product/' + product.slug">
<!--                <img src="img/shop/products/02.jpg" alt="Product">-->
                <img style="height: 145px" :src="product.front_image" alt="Product">
            </a>
            <h3 class="product-title"><a :href="'/product/' + product.slug">{{product.name}}</a></h3>
            <h4 class="product-price">N{{product.price}}</h4>
            <div class="product-buttons">
                <wishlist :product="product"></wishlist>
                <button class="btn btn-outline-primary btn-sm" data-toast data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-circle-check" data-toast-title="Product" data-toast-message="successfuly added to cart!">Add to Cart</button>
            </div>
        </div>
    </div>
</template>

<script>
import Wishlist from "./Wishlist";
export default {
    name: "Product",

    props: ['product'],

    components: {Wishlist},

    methods: {

        addOrRemoveWishlist(){



        }
    }
}
</script>

<style scoped>

</style>
