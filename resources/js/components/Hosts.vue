<template>
    <div>
        <b-container>
            <b-row>
                <b-col cols="4">
                </b-col>
                <b-col cols="4">
                    <HashLoader class="mx-auto" color="#000000" :size="size" sizeUnit="px"  v-if="hosts==null"></HashLoader>
                </b-col>
                <b-col cols="4">
                </b-col>
            </b-row>


        <b-row>
            <b-table striped hover :items="hosts" :fields="fields"  v-if="hosts!=null"/>
            <h4 class="mx-auto" v-if="hosts==''"> No hosts conneted</h4>
        </b-row>

        </b-container>
    </div>
</template>
<script>
    export default {

        data() {
            return {
                size : 50,
                hosts: null,
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
                    configured : {
                        lable: 'Configured'
                    }

                },


            };
        },
        methods: {

            showHosts() {
                let user = { ip: this.$store.state.ip,
                        username: this.$store.state.username,
                        password: this.$store.state.password};
                axios
                    .post("api/hosts", user)
                    .then(response => {
                        this.hosts = (response.data.hosts);
                    })
                    .catch(error => {
                        console.log(error);
                        console.log(error.response.data.message);
                        this.hosts = '';
                    });
            },
        },
        mounted() {
            this.showHosts();
        }
    }


</script>