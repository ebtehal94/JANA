<template>
    <div id="product-images" v-if="product_images && product_images.length > 0">
        <div class="vx-row w-full m-0">
            <div class="vx-col md:w-1/5 hide-on-phone">
                <button class="prev w-full m-1" @click="decrement"><vs-icon icon="expand_less"></vs-icon></button>
                <img v-for="(img, index) in product_images.slice(0,5)" :key="index" @click="selectImage(index)" :class="{ 'active': currentImage == index }" class="mini-img m-1" :src="'https://janacard.s3.eu-central-1.amazonaws.com/products/' + img" alt="Product Image">
                <button class="next w-full m-1" @click="increment"><vs-icon icon="expand_more"></vs-icon></button>
            </div>
            <div class="vx-col w-full md:w-4/5  p-0 relative mx-auto block">
                <button class="prev-main mx-10" @click="increment"><vs-icon icon="chevron_left"></vs-icon></button>
                <button class="next-main mx-10" @click="decrement"><vs-icon icon="chevron_right"></vs-icon></button>
                <div class="main-img-container">
                <img :src="'https://janacard.s3.eu-central-1.amazonaws.com/products/' + product_images[currentImage]" alt="Main Image" class="main-img">
                </div>
                <div class="slides flex justify-center items-center">
                    <div class="slide" v-for="(img, index) in product_images" :key="index" @click="selectImage(index)" :class="{ 'active': currentImage == index }"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        product_images: Array,
    },
    data() {
        return {
            // product_images: [ 'red.png', 'gold.png', 'blue.png', 'purple.png'],
            popupActive: false,
            currentImage: 0,
        }
    },
    methods: {
        selectImage(imageIndex) {
            // if (this.currentImage < (this.product_images.length - 1))
                this.currentImage = imageIndex
        },
        increment() {
            if (this.currentImage < (this.product_images.length - 1))
                this.currentImage++
        },
        decrement() {
            if (this.currentImage > 0)
                this.currentImage--
        },
    },
}
</script>

<style lang="scss" scoped>
#product-images {
    .active { border: 2px solid #D5D5D5; }

    .main-img-container {
        // padding-bottom: 100%;

        img.main-img {
            width: 100%;
            height: auto;
        }

    }

    img.mini-img {
        width: 100%;
    }

    .slides {
        position: absolute;
        bottom: 5%;
        width: 100%;

        .slide {
            height: 7.5px;
            width: 20px;
            background-color: #434343;
            border: 2px solid #434343;
            margin: 0.5rem;
        }

        .slide.active {
            background-color: transparent;
        }
    }

    button.prev, button.next {
        border: 0.5px solid #D5D5D5;
        cursor: pointer;
    }

    .prev-main, .next-main {
        position: absolute;
        top: 48%;
        padding: 0.75rem 0.85rem;
        border: 0.5px solid #D5D5D5;
        border-radius: 5rem;
        cursor: pointer;
    }

    .prev-main { right: 0; }

    .zoom {
        background: #D5D5D5;
        position: absolute;
        bottom: 5px;
        right: 0;
        padding: 0.5rem;
        cursor: pointer;
    }
}

@media only screen and (max-width: 768px) {
    #product-images {
        .hide-on-phone {
            display: none;
        }

        img.main-img {
            width: 100%;
            height: 300px;
        }
    }
}

@media only screen and (min-width: 320px) and (max-width: 768px) {
    #product-images {
        .hide-on-phone {
            display: none;
        }

        .main-img-container {
            padding-bottom: 0 !important;

            img.main-img {
                width: 100%;
            }
        }

        .prev-main, .next-main {
            top: 50%;
        }

        .slides {
            top: 80%;
        }
    }
}
</style>
