<template>
    <div>
    <div>
        <b-input class="mb-2 mr-sm-2 mb-sm-0" v-model="ip" placeholder="IP" />
    </div>
    <div>
        <b-input class="mb-2 mr-sm-2 mb-sm-0"  v-model="username" placeholder="Username" />
    </div>
    <div>
        <b-input class="mb-2 mr-sm-2 mb-sm-0" type="password" v-model="password" placeholder="Password" />
    </div>

        <b-button variant="success" @click="setLogin">Login</b-button>
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
            setLogin(){
                this.$store.state.ip = this.ip
                this.$store.state.username = this.username
                this.$store.state.password = this.password
                if (this.$store.state.ip == '' || this.$store.state.username == '' || this.$store.state.password == '') {
                    this.$toasted.error("Please insert IP, Username and Password", {duration: 3000, position: 'top-center', theme: 'bubble'});
                    return;
                }
                this.$toasted.success("You logged in successfully", {duration: 3000, position: 'top-center', theme: 'bubble'});

            }

        },
        mounted(){
            this.ip = this.$store.state.ip;
            this.username = this.$store.state.username;
            this.password = this.$store.state.password;
        }

    }
</script>