<template>
    <div>
        <b-container>
            <b-row>
                <b-col cols="4">
                </b-col>
                <b-col cols="4">
                    <HashLoader class="mx-auto" color="#000000" :size="size" sizeUnit="px"
                                v-if="hosts==null"></HashLoader>
                </b-col>
                <b-col cols="4">
                </b-col>
            </b-row>


            <b-row>
                <b-table striped hover :items="hosts" :fields="fields" v-if="hosts!=null">
                    <template slot="actions" slot-scope="row">
                        <b-form-select v-model="row.selected" :options="optionsHosts" >
                            <template slot="first" >
                                <option :value="row.null" disabled>Please select an option</option>
                            </template>
                        </b-form-select>
                        <b-button variant="success" v-on:click.prevent="AddConnection(row.selected, row.item.mac)">Add Connection </b-button>
                    </template>
                </b-table>
                <h4 class="mx-auto" v-if="hosts==''"> No hosts conneted</h4>
            </b-row>

        </b-container>
    </div>
</template>
<script>
    export default {

        data() {
            return {
                optionsHosts: [],
                selected : "",
                size: 50,
                hosts: [],
                fields: {
                    'ipAddresses.0': {
                        label: 'IP Address',
                        sortable: true
                    },
                    mac: {
                        label: 'MAC',
                        sortable: true
                    },
                    id: {
                        label: 'ID',
                        sortable: true
                    },
                    'locations.0.elementId': {
                        label: 'Connect to ',
                        sortable: false
                    },
                    'locations.0.port': {
                        label: 'Connected on Port',
                        sortable: false
                    },
                    vlan: {
                        label: 'Vlan',
                        sortable: false
                    },
                    configured: {
                        lable: 'Configured'
                    },
                    actions: {
                        label: 'Actions'
                    }

                },


            };
        },
        methods: {

            showHosts() {
                let user = {
                    ip: this.$store.state.ip,
                    username: this.$store.state.username,
                    password: this.$store.state.password
                };
                axios
                    .post("api/hosts", user)
                    .then(response => {
                        this.hosts = (response.data.hosts);
                        this.hosts.forEach(host => {
                             this.optionsHosts.push({
                                text: host.ipAddresses[0],
                                value: host.mac
                            });
                        });


                    })
                    .catch(error => {
                        console.log(error);
                        console.log(error.response.data.message);
                        this.hosts = '';
                    });
            },
            AddConnection(macSelected,macOriginal){
                console.log(macSelected,macOriginal);
                if(macSelected == macOriginal ){
                    this.$toasted.error("The IP can not be the same", {duration: 3000, position: 'top-center', theme: 'bubble'});
                    return;
                }
                if (macSelected ==null){
                    this.$toasted.error("Please select a field", {duration: 3000, position: 'top-center', theme: 'bubble'});
                    return;
                }
                let user = {
                    ip: this.$store.state.ip,
                    username: this.$store.state.username,
                    password: this.$store.state.password,
                    macS: macSelected,
                    macO: macOriginal
                };
                console.log(user);
                axios
                    .post("api/intents/add", user)
                    .then(response => {
                        this.$toasted.success("Connection created", {duration: 3000, position: 'top-center', theme: 'bubble'});
                    })
                    .catch(error => {
                        console.log(error);
                        console.log(error.response.data.message)
                    });

            }
        },
        mounted() {
            this.showHosts();

        }
    }


</script>