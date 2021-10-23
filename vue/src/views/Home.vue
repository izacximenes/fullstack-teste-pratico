<template>
  <v-container>
    <v-col>
      <v-card class="py-2 mb-2" elevation="0">
        <v-card-title>Filtros</v-card-title>

        <v-col cols="12" lg="12" sm="12">
          <v-autocomplete
            :items="station_types"
            v-model="station_type_selected"
            item-text="name"
            item-value="id"
            label="Tipos de estação"
            multiple
            outlined
          >
          </v-autocomplete>
        </v-col>
        <v-col cols="12" lg="12" sm="12">
          <v-autocomplete
            :items="stations_filted"
            v-model="stations_selected"
            item-text="name"
            item-value="id"
            label="Estações"
            multiple
            outlined
          ></v-autocomplete>

          <v-btn color="primary" @click="filter">Consultar</v-btn>
        </v-col>
      </v-card>

      <v-map
        :stations="stations_map_filted"
        @open="openModal"
        :types="types_filted"
      ></v-map>
    </v-col>

    <v-dialog v-model="dialog" max-width="600px">
      <v-card>
        <v-card-title>
          <span class="text-h5">Dados da Estação</span>
          <v-spacer></v-spacer>

          <v-btn icon @click="dialog = false">
            <v-icon>mdi-close</v-icon>
          </v-btn>
        </v-card-title>
        <v-card-text>
          <v-row>
            <v-col cols="12" sm="12" md="6" lg="6">
              <v-text-field
                outlined
                label="Identificador"
                disabled
                v-model="station_dialog.id"
              ></v-text-field>
            </v-col>
            <v-col cols="12" sm="12" md="6" lg="6">
              <v-text-field
                outlined
                label="Nome"
                disabled
                v-model="station_dialog.name"
              ></v-text-field>
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="12" sm="12" md="6" lg="6">
              <v-text-field
                outlined
                label="Latitude"
                disabled
                v-model="station_dialog.latitude"
              ></v-text-field>
            </v-col>
            <v-col cols="12" sm="12" md="6" lg="6">
              <v-text-field
                outlined
                label="Longitude"
                disabled
                v-model="station_dialog.longitude"
              ></v-text-field>
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="12" sm="12" md="6" lg="6">
              <v-text-field
                type="date"
                outlined
                label="Início de Operação"
                disabled
                v-model="station_dialog.operation_start_date"
              ></v-text-field>
            </v-col>
            <v-col cols="12" sm="12" md="6" lg="6">
              <v-text-field
                type="date"
                outlined
                label="Fim de Operação"
                disabled
                v-model="station_dialog.operation_end_date"
              ></v-text-field>
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="12" sm="12" md="6" lg="6">
              <v-text-field
                outlined
                label="Elevação (m2)"
                disabled
                v-model="station_dialog.elevation_meters"
              ></v-text-field>
            </v-col>
            <v-col cols="12" sm="12" md="6" lg="6">
              <v-autocomplete
                :items="station_types_dialog"
                item-text="name"
                item-value="id"
                label="Tipo de Estação"
                outlined
                disabled
                v-model="station_dialog.station_type_id"
              ></v-autocomplete>
            </v-col>
          </v-row>
        </v-card-text>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script>
import Map from "../components/Map.vue";
import { stations, types } from "../utils/station";
export default {
  name: "Home",
  components: {
    "v-map": Map,
  },
  computed: {
    stations_filted() {
      if (this.station_type_selected.includes(-1)) {
        return [{ id: -1, name: "TODAS" }, ...stations];
      }
      return [
        { id: -1, name: "TODAS" },
        ...stations.filter((row) =>
          this.station_type_selected.includes(row.station_type_id)
        ),
      ];
    },
  },
  data() {
    return {
      station_type_selected: [],
      stations_selected: [],
      stations_map_filted: [],
      types_filted: [],
      station_types_dialog: [...types],
      station_types: [{ id: -1, name: "TODAS" }, ...types],
      dialog: false,
      station_dialog: {},
    };
  },
  methods: {
    filter() {
      if (this.stations_selected.includes(-1)) {
        this.stations_map_filted = stations;
      } else {
        this.stations_map_filted = stations.filter((row) =>
          this.stations_selected.includes(row.id)
        );
      }

      if (this.station_type_selected.includes(-1)) {
        this.types_filted = types;
      } else {
        this.types_filted = types.filter((row) =>
          this.station_type_selected.includes(row.id)
        );
      }
    },
    openModal(id) {
      this.dialog = true;
      this.station_dialog = stations.find((row) => row.id == id);
    },
  },
};
</script>
