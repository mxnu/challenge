module.exports = {
   methods: {
      openModal: function(id) {
         let self = this;
         self.$refs[id].open();
         // Verificar si existe fondo
         let modalBackground = document.querySelector('.modal-background');
         if (modalBackground == null) {
            let modalBackground = document.createElement('div');
            modalBackground.classList.add('modal-background');
            modalBackground.onclick = function() {
               self.closeModal(id);
            };
            document.body.appendChild(modalBackground);
         }
         document.body.classList.add('modal-open');
      },
      closeModal: function(id) {
         this.$refs[id].close();
         let modalBackground = document.querySelector('.modal-background');
         if (modalBackground != null) {
            document.body.removeChild(modalBackground);
         }
         document.body.classList.remove('modal-open');
      }
   }
};