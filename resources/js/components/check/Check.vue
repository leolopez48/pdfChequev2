<template>
  <div>
    <div class="container">
      <template v-if="!loading">
        <div class="row">
          <h1>Cheques</h1>
          <!-- Form -->
          <div class="col-md-4 d-none">
            <input class="form-control" type="text" v-model="check.id" />
          </div>
          <div class="col-md-6 pt-3">
            <label>Proveedor</label>
            <select v-model="check.check_name" class="form-select">
              <option
                v-for="supplier in suppliers"
                :key="supplier.id"
                :value="supplier.name_supplier"
              >
                {{ supplier.name_supplier }}
              </option>
            </select>
          </div>
          <div class="col-md-6 pt-3">
            <label>Concepto</label>
            <textarea
              cols="30"
              rows="3"
              class="form-control"
              v-model="check.concept"
            ></textarea>
          </div>
          <div class="col-md-4 pt-3">
            <label>Fecha</label>
            <input class="form-control" type="date" v-model="check.date" />
          </div>
          <div class="col-md-4 pt-3">
            <label>Monto</label>
            <input
              class="form-control"
              type="number"
              step="0.01"
              v-model="check.amount"
            />
          </div>
          <div class="col-md-4 pt-3">
            <label>Tipo de fondo</label>
            <select v-model="check.document_name" class="form-select">
              <option
                v-for="document in documents"
                :key="document.id"
                :value="document.document_name"
              >
                {{ document.document_name }}
              </option>
            </select>
          </div>
          <div class="col-md-4 pt-3">
            <label>No. de proyecto</label>
            <input
              class="form-control"
              type="text"
              v-model="check.number_project"
            />
          </div>
          <div class="col-md-4 pt-3">
            <label>No. de Cuenta</label>
            <select v-model="check.account_number" class="form-select">
              <option
                v-for="account in banks"
                :key="account.id"
                :value="account.account_number"
              >
                {{ account.account_number }}
              </option>
            </select>
          </div>
          <div class="col-md-4 pt-3">
            <label>Movimiento</label>
            <select v-model="check.movement" class="form-select">
              <option
                v-for="(movement, index) in movements"
                :key="index"
                :value="movement"
              >
                {{ movement }}
              </option>
            </select>
          </div>

          <div class="col-md-12 pt-3">
            <a href="#" class="btn btn-success" @click="save()">
              <i class="fa fa-save"></i> {{ textButton }}</a
            >
          </div>

          <!-- Table -->
          <check-table
            :data="checks"
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
      check: {
        code: "Lopez",
        check_name: "Leonel",
        concept: "Leonel",
        date: "",
        account_number: "",
        number_project: "",
        document_name: "",
        amount: "0.00",
      },
      banks: [],
      documents: [],
      suppliers: [],
      checks: [],
      movements: ["Abonar", "Cargar"],
      headers: [
        "#",
        "Código",
        "Proveedor",
        "Concepto",
        "Fecha",
        "Monto",
        "Fondo",
        "No. de cuenta",
        "No. de proyecto",
        "Acciones",
      ],
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

      let res = await axios.get("api/check");
      this.checks = res.data.checks;
      res = await axios.get("api/bank");
      this.banks = res.data.banks;

      if (this.banks.length > 0) {
        console.log(res.data);
        this.check.account_number = res.data.banks[0].account_number;
      }

      res = await axios.get("api/document");
      this.documents = res.data.documents;

      if (this.documents.length > 0) {
        this.check.document_name = res.data.documents[0].document_name;
      }

      res = await axios.get("api/supplier");
      this.suppliers = res.data.suppliers;

      if (this.suppliers.length > 0) {
        this.check.check_name = res.data.suppliers[0].name_supplier;
      }

      this.check.movement = this.movements[0];
      this.check.date = new Date().toISOString().substr(0, 10);
      this.loading = false;
    },

    async save() {
      let res;
      switch (this.textButton) {
        case "Guardar":
          res = await axios.post("api/check", this.check).catch((e) => {
            ui.alert("Registro no pudo ser guardado correctamente.", "error");
          });

          if (res.data.message == "success") {
            this.checks = res.data.checks;
            ui.alert("Registro creado correctamente.");
          }
          break;
        case "Modificar":
          res = await axios
            .put(`api/check/${this.check.id}`, this.check)
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
      this.check = this.checks.find((check) => check.id == id);
      this.textButton = "Modificar";
    },

    async deleteP(id) {
      const res = await axios.delete(`api/check/${id}`).catch((e) => {
        ui.alert("Registro no pudo ser eliminado correctamente.", "error");
      });

      if (res.data.message == "success") {
        ui.alert("Registro eliminado correctamente.");
        this.initialize();
        this.cleanInputs();
      }
    },

    cleanInputs() {
      this.check = {};
      this.textButton = "Guardar";
    },
  },
};
</script>

<style>
</style>
