<template>
    <div>
        <div>
            <b-navbar toggleable="lg" type="dark" variant="dark">
                <router-link class="navbar-brand" to="/">#LTI</router-link>

                <b-navbar-toggle target="nav_collapse"/>

                <b-collapse is-nav id="nav_collapse">
                    <b-navbar-nav>
                        <router-link class="nav-link" to="/devices">Devices</router-link>

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
                        <b-nav-item href="#">Link</b-nav-item>

                    </b-navbar-nav>

                    <!-- Right aligned nav items -->
                    <b-navbar-nav class="ml-auto">
                        <b-nav-item-dropdown right>
                            <!-- Using button-content slot -->
                            <template slot="button-content"><em>User</em></template>
                            <b-dropdown-item href="#">Profile</b-dropdown-item>
                            <b-dropdown-item href="#">Signout</b-dropdown-item>
                        </b-nav-item-dropdown>
                    </b-navbar-nav>
                </b-collapse>
            </b-navbar>
        </div>
        <div>
            <b-carousel
                    id="carousel1"
                    style="text-shadow: 1px 1px 2px #333;"
                    controls
                    indicators

                    background="#ababab"
                    :interval="4000"
                    img-width="1024"
                    img-height="125"
                    v-model="slide"
                    @sliding-start="onSlideStart"
                    @sliding-end="onSlideEnd"
            >
            <b-carousel-slide caption="Scalability"   img-blank >
                <p>
                    Offers virtually unlimited replication for scaling control plane capacity is needed
                </p>
            </b-carousel-slide>
            <b-carousel-slide caption="High Performance" img-blank>
                <p>
                    Performs to the exacting specifications of large network operators
                </p>
            </b-carousel-slide>
            <b-carousel-slide caption="Resiliency" img-blank>
                <p>
                    Provides the availability required for mission critical operator networks
                </p>
            </b-carousel-slide>
            <b-carousel-slide caption="Legacy device support" img-blank>
                <p>
                    Makes it easy to add or configure traditional devices and services with model based dynamic
                    configuration
                </p>
            </b-carousel-slide>

            <!-- Slide with blank fluid image to maintain slide aspect ratio -->
            <b-carousel-slide caption="Next-Generation device support" img-blank>
                <p>
                    Gives real-time control for native SDN dataplane devices with OpenFlow® and now with P4 support
                </p>
            </b-carousel-slide>
            </b-carousel>

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