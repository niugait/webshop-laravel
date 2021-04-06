<template>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <a v-if="is_admin" class="btn btn-outline-info height-button" :href="route">Edit</a>
            <a v-if="list" class="btn btn-outline-success" :href="route_show">View</a>
            <div class="col-md-6" v-if="!list">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Coupon" name="coupon" v-model="coupon">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="button-coupon" @click="applyCoupon" :disabled="coupon.length < 1">Apply</button>
                    </div>
                    <div v-if="valid_coupon === ''" class="invalid-feedback d-block">This is not a valid coupon.</div>
                    <div v-if="valid_coupon" class="valid-feedback d-block">The coupon was applied!</div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ product.name }}</h5>
            <div v-if="coupon_applied_list">
                <div class="card-text line-through">{{ product.price }}</div>
                <money v-model="product.price_with_discount" v-bind="money" class="card-text border-0" readonly></money>
            </div>
            <div v-else>
                <div class="card-text" :class="{ 'line-through' : coupon_applied}">{{ product.price }}</div>
                <money v-if="coupon_applied" v-model="discount_applied" v-bind="money" class="card-text border-0" readonly></money>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <small v-if="product.category" class="text-muted">Category: {{ product.category.name }}</small>
            <small class="text-muted">{{ product.in_stock }} left</small>
        </div>
    </div>
</template>

<script>
export default {
    name: "ProductShow",
    data() {
        return {
            coupon: '',
            valid_coupon: null,
            coupon_applied: false,
            discount_applied: '',

            money: {
                decimal: ',',
                thousands: '.',
                prefix: 'R$ ',
                precision: 2,
                masked: false
            }
        }
    },
    props: {
        route: {
            type: String,
            required: true,
        },
        route_show: {
            type: String,
            required: true,
        },
        coupon_route: {
            type: String,
            required: true,
        },
        csrf: {
            type: String,
            required: true,
        },
        coupon_applied_list: {
            type: Boolean,
            required: false,
        },
        is_admin: {
            type: Boolean,
            required: true,
        },
        list: {
            type: Boolean,
            required: false,
        },
        product: {
            type: Object,
            required: false,
        },
    },
    methods: {
        applyCoupon: async function () {
            this.valid_coupon = await axios.get(this.coupon_route + '/' + this.coupon)
                .then(function (response) {
                    return response.data
                })
            if (this.valid_coupon) {
                this.coupon_applied = true
                if (this.valid_coupon.is_percentage) {
                    this.discount_applied = this.product.price - (this.product.price * this.valid_coupon.discount/100)
                } else {
                    this.discount_applied = this.product.price - this.valid_coupon.discount
                }
            }
        }
    }
}
</script>

<style lang="scss" scoped>
.height-button {
    height: 37px;
}
.line-through {
    text-decoration: line-through;
}

</style>
