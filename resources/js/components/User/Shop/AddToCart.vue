<template>

    <div class="modal fade" id="addToCart" data-backdrop="false" tabindex="-1" >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Modal title</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">

                    <div class="row">

                        <div  class="col-2 sizes">
                            <h6 v-for="size in sizes">{{ size }}</h6>
                        </div>
                        <div class="col-4">
                            <div v-for="size in sizes">
                                <input v-model="selected_size" type="hidden">
                                <select  v-model="selected_color[size]" class="form-control mb-2 form-control-sm form-control-rounded">
                                    <option>Select</option>
                                    <option v-for="color in colors">{{ color }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div v-for="size in sizes">
                                <input v-model="selected_size" type="hidden">
                                <select v-model="selected_quantity[size]"  class="form-control mb-2 form-control-sm form-control-rounded">
                                    <option  v-for="index in 11" :key="index - 1" >{{index - 1}}</option>
                                </select>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary btn-sm" type="button" data-dismiss="modal">Continue Shopping</button>
                    <button class="btn btn-primary btn-sm" type="button">Checkout</button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    name: "AddToCart",

    props: ['sizes', 'colors'],

    data(){

      return {

          selected_quantity: [],
          selected_color: [],
          selected_size: '',

      }

    },

    mounted() {
        $('#addToCart').modal()

        this.$parent.$on('show-add-cart', () => {

            $('#addToCart').modal()

        })

    }
}
</script>

<style scoped>

div.sizes h6 {
    height: 42px !important;
}

</style>
