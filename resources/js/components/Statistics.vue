<template>
    <div>
        <b-container>
            <template>

                <b-form-select v-model="selected"  :options="optionsDevice">
                    <template slot="first">
                        <option :value="null" disabled>Please select an option</option>
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
        components: { BarChart },
        data() {
            return {
                selected: null,
                optionsDevice: [
                ],
                size: 50,
                loaded: false,
                chartData: null,

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
                    if (this.selected == null){
                        this.$toasted.error("Please select a option", {duration: 3000, position: 'top-center', theme: 'bubble'});
                        return;
                    }
                    let user = {
                        ip: this.$store.state.ip,
                        username: this.$store.state.username,
                        password: this.$store.state.password,
                        selected: this.selected
                    };
                    axios
                        .post("api/statistics", user)
                        .then(response => {
                            
                            let labels = response.data[0];
                            let dados = response.data[1];
                            console.log(labels,dados);
                            this.chartData = {
                              labels: labels,
                              datasets: [
                                {
                                  label: 'Statistics',
                                  backgroundColor: '#f87979',
                                  data: dados
                                }
                              ]
                            };
                            this.loaded = true;
                        })
                        .catch(error => {
                            console.log(error);
                        });
                },


        },
        mounted() {
            this.getDevices();

        }
    }


</script>


