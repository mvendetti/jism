<template>
    <div>
        <jism-button-stop></jism-button-stop>
        <jism-button-record></jism-button-record>
        <router-link :to="'#'"><i class="fa fa-volume-up" aria-hidden="true"></i></router-link>
        <router-link :to="'#'"><i class="fa fa-plus" aria-hidden="true"></i></router-link>
        <router-link :to="'#'"><i class="fa fa-minus" aria-hidden="true"></i></router-link>
        <router-link v-if="$route.params.camera_id === 'left'" :to="{ path: '/pod/' + $route.params.pod_id +'/camera/' + $route.params.camera_id + '/settings' }"><i class="fa fa-cog" aria-hidden="true"></i></router-link>
        <router-link v-if="$route.params.camera_id === 'right'" :to="{ path: '/pod/' + $route.params.pod_id +'/camera/' + $route.params.camera_id + '/settings' }"><i class="fa fa-cog" aria-hidden="true"></i></router-link>
    </div>
</template>
