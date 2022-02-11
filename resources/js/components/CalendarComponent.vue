<template>
   <div>
      <div class="calendar-form">
         <div class="calendar-text" @click="open = true">{{format()}}</div>
      </div>
      <div v-if="open" class="calendar">
         <div class="row">
            <div class="col-md-8">
               {{months[month]}} {{year}}
            </div>
            <div class="col-md-4">
               <button @click="before" class="btn-calendar"><img :src="asset('images/left-arrow.png')" alt="Anterior"></button>
               <button @click="after" class="btn-calendar"><img :src="asset('images/right-arrow.png')" alt="Siguiente"></button>
            </div>
         </div>
         <div class="flex justify-content-center">
            <table>
               <thead>
                  <tr>
                     <td class="center:text">S</td>
                     <td class="center:text">M</td>
                     <td class="center:text">T</td>
                     <td class="center:text">W</td>
                     <td class="center:text">T</td>
                     <td class="center:text">F</td>
                     <td class="center:text">S</td>
                  </tr>
               </thead>
               <tbody>
                  <tr v-for="week in Object.values(data)">
                     <td class="calendar-day" v-for="day in arr_day">
                        <button 
                           @click="select(week[day])" 
                           :class="week[day] && selected == week[day] ? 'active' : ''"
                           class="btn-calendar-days">{{ week[day] }}</button>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</template>
<script>
export default {
   data() {
      return {
         open: false,
         year: null,
         month: null,
         days: null,
         dayOfWeek: null,
         data: {},
         arr_day: [0,1,2,3,4,5,6],
         months: [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
         ],
         selected: null
      }
   },
   mounted() {
      this.year = new Date().getFullYear();
      this.month = new Date().getMonth();
      this.init();
   },
   methods: {
      init: function() {
         this.dayOfWeek = new Date(this.year, this.month, 1).getDay();
         this.days = this.getDaysInMonth(this.month);
         // Procesar calendario
         let data = {};
         let dayOW = this.dayOfWeek;
         let idx = 0;
         for (let i = 0; i < this.days; i++) {
            if (!data[idx]) {
               data[idx] = {};
            }
            data[idx][dayOW] = i + 1;
            // Si es ultimo dia de la semana
            if (dayOW == 6) {
               idx += 1;
               dayOW = 0;
            } else {
               dayOW += 1;
            }
         }
         this.data = data;
      },
      getDaysInMonth(month) {
         return new Date(this.year, month + 1, 0).getDate();
      },
      before: function() {
         this.month -= 1;
         if (this.month < 0) {
            this.month = 11;
            this.year -= 1;
         }
         this.init();
      },
      after: function() {
         this.month += 1;
         if (this.month > 11) {
            this.month = 0;
            this.year += 1;
         }
         this.init();
      },
      select: function(day) {
         this.selected = day;
         this.open = false;
         this.$emit('input', this.formatEmit());
      },
      formatEmit: function() {
         let day = ('0' + this.selected).slice(-2);
         let month = ('0' + (this.month + 1)).slice(-2);
         return `${this.year}-${month}-${day}`;
      },
      format: function() {
         if (this.selected == null) {
            return '';
         }
         let day = ('0' + this.selected).slice(-2);
         let month = ('0' + (this.month + 1)).slice(-2);
         return `${day}/${month}/${this.year}`;
      }
   }
}
</script>