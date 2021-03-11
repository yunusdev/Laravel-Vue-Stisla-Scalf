<template>

    <div>
        <div class="text-center mb-3">
            <img width="150" height="auto" :src="product.front_image" class="img-fluid" alt="">
        </div>

        <div class="row">

            <div class="col-md-6">
                <label>Name:</label>
                <h6>{{product.name}}</h6>
            </div>
            <div class="col-md-6">
                <label>Code:</label>
                <h6>{{product.code}}</h6>
            </div>
            <div class="col-md-6">
                <label>Price:</label>
                <h6>N{{product.price}}</h6>
            </div>
            <div class="col-md-6">
                <label>Class:</label>
                <h6>{{product.class}}</h6>
            </div>
            <div class="col-md-6">
                <label>Category:</label>
                <h6>{{product.category.name}}</h6>
            </div>
            <div class="col-md-6">
                <label>Sub Category:</label>
                <h6>{{product.sub_category.name}}</h6>
            </div>
            <div class="col-md-6">
                <label>Weight:</label>
                <h6>{{product.weight}}kg</h6>
            </div>
            <div class="col-md-6">
                <label>Available:</label>
                <h6>
                <span class="badge py-2" :class="product.available ? 'badge-primary' : 'badge-warning'">
                    {{product.available ? 'Available' : 'Not Available'}}
                </span>
                </h6>
            </div>
            <div class="col-md-6 mb-3">
                <label>Available Colors:</label>
                <div>
                <span class="badge badge-white border mr-2" v-for="color in product.available_colors.split(',')" >
                    {{color}}
                </span>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label>Available Sizes:</label>
                <div>
                <span class="badge badge-white border mr-2" v-for="size in product.available_sizes.split(',')" >
                    {{size}}
                </span>
                </div>
            </div>
            <div class="col-md-12">
                <label>Images:</label>
                <div>
                    <img :src="image.path" v-for="image in product.product_images" class="mr-3" alt="">
                </div>
            </div>
        </div>

    </div>

</template>

<script>
export default {
    name: "ViewProduct",
    props: ['raw_product'],

    data(){

        return{

            product: JSON.parse(this.raw_product)

        }
    },

}
</script>

<style scoped>

    h6{
        color: #232B35;
        line-height: 1.5em;

    }

    img{
        height: 150px;
        width: 150px;
        border-radius: 8px;
        border: 2px solid #c4cbd4;
    }

</style>
