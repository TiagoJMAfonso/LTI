<template>
    <div>
        <b-container>
            <template>
                <b-form-select v-model="selected" :options="optionsDevice">
                    <template slot="first" >
                        <option :value="optionsDevice.null" disabled>Please select an option</option>
                    </template>
                </b-form-select>
                <b-button variant="success" v-on:click.prevent="getStatistics()">Show statistic</b-button>
            </template>
        </b-container>
    </div>
</template>
<script>
    export default {

        data() {
            return {
                optionsDevice: [],
                selected : "",
                size: 50
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
                    console.log(this.optionsDevice);
                },
                getStatistics(){
                    console.log(this.selected);
                }
        },
        mounted() {
            this.getDevices();

        }
    }


</script>