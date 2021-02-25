<template>
  <div id="user-order-details">
    <vx-card class="order-info">
      <div class="vx-row">
          <div class="vx-col md:w-1/2 w-full mt-8">
            <h3>Order Info</h3>
            <table class="info">
              <tr>
                <th>{{ order_data.code }}</th>
                <th>Code</th>
              </tr>
              <tr>
                <th>{{ order_data.customer.name }}</th>
                <th>Customer Name</th>
              </tr>
              <tr>
                <th>{{ order_data.customer.mobile }}</th>
                <th>Customer Phone</th>
              </tr>
              <tr>
                <th>{{ order_data.customer.email }}</th>
                <th>Customer Email</th>
              </tr>
            </table>

            <h3 class="mt-5">Order Products</h3>
            <table class="order">
              <tr>
                <th>Item</th>
                <th>Quantity</th>
                <th>Price</th>
              </tr>
              <tr v-for="product in order_data.products" :key="product.id">
                <td>{{ product.name.title_en }}</td>
                <td>{{ product.quantity }}</td>
                <td>{{ product.price }}</td>
              </tr>
            </table>
          </div>

          <div class="vx-col md:w-1/2 w-full mt-8">
            <label class="vs-input-label">Delivery Price</label>
            <vs-input class="w-full mb-4" v-model="order_data.delivery_price" v-validate="'required|alpha_spaces'" />
            <span class="text-danger text-sm" v-show="errors.has('delivery_price')">{{ errors.first('delivery_price') }}</span>

            <label class="vs-input-label">Products Price</label>
            <vs-input class="w-full mb-4" v-model="order_data.products_price" v-validate="'required|alpha_spaces'" />
            <span class="text-danger text-sm" v-show="errors.has('products_price')">{{ errors.first('products_price') }}</span>

            <label class="vs-input-label">Discount</label>
            <vs-input class="w-full mb-4" v-model="order_data.discount" v-validate="'required|alpha_spaces'" />
            <span class="text-danger text-sm" v-show="errors.has('discount')">{{ errors.first('discount') }}</span>

            <label class="vs-input-label">Total Price</label>
            <vs-input class="w-full mb-4" v-model="total_price" disabled v-validate="'required|alpha_spaces'" />
            <span class="text-danger text-sm" v-show="errors.has('total_price')">{{ errors.first('total_price') }}</span>

            <div class="w-full mt-2">
              <label class="vs-input-label">Update Status</label>
              <v-select v-model="order_data.status" class="mb-4" as="value:id:id" :from="statusOptions" tagging></v-select>
            </div>
          </div>
        </div>

        <!-- Save & Reset Button -->
        <div class="vx-row">
          <div class="vx-col w-full">
            <div class="mt-8 flex flex-wrap items-center justify-end">
              <vs-button class="ml-auto mt-2" @click="save_changes">{{ $t('Save Changes') }}</vs-button>
              <vs-button class="ml-4 mt-2" type="border" color="warning" @click="goBack">{{ $t('Cancel')}}</vs-button>
            </div>
          </div>
        </div>
    </vx-card>
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
      // total_price: 0,
      statusOptions: [
        { value: 'New', id: 0 },
        { value: 'In Progress', id: 1 },
        { value: 'Ready For Pickup', id: 2 },
        { value: 'On The Way', id: 3 },
        { value: 'Delivered', id: 4 },
        { value: 'Cancelled', id: 5 },
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

    this.$store.dispatch("orderManagement/fetchOrder", this.$route.params.orderId).catch(err => { console.error(err) })
    .then((res) => { 
      // console.log(res.data)
      this.order_data = res.data
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