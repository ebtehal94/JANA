<template>
    <div id="product-images" v-if="product_images && product_images.length > 0">
        <div class="vx-row w-full">
            <div class="vx-col w-full p-0 relative">
                <button class="prev-main mx-3" @click="increment"><vs-icon size="medium" color="#fff" icon="chevron_left"></vs-icon></button>
                <button class="next-main mx-3" @click="decrement"><vs-icon size="medium" color="#fff" icon="chevron_right"></vs-icon></button>
                <img :src="'https://otantik-home.s3.me-south-1.amazonaws.com/products/' + product_images[currentImage]" alt="Main Image" class="main-img">
                <!-- <div class="zoom"><vs-icon icon="zoom_in" size="medium"></vs-icon></div> -->
                <!-- <div class="slider w-full">
                    <button class="prev m-1" @click="decrement"><vs-icon icon="chevron_left" size="medium" color="#fff"></vs-icon></button>
                    <img v-for="(img, index) in product_images" :key="index" @click="selectImage(index)" :class="{ 'active': currentImage == index }" class="mini-img m-1" :src="'https://otantik-home.s3.me-south-1.amazonaws.com/products/' + img" alt="Product Image">
                    <button class="next m-1" @click="increment"><vs-icon icon="chevron_right" size="medium" color="#fff"></vs-icon></button>
                  </div> -->
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

    img.main-img {
        width: 100%;
    }

    img.mini-img {
        width: 100%;
    }

    .slides {
        position: absolute;
        bottom: 10%;
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
        background: transparent;
        border: none;
        cursor: pointer;
        width: 1rem;
        height: 3rem;
        position: absolute;
        top: 15%;
    }

    button.prev { right: 0; }

    .prev-main, .next-main {
        position: absolute;
        top: 65%;
        border: none;
        padding: 0.75rem 0.85rem;
        background: transparent;
        cursor: pointer;
    }

    .prev-main { right: 0; }

    .zoom {
        background: #D5D5D5;
        position: absolute;
        bottom: 10px;
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
</style>
