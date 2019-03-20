<template>
    <div>
        <div>
            <b-button  v-on:click.prevent="showDevices()">Click me to get all machines</b-button>

        </div>
    </div>
</template>
<script>
    export default {

        data() {
            return {};
        },
        methods: {

            showDevices() {
                console.log("esqui aqui ");

            }
        }
    }


</script>