<template>
  <div id="user-order-details">
    <div class="flex justify justify-between">
      <h5 class="mt-2">{{$t('Order') + '# ' + order_data.code}}</h5>
      <div class="ml-4">
        <h5 class="mt-2">{{$t('Status')}}</h5>
        <vs-chip v-if="statusOptions[order_data.status]" transparent class="text-lg m-1 mt-4" :color="statusOptions[order_data.status].color">
            <span>{{ statusOptions[order_data.status].value }}</span>
        </vs-chip>
      </div>
    </div>
    <div class="vx-row">
        <div class="vx-col w-full md:w-1/2 mt-8">
          <vx-card :title="$t('Products')" class=" mt-4">
            <div class="vx-row" v-for="product in order_data.products" :key="product.id">
              <div class="vx-col w-1/2">
                <th>{{$t('Product')}}</th><br>
                <vs-td class="vx-col w-1/2">
                  <img v-if="product.image.link.length > 0" :src="productsLink+product.image.link"  height="60" />
                </vs-td>
              </div>
              <div class="vx-col w-1/2">
                <th>{{$t('Name')}}</th><br>
                <td class="vx-col w-1/2">{{ product.name.title_en }}</td>
              </div>
              <div class="vx-col w-1/2">
                <th>{{$t('Quantity')}}</th><br>
                <td class="vx-col w-1/2">{{ product.quantity }}</td>
              </div>
              <div class="vx-col w-1/2">
                <th>{{$t('Price')}}</th><br>
                <td class="vx-col w-1/2">{{ product.price }}</td>
              </div>
            </div>
          </vx-card>
          <vx-card :title="$t('Prices')" class=" mt-4">
            <div class="vx-row">
              <div class="vx-col md:w-1/2 w-full mt-4">
                <label class="vs-input-label">{{$t('DeliveryPrice')}}</label>
                <p> {{order_data.delivery_price}} {{$t('SAR')}} </p>
              </div>
              <div class="vx-col md:w-1/2 w-full mt-4">
                <label class="vs-input-label">{{$t('ProductsPrice')}}</label>
                <p> {{order_data.products_price}} {{$t('SAR')}} </p>
              </div>

              <div v-if="order_data.discount" class="vx-col md:w-1/2 w-full mt-4">
                <label class="vs-input-label">{{$t('Discount')}}</label>
                <p> {{order_data.discount}} {{$t('SAR')}} </p>
              </div>

              <div class="vx-col md:w-1/2 w-full mt-4">
                <label class="vs-input-label">{{$t('TotalPrice')}}</label>
                <p> {{total_price}} {{$t('SAR')}} </p>
              </div>
              <div class="vx-col md:w-1/2 w-full mt-4">
                <label class="vs-input-label">{{$t('PaymentMethod')}}</label>
              <br>
                <vs-chip v-if="paymentOptions[order_data.payment_method] && order_data.payment_method != null" transparent class="text-lg m-1 mt-4" >
                    <span>{{ paymentOptions[order_data.payment_method].label }}</span>
                </vs-chip>
                <p v-else>{{$t('NA')}}</p>
              </div>

            </div>
          </vx-card>
        </div>

        <div class="vx-col md:w-1/2 w-full mt-8">
          <vx-card :title="$t('Delivery')" class=" mt-4">
            <div class="vx-row">
              <div class="vx-col md:w-1/2 w-full mt-4">
                <label class="vs-input-label">{{$t('DeliveryMethod')}}</label>
              <br>
                <vs-chip transparent class="text-lg m-1 mt-4" :color="deliveryOptions[order_data.delivery_method].color">
                    <span>{{ deliveryOptions[order_data.delivery_method].label }}</span>
                </vs-chip>
              </div>
              <div class="vx-col md:w-1/2 w-full mt-4" v-if="!order_data.delivery_method">
                <label class="vs-input-label">{{$t('Location')}}</label>
              <br>
                <vs-button size="small" target :href="'https://www.google.com/maps/search/?api=1&query='+order_data.location.lat+','+order_data.location.lng" class="ml-auto mt-2" >{{$t('View')}}</vs-button>
              </div>
            </div>
          </vx-card>
          <vx-card :title="$t('ContactInfo')" class=" mt-4">
            <div class="vx-row" v-if="!loading">
              <div class="vx-col md:w-1/2 w-full mt-4">
                <th>{{$t('Name')}}</th>
              </div>
              <div class="vx-col md:w-1/2 w-full mt-4">
                <th>{{ order_data.customer.name }}</th>
              </div>
              <div class="vx-col md:w-1/2 w-full mt-4">
                <th>{{$t('Mobile')}}</th>
              </div>
              <div class="vx-col md:w-1/2 w-full mt-4">
                <th>{{ order_data.customer.mobile }}</th>
              </div>
              <div class="vx-col md:w-1/2 w-full mt-4">
                <th>{{$t('Notes')}}</th>
              </div>
              <div class="vx-col md:w-1/2 w-full mt-4">
                <th>{{ order_data.comments }}</th>
              </div>
            </div>
          </vx-card>
        </div>
    </div>
  </div>
