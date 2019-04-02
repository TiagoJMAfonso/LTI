<template>
    <div>
        <b-container>
            <template>

                <b-form-select v-model="selected" :options="optionsDevice">
                    <template slot="first">
                        <option :value="null" disabled>Please select an option</option>
                    </template>
                </b-form-select>
                <b-form-select v-model="selected2" :options="options">
                    <template slot="first">
                        <option :value="null" disabled>Please select a port</option>
                    </template>

                </b-form-select>

                <b-button variant="success" v-on:click.prevent="getStatistics()">Show statistic</b-button>
            </template>
        </b-container>

        <bar-chart
                v-if="loaded"
                :chartdata="chartData">
        </bar-chart>
    </div>
</template>
<script>
    import BarChart from './Chart.vue'

    export default {
        name: 'BarChartContainer',
        components: {BarChart},
        data() {
            return {
                selected: null,
                selected2: null,
                optionsDevice: [],
                options: [],
                size: 50,
                loaded: false,
                chartData: null,
                labels: [],
                dados: []
            };
        },
        methods: {
            getDevices() {
                let user = {
                    ip: this.$store.state.ip,
                    username: this.$store.state.username,
                    password: this.$store.state.password
                };
                axios
                    .post("api/devices", user)
                    .then(response => {
                        let allDevices = response.data.devices;
                        allDevices.forEach(device => {
                            this.optionsDevice.push({
                                text: device.id,
                                value: device.id
                            });
                        });
                    })
                    .catch(error => {
                        console.log(error.response.data.message)
                    });

            },
            getStatistics() {
                this.loaded = false;
                if (this.selected == null) {
                    this.$toasted.error("Please select a option", {
                        duration: 3000,
                        position: 'top-center',
                        theme: 'bubble'
                    });
                    return;
                }
                let user = {
                    ip: this.$store.state.ip,
                    username: this.$store.state.username,
                    password: this.$store.state.password,
                    selected: this.selected,
                    selected2: this.selected2
                };
                axios
                    .post("api/statistics/port", user)
                    .then(response => {
                        console.log(response);
                        this.labels = null;
                        this.dados = null;
                        this.labels = response.data[0];
                        this.dados = response.data[1];
                        this.fillData();
                        console.log(this.labels, this.dados);

                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            fillData(){
                console.log("ez")
                this.labels.splice(5, 5);
                this.labels.shift();
                this.dados.splice(5, 5);
                this.dados.shift();
                this.chartData = {
                    labels: this.labels,
                    datasets: [
                        {
                            label: 'Statistics',
                            backgroundColor: '#f87979',
                            data: this.dados,
                        }
                    ]
                };
                this.loaded = true;
            }


        },
        mounted() {
            this.getDevices();

        },
        watch: {
            selected: function () {
                let user = {
                    ip: this.$store.state.ip,
                    username: this.$store.state.username,
                    password: this.$store.state.password,
                    deviceId: this.selected

                };

                axios
                    .post("api/devices/ports", user)
                    .then(response => {
                        this.options = response.data;
                    })
                    .catch(error => {
                        console.log(error.response.data.message)
                    });
            },
            dados : function () {

            }
        }
    }


</script>


