<template>
  <vs-popup class="holamundo" :title="this.$i18n.locale == 'en' ? data.title.en : data.title.ar" :active.sync="isPopupActiveLocal">
	  <div class="vx-row">
		  <div class="vx-col w-full md:w-1/2">
			<!-- Product Details -->
			<h3>{{ this.$i18n.locale == 'en' ? data.title.en : data.title.ar }}</h3>
			<div class="add-to-cart flex justify-start items-center mt-5">
				<!-- Add To Cart Button -->
				<vs-button
				class="add-to-cart w-full"
				icon-pack="feather"
				icon="icon-shopping-cart"
				v-if="!isInCart(data.objectID)"
				@click="toggleItemInCart(data)">
				{{$t('AddToCart')}}
				</vs-button>

				<vs-button
				v-else
				class="add-to-cart w-full"
				icon-pack="feather"
				icon="icon-shopping-cart"
				@click="viewInCart()">
				{{$t('ViewInCart')}}
				</vs-button>
				<!-- Quantity -->

				<input class="qty-input" type="number" :value="quantity" placeholder="Qty" min="1">
			</div>
			<div class="wishlist-button flex justify-start items-center my-3">
				<feather-icon class="wishlist cursor-pointer" @click="toggleItemInWishList(data)" icon="HeartIcon" :svgClasses="[{'text-danger fill-current' : isInWishList(data.objectID)}, 'h-8 w-8']" />
			</div>
			<div class="product-decription mb-10">
				<p>{{ $i18n.locale == 'en' ?  data.desc.en : data.desc.ar }}</p>
			</div>
			<span class="details-link cursor-pointer" @click="viewProduct()">{{ $t('FullDetails') }}</span>
		  </div>
		  <div class="vx-col w-full md:w-1/2">
		  	<product-images :product_images="data.images" />
		  </div>
	  </div>
  </vs-popup>
</template>

<script>
import axios from "@/axios.js"

export default {
  props: {
	popupActive: {
	  type: Boolean,
	  required: true
	},
	data: {
	  type: Object,
	}
  },
  components: {
    ProductImages: () => import("./ProductImages.vue"),
  },
  data() {
	return {
	  quantity: 1,
	  productsLink: 'https://janacard.s3.eu-central-1.amazonaws.com/products/',
	  currency: (localStorage.getItem("currency")) ? localStorage.getItem("currency") : 'QAR',
	  short_code: (localStorage.getItem("country_code")) ? localStorage.getItem("country_code") : 'QTR',
	}
  },
  watch: {
	popupActive(val) {
	  if(!val) return
	  if(Object.entries(this.data).length === 0) {
		// this.initValues()
		return
	  }else {

	  }
	}
  },
  computed: {
	isInWishList() {
		return (itemId) => this.$store.getters['eCommerce/isInWishList'](itemId)
	},
	isInCart() {
	  return (itemId) => this.$store.getters['eCommerce/isInCart'](itemId)
	},
	cartItems() {
	  return this.$store.state.eCommerce.cartItems.slice().reverse();
	},
	isFormValid() {
	  return !this.errors.any()
	},
	isPopupActiveLocal: {
	  get() {
		return this.popupActive
	  },
	  set(val) {
		if(!val) {
		  this.$emit('closePopup')
		}
	  }
	}
  },
  methods: {
	viewInCart() {
		this.$emit('closePopup', false);
		this.$router.push({name: 'ecommerce-cart'}).catch(err => {})
	},
	viewProduct() {
		this.$emit('closePopup', false)
		this.$router.push({name: 'ecommerce-item-detail-view', params: {item_id: this.data.objectID }})
          .catch(() => {})
	},
	toggleItemInWishList(item) {
	  this.$store.dispatch('eCommerce/toggleItemInWishList', item)
	},
	toggleItemInCart(item) {
	  item["quantity"] = this.quantity
	  this.$store.dispatch('eCommerce/toggleItemInCart', item)
	},
	increment() {
	  this.quantity++
	},
	decrement() {
	  (this.quantity === 1) ? this.quantity = 1 : this.quantity--
	},
	updateItemQuantity(event, index) {
	  const itemIndex = Math.abs(index + 1 - this.cartItems.length)
	  this.$store.dispatch("eCommerce/updateItemQuantity", { quantity: event, index: itemIndex })
	},
	navigate_to_detail_view() {
	  this.$router.push({name: 'ecommerce-item-detail-view', params: {item_id: this.item.objectID }})
		.catch(() => {})
	},
	initValues(){
	  if(this.data.id) return
	  return
	},
	getDetails(details) {
	  let detail = null
	  Object.entries(details).forEach(([key, val]) => {
		if (key == this.short_code) {
			detail = val
		}
	  });

	  return detail
	},
  }
}
</script>

<style lang="scss" scoped>
.qty-input {
	width: 25%;
	padding: 1rem 0.5rem;
	margin: 0.5rem;
	border: 1px solid rgb(43, 43, 43);
}

.wishlist {
	border: 1px solid gray;
	padding: 0.25rem 2rem;
}

.details-link:hover {
	color: #BD9C72;
	margin-top: 2rem;
}

.quantity {
	border: 1px solid #e2e2e2;
	border-radius: 1rem;
	width: 100%;
	padding: 1rem;

	#qty {
	font-size: 1.5rem;
	}

	.wishlist {
	border: 1px solid #e2e2e2;
	border-radius: 10rem;
	padding: 1rem;
	}
}
</style>
