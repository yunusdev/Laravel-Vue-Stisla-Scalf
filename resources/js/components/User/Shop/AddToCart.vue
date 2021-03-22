<template>

    <div class="modal fade" id="addToCart" data-backdrop="false" tabindex="-1" >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Modal title</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form @submit.prevent="addToCart()">
                    <div class="modal-body">

                        <div v-for="item, key in items" class="row">

                            <div class="col-1" style="">
                                <a class="remove-from-cart mt-2 text-danger cursor" @click="removeItem(item)" data-toggle="tooltip" title="Remove item">
                                    <i class="icon-cross"></i>
                                </a>
                            </div>
                            <div class="col-3">
                                <select required  v-model="item.size" class="form-control mb-2 form-control-sm form-control-rounded">
                                    <option value="">Select</option>
                                    <option v-for="size in sizes">{{ size }}</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <select required v-model="item.color" class="form-control mb-2 form-control-sm form-control-rounded">
                                    <option value="">Select</option>
                                    <option v-for="color in colors">{{ color }}</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <select required v-model="item.quantity"  class="form-control mb-2 form-control-sm form-control-rounded">
                                    <option value="">Select</option>
                                    <option  v-for="index in 11" :key="index" >{{index}}</option>
                                </select>
                            </div>
                        </div>
                        <div class=" text-center">
                            <button style="" class="mt-2 mb-3 btn btn-sm btn-secondary" @click="addMore()">
                                <i class="fas fa-plus"></i> Select More</button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-outline-secondary btn-sm" type="submit">Add To cart</button>
                        <button class="btn btn-primary btn-sm" type="button">Checkout</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</template>

<script>
import { mapActions } from 'vuex'

export default {
    name: "AddToCart",

    props: ['sizes', 'colors', 'product'],

    data(){

      return {

          items: [],
          item: {
              product_id: this.product.id,
              product_name: this.product.name,
              product: this.product,
              product_price: this.product.price,
              size: '',
              color: '',
              quantity: '',
          }

      }

    },

    async mounted() {

        await this.getUserCartItems()
        this.items.push({...this.item})
        this.$parent.$on('show-add-cart', () => {
            $('#addToCart').modal()
        })

    },

    methods: {

        ...mapActions({
            getUserCartItems: 'cart/getUserCartItems',
            addItemsToCart: 'cart/addItemsToCart'
        }),

        addMore(){
            this.items.push({...this.item})
        },
        removeItem(index){
            this.items.splice(index, 1)
        },

        addToCart(){

            this.addItemsToCart(this.items).then((data) => {
                this.notifSuceess('Item Added to cart successfully');
                $('#addToCart').modal('hide')
            }).catch((err) => {
                this.notifError( err.message || 'An error occurred')
            })

        }



    }
}
</script>

<style scoped>

div.sizes h6 {
    height: 42px !important;
}

.item-remove{
    cursor: pointer;
    font-size: 29px;
    font-weight: bolder;
}

.item-remove:hover{
    cursor: pointer;
    font-size: 31px;
    /*margin-top: 6px;*/
}

</style>
