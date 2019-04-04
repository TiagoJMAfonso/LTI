<template>
    <div>
        <b-container>
            <template>

                <b-form-select v-model="selected" :options="optionsDevice">
                    <template slot="first">
                        <option :value="null" disabled>Please select a Device option</option>
                    </template>
                </b-form-select>
                <b-form-select v-model="selected3" :options="options">
                    <template slot="first">
                        <option :value="0" disabled>Please select a Port to apply rules(default is 0)</option>
                    </template>

                </b-form-select>
                <b-form-input
                        id="input-2"
                        v-model="port"
                        required
                        placeholder="Please introduce a  TCP Port number"
                        @change="verifyText()"
                        v-if="visibleRadio"
                ></b-form-input>
                <b-form-input
                        v-model="priority"
                        required
                        placeholder="Please introduce a Priority number"
                ></b-form-input>
                <b-form-group label="Please select a port name " v-if="visible" @change="verifyRadio()">
                    <b-form-radio v-model="selected1" name="some-radios" value="21">FTP</b-form-radio>
                    <b-form-radio v-model="selected1" name="some-radios" value="22">SSH</b-form-radio>
                    <b-form-radio v-model="selected1" name="some-radios" value="23">Telnet</b-form-radio>
                    <b-form-radio v-model="selected1" name="some-radios" value="25">SMTP</b-form-radio>
                    <b-form-radio v-model="selected1" name="some-radios" value="80">HTTP</b-form-radio>
                    <b-form-radio v-model="selected1" name="some-radios" value="110">POP3</b-form-radio>
                    <b-form-radio v-model="selected1" name="some-radios" value="443">HTTPS</b-form-radio>

                </b-form-group>


                <b-button variant="success" v-on:click.prevent="createQOS(0)">Permit Traffic</b-button>
                <b-button variant="info" v-on:click.prevent="clearRadio()" v-if="!visibleRadio">Clear Radio</b-button>
                <b-button variant="danger" v-on:click.prevent="createQOS(1)">Deny Traffic</b-button>
            </template>
        </b-container>

    </div>
</template>
<script>
    export default {

        data() {
            return {
                selected: null,
                selected1: '',
                optionsDevice: [],
                port: '',
                priority: null,
                visible: true,
                visibleRadio: true,
                options: [],
                selected3: '0'

            }
        },
        methods: {
            getDevices() {
                let user = {
                    ip: this.$store.state.ip,
                    username: this.$store.state.username,
                    password: this.$store.state.password,

                };
                axios
                    .post("api/devices", user)
                    .then(response => {
                        let allDevices = response.data.devices;
                        console.log(response.data.devices);
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
            verifyText() {

                if (this.port != '') {
                    this.visible = false;

                } else {
                    this.visible = true;
                }
            },
            verifyRadio() {
                console.log(this.selected1);
                if (this.selected1 != '') {
                    this.visibleRadio = false;

                } else {
                    this.visibleRadio = true;
                }
            },
            clearRadio() {
                this.selected1 = '';
            },
            createQOS(aux) {

                if (this.selected == null) {
                    this.$toasted.error("Please select a Device option", {
                        duration: 3000,
                        position: 'top-center',
                        theme: 'bubble'
                    });
                    return;
                }

                if (this.port < 0 || this.port > 65535 || this.port == null) {
                    this.$toasted.error("Please introduce a port beetween 0 - 65535", {
                        duration: 3000,
                        position: 'top-center',
                        theme: 'bubble'
                    });
                    return;
                }
                if (this.priority < 0 || this.priority > 65535 || this.priority == null) {
                    this.$toasted.error("Please introduce a priority beetween 0 - 65535", {
                        duration: 3000,
                        position: 'top-center',
                        theme: 'bubble'
                    });
                    return;
                }
                if (this.port == '' && this.selected1 == '') {
                    this.$toasted.error("Please select a port name or introduced a port number", {
                        duration: 3000,
                        position: 'top-center',
                        theme: 'bubble'
                    });
                    return;
                }
                if (aux == 1) {

                    this.selected3 = 0;
                }
                if (aux == 0 && this.selected3 == 0) {
                    this.$toasted.error("Please select a port rule to apply", {
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
                    deviceId: this.selected,
                    port: this.port,
                    priority: this.priority,
                    portRadio: this.selected1,
                    portSW: this.selected3


                };

                axios
                    .post("api/qos", user)
                    .then(response => {

                        if (this.port == "") {
                            if (this.selected3 == 0) {
                                this.$toasted.error("Traffic on port " + this.selected1 + " has been dennied", {
                                    duration: 3000,
                                    position: 'top-center',
                                    theme: 'bubble'
                                });
                            } else {
                                this.$toasted.success("Traffic on port " + this.selected1 + " has been allowed", {
                                    duration: 3000,
                                    position: 'top-center',
                                    theme: 'bubble'
                                });
                            }
                        } else {
                            if (this.selected3 == 0) {
                                this.$toasted.error("Traffic on port " + this.port + " has been dennied", {
                                    duration: 3000,
                                    position: 'top-center',
                                    theme: 'bubble'
                                });
                            } else {
                                this.$toasted.success("Traffic on port " + this.port + " has been allowed", {
                                    duration: 3000,
                                    position: 'top-center',
                                    theme: 'bubble'
                                });
                            }
                        }

                    })
                    .catch(error => {
                        console.log(error.response.data.message)
                    });

            }

        },
        mounted() {
            this.getDevices();
        },
        watch: {
            selected1: function () {
                if (this.selected1 != '') {
                    this.visibleRadio = false;
                } else {
                    this.visibleRadio = true;
                }

            },
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
            }


        }
    }


</script>
