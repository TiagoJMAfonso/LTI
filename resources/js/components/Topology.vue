<template>
    <div>
        <b-container>
            <b-row>
                <b-col cols="4">
                </b-col>
                <b-col cols="4">
                    <HashLoader class="mx-auto" color="#000000" :size="size" sizeUnit="px"
                                v-if="topo==null"></HashLoader>
                </b-col>
                <b-col cols="4">
                </b-col>
            </b-row>
            <div v-if="topo!=null">
                <b-row>
                    <b-col md="6">
                        <b-card-img src="imagens/Links.jpg" class="rounded-0 w-50" />
                        <b-card-body title="Links's ">
                            <b-card-text>
                                {{topo.links}}
                            </b-card-text>
                        </b-card-body>
                    </b-col>
                    <b-col md="6">
                        <b-card-img src="imagens/switch.png" class="rounded-0  w-50"/>
                        <b-card-body title="Switch's">
                            <b-card-text >
                                {{topo.devices}}
                            </b-card-text>
                        </b-card-body>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col md="6">
                        <b-card-img src="imagens/flows.png" class="rounded-0 w-50"/>
                        <b-card-body title="Flows">
                            <b-card-text>
                                {{topo.flows}}
                            </b-card-text>
                        </b-card-body>
                    </b-col>
                    <b-col md="6">
                        <b-card-img src="imagens/intents.jpg" class="rounded-0 w-50"/>
                        <b-card-body title="Intents">
                            <b-card-text>
                                {{topo.intents}}
                            </b-card-text>
                        </b-card-body>
                    </b-col>
                </b-row>

            </div>
        </b-container>
    </div>
</template>
<script>
    export default {

        data() {
            return {
                topo: null,
                size:30,
            }
        },
        methods: {

            showTopology() {
                let user = { ip: this.$store.state.ip,
                        username: this.$store.state.username,
                        password: this.$store.state.password};
                axios
                    .post("api/topology", user)
                    .then(response => {
                        this.topo = (response.data);
                    })
                    .catch(error => {
                        console.log(error);
                        console.log(error.response.data.message);
                        this.topo = '';
                    });
            },
        },
        mounted() {
            this.showTopology();
        }
    }


</script>