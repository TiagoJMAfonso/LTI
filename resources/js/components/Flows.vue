<template>
    <div>
        <b-container>
            <b-row>
                <b-col cols="4">
                </b-col>
                <b-col cols="4">
                    <HashLoader class="mx-auto" color="#000000" :size="size" sizeUnit="px"  v-if="flows==null"></HashLoader>
                </b-col>
                <b-col cols="4">
                </b-col>
            </b-row>


            <b-row>

                <b-table striped hover :items="flows" :fields="fields" v-if="flows!=null"/>
                <h4 class="mx-auto" v-if="flows==''">No Flows currently available</h4>

            </b-row>
        </b-container>
    </div>
</template>
<script>
    export default {

        data() {
            return {
                size : 50,
                flows: null,
                aux: 0,
                sucess:true,
                fields: {

                    id: {
                        label: 'ID',
                        sortable: true
                    },
                    tableId: {
                        label: 'Type',
                        sortable: false
                    },
                    priority: {
                        label: 'Priority',
                        sortable: true
                    },
                    deviceId: {
                        label: 'Device ID',
                        sortable: true
                    },
                    'selector.criteria[0].type': {
                        label: 'Criteria type',
                        sortable: false
                    },
                    'selector.criteria[0].type': {
                        label: 'Criteria type',
                        sortable: false
                    },
                    'selector.criteria[0].ethType': {
                        label: 'Criteria type',
                        sortable: false
                    },
                    state: {
                        label: 'State',
                        sortable: false
                    },

                },


            };
        },
        methods: {

            showIntents() {
                let user = { ip: this.$store.state.ip,
                        username: this.$store.state.username,
                        password: this.$store.state.password};
                axios
                    .post("api/flows",user)
                    .then(response => {

                        this.flows = (response.data.flows);
                        this.aux = this.flows.length;
                    })
                    .catch(error => {
                        console.log(error);
                        console.log(error.response.data.message);
                        this.flows = '';
                    });
            },
        },
        mounted() {
            this.showIntents();
        }
    }


</script>