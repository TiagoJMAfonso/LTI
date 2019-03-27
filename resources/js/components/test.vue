<template>
    <div>
        <b-container>
            <b-row>
                <b-col cols="4">
                </b-col>
                <b-col cols="4">
                    <HashLoader class="mx-auto" color="#000000" :size="size" sizeUnit="px"  v-if="devices==null"></HashLoader>
                </b-col>
                <b-col cols="4">
                </b-col>
            </b-row>


        <b-row>
            <b-table striped hover :items="devices" :fields="fields"  v-if="devices!=null"/>
            <h4 class="mx-auto" v-if="devices==''"> No devices conneted</h4>

        </b-row>
        </b-container>

    </div>
</template>
<script>
    export default {

        data() {
            return {
                size : 50 ,
                devices: null,
                aux :0,
                fields: {
                    id: {
                        label: 'ID',
                        sortable: true
                    },
                    type: {
                        label: 'Type',
                        sortable: false
                    },
                    hw: {
                        // This key overrides `foo`!
                        label: 'Protocol',
                        sortable: false
                    },
                    chassisId: {
                        // This key overrides `foo`!

                        label: 'Ports',
                        sortable: true
                    },
                    humanReadableLastUpdate: {
                        label: 'Connection',
                        sortable: false
                    },
                    role: {
                        label: 'Role',
                        sortable: false
                    },
                    mfr: {
                        label: 'Vendor',
                        sortable: false
                    },

                },


            };
        },
        methods: {

            showDevices() {
                let user = { ip: this.$store.state.ip,
                        username: this.$store.state.username,
                        password: this.$store.state.password};
                console.log(user);
                axios
                    .post("api/devices", user)
                    .then(response => {
                         this.devices = (response.data.devices);
                        console.log(this.devices.length);


                    })
                    .catch(error => {
                        console.log(error);
                        console.log(user);
                        console.log(error.response.data.message)
                        this.devices = '';
                    });
            },
        },
        mounted() {
            this.showDevices();
        }
    }


</script>