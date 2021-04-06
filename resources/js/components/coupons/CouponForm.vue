<template>
    <form method="POST" :action="route">
        <input v-if="coupon" name="_method" type="hidden" value="PUT">
        <input type="hidden" name="_token" :value="csrf">
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Coupon name *</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" v-model="form.name" required autocomplete="name" autofocus>
            </div>
        </div>
        <div class="form-group row">
            <label for="code" class="col-md-4 col-form-label text-md-right">Code *</label>

            <div class="col-md-6">
                <input id="code" type="text" class="form-control" name="code" v-model="form.code" @input="form.code = form.code.toUpperCase()" required autocomplete="code" autofocus>
            </div>
        </div>
        <div class="form-group row">
            <label for="discount" class="col-md-4 col-form-label text-md-right">Discount *</label>

            <div class="col-md-6">
                <money v-model="form.discount" v-bind="money" class="form-control" required placeholder="Price"></money>
                <input type="hidden" id="discount" name="discount" :value="form.discount">
                <small id="priceHelp" class="form-text text-muted">Discount has to be bigger than 0.</small>
                <div class="custom-control custom-switch pt-2">
                    <input type="checkbox" class="custom-control-input" id="percentage" name="is_percentage" v-model="form.is_percentage">
                    <label class="custom-control-label" for="percentage">Percentage</label>
                </div>
                <div class="custom-control custom-switch pt-2">
                    <input type="checkbox" class="custom-control-input" id="expires" v-model="expires">
                    <label class="custom-control-label" for="expires">Has expiration date</label>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6 offset-4">
                <vc-date-picker
                    v-if="expires"
                    v-model="form.expires_at"
                    :model-config="modelConfig"
                    :min-date='minDate'
                    class="form-control"
                />
                <input type="hidden" id="expires_at" name="expires_at" :value="form.expires_at">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6 offset-4">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" v-model="form.is_active">
                    <label class="custom-control-label" for="is_active">Activate coupon</label>
                </div>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary" :disabled="!canSubmit">
                    {{ coupon ? 'Update' : 'Create'}}
                </button>
            </div>
        </div>
    </form>
</template>

<script>
export default {
    name: "CouponForm",
    data() {
        return {
            form: {
                name: '',
                code: '',
                discount: '',
                expires_at: null,
                is_percentage: false,
                is_active: true,
            },
            expires: false,

            modelConfig: {
                type: 'string',
                mask: 'iso',
                timeAdjust: '12:00:00',
            },
            money: {
                decimal: ',',
                thousands: '.',
                prefix: 'R$ ',
                suffix: '',
                precision: 2,
                masked: false
            }
        }
    },
    methods: {
        checkExpiration: function () {
            if (this.expires) {
                let coupon = new Date(this.coupon.expires_at)
                let today = new Date()
                if (today > coupon) {
                    this.form.expires_at = null
                }
            }
        }
    },
    computed: {
        canSubmit: function () {
            if (this.expires && !this.form.expires_at) {
                return false
            }
            return this.form.discount > 0
        },
        percentage: function () {
            return this.form.is_percentage
        },
        minDate: function () {
            let date = new Date()
            return date.setDate(date.getDate() + 1)
        }
    },
    watch: {
        percentage: function () {
            if (this.percentage) {
                this.money.prefix = ''
                this.money.suffix = '%'
            } else {
                this.money.prefix = 'R$ '
                this.money.suffix = ''
            }
        },
        expires: function () {
            if (!this.expires) {
                this.form.expires_at = null
            }
        }
    },
    props: {
        route: {
            type: String,
            required: true,
        },
        csrf: {
            type: String,
            required: true,
        },
        coupon: {
            type: Object,
            required: false,
        },
    },
    created() {
        if (this.coupon) {
            this.form = this.coupon
            this.expires = !!this.coupon.expires_at
            this.checkExpiration()
        }
    }
}
</script>

<style scoped>

</style>
