<template>
    <div class="widget widget-featured-products">
        <h3 class="widget-title">{{ title }}</h3>
        <!-- Entry-->
        <div v-for="product, key in products" v-if="!num || num > key" class="entry">
            <div class="entry-thumb"><a :href="'/product/' + product.slug"><img class="widget-img" :src="product.front_image" :alt="product.name"></a></div>
            <div class="entry-content content">
                <h4 class="entry-title"><a :href="'/product/' + product.slug">{{product.name}}</a></h4><span class="entry-meta">N{{product.price | formatMoney}}</span>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    name: "ProductWidget",

    props: ['title', 'products', 'num']
}
</script>

<style scoped>

.widget-img{
    width: 50px;
    height: 50px;
    /*border: 2px solid #aaa;*/
    /*border-color: #aaa;*/
}
h4, .entry-meta{
    margin-left: 7px !important;
}
</style>
