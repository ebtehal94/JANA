<template>
    <div>
        <span class="cursor-pointer text-primary flex items-center i18n-locale p-2">
            {{ $t("currency") }} <span class="text-dark px-2">{{ currency }}</span>
        </span>
    </div>
</template>

<script>
export default {
    data() {
        return {
            currency: ''
        }
    },
    computed: {
      countries () {
        return this.$store.state.CountriesList
      },
    },
    created() {
        for (const el of this.countries) {
            if (localStorage.getItem("country") == el.id) {
                this.currency = el.currency
                localStorage.setItem("currency", this.currency);
            }
        }
    },
}
</script>
