<template>
  <div id="user-order-details">
    <vx-card class="order-info">
      <h4>Order #{{ order_data.id }}{{ order_data.code }}</h4>
      <div class="vx-row">
        <div class="vx-col md:w-1/2">
          <p>Date Ordered: {{ order_data.created_at }}</p>
          <p>Delivery Price: {{ order_data.delivery_price }}</p>
        </div>
        <div class="vx-col md:w-1/2">
          <p>Payment Total: {{ order_data.payment_amount }}</p>
        </div>
      </div>
      <div class="vx-row">
        <div class="vx-col w-100">
          <h4>Products</h4>
          <table>
            <thead>
              <th>Item</th>
              <th>Price</th>
              <th>Quantity</th>
            </thead>
            <tbody>
              <tr v-for="product in order_products" :key="product.id">
                <td>{{ product.title_en }}</td>
                <td>{{ product.price }}</td>
                <td>{{ product.quantity }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </vx-card>
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
        'SXG4PV0YAT',
        '42b8e7ea3e742f53ca29e378b2e53e38'
      ).initIndex("products"),
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
    console.log('ORDER', order_data)
    if(!moduleOrderManagement.isRegistered) {
        this.$store.registerModule('orderManagement', moduleOrderManagement)
        moduleOrderManagement.isRegistered = true
    }

    const res = this.$store.dispatch("orderManagement/fetchOrder", this.$route.params.order_id).catch(err => { console.error(err) })

    res.then((order) => { 
      this.order_data = order.data

      this.order_data.products.forEach((order) => {
        const product = this.$store.dispatch("eCommerce/fetchProductInfo", order.product_id)
        .catch(err => { console.error(err) })

        product.then((details) => {
          let prod = details.data.product
          prod['price'] = order.price
          prod['quantity'] = order.quantity
          
          this.order_products.push(prod)
        })
        .catch((error) => console.log(error.response))
      })
    })
    .catch((error) => console.log(error))
  },
}
</script>

<style lang="scss" scoped>
#user-order-details {
  margin: 2rem;

  table {
    width: 100%;

    th, td { padding: 0 10rem }
  }
}
</style>