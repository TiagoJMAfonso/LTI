<template>
    <div>
        <b-container>
            <b-row>
                <b-col cols="4">
                </b-col>
                <b-col cols="4">
                    <HashLoader class="mx-auto" color="#000000" :size="size" sizeUnit="px"  v-if="applications==null"></HashLoader>
                </b-col>
                <b-col cols="4">
                </b-col>
            </b-row>


            <b-row>

                <b-table striped hover :items="applications" :fields="fields" v-if="applications!=null">
                    <template slot="actions" slot-scope="row">
                        <b-button variant="success" v-on:click.prevent="ActiveApp(row.item.name)" v-show="row.item.state!='ACTIVE'">Activate </b-button>
                        <b-button variant="danger" v-on:click.prevent="DeleteApp(row.item.name)" v-show="row.item.state=='ACTIVE'">Delete </b-button>
                    </template>
                </b-table>
                <h4 class="mx-auto" v-if="applications==''">No Applications currently installed</h4>

            </b-row>
        </b-container>
    </div>
</template>
<script>
    export default {

        data() {
            return {
                size : 50,
                applications: null,

                sucess:true,
                fields: {

                    id: {
                        label: 'ID',
                        sortable: true
                    },
                    name: {
                        label: 'Name',
                        sortable: true
                    },
                    state: {
                        label: 'State',
                        sortable: true
                    },
                    category: {
                        label: 'Category',
                        sortable: true
                    },
                    description: {
                        label: 'Description',
                        sortable: false
                    },
                    actions : {
                        label:'Actions'
                    }
                },
            };
        },
        methods: {
            showAPP() {
                let user = { ip: this.$store.state.ip,
                    username: this.$store.state.username,
                    password: this.$store.state.password};
                axios
                    .post("api/applications",user)
                    .then(response => {

                        this.applications = (response.data.applications);
                    })
                    .catch(error => {
                        console.log(error);
                        console.log(error.response.data.message);
                        this.applications = '';
                    });
            },
            ActiveApp(appName){
                let user = { ip: this.$store.state.ip,
                    username: this.$store.state.username,
                    password: this.$store.state.password,
                    appName : appName};
                axios
                    .post("api/applications/active",user)
                    .then(response => {
                    })
                    .catch(error => {
                        console.log(error);
                        console.log(error.response.data.message);
                    });
                this.showAPP();

            },
            DeleteApp (appName){
                console.log(appName);
                let user = { ip: this.$store.state.ip,
                    username: this.$store.state.username,
                    password: this.$store.state.password,
                    appName : appName};
                axios
                    .post("api/applications/deactivate",user)
                    .then(response => {

                    })
                    .catch(error => {
                        console.log(error);
                        console.log(error.response.data.message);
                    });
                this.showAPP();
            }
        },
        mounted() {
            this.showAPP();
        }
    }
</script>