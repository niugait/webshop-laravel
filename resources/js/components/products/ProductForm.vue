<template>
    <form method="POST" :action="route">
        <input v-if="product" name="_method" type="hidden" value="PUT">
        <input type="hidden" name="_token" :value="csrf">
        <div class="form-group row">
            <div class="col">
                <label for="name">
                    <input id="name" type="text" class="form-control" name="name" v-model="form.name" required autocomplete="name" autofocus placeholder="Product Name">
                </label>
            </div>
            <div class="col">
                <label for="category" class="w-100 pr-3">
                    <select class="form-control" id="category" name="category_id" v-model="form.category_id" required autofocus>
                        <option value="0" selected disabled>Choose category...</option>
                        <option v-for="(category, index) in categories" :key="index" :value="category.id">
                            {{ category.name }}
                        </option>
                    </select>
                </label>
            </div>
        </div>
        <div class="form-group row pl-0">
            <div class="col">
                <label for="price">
                    <money v-model="form.price" v-bind="money" class="form-control" required placeholder="Price"></money>
                    <input type="hidden" id="price" name="price" :value="form.price">
                </label>
            </div>
            <div class="col">
                <label for="in_stock">
                    <input id="in_stock" type="number" class="form-control" name="in_stock" v-model="form.in_stock" required autocomplete="in_stock" autofocus placeholder="Amount in stock">
                </label>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary">
                    {{ product ? 'Update' : 'Create'}}
                </button>
            </div>
        </div>
    </form>
</template>

<script>
export default {
    name: "ProductForm",
    data() {
        return {
            form: {
                name: '',
                price: '',
                in_stock: '',
                category_id: 0,
            },
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
        csrf: {
            type: String,
            required: true,
        },
        categories: {
            type: Array,
            required: true,
        },
        product: {
            type: Object,
            required: false,
        },
    },
    created() {
        if (this.product) {
            this.form = this.product
        }
    }
}
</script>

<style scoped>

</style>
