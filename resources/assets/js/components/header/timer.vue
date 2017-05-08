<template>
    <span class="dropdown">
        <button class="dropdown-toggle" data-toggle="dropdown">
            {{ videoDuration | secondsToHours }}
        </button>
        <!-- <ul class="dropdown-menu duration">
            <li v-for="duration in videoDurations">
                <a>{{ duration }} hours</a>
            </li>
        </ul> -->
    </span>
</template>

<script>
    import { mapGetters } from 'vuex'
    export default {
        computed: mapGetters('status', ['videoDuration']),
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
