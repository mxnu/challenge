<template>
   <div class="flex flex-column justify-content-center">
      <div class="table-responsive mt-6">
         <table class="table">
            <thead>
               <tr>
                  <th>Título</th>
                  <th>Fecha de creación</th>
                  <th>Acción</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>Reporte de usuario 1</td>
                  <td>04/02/2020</td>
                  <td>
                     <button class="btn-descargar">
                        <span>Descargar</span><img :src="asset('images/icon-download.png')" alt="Descargar">
                     </button>
                  </td>
               </tr>
            </tbody>
         </table>
      </div>
      <button class="btn mt-4" @click="$emit('new')">Crear reporte</button>
   </div>
</template>
<script>
export default {
   mounted() {
      this.loadData();
   },
   methods: {
      loadData() {
         
      },
   },
}
</script>
