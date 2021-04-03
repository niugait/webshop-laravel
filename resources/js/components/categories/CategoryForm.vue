<template>
    <form method="POST" :action="route">
        <input type="hidden" name="_token" :value="csrf">
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Category name</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" value="" required autocomplete="name" autofocus>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    Create
                </button>
            </div>
        </div>
    </form>
</template>

<script>
export default {
name: "CategoryForm",
    props: {
        route: {
            type: String,
            required: true,
        },
        csrf: {
            type: String,
            required: true,
        },
    }
}
</script>

<style scoped>

</style>
