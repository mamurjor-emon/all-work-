<template>
    <div>
      <ParentComponent>
        <ChildComponent/>
      </ParentComponent>
    </div>
</template>
  
  <script>
  import ParentComponent from '../../back/app/app.vue';
  import ChildComponent from './home/about.vue';
  
  export default {
    components: {
      ParentComponent,
      ChildComponent,
    },
  };
  </script>
  