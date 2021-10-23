<template>
  <div>
    <vl-map
      :load-tiles-while-animating="true"
      :load-tiles-while-interacting="true"
      data-projection="EPSG:4326"
      style="height: 70vh"
    >
      <vl-view
        :zoom.sync="zoom"
        :center.sync="center"
        :rotation.sync="rotation"
      ></vl-view>

      <vl-layer-tile>
        <vl-source-osm></vl-source-osm>
      </vl-layer-tile>

      <vl-feature
        v-for="station in stations"
        :key="station.id"
        :id="station.id"
      >
        <vl-geom-point :coordinates="[station.longitude, station.latitude]">
        </vl-geom-point>
        <vl-style-box>
          <vl-style-icon
            src="./map-marker.svg"
            :color="getColorByType(station.station_type_id)"
            :scale="1"
            :anchor="[1, 1]"
          ></vl-style-icon>
        </vl-style-box>
        <vl-interaction-select :features.sync="selectedFeatures">
          <vl-style-box>
            <vl-style-icon
              src="./map-marker.svg"
              :scale="1"
              :anchor="[1, 1]"
            ></vl-style-icon>
          </vl-style-box>
        </vl-interaction-select>
      </vl-feature>
    </vl-map>
  </div>
</template>

<script>
export default {
  props: {
    stations: Array,
    types: Array,
  },
  watch: {
    selectedFeatures(newValue) {
      if (newValue.length == 0) return;
      this.$emit("open", newValue[0].id);
    },
  },
  data() {
    return {
      selectedFeatures: [],
      zoom: 2,
      center: [0, 0],
      rotation: 0,
    };
  },

  methods: {
    getColorByType(id) {
      return this.types.find((row) => row.id == id).color;
    },
  },
};
</script>
