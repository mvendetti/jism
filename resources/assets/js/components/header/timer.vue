<template>
    <span class="dropdown">
        <button class="dropdown-toggle" data-toggle="dropdown">
            {{ remainingVideoDuration | secondsToHours }}
        </button>
    </span>
</template>

<script>
    import { mapGetters } from 'vuex'
    export default {
        computed: mapGetters('status', ['remainingVideoDuration']),
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
