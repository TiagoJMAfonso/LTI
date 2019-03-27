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
                        <b-card-img src="imagens/Links.jpg" class="rounded-0 w-75" />
                        <b-card-body title="Links's ">
                            <b-card-text>
                             <p>olalal</p>
                            </b-card-text>
                        </b-card-body>
                    </b-col>
                    <b-col md="6">
                        <b-card-img src="imagens/switch.png" class="rounded-0  w-75"/>
                        <b-card-body title="Switch's 11">
                            <b-card-text>
                                {{topo.devices}}
                            </b-card-text>
                        </b-card-body>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col md="6">
                        <b-card-img src="imagens/switch.png" class="rounded-0"/>
                        <b-card-body title="Switch's 11">
                            <b-card-text>
                                {{topo.devices}}
                            </b-card-text>
                        </b-card-body>
                    </b-col>
                    <b-col md="6">
                        <b-card-img src="imagens/switch.png" class="rounded-0"/>
                        <b-card-body title="Switch's 11">
                            <b-card-text>
                                {{topo.devices}}
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
                axios
                    .get("api/topology")
                    .then(response => {
                        this.topo = (response.data);
                        console.log(this.topo);

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