<template>
    <div>
        <jism-button-stop></jism-button-stop>
        <jism-button-record></jism-button-record>
        <router-link :to="{ name: 'assign' }"><i class="fa fa-camera" aria-hidden="true"></i></router-link>
        <router-link :to="{ name: 'home' }"><i class="fa fa-arrow-left" aria-hidden="true"></i></router-link>
    </div>
</template>
