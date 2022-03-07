<template>
  <div class="container">
    <h1 class="text-center">Reportes</h1>

    <hr />

    <div class="row">
      <div class="col-md-6">
        <a href="/generatePDFTotal" class="btn btn-light">
          <i class="fa fa-file-alt"></i> Generar reporte de total de alumnos por
          profesors</a
        >
      </div>

      <div class="col-md-6">
        <a
          href="/generatePDFGroups"
          class="btn btn-light"
          @click="generatePdf()"
        >
          <i class="fa fa-file-alt"></i> Generar reporte por rango de nota</a
        >
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      start: "",
      end: "",
    };
  },
  methods: {
    generatePdf() {
      window.location = "/generate-pdf";
    },

    generatePdfDate() {
      window.location = `/generatePdfDate/${this.start}/${this.end}`;
    },
  },
};
</script>

<style>
</style>
