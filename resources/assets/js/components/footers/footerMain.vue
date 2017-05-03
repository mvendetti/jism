<template>
    <div>
        <jism-button-stop></jism-button-stop>
        <jism-button-record></jism-button-record>
        <router-link :to="'#'"><i class="fa fa-xing" aria-hidden="true"></i></router-link>
        <router-link :to="{ name: 'settings' }"><i class="fa fa-cog" aria-hidden="true"></i></router-link>
    </div>
</template>
