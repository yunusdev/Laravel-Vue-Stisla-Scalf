<template>
    <div class="container padding-bottom-3x mb-2">
        <div class="row">
            <nav-account :raw_url="raw_url" :user="user"></nav-account>
            <div class="col-lg-8">
                <h4 class="mt-3">Profile</h4>
                <hr class="mb-4">
                <form v-if="user" @submit.prevent="updateProfile" class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="account-fn">Name</label>
                            <input required  :class="{'is-invalid': errors.hasError('name')}"  v-model="user.name" class="form-control" type="text" id="account-fn" value="Daniel">
                            <div class="invalid-feedback" v-if="errors.hasError('name')">{{ errors.first('name') }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="account-email">E-mail Address</label>
                            <input required :class="{'is-invalid': errors.hasError('email')}"  v-model="user.email" class="form-control" type="email" id="account-email" value="daniel.adams@mail.com" disabled>
                            <div class="invalid-feedback" v-if="errors.hasError('email')">{{ errors.first('email') }}</div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="account-phone">Phone Number</label>
                            <input required :class="{'is-invalid': errors.hasError('phone')}"  v-model="user.phone" class="form-control" type="text" id="account-phone" value="+7(805) 348 95 72">
                            <div class="invalid-feedback" v-if="errors.hasError('phone')">{{ errors.first('phone') }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="account-pass">New Password</label>
                            <input  :class="{'is-invalid': errors.hasError('password')}"  v-model="user.password" class="form-control" type="password" id="account-pass">
<!--                            <div class="invalid-tooltip">The password confirmation does not match.</div>-->
                            <div class="invalid invalid-tooltip" v-if="errors.hasError('password')">{{ errors.first('password') }}</div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="account-confirm-pass">Confirm Password</label>
                            <input  v-model="user.password_confirmation" class="form-control" type="password" id="account-confirm-pass">
                            <div class="invalid-feedback" v-if="errors.hasError('password_confirmation')">{{ errors.first('password_confirmation') }}</div>

                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex flex-wrap justify-content-between align-items-center">
                            <div class="custom-control custom-checkbox d-block">
                            </div>
                            <button class="btn btn-primary margin-right-none" type="submit">Update Profile</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import NavAccount from "./NavAccount";
import ErrorBag from "../../error_bag";

class User{

    constructor(user) {

        this.name = user.name || ''
        this.phone = user.phone || ''
        this.email = user.email || ''
        this.password = user.password || ''
        this.password_confirmation = user.password_confirmation || ''
    }

}
export default {
    name: "UserProfile",

    props: ['raw_user', 'raw_url'],

    components: {NavAccount},

    data(){

        return {

            user: null,
            errors: new ErrorBag

        }

    },

    mounted() {
        const user = JSON.parse(this.raw_user)
        this.user = new User(user)
    },

    methods: {

        updateProfile(){

            this.$http.put('/account/profile', this.user).then(async (res) => {
                this.notifSuceess('Profile updated successfully')

            }).catch(err => {
                if (err.response && err.response.status === 422) {
                    const errors = err.response.data.errors;
                    this.errors.setErrors(errors);
                }
                this.notifError( err.message || 'An error occurred')
            })

        }

    }

}
</script>

<style scoped>

</style>
