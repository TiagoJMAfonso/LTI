<template>
    <div>
        <div>
            <b-card no-body class="overflow-hidden" style="max-width: 540px;">
                <b-row no-gutters>
                    <b-col md="6">
                        <b-card-img src="imagens/switch.png" class="rounded-0" />
                    </b-col>
                    <b-col md="6">
                        <b-card-body title="Switch's">
                            <b-card-text>
                              {{topo.devices}}
                            </b-card-text>
                        </b-card-body>
                    </b-col>
                </b-row>
            </b-card>
            <b-card no-body class="overflow-hidden" style="max-width: 540px;">
                <b-row no-gutters>
                    <b-col md="6">
                        <b-card-img src="imagens/links.jpg" class="rounded-0" />
                    </b-col>
                    <b-col md="6">
                        <b-card-body title="Link's">
                            <b-card-text>
                                {{topo.links}}
                            </b-card-text>
                        </b-card-body>
                    </b-col>
                </b-row>
            </b-card>
        </div>
    </div>
</template>
<script>
    export default {

        data() {
            return {
                topo: null,
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
                    });
            },
        },
        mounted() {
            this.showTopology();
        }
    }


</script>