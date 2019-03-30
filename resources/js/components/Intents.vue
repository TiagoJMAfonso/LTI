<template>
    <div>

        <b-container>
            <b-row>
                <b-col cols="4">
                </b-col>
                <b-col cols="4">
                    <HashLoader class="mx-auto" color="#000000" :size="size" sizeUnit="px"
                                v-if="intents==null"></HashLoader>
                </b-col>
                <b-col cols="4">
                </b-col>
            </b-row>


            <b-row>

                <b-table striped hover :items="intents" :fields="fields" v-if="intents!=null">
                    <template slot="actions" slot-scope="row">
                        <b-button variant="danger" v-on:click.prevent="deleteIntent( row.item.key, row.item.appId)">
                            Delete Intent
                        </b-button>
                    </template>
                </b-table>
                <h4 class="mx-auto" v-if="intents==''">No Intents currently available</h4>

            </b-row>
        </b-container>
    </div>
</template>
<script>
    export default {

        data() {
            return {
                size: 50,
                intents: null,
                aux: 0,
                sucess: true,
                fields: {

                    appId: {
                        label: 'Application ID',
                        sortable: true
                    },
                    type: {
                        label: 'Type',
                        sortable: false
                    },
                    'resources.[0]': {
                        label: 'Source MAC/vlan',
                        sortable: true
                    },
                    'resources.[1]': {
                        label: 'Destination MAC/vlan',
                        sortable: true
                    },
                    key: {
                        label: 'Key',
                        sortable: false
                    },
                    state: {
                        label: 'State',
                        sortable: false
                    },
                    state: {
                        label: 'State',
                        sortable: false
                    },
                    actions: {
                        label: 'Actions',
                        sortable: false
                    },


                },


            };
        },
        methods: {

            showIntents() {
                let user = {
                    ip: this.$store.state.ip,
                    username: this.$store.state.username,
                    password: this.$store.state.password
                };
                axios
                    .post("api/intents", user)
                    .then(response => {
                        this.intents = (response.data.intents);
                        this.aux = this.intents.length;
                    })
                    .catch(error => {
                        console.log(error);
                        console.log(error.response.data.message);
                        this.intents = '';
                    });
            },
            deleteIntent(key, appId) {

                let user = {
                    ip: this.$store.state.ip,
                    username: this.$store.state.username,
                    password: this.$store.state.password,
                    key: key,
                    appId: appId
                };
                axios
                    .post("api/intents/delete", user)
                    .then(response => {
                        this.showIntents();
                    })
                    .catch(error => {
                        console.log(error);
                        console.log(error.response.data.message);
                    });
            }
        },
        mounted() {
            this.showIntents();
        }
    }


</script>