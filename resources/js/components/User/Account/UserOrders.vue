<template>
    <!-- Page Content-->
    <div class="container padding-bottom-3x mb-2">
        <div class="row">
            <nav-account :user="user" :raw_url="raw_url"></nav-account>
            <div class="col-lg-8">
                <div class="padding-top-2x mt-2 hidden-lg-up"></div>
                <div v-if="userOrders.length > 0"  class="table-responsive">
                    <table class="table table-hover margin-bottom-none">
                        <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Date Purchased</th>

                        </tr>
                        </thead>
                        <tbody>
                            <tr @click="viewOrder(order)" class="cursor" v-for="order in userOrders">
                                <td><a class="text-medium navi-link" href="#" data-toggle="modal" data-target="#orderDetails">{{order.tracking_number}}</a></td>
                                <td><span class="text-medium">N{{order.total_amount | formatMoney}}</span></td>
                                <td><span class="text-danger">{{ order.status }}</span></td>
                                <td>{{order.formatted_date}}</td>

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

    props: ['raw_url', 'raw_user'],

    components: {NavAccount},

    data(){

        return {

            user: JSON.parse(this.raw_user),

        }

    },

    async mounted(){

        await this.getUserOrders({reset: true})

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
