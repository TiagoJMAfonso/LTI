<template>
    <div>
    <div>
        <b-input class="mb-2 mr-sm-2 mb-sm-0" v-model="ip" placeholder="IP" />
    </div>
    <div>
        <b-input class="mb-2 mr-sm-2 mb-sm-0"  v-model="username" placeholder="Username" />
    </div>
    <div>
        <b-input class="mb-2 mr-sm-2 mb-sm-0"  v-model="password" placeholder="Password" />
    </div>

        <b-button variant="success" @click="changeConfig">Ok</b-button>
    </div>
</template>
<script>

    export default {
        data() {
            return {
                ip : '',
                username : '',
                password : '',

            }
        },
        methods: {
            changeConfig(){
                this.$store.state.ip = this.ip
                this.$store.state.username = this.username
                this.$store.state.password = this.password
                console.log(this.$store.state.ip);
                console.log(this.$store.state.username);
                console.log(this.$store.state.password);

            }

        },
        mounted() {
            console.log(this.$store.state.ip);
        }
    }
</script>