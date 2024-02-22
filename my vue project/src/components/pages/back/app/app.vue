<template>
    <div>
      <Header></Header>
      <slot></slot>
      <Footer></Footer>
    </div>
</template>
  
  <script>
  import Header from '../include/header.vue'
  import Footer from '../include/footer.vue'
  export default {
    components:{
        Header,
        Footer
    },
    mounted() {
    import("../../../../assets/backend/style.css");
  }
  };
  </script>
