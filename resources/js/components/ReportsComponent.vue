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
               <tr v-for="report in reports">
                  <td>{{ report.title }}</td>
                  <td>{{ report.created_at }}</td>
                  <td>
                     <a :href="'/api/get-report/' + report.id" target="_blank" class="btn-descargar">
                        <span>Descargar</span><img :src="asset('images/icon-download.png')" alt="Descargar">
                     </a>
                  </td>
               </tr>
               <tr v-if="!reports">
                  <td colspan="3" class="force-center:text">Cargando...</td>
               </tr>
               <tr v-if="reports && reports.length == 0">
                  <td colspan="3" class="force-center:text">Sin reportes generados</td>
               </tr>
            </tbody>
         </table>
      </div>
      <button class="btn mt-4" @click="$emit('new')">Crear reporte</button>
   </div>
</template>
<script>
export default {
   data() {
      return {
         reports: null
      }
   },
   mounted() {
      this.loadData();
   },
   methods: {
      loadData() {
         fetch('/api/list-reports')
            .then(response => response.json())
            .then(data => {
               this.reports = data;
            });
      },
   },
}
</script>
