<template>
    <span class="dropdown" v-if="videoDuration">
        <button class="dropdown-toggle" data-toggle="dropdown">
            {{ videoDuration.duration | secondsToHours }}
        </button>
        <ul class="dropdown-menu duration">
            <li v-for="status in videoDurations">
                <!-- eventually need to add which pod side next to pod number -->
                <a>P{{ pod.number }}: {{ status.duration | secondsToHours }}</a>
            </li>
        </ul>
    </span>
</template>

<script>
    import { mapGetters } from 'vuex'
    export default {
        computed: mapGetters('landlord', ['pod', 'videoDurations', 'videoDuration']),
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
