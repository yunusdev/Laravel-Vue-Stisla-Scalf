<template>
    <div class="owl-carousel" data-owl-carousel="{ &quot;nav&quot;: false, &quot;dots&quot;: true, &quot;margin&quot;: 30, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;576&quot;:{&quot;items&quot;:2},&quot;768&quot;:{&quot;items&quot;:3},&quot;991&quot;:{&quot;items&quot;:4},&quot;1200&quot;:{&quot;items&quot;:4}} }">
        <!-- Product-->
        <product v-for="product, key in products" :key="product.name" :product="product"></product>

    </div>
</template>

<script>

import Product from "./Shop/Product";

export default {

    name: "CarouselProducts",

    props: ['raw_products'],

    components: {Product},

    data(){

        return {

            products: JSON.parse(this.raw_products),

        }

    }

}
</script>

<style scoped>

</style>
