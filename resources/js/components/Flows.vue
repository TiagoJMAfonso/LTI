<template>
  <div>
    <b-container>
      <b-row>
        <b-col cols="4"></b-col>
        <b-col cols="4">
          <HashLoader class="mx-auto" color="#000000" :size="size" sizeUnit="px" v-if="flows==null"></HashLoader>
        </b-col>
        <b-col cols="4"></b-col>
      </b-row>

      <b-row>
        <b-table striped hover :items="flows" :fields="fields" v-if="flows!=null">
          <template slot="actions" slot-scope="row">
            <b-button
              variant="danger"
              v-on:click.prevent="deleteFlow(row.item.id, row.item.deviceId)"
            >Delete</b-button>
            <b-button
              size="sm"
              @click="mostrarGrafico(row.item.id,row.item.deviceId,row);"
              class="mr-2"
            >{{ row.detailsShowing ? 'Hide Graph' : 'Graph'}}</b-button>
          </template>
          <template slot="row-details" slot-scope="row">
            <b-card>
              <bar-chart id="graph" class="potato" :chartdata="chartData"></bar-chart>
              <b-button size="sm" @click="row.toggleDetails">Hide Graph</b-button>
            </b-card>
          </template>
        </b-table>
        <h4 class="mx-auto" v-if="flows==''">No Flows currently available</h4>
      </b-row>
    </b-container>
  </div>
</template>
<script>
import BarChart from "./Chart.vue";
export default {
  name: "BarChartContainer",
  components: { BarChart },
  data() {
    return {
      chartData: {
        labels: null,
        datasets: [
          {
            label: "Statistics",
            backgroundColor: "#f87979",
            data: null
          }
        ]
      },
      loaded: false,
      size: 50,
      flows: null,
      aux: 0,
      sucess: true,
      fields: {
        id: {
          label: "ID",
          sortable: true
        },
        priority: {
          label: "Priority",
          sortable: true
        },
        deviceId: {
          label: "Device ID",
          sortable: true
        },
        appId: {
          label: "Application ID",
          sortable: true
        },
        "selector.criteria[0].type": {
          label: "Criteria type",
          sortable: false
        },
        "selector.criteria[0].type": {
          label: "Criteria type",
          sortable: false
        },
        "selector.criteria[0].ethType": {
          label: "Ethernet type",
          sortable: false
        },

        "selector.criteria[2].tcpPort": {
          label: "Tcp Port ",
          sortable: true
        },
        state: {
          label: "State",
          sortable: true
        },
        actions: {
          lable: "Actions"
        }
      }
    };
  },
  methods: {
    mostrarGrafico(id, deviceId, row) {
      console.log(id, deviceId);
      let user = {
        ip: this.$store.state.ip,
        username: this.$store.state.username,
        password: this.$store.state.password,
        id: id,
        deviceId: deviceId
      };

      axios
        .post("api/statistics/flow", user)
        .then(response => {
          this.chartData.labels = null;
          this.chartData.datasets[0].data = null;
          this.chartData.labels = response.data[0];
          this.chartData.datasets[0].data = response.data[1];
          this.fillData();
          console.log(this.chartData);
          row.toggleDetails();
        })
        .catch(error => {
          console.log(error);
        });
    },
    fillData() {
      this.chartData.labels.splice(0, 9);
      this.chartData.labels.splice(3, 6);
      this.chartData.labels.shift();
      this.chartData.datasets[0].data.splice(0, 9);
      this.chartData.datasets[0].data.splice(3, 6);
      this.chartData.datasets[0].data.shift();
    },
    showFlows() {
      let user = {
        ip: this.$store.state.ip,
        username: this.$store.state.username,
        password: this.$store.state.password
      };
      axios
        .post("api/flows", user)
        .then(response => {
          this.flows = response.data.flows;
          this.aux = this.flows.length;
        })
        .catch(error => {
          console.log(error);
          console.log(error.response.data.message);
          this.flows = "";
        });
    },
    deleteFlow(flowId, deviceId) {
      let user = {
        ip: this.$store.state.ip,
        username: this.$store.state.username,
        password: this.$store.state.password,
        flowId: flowId,
        deviceId: deviceId
      };
      axios
        .post("api/flows/delete", user)
        .then(response => {
          this.$toasted.success("Flows deleted", {
            duration: 2000,
            position: "top-center",
            theme: "bubble"
          });
          this.showFlows();
        })
        .catch(error => {
          console.log(error);
          console.log(error.response.data.message);
        });
    }
  },
  mounted() {
    this.showFlows();
  }
};
</script>
<style>
#bar-chart {
  max-width: 50% !important;
  max-height: 75% !important;
}
</style>
