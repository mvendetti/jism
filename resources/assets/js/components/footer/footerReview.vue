<template>
    <div>
        <jism-button-stop></jism-button-stop>
        <jism-button-record></jism-button-record>
        <jism-button-backward></jism-button-backward>
        <jism-button-pause></jism-button-pause>
        <jism-button-forward></jism-button-forward>
        <router-link :to="{ name: 'camera-settings' }"><i class="fa fa-arrow-left" aria-hidden="true"></i></router-link>
    </div>
</template>
