<template>
  <div id="user-order-details">
    <div class="flex">
        <h5 class="mt-2">{{$t('Order') + '# ' + order_data.code}}</h5>
      <div class="ml-4">
        <label class="vs-input-label">{{$t('Status')}}</label>
        <v-select v-model="order_data.status" class="mb-4" as="value:id:id" :from="statusOptions" tagging></v-select>
      </div>
    </div>
      <div class="vx-row">
          <div class="vx-col md:w-1/2 w-full mt-8">
            <vx-card :title="$t('CustomerInfo')" class="order-info">
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
                  <th>{{$t('Email')}}</th>
                </div>
                <div class="vx-col md:w-1/2 w-full mt-4">
                  <th>{{ order_data.customer.email }}</th>
                </div>
                <div class="vx-col md:w-1/2 w-full mt-4">
                  <th>{{$t('Notes')}}</th>
                </div>
                <div class="vx-col md:w-1/2 w-full mt-4">
                  <th>{{ order_data.comments }}</th>
                </div>
              </div>
            </vx-card>
            <vx-card :title="$t('Products')" class="order-info mt-4">
              <table class="order" v-if="!loading">
                <tr>
                  <th>{{$t('Product')}}</th>
                  <th>{{$t('Name')}}</th>
                  <th>{{$t('Quantity')}}</th>
                  <th>{{$t('Price')}}</th>
                </tr>
                <tr v-for="product in order_data.products" :key="product.id" @click="$router.push({path: 'products/edit/'+product.id})">
                  <vs-td class="img-container">
                    <img v-if="product.image.link.length > 0" :src="productsLink+product.image.link"  width="100" />
                  </vs-td>
                  <td>{{ product.name.title_en }}</td>
                  <td>{{ product.quantity }}</td>
                  <td>{{ product.price }}</td>
                </tr>
              </table>
            </vx-card>
          </div>

          <div class="vx-col md:w-1/2 w-full mt-8">
            <vx-card :title="$t('Prices')" class="order-info mt-4">
              <div class="vx-row">
                <div class="vx-col md:w-1/2 w-full mt-4">
                  <label class="vs-input-label">{{$t('DeliveryPrice')}}</label>
                  <vs-input size="small" v-model="order_data.delivery_price" v-validate="'required|alpha_spaces'" />
                  <span class="text-danger text-sm" v-show="errors.has('delivery_price')">{{ errors.first('delivery_price') }}</span>
                </div>
                <div class="vx-col md:w-1/2 w-full mt-4">
                  <label class="vs-input-label">{{$t('ProductsPrice')}}</label>
                  <vs-input size="small" v-model="order_data.products_price" v-validate="'required|alpha_spaces'" />
                  <span class="text-danger text-sm" v-show="errors.has('products_price')">{{ errors.first('products_price') }}</span>
                </div>

                <div class="vx-col md:w-1/2 w-full mt-4">
                  <label class="vs-input-label">{{$t('Discount')}}</label>
                  <vs-input size="small" v-model="order_data.discount" v-validate="'required|alpha_spaces'" />
                  <span class="text-danger text-sm" v-show="errors.has('discount')">{{ errors.first('discount') }}</span>
                </div>

                <div class="vx-col md:w-1/2 w-full mt-4">
                  <label class="vs-input-label">{{$t('TotalPrice')}}</label>
                  <vs-input size="small" v-model="total_price" disabled v-validate="'required|alpha_spaces'" />
                  <span class="text-danger text-sm" v-show="errors.has('total_price')">{{ errors.first('total_price') }}</span>
                </div>
                <div class="vx-col md:w-1/2 w-full mt-4">
                  <label class="vs-input-label">{{$t('PaymentMethod')}}</label>
                  <v-select v-model="order_data.payment_method" class="mb-4" as="label:id:id" :from="paymentOptions" tagging></v-select>
                  <span class="text-danger text-sm" v-show="errors.has('payment_method')">{{ errors.first('payment_method') }}</span>
                </div>

              </div>
            </vx-card>
            <vx-card :title="$t('Delivery')" class="order-info mt-4">
              <div class="vx-row">
                <div class="vx-col md:w-1/2 w-full mt-4">
                  <label class="vs-input-label">{{$t('DeliveryMethod')}}</label>
                  <v-select v-model="order_data.delivery_method" class="mb-4 mt-2" as="label:id:id" :from="deliveryOptions"></v-select>
                </div>
                <div class="vx-col md:w-1/2 w-full mt-4" v-if="!order_data.delivery_method">
                  <label class="vs-input-label">{{$t('Location')}}</label>
                <br>

                  <vs-button v-if="order_data.location" size="small" target :href="'https://www.google.com/maps/search/?api=1&query='+order_data.location.lat+','+order_data.location.lng" class="ml-auto mt-2" >{{$t('View')}}</vs-button>
                </div>
              </div>
            </vx-card>
          </div>
        </div>

        <!-- Save & Reset Button -->
        <div class="vx-row">
          <div class="vx-col w-full">
            <div class="mt-8 flex flex-wrap items-center justify-end">
              <vs-button class="ml-auto mt-2" @click="save_changes">{{ $t('SaveChanges') }}</vs-button>
              <vs-button class="ml-4 mt-2" type="border" color="warning" @click="goBack">{{ $t('Cancel')}}</vs-button>
            </div>
          </div>
        </div>
  </div>
