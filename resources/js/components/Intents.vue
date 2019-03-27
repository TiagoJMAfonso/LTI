<template>
    <div>
        <b-container>
            <b-row>
                <b-col cols="4">
                </b-col>
                <b-col cols="4">
                    <HashLoader class="mx-auto" color="#000000" :size="size" sizeUnit="px"  v-if="intents==null"></HashLoader>
                </b-col>
                <b-col cols="4">
                </b-col>
            </b-row>


            <b-row>

                <b-table striped hover :items="intents" :fields="fields" v-if="intents!=null"/>
                <h4 class="mx-auto" v-if="intents==''">No Intents currently available</h4>

            </b-row>
        </b-container>
    </div>
</template>
<script>
    export default {

        data() {
            return {
                size : 50,
                intents: null,
                aux: 0,
                sucess:true,
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
                    '': {
                        label: 'Actions',
                        sortable: false
                    },



                },


            };
        },
        methods: {

            showIntents() {
                axios
                    .get("api/intents")
                    .then(response => {

                        this.intents = (response.data.intents);
                        console.log(this.intents);
                        this.aux = this.intents.length;
                        console.log(this.aux);

                    })
                    .catch(error => {
                        console.log(error);
                        console.log(error.response.data.message);
                        this.intents = '';
                    });
            },
        },
        mounted() {
            this.showIntents();
        }
    }


</script>