<template>
    <div>
        <div>
            <b-navbar toggleable="lg" type="dark" variant="dark">
                <router-link tag="h1" class="navbar-brand" to="/">#LTI</router-link>

                <b-navbar-toggle target="nav_collapse"/>

                <b-collapse is-nav id="nav_collapse">
                    <b-navbar-nav>
                        <router-link  class="nav-link" to="/devices">Devices</router-link>

                    </b-navbar-nav>
                    <b-navbar-nav>
                        <router-link class="nav-link" to="/links">Links</router-link>

                    </b-navbar-nav>
                    <b-navbar-nav>
                        <router-link class="nav-link" to="/hosts">Hosts</router-link>

                    </b-navbar-nav>
                    <b-navbar-nav>
                        <router-link class="nav-link" to="/topology">Topology</router-link>
                    </b-navbar-nav>
                    <b-navbar-nav>
                        <router-link class="nav-link" to="/flows">Flows</router-link>
                    </b-navbar-nav>
                    <b-navbar-nav>
                        <router-link class="nav-link" to="/intents">Intents</router-link>
                    </b-navbar-nav>
                    <b-navbar-nav>
                        <router-link class="nav-link" to="/flows/create">Create Flow</router-link>
                    </b-navbar-nav>
                    <!-- Right aligned nav items -->

                </b-collapse>
            </b-navbar>
        </div>

        <b-container>
            <b-row>
                <b-col class="mt-5">
                    <router-view></router-view>
                </b-col>
            </b-row>
        </b-container>


    </div>
</template>
<script>
    export default {
        data() {
            return {
                slide: 0,
                sliding: null,
                sucess: true,


            }
        },
        methods: {
            onSlideStart(slide) {
                this.sliding = true
            },
            onSlideEnd(slide) {
                this.sliding = false
            }
        }
    }
</script>