</template>

<script>
// Store Module
import moduleOrderManagement from '@/store/order-management/moduleOrderManagement.js'

import '@desislavsd/vue-select/dist/vue-select.css'
import { vSelect } from '@desislavsd/vue-select'

export default {
  components: {
    vSelect,
  },
  data() {
    return {
      order_data: { },
      productsLink: 'https://janacard.s3.eu-central-1.amazonaws.com/products/',
      loading: false,
      paymentOptions: [
        { label: this.$t('COD'), id: 0 },
        { label: this.$t('ePayment'), id: 1 },
        // { label: this.$t('BankWire'), id: 2 },
      ],
      deliveryOptions: [
        { label: this.$t('PickupLabel'), id: 0 },
        { label: this.$t('DeliveryLabel'), id: 1 },
      ],
      statusOptions: [
        { value: this.$t('New'), id: 0 },
        { value: this.$t('InProgress'), id: 1 },
        { value: this.$t('ReadyForPickup'), id: 2 },
        { value: this.$t('OnTheWay'), id: 3 },
        { value: this.$t('Delivered'), id: 4 },
        { value: this.$t('Cancelled'), id: 5 },
      ],
    }
  },
  computed: {
    total_price() {
      return (this.order_data.products_price + this.order_data.delivery_price) - this.order_data.discount
    }
  },
  methods: {
    goBack(){
      this.$router.push({path: '/orders'})
    },
    save_changes() {
      let formData = new FormData();
      formData.append('order_id', this.order_data.id)
      formData.append('delivery_price', this.order_data.delivery_price)
      formData.append('products_price', this.order_data.products_price)
      formData.append('discount', this.order_data.discount)
      formData.append('total_price', this.total_price)
      formData.append('status', this.order_data.status)

      this.$store.dispatch("orderManagement/updateOrder", formData)
      .then(res => {
        if (res.data.statusCode == 200) {
          this.$vs.notify({
            color: 'success',
            title: 'Successfull',
            text: 'Status Updated Successfully'
          })

          this.$router.push({path: '/orders'})
        } else {
          this.$vs.notify({
            color: 'danger',
            title: 'Error',
            text: 'Something Went Wrong'
          })
        }
      })
      .catch(err => { console.error(err) })
    }
  },
  created() {
    if(!moduleOrderManagement.isRegistered) {
        this.$store.registerModule('orderManagement', moduleOrderManagement)
        moduleOrderManagement.isRegistered = true
    }

    this.loading = true;
    this.$store.dispatch("orderManagement/fetchOrder", this.$route.params.orderId).catch(err => { console.error(err) })
    .then((res) => {
      this.order_data = res.data
      this.loading = false;
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
