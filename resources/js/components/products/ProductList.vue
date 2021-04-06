<template>
    <div class="card">
        <div class="card-header">
            Products
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Coupon" name="coupon" v-model="coupon">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="button-coupon" @click="applyCoupon" :disabled="coupon.length < 1">Apply</button>
                </div>
                <div v-if="valid_coupon === ''" class="invalid-feedback d-block">This is not a valid coupon.</div>
                <div v-if="valid_coupon" class="valid-feedback d-block">The coupon was applied!</div>
            </div>
        </div>

        <div class="card-body">
            <div class="alert alert-info" role="alert" v-if="products.length < 1">
                There are no products available.
            </div>
            <div class="card-columns" v-else>
                <div v-for="(product, index) in products_with_discount" :key="index">
                    <product-show
                        :is_admin="is_admin"
                        :route="route_update + '/' + product.id"
                        :route_show="route_show + '/' + product.id"
                        :coupon_route="coupon_route"
                        :coupon_applied_list="coupon_applied"
                        :csrf="csrf"
                        :product="product"
                        :list="true"
                    ></product-show>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ProductList",
    data() {
        return {
            coupon: '',
            valid_coupon: null,
            coupon_applied: false,
            discount_applied: '',
            products_with_discount: 0,

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
        route_update: {
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
        is_admin: {
            type: Boolean,
            required: true,
        },
        products: {
            type: Array,
            required: false,
        },
    },
    methods: {
        applyCoupon: async function () {
            this.coupon_applied = false
            this.valid_coupon = await axios.get(this.coupon_route + '/' + this.coupon)
                .then(function (response) {
                    return response.data
                })
            if (this.valid_coupon) {
                this.coupon_applied = true
            }
        },
        calculateDiscount: function (price, discount, is_percentage) {
            if (is_percentage) {
                return price - (price * discount/100)
            }
            return price - discount
        }
    },
    watch: {
        coupon_applied: function () {
            if (this.coupon_applied) {
                this.products_with_discount = this.products.map((product) => {
                    product.price_with_discount = this.calculateDiscount(product.price, this.valid_coupon.discount, this.valid_coupon.is_percentage)
                    return product
                })
            }
        }
    },
    created() {
        this.products_with_discount = this.products
    }
}
</script>

<style scoped>

</style>
