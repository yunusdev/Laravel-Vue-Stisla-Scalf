<template>
    <div class="container padding-bottom-3x mb-1">

        <div class="row">
            <!-- Poduct Gallery-->
            <div class="col-md-6">
                <div class="product-gallery"><span class="product-badge text-danger">30% Off</span>
                    <div class="gallery-wrapper">
                        <div class="gallery-item video-btn text-center"><a href="#" data-toggle="tooltip" data-type="video" data-video="&lt;div class=&quot;wrapper&quot;&gt;&lt;div class=&quot;video-wrapper&quot;&gt;&lt;iframe class=&quot;pswp__video&quot; width=&quot;960&quot; height=&quot;640&quot; src=&quot;//www.youtube.com/embed/B81qd2v6alw?rel=0&quot; frameborder=&quot;0&quot; allowfullscreen&gt;&lt;/iframe&gt;&lt;/div&gt;&lt;/div&gt;" title="Watch video"></a></div>
                    </div>
                    <div class="product-carousel owl-carousel gallery-wrapper">
                        <div class="gallery-item" data-hash="one"><a :href="product.front_image" data-size="1000x667">
                            <img :src="product.front_image" alt="Product"></a></div>
                        <div class="gallery-item" :key="image.id" v-for="image in product.product_images" :data-hash="image.id">
                            <a :href="image.path" data-size="1000x667">
                                <img :src="image.path" alt="Product">
                            </a>
                        </div>
                    </div>
                    <ul class="product-thumbnails">
                        <li class="active"><a href="#one"><img :src="product.front_image" alt="Product"></a></li>
                        <li :key="image.id" v-for="image in product.product_images" >
                            <a :href="'#'+ image.id">
                                <img :src="image.path" alt="Product">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Product Info-->
            <div class="col-md-6">
                <div class="padding-top-2x mt-2 hidden-md-up"></div>
                <h2 class="padding-top-1x text-normal">{{product.name}}</h2>
                <span class="h2 d-block">
<!--                    <del class="text-muted text-normal">$68.00</del>&nbsp; -->
                    N{{product.price}}
                </span>
                <p class="text-justify" v-if="product.description">{{product.description}}</p>

                <div class="pt-1 mb-2"><span class="">Code:</span> #{{ product.code }}</div>
                <div class="mb-2">
                    <span class="">Category:&nbsp;</span>
                    <a class="navi-link" :href="`/category/${product.category.slug}/products`"> {{ product.category.name }}</a>
                </div>
                <div class="mb-4">
                    <span class="">Sub Category:&nbsp;</span>
                    <a class="navi-link" :href="`/sub-category/${product.sub_category.slug}/products`"> {{ product.sub_category.name }}</a>
                </div>
                <dt>Available Sizes:</dt>
                <dd>{{product.available_sizes.split(',').join(', ')}}</dd>
                <dt>Available Colors:</dt>
                <dd>{{product.available_colors.split(',').join(', ')}}</dd>
                <hr class="mb-3">
                <div class="d-flex flex-wrap justify-content-between">
                    <div class="entry-share mt-2 mb-2"><span class="text-muted">Share:</span>
                        <div class="share-links"><a class="social-button shape-circle sb-facebook" href="#" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="socicon-facebook"></i></a><a class="social-button shape-circle sb-twitter" href="#" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="socicon-twitter"></i></a><a class="social-button shape-circle sb-instagram" href="#" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="socicon-instagram"></i></a><a class="social-button shape-circle sb-google-plus" href="#" data-toggle="tooltip" data-placement="top" title="Google +"><i class="socicon-googleplus"></i></a></div>
                    </div>
                    <div class="sp-buttons mt-2 mb-2">
                        <wishlist :product="product"></wishlist>

<!--                        <button class="btn btn-primary" data-toast data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-circle-check" data-toast-title="Product" data-toast-message="successfuly added to cart!"><i class="icon-bag"></i> Add to Cart</button>-->
                        <button class="btn btn-primary" @click="showAddToCart"><i class="icon-bag"></i> Add to Cart</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Related Products Carousel-->
        <h3 class="text-center padding-top-2x mt-2 padding-bottom-1x">You May Also Like</h3>
        <!-- Carousel-->
        <div class="owl-carousel" data-owl-carousel="{ &quot;nav&quot;: false, &quot;dots&quot;: true, &quot;margin&quot;: 30, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;576&quot;:{&quot;items&quot;:2},&quot;768&quot;:{&quot;items&quot;:3},&quot;991&quot;:{&quot;items&quot;:4},&quot;1200&quot;:{&quot;items&quot;:4}} }">
            <!-- Product-->
            <product v-for="product, key in related_products" :key="product.name" :product="product"></product>

        </div>
        <add-to-cart :sizes="product.sizes" :product="product" :colors="product.colors"></add-to-cart>

    </div>


</template>

<script>
import Product from "./Product";
import AddToCart from "./AddToCart";
import Wishlist from "./Wishlist";

export default {
    name: "ViewProduct",

    components: {AddToCart, Product, Wishlist},

    props: ['raw_product', 'raw_related_products'],

    data(){

        return {

            product: JSON.parse(this.raw_product),
            related_products: JSON.parse(this.raw_related_products),

        }

    },

    methods: {

        showAddToCart(){

            this.$emit('show-add-cart')

        }
    }
}
</script>

<style scoped>

div.gallery-item img{
    height: 349px;
}

ul.product-thumbnails img{
    height: 66px;
    width: 92px;

}

</style>
