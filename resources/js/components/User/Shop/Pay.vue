<template>

    <div class="modal fade" id="payAmount" data-backdrop="false" tabindex="-1" >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Payment</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body text-center">
                    <p><span class="text-small">Pay: </span>
                        <span class="text-primary f-29 font-weight-bold">N{{amount | formatMoney}}</span>
                    </p>

<!--                    <h3>Pay: N{{amount | formatMoney}}</h3>-->
                    <paystack
                        @payment-successful="callback"
                        @go-back=""
                        ref="paystackPayment"
                        :user="remitaUser"
                        id="paystack"
                        :amount="amount"
                        :paystack_pk="paystack_pk"
                    />
                    <button class="btn btn-primary btn-sm" type="button">
                        <i class="fa fa-money"></i>Pay
                    </button>
                </div>
<!--                <div class="modal-footer">-->
<!--                    <button class="btn btn-outline-secondary btn-sm" type="submit">Add To cart</button>-->
<!--                    <button class="btn btn-primary btn-sm" type="button">Checkout</button>-->
<!--                </div>-->
            </div>
        </div>
    </div>

</template>

<script>
export default {
    name: "Pay",

    props: ['amount', 'paystack_pk', 'user']
}
</script>

<style scoped>

</style>