</template>

<script>
// Store Module
import moduleOrderManagement from '@/store/order-management/moduleOrderManagement.js'

import algoliasearch from 'algoliasearch/lite'

export default {
  data() {
    return {
      order_data: {},
      order_products: [],
      algolia_index: algoliasearch(
        '1QQCCC7V7K',
        '5eb1665900dd1ae25c1ca6d8965fd5ce'
      ).initIndex("products"),
      productsLink: 'https://otantik-home.s3.me-south-1.amazonaws.com/products/',
      loading: false,
      paymentOptions: [
        { label: this.$t('COD'), color:'warning' },
        { label: this.$t('ePayment'), color:'primary' },
        { label: this.$t('BankWire'), color:'dark' },
      ],
      deliveryOptions: [
        { label: this.$t('PickupLabel'), color:'dark', },
        { label: this.$t('DeliveryLabel'), color:'success', },
      ],
      statusOptions: [
        { value: this.$t('New'), color:'#24c1a0', },
        { value: this.$t('InProgress'), color:'primary', },
        { value: this.$t('ReadyForPickup'), color:'danger', },
        { value: this.$t('OnTheWay'), color:'warning', },
        { value: this.$t('Delivered'), color:'success', },
        { value: this.$t('Cancelled'), color:'dark', },
      ],
    }
  },
  computed: {
    total_price() {
      return (this.order_data.products_price + this.order_data.delivery_price) - this.order_data.discount
    }
  },
  methods: {
    fetch_item_details(id) {
      this.algolia_index.getObject(id, (err, content) => {
        if(err) {
          this.error_occured = true
          this.error_msg = err.message
          console.error(err);
        }else {
          this.item_data = content
          this.isInCart(this.item_data.objectID) ? this.quantity = this.item_qty : this.quantity = 1
          this.isInCart(this.item_data.objectID) ? this.indexInCart = this.item_index : null
        }
      })

    },
  },
  created() {
    if(!moduleOrderManagement.isRegistered) {
        this.$store.registerModule('orderManagement', moduleOrderManagement)
        moduleOrderManagement.isRegistered = true
    }

    this.$store.dispatch("orderManagement/fetchOrder", this.$route.params.order_id).catch(err => { console.error(err) })
    .then((order) => {
      this.order_data = order.data
      console.log(this.order_data)
    })
    .catch((error) => console.log(error))
  },
}
</script>

<style lang="scss" scoped>
#user-order-details {
  margin: 2rem;

    table.info {
      width: 100%;

      th, td { padding: 0 5rem; }
    }

    table.order {
      width: 100%;

      th, td { padding: 0 2rem; text-align: center; }
    }
  }
  </style>
