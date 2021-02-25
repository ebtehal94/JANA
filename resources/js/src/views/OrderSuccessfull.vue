<template>
  <div class="vx-row justify-center text-center mt-8">
      <div class="vx-col w-full text-center mt-8">
        <h4>{{$t('YourOrderWasSuccessfull')}}</h4>
      </div>
      <div class="vx-col w-full text-center mt-8">
        <h4>{{$t('Thankyouforchoosing')}}</h4>
      </div>
      <vs-button class="mt-10" to="/all">{{ $t('ShopNow') }}</vs-button>
  </div>
</template>
