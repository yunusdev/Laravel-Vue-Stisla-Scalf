<template>
    <div>
        <section class="container padding-top-3x padding-bottom-3x">
            <h3 class="text-center mb-30">Trending Products</h3>
            <carousel-products :products="trendingProducts"></carousel-products>
        </section>
        <section class="container padding-bottom-2x">
            <div class="row justify-content-md-center">
                <div class="col-md-4 col-sm-6">
                    <product-widget :title="'TOP SELLERS'" :num="3" :products="topSellingProducts"></product-widget>
                </div>
                <div class="col-md-4 col-sm-6">
                    <product-widget :title="'NEW ARRIVALS'" :products="newArrivalsProducts"></product-widget>
                </div>
                <!--            <div class="col-md-4 col-sm-6">-->
                <!--                <product-widget></product-widget>-->
                <!--            </div>-->
            </div>
        </section>
    </div>

</template>

<script>
import ProductWidget from "./ProductWidget";
import {mapActions, mapGetters} from "vuex";

export default {
    name: "LeadingProductsHome",

    data(){

        return {



        }

    },
    components: {ProductWidget},

    async mounted() {

        await this.getTrendingProducts({})
        await this.getTopSellingProducts({})
        await this.getNewArrivalsProducts({})

    },

    computed: {

        ...mapGetters({

            topSellingProducts: 'shop/topSellingProducts',
            newArrivalsProducts: 'shop/newArrivalsProducts',
            trendingProducts: 'shop/trendingProducts'

        })

    },

    methods: {

        ...mapActions({

            getTopSellingProducts: 'shop/getTopSellingProducts',
            getNewArrivalsProducts: 'shop/getNewArrivalsProducts',
            getTrendingProducts: 'shop/getTrendingProducts',

        })

    }
}
</script>

<style scoped>

</style>
