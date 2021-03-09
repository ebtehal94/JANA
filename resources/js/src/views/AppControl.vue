<template>
    <div id="app-control">
        <div class="vx-row">
            <div class="vx-col w-full">
                <vx-card class="mt-8 pt-0">
                    <div class="vx-row">
                    </div>
                </vx-card>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    components: {
        
    },
    props:{
        stores:{
            type:Array
        }
    },
    data() {
        return {

        }
    }
}
</script>

<style lang="scss" scoped>
#app-control{
    margin: 0 3rem 3rem 3rem;
    .vx-card{
        box-shadow: none;
    }
    .vx-row{
        margin: 0;
    }
    .vx-row > .vx-col {
        padding: 0 .6rem;
    }
}  
</style>