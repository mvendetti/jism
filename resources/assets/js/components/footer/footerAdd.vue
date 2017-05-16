<template>
    <div>
        <jism-button-stop></jism-button-stop>
        <jism-button-record></jism-button-record>
        <router-link :to="{ name: 'remove' }"><i class="fa fa-minus" aria-hidden="true"></i></router-link>
        <router-link :to="{ name: 'home' }"><i class="fa fa-arrow-left" aria-hidden="true"></i></router-link>
    </div>
</template>
