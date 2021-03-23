<template>
    <!-- Page Content-->
    <div class="container padding-bottom-3x mb-2">
        <div class="row">
            <nav-account></nav-account>
            <div class="col-lg-8">
                <div class="padding-top-2x mt-2 hidden-lg-up"></div>
                <div v-if="userOrders.length > 0"  class="table-responsive">
                    <table class="table table-hover margin-bottom-none">
                        <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Date Purchased</th>
                            <th>Status</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr @click="viewOrder(order)" class="cursor" v-for="order in userOrders">
                                <td><a class="text-medium navi-link" href="#" data-toggle="modal" data-target="#orderDetails">{{order.tracking_number}}</a></td>
                                <td>{{order.formatted_date}}</td>
                                <td><span class="text-danger">{{ order.status }}</span></td>
                                <td><span class="text-medium">N{{order.total_amount | formatMoney}}</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <p v-else>No orders yet.</p>

            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapMutations, mapGetters } from 'vuex'
import NavAccount from "./NavAccount";

export default {
    name: "UserOrders",

    components: {NavAccount},

    data(){

        return {



        }

    },

    async mounted(){

        // if (this.userOrders.length === 0){
            await this.getUserOrders({reset: true})
        // }

    },

    computed: {

        ...mapGetters({
            userOrders: 'account/userOrders'
        })

    },

    methods: {

        ...mapMutations({

            setOrder: 'account/setOrder'

        }),

        ...mapActions({

            getUserOrders: 'account/getUserOrders'

        }),

        viewOrder(order){

            this.setOrder(order)
            window.location = '/account/orders/' + order.tracking_number

        }

    }
}
</script>

<style scoped>

</style>
