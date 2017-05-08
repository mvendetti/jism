<template>
    <span class="dropdown">
        <button v-if="batteryDuration" class="dropdown-toggle" data-toggle="dropdown">
            <i v-if="batteryDuration === 1" class="fa fa-battery-quarter" aria-hidden="true"></i>
            <i v-if="batteryDuration === 2" class="fa fa-battery-half" aria-hidden="true"></i>
            <i v-if="batteryDuration === 3" class="fa fa-battery-full" aria-hidden="true"></i>
            <i v-if="batteryDuration === 4" class="fa fa-bolt" aria-hidden="true"></i>
        </button>
        <i v-else class="fa fa-ban" aria-hidden="true"></i>
        <!-- <ul class="dropdown-menu">
            <li v-for="battery in batteryDuration">
                <a v-if="battery === 1">P{{ battery.pod_id }}/{{ battery.pod_side }}: <i class="fa fa-battery-quarter" aria-hidden="true"></i></a>
                <a v-if="battery === 2">P{{ battery.pod_id }}/{{ battery.pod_side }}: <i class="fa fa-battery-half" aria-hidden="true"></i></a>
                <a v-if="battery === 3">P{{ battery.pod_id }}/{{ battery.pod_side }}: <i class="fa fa-battery-full" aria-hidden="true"></i></a>
                <a v-if="battery === 4">P{{ battery.pod_id }}/{{ battery.pod_side }}: <i class="fa fa-bolt" aria-hidden="true"></i></a>
            </li>
        </ul> -->
    </span>
</template>

<script>
    import { mapGetters } from 'vuex'
    export default {
        computed: mapGetters('status', ['batteryDuration']),
    }
</script>
