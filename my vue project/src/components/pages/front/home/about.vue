<template>
    <div>
      <ParentComponent>
        <ChildComponent/>
      </ParentComponent>
    </div>
</template>
  
  <script>
  import ParentComponent from '../../front/app/app.vue';
  import ChildComponent from './pages/about.vue';
  
  export default {
    components: {
      ParentComponent,
      ChildComponent,
    },
  };
  </script>
  