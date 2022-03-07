<template>
  <div>
    <div class="container">
      <template v-if="!loading">
        <div class="row">
          <h1>Profesores</h1>
          <!-- Form -->
          <div class="col-md-4 d-none">
            <input class="form-control" type="text" v-model="professor.id" />
          </div>
          <div class="col-md-4 pt-3">
            <label> Nombre</label>
            <input class="form-control" type="text" v-model="professor.name" />
          </div>
          <div class="col-md-4 pt-3">
            <label> Apellidos</label>
            <input
              class="form-control"
              type="text"
              v-model="professor.last_names"
            />
          </div>
          <div class="col-md-4 pt-3">
            <label> Grado</label>
            <select v-model="professor.grade_id" class="form-control">
              <option
                :value="grade.id"
                v-for="(grade, index) in grades"
                :key="index"
              >
                {{ grade.name }}
              </option>
            </select>
          </div>
          <div class="col-md-4 pt-3">
            <label> Sexo</label>
            <select v-model="professor.sex" class="form-control">
              <option :value="sex" v-for="(sex, index) in sexs" :key="index">
                {{ sex }}
              </option>
            </select>
          </div>
          <div class="col-md-4 pt-3">
            <label> Edad</label>
            <input class="form-control" type="number" v-model="professor.age" />
          </div>
          <div class="col-md-4 pt-3">
            <label> Titulo</label>
            <input class="form-control" type="text" v-model="professor.title" />
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
          <base-table-professor
            :data="professors"
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
      professor: {
        name: "Juan ",
        last_names: "Perez",
        grade_id: 1,
        age: "43",
        sex: "Masculino",
        title: "Profesor de primaria",
        // name: "",
        // last_names: "",
        // grade_id: "",
        // age: "",
        // sex: "",
        // title: "",
      },
      professors: [],
      sexs: ["Masculino", "Femenino"],
      grades: [],
      headers: ["#", "Nombre", "Apellidos", "Grado", "Edad", "Sexo", "Titulo"],
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
      // this.professor = {};

      let res = await axios.get("api/professor");
      this.professors = res.data.professors;

      res = await axios.get("api/grade");
      this.grades = res.data.grades;

      this.professors.forEach((professor) => {
        this.grades.forEach((grade) => {
          if (professor.grade_id == grade.id) {
            professor.grade_name = grade.name;
          }
        });
      });

      this.loading = false;
    },

    async save() {
      let res;
      switch (this.textButton) {
        case "Guardar":
          res = await axios.post("api/professor", this.professor).catch((e) => {
            ui.alert("Registro no pudo ser guardado correctamente.", "error");
          });

          if (res.data.message == "success") {
            this.professors = res.data.professors;
            ui.alert("Registro creado correctamente.");
            this.initialize();
          }
          break;
        case "Modificar":
          res = await axios
            .put(`api/professor/${this.professor.id}`, this.professor)
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
      this.professor = this.professors.find((professor) => professor.id == id);
      this.textButton = "Modificar";
    },

    async deleteP(id) {
      const res = await axios.delete(`api/professor/${id}`).catch((e) => {
        ui.alert("Registro no pudo ser eliminado correctamente.", "error");
      });

      if (res.data.message == "success") {
        ui.alert("Registro eliminado correctamente.");
        this.initialize();
      }
    },

    cleanInputs() {
      this.professor = {};
      this.textButton = "Guardar";
    },
  },
};
</script>

<style>
</style>
