<template>
  <div>
    <div class="container">
      <template v-if="!loading">
        <div class="row">
          <h1>Tipo de fondos</h1>
          <!-- Form -->
          <div class="col-md-4 d-none">
            <input class="form-control" type="text" v-model="document.id" />
          </div>

          <div class="col-md-4 pt-3">
            <label>Código</label>
            <input class="form-control" type="text" v-model="document.code" />
          </div>
          <div class="col-md-6 pt-3">
            <label>Nombre</label>
            <input
              class="form-control"
              type="text"
              v-model="document.document_name"
            />
          </div>

          <div class="col-md-12 pt-3">
            <a href="#" class="btn btn-success" @click="save()">
              <i class="fa fa-save"></i> {{ textButton }}</a
            >
          </div>

          <!-- Table -->
          <document-table
            :data="documents"
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
import ui from "../../libs/ui";

export default {
  data: () => {
    return {
      document: {
        code: "Lopez",
        document_name: "Leonel",
      },
      documents: [],
      headers: ["#", "Código", "Nombre", "Acciones"],
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

      let res = await axios.get("api/document");
      this.documents = res.data.documents;

      this.loading = false;
    },

    async save() {
      let res;
      switch (this.textButton) {
        case "Guardar":
          res = await axios.post("api/document", this.document).catch((e) => {
            ui.alert("Registro no pudo ser guardado correctamente.", "error");
          });

          if (res.data.message == "success") {
            this.documents = res.data.documents;
            ui.alert("Registro creado correctamente.");
          }
          break;
        case "Modificar":
          res = await axios
            .put(`api/document/${this.document.id}`, this.document)
            .catch((e) => {
              ui.alert(
                "Registro no pudo ser actualizado correctamente.",
                "error"
              );
            });

          if (res.data.message == "success") {
            ui.alert("Registro modificado correctamente.");
          }
          break;
      }
      this.initialize();
      this.cleanInputs();
    },

    edit(id) {
      this.document = this.documents.find((document) => document.id == id);
      this.textButton = "Modificar";
    },

    async deleteP(id) {
      const res = await axios.delete(`api/document/${id}`).catch((e) => {
        ui.alert("Registro no pudo ser eliminado correctamente.", "error");
      });

      if (res.data.message == "success") {
        ui.alert("Registro eliminado correctamente.");
        this.initialize();
        this.cleanInputs();
      }
    },

    cleanInputs() {
      this.document = {};
      this.textButton = "Guardar";
    },
  },
};
</script>

<style>
</style>
