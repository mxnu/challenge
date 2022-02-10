module.exports = {
   methods: {
      asset: function(path) {
         let base = window._asset || '';
         return base + path;
      }
   }
};