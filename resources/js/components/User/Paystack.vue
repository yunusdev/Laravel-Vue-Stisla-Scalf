<template>
    <div class="payment">
        <!-- <button type="button" @click="makePayment">Pay</button> -->
    </div>
</template>

<script>
import Vue from 'vue'

export default Vue.extend({
    name: 'Paystack',
    props: ['amount', 'user', 'paystack_pk'],
    methods: {
        makePayment() {
            /* eslint-disable no-undef */
            const that = this
            const handler = PaystackPop.setup({
                key: this.paystack_pk,
                email: this.user ? this.user.email : '',
                amount: this.amount * 100,
                currency: 'NGN',
                reference: 'REF-' + Date.now(),
                firstName: this.user ? this.user.name : '',
                callback: function(response) {
                    if (response.status === 'success') {
                        that.$emit('payment-successful', response)
                    } else {
                        that.$emit('payment-failed', response)
                    }
                },
                onError: function(response) {
                    that.$emit('go-back', null)
                },
                onClose: function() {
                    that.$emit('go-back', null)
                }
            })
            handler.openIframe()
        },
        pressed(value) {
            this.selectedPackageIndex = value
        }
    }
})
</script>

<style scoped>
</style>
