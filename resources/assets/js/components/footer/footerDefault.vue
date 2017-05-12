<template>
    <div>
        <jism-button-stop></jism-button-stop>
        <jism-button-record></jism-button-record>
        <router-link v-if="$route.name === 'pod-settings'" :to="{ name: 'pod' }"><i class="fa fa-arrow-left" aria-hidden="true"></i></router-link>
        <router-link v-if="$route.name === 'camera-settings'" :to="{ name: 'camera' }"><i class="fa fa-arrow-left" aria-hidden="true"></i></router-link>
        <router-link v-if="$route.name === 'remove'" :to="{ name: 'add' }"><i class="fa fa-arrow-left" aria-hidden="true"></i></router-link>
    </div>
</template>
