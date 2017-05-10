<template>
    <span class="dropdown">
        <button class="dropdown-toggle" data-toggle="dropdown">
            <i v-if="batteryDuration.battery_level_id === 1" class="fa fa-battery-quarter" aria-hidden="true"></i>
            <i v-if="batteryDuration.battery_level_id === 2" class="fa fa-battery-half" aria-hidden="true"></i>
            <i v-if="batteryDuration.battery_level_id === 3" class="fa fa-battery-full" aria-hidden="true"></i>
            <i v-if="batteryDuration.battery_level_id === 4" class="fa fa-bolt" aria-hidden="true"></i>
            <i v-if="batteryDuration.battery_level_id === 0" class="fa fa-ban" aria-hidden="true"></i>
        </button>
        <ul class="dropdown-menu">
            <li v-for="status in batteryDurations">
                <a v-if="status.battery_level_id === 1">P{{ status.pod_id }}/{{ status.pod_side }}: <i class="fa fa-battery-quarter" aria-hidden="true"></i></a>
                <a v-if="status.battery_level_id === 2">P{{ status.pod_id }}/{{ status.pod_side }}: <i class="fa fa-battery-half" aria-hidden="true"></i></a>
                <a v-if="status.battery_level_id === 3">P{{ status.pod_id }}/{{ status.pod_side }}: <i class="fa fa-battery-full" aria-hidden="true"></i></a>
                <a v-if="status.battery_level_id === 4">P{{ status.pod_id }}/{{ status.pod_side }}: <i class="fa fa-bolt" aria-hidden="true"></i></a>
            </li>
        </ul>
    </span>
</template>

<script>
    import { mapGetters } from 'vuex'
    export default {
        computed: mapGetters('landlord', ['batteryDurations', 'batteryDuration']),
    }
</script>
