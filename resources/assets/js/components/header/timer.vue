<template>
    <span class="dropdown">
        <button class="dropdown-toggle" data-toggle="dropdown">
            {{ videoDuration.duration | secondsToHours }}
        </button>
        <ul class="dropdown-menu duration">
            <li v-for="status in videoDurations">
                <a>P{{ status.pod_id }}/{{ status.pod_side }}: {{ status.duration | secondsToHours }}</a>
            </li>
        </ul>
    </span>
</template>

<script>
    import { mapGetters } from 'vuex'
    export default {
        computed: mapGetters('landlord', ['videoDurations', 'videoDuration']),
        filters: {
            secondsToHours(value) {
                var mom = moment.duration(value, 'seconds'),
                    h = mom.hours(),
                    m = mom.minutes(),
                    s = mom.seconds();
                return h + ':' + m + ':' + s;
            }
        }
    }
</script>
