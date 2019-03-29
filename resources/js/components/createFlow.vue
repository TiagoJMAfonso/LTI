<template>
    <div>
        <div>
            <b-form-select v-model="selected" :deviceId="deviceId"></b-form-select>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                deviceId: '',
                selected: ''
            };
        },
        methods: {

            createFlow(){
                
                /*axios
                    .post("api/flows/create", flow_data)
                    .then(response => {
                        this. = (response.data.devices);
                        this.$store.state.devices = this.devices;
                    })
                    .catch(error => {
                        console.log(error);
                        console.log(user);
                        console.log(error.response.data.message)
                        this.devices = '';
                    });*/
            }
            
        },
        mounted() {
            let i = "";
            for (i in this.$store.state.devices) {
                let id = this.$store.state.devices[i].id;
            };

        }
    }
</script>