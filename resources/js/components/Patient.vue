<template>
  <div>
    <div class="container">
      <template v-if="!loading">
        <div class="row">
          <h1>Pacientes</h1>
          <!-- Form -->
          <div class="col-md-4 d-none">
            <input class="form-control" type="text" v-model="patient.id" />
          </div>
          <div class="col-md-4 pt-3">
            <input class="form-control" type="text" v-model="patient.name" />
          </div>
          <div class="col-md-4 pt-3">
            <input
              class="form-control"
              type="number"
              v-model="patient.height"
            />
          </div>
          <div class="col-md-4 pt-3">
            <input
              class="form-control"
              type="date"
              v-model="patient.birthday_date"
            />
          </div>
          <div class="col-md-12 pt-3">
            <a href="#" class="btn btn-success" @click="save()">
              <i class="fa fa-save"></i> {{ textButton }}</a
            >
            <a href="#" class="btn btn-info" @click="cleanInputs()"
              ><i class="fas fa-broom"></i> Limpiar</a
            >
          </div>

          <!-- Table -->
          <base-table
            :data="patients"
            :headers="headers"
            @delete="deleteP($event)"
            @edit="edit($event)"
          />
        </div>
      </template>
      <template v-else>
        <alert />
      </template>
    </div>
  </div>
</template>

<script>
import ui from "../libs/ui";

export default {
  data: () => {
    return {
      patient: {
        name: "",
        height: "",
        birthday_date: "",
      },
      patients: [],
      headers: ["#", "Nombre", "Altura", "Fecha de cumpleaños", "Acciones"],
      textButton: "Guardar",
      loading: false,
    };
  },

  mounted() {
    this.initialize();
  },

  methods: {
    async initialize() {
      this.loading = true;
      this.patient = {};

      const res = await axios.get("api/patient");
      this.patients = res.data.patients;
      this.loading = false;
    },

    async save() {
      let res;
      switch (this.textButton) {
        case "Guardar":
          res = await axios.post("api/patient", this.patient).catch((e) => {
            ui.alert("Registro no pudo ser guardado correctamente.", "error");
          });

          if (res.data.message == "success") {
            this.patients = res.data.patients;
            ui.alert("Registro creado correctamente.");
            this.initialize();
          }
          break;
        case "Modificar":
          res = await axios
            .put(`api/patient/${this.patient.id}`, this.patient)
            .catch((e) => {
              ui.alert(
                "Registro no pudo ser actualizado correctamente.",
                "error"
              );
            });

          if (res.data.message == "success") {
            ui.alert("Registro modificado correctamente.");
            this.initialize();
          }
          break;
      }
    },

    edit(id) {
      this.patient = this.patients.find((patient) => patient.id == id);
      this.textButton = "Modificar";
    },

    async deleteP(id) {
      const res = await axios.delete(`api/patient/${id}`).catch((e) => {
        ui.alert("Registro no pudo ser eliminado correctamente.", "error");
      });

      if (res.data.message == "success") {
        ui.alert("Registro eliminado correctamente.");
        this.initialize();
      }
    },

    cleanInputs() {
      this.patient = {};
      this.textButton = "Guardar";
    },
  },
};
</script>

<style>
</style>
