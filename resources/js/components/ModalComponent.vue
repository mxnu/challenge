<template>
   <div ref="modal" class="modal d-none">
      <slot></slot>
   </div>
</template>
<script>
export default {
   mounted() {
   },
   methods: {
      open: function() {
         this.$refs.modal.classList.remove('d-none');
      },
      close: function() {
         this.$refs.modal.classList.add('d-none');
      }
   }
}
</script>