
<template>
  <div>
    <div class="flex flex-wrap justify text-center justify-center">
      <div class="w-full text-center">
        <h1 class="mt-10">{{$t('AboutOtantik')}}</h1>
        <p class="p-10 md:p-20 desc"v-if="$i18n.locale == 'en'">
           Otantik Home is an oriental antique home hardware, giftware,
           and Ornaments the company established in 2012.
           Our stores offer a vast collection of unique and elegant Ottoman-inspired collectors’
           in addition to our unique collection of porcelain crafted by our own designers and made in our professional factories.
           Otantik prides itself for its breathtaking signature designs in line with all fashion trends and intertwined
           with the authentic antique patterns.
         </p>
        <p class="p-10 md:p-20 desc"v-else>
          Otantik Home  عبارة عن أواني منزلية شرقية عتيقة ، وهدايا ، وزخارف تأسست الشركة في عام 2012. تقدم متاجرنا مجموعة كبيرة من هواة جمع التحف الفريدة والأنيقة المستوحاة من الطراز العثماني بالإضافة إلى مجموعتنا الفريدة من الخزف المصنوع من قبل مصممينا الخاصين والمصنوع من مصانعنا المهنية. تفتخر Otantik بتصميماتها المميزة التي تخطف الأنفاس بما يتماشى مع جميع اتجاهات الموضة والمتشابكة مع الأنماط العتيقة الأصيلة.
         </p>

      </div>
    </div>
  </div>
</template>

<style lang="scss">
  .desc {
    line-height: 2;
  }
</style>
