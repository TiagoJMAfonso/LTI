<template>
    <div>
        <b-container>
            <b-row>
                <b-col cols="4">
                </b-col>
                <b-col cols="4">
                    <HashLoader class="mx-auto" color="#000000" :size="size" sizeUnit="px"  v-if="links==null"></HashLoader>
                </b-col>
                <b-col cols="4">
                </b-col>
            </b-row>


        <b-row>

            <b-table striped hover :items="links" :fields="fields" v-if="links!=null"/>
            <h4 class="mx-auto" v-if="links==''"> No links conneted</h4>

        </b-row>
        </b-container>
    </div>
</template>
<script>
    export default {

        data() {
            return {
                size : 50,
                links: null,
                aux: 0,
                sucess:true,
                fields: {

                    'src.device': {
                        label: 'Source Device',
                        sortable: true
                    },
                    'src.port': {
                        label: 'Source Port',
                        sortable: true
                    },
                    'dst.device': {
                        label: 'Destination Device',
                        sortable: true
                    },
                    'dst.port': {
                        label: 'Destination Port',
                        sortable: false
                    },
                    state: {
                        label: 'State',
                        sortable: false
                    },
                    type: {
                        label: 'Type',
                        sortable: false
                    },

                },


            };
        },
        methods: {

            showLinks() {
                let user = { ip: this.$store.state.ip,
                        username: this.$store.state.username,
                        password: this.$store.state.password};
                axios
                    .post("api/links", user)
                    .then(response => {

                        this.links = (response.data.links);
                        console.log(this.links);
                        this.aux = this.links.length;
                        console.log(this.aux);

                    })
                    .catch(error => {
                        console.log(error);
                        console.log(error.response.data.message);
                        this.links = '';
                    });
            },
        },
        mounted() {
            this.showLinks();
        }
    }


</script>