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
<!--                        <div class="gallery-item" data-hash="three"><a href="img/shop/single/03.jpg" data-size="1000x667"><img src="img/shop/single/03.jpg" alt="Product"></a></div>-->
<!--                        <div class="gallery-item" data-hash="four"><a href="img/shop/single/04.jpg" data-size="1000x667"><img src="img/shop/single/04.jpg" alt="Product"></a></div>-->
<!--                        <div class="gallery-item" data-hash="five"><a href="img/shop/single/05.jpg" data-size="1000x667"><img src="img/shop/single/05.jpg" alt="Product"></a></div>-->
                    </div>
                    <ul class="product-thumbnails">
                        <li class="active"><a href="#one"><img :src="product.front_image" alt="Product"></a></li>
                        <li :key="image.id" v-for="image in product.product_images" >
                            <a :href="'#'+ image.id">
                                <img :src="image.path" alt="Product">
                            </a>
                        </li>
<!--                        <li><a href="#three"><img src="img/shop/single/th03.jpg" alt="Product"></a></li>-->
<!--                        <li><a href="#four"><img src="img/shop/single/th04.jpg" alt="Product"></a></li>-->
<!--                        <li><a href="#five"><img src="img/shop/single/th05.jpg" alt="Product"></a></li>-->
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
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta voluptatibus quos ea dolore rem, molestias laudantium et explicabo assumenda fugiat deserunt in, facilis laborum excepturi aliquid nobis ipsam deleniti aut? Aliquid sit hic id velit qui fuga nemo suscipit obcaecati. Officia nisi quaerat minus nulla saepe aperiam sint possimus magni veniam provident.</p>
                <div class="row margin-top-1x">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="size">Size</label>
                            <select class="form-control" id="size">
                                <option>Chooze size</option>
                                <option v-for="size in product.sizes">{{ size }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label for="color">Color</label>
                            <select class="form-control" id="color">
                                <option>Select color</option>
                                <option v-for="color in product.colors">{{ color }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <select class="form-control" id="quantity">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="pt-1 mb-2"><span class="text-medium">SKU:</span> #21457832</div>
                <div class="padding-bottom-1x mb-2"><span class="text-medium">Categories:&nbsp;</span><a class="navi-link" href="#">Men’s shoes,</a><a class="navi-link" href="#"> Snickers,</a><a class="navi-link" href="#"> Sport shoes</a></div>
                <hr class="mb-3">
                <div class="d-flex flex-wrap justify-content-between">
                    <div class="entry-share mt-2 mb-2"><span class="text-muted">Share:</span>
                        <div class="share-links"><a class="social-button shape-circle sb-facebook" href="#" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="socicon-facebook"></i></a><a class="social-button shape-circle sb-twitter" href="#" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="socicon-twitter"></i></a><a class="social-button shape-circle sb-instagram" href="#" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="socicon-instagram"></i></a><a class="social-button shape-circle sb-google-plus" href="#" data-toggle="tooltip" data-placement="top" title="Google +"><i class="socicon-googleplus"></i></a></div>
                    </div>
                    <div class="sp-buttons mt-2 mb-2">
                        <button class="btn btn-outline-secondary btn-sm btn-wishlist" data-toggle="tooltip" title="Whishlist"><i class="icon-heart"></i></button>

<!--                        <button class="btn btn-primary" data-toast data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-circle-check" data-toast-title="Product" data-toast-message="successfuly added to cart!"><i class="icon-bag"></i> Add to Cart</button>-->
                        <button class="btn btn-primary" @click="showAddToCart"><i class="icon-bag"></i> Add to Cart</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Product Tabs-->
        <div class="row padding-top-3x mb-3">
            <div class="col-lg-10 offset-lg-1">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item"><a class="nav-link active" href="#description" data-toggle="tab" role="tab">Description</a></li>
                    <li class="nav-item"><a class="nav-link" href="#reviews" data-toggle="tab" role="tab">Reviews (3)</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="description" role="tabpanel">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error blanditiis a, deserunt magnam pariatur quam suscipit quae. Veniam, deserunt reprehenderit quasi hic recusandae itaque omnis fugiat animi architecto facilis repellendus. Commodi dolorem, eius consectetur. Amet maiores nemo at nobi s aspernatur velit, sequi odio, a veritatis inventore autem esse provident in? Placeat, sunt!</p>
                        <p class="mb-30">Iste assumenda, vitae, aliquam excepturi libero quia ullam quisquam tenetur id sint labore. Pariatur praesentium velit, fugit facere maxime voluptates optio qui? Quidem obcaecati necessitatibus rem aspernatur, mollitia, assumenda explicabo numquam minus eos sapiente totam dicta, laborum dolorum! Vitae distinctio quos non ut fugiat.</p>
                        <div class="row">
                            <div class="col-sm-6">
                                <dl>
                                    <dt>Materials:</dt>
                                    <dd>Leather, Cotton, Rubber, Foam</dd>
                                    <dt>Available Sizes:</dt>
                                    <dd>8.5, 9.0, 9.5, 10.0, 10.5, 11.0, 11.5</dd>
                                    <dt>Available Colors:</dt>
                                    <dd>White/Red/Blue, Black/Orange/Green</dd>
                                </dl>
                            </div>
                            <div class="col-sm-6">
                                <dl>
                                    <dt>Model Year:</dt>
                                    <dd>2016</dd>
                                    <dt>Manufacturer:</dt>
                                    <dd>Reebok Inc.</dd>
                                    <dt>Made In:</dt>
                                    <dd>Taiwan</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="reviews" role="tabpanel">
                        <!-- Review-->
                        <div class="comment">
                            <div class="comment-author-ava"><img src="img/reviews/01.jpg" alt="Review author"></div>
                            <div class="comment-body">
                                <div class="comment-header d-flex flex-wrap justify-content-between">
                                    <h4 class="comment-title">Average quality for the price</h4>
                                    <div class="mb-2">
                                        <div class="rating-stars"><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star"></i><i class="icon-star"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="comment-text">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.</p>
                                <div class="comment-footer"><span class="comment-meta">Francis Burton</span></div>
                            </div>
                        </div>
                        <!-- Review-->
                        <div class="comment">
                            <div class="comment-author-ava"><img src="img/reviews/02.jpg" alt="Review author"></div>
                            <div class="comment-body">
                                <div class="comment-header d-flex flex-wrap justify-content-between">
                                    <h4 class="comment-title">My husband love his new...</h4>
                                    <div class="mb-2">
                                        <div class="rating-stars"><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="comment-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                <div class="comment-footer"><span class="comment-meta">Maggie Scott</span></div>
                            </div>
                        </div>
                        <!-- Review-->
                        <div class="comment">
                            <div class="comment-author-ava"><img src="img/reviews/03.jpg" alt="Review author"></div>
                            <div class="comment-body">
                                <div class="comment-header d-flex flex-wrap justify-content-between">
                                    <h4 class="comment-title">Soft, comfortable, quite durable...</h4>
                                    <div class="mb-2">
                                        <div class="rating-stars"><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="comment-text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                                <div class="comment-footer"><span class="comment-meta">Jacob Hammond</span></div>
                            </div>
                        </div>
                        <!-- Review Form-->
                        <h5 class="mb-30 padding-top-1x">Leave Review</h5>
                        <form class="row" method="post">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="review_name">Your Name</label>
                                    <input class="form-control form-control-rounded" type="text" id="review_name" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="review_email">Your Email</label>
                                    <input class="form-control form-control-rounded" type="email" id="review_email" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="review_subject">Subject</label>
                                    <input class="form-control form-control-rounded" type="text" id="review_subject" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="review_rating">Rating</label>
                                    <select class="form-control form-control-rounded" id="review_rating">
                                        <option>5 Stars</option>
                                        <option>4 Stars</option>
                                        <option>3 Stars</option>
                                        <option>2 Stars</option>
                                        <option>1 Star</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="review_text">Review </label>
                                    <textarea class="form-control form-control-rounded" id="review_text" rows="8" required></textarea>
                                </div>
                            </div>
                            <div class="col-12 text-right">
                                <button class="btn btn-outline-primary" type="submit">Submit Review</button>
                            </div>
                        </form>
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

export default {
    name: "ViewProduct",

    components: {AddToCart, Product},

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
