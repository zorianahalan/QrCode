<template>
    <div class="header">
        <div class="header-left"> {{ this.user?.email }}</div>
        <div>QrCode App</div>
        <div class="header-right"><ui-btn @click.prevent="logout">Log out</ui-btn></div>
    </div>
    <div class="container">
        <router-view></router-view>
    </div>
</template>

<script>
import auth from '../../store/auth'

export default {
    name: "Home",

    created() {
        this.$store.dispatch("getUser", () => {
            this.user = this.$store.getters.user.data
        })

    },
    data() {
        return {
            user: null,
            qrForm: {}
        }
    },
    methods: {
        logout() {
            this.$store.dispatch("logout")
        }
    }
}
</script>

<style scoped>
    .header {
        position: fixed;
        display: flex;
        height: 40px;
        background: #8770ff;
        width: 100vw;
        top: 0;
        justify-content: space-between;
        color: #ffffff;
        font-size: 16px;
        align-items: center;
        flex-direction: row;
        padding: 0 8px;
    }
    .header-right,
    .header-left {
        display: flex;
        align-items: center;
        height: 100%;
        width: fit-content;
    }
    .container {
        display: flex;
        margin: 40px auto 0 auto;
    }
    .qr-create {
        display: flex;
        flex-direction: column;
        width: 320px;
        gap: 8px;
    }
    .label-group {
        display: flex;
        flex-direction: column;
    }
    .label-group label {
        font-size: 16px;
        color: #8770ff;
        text-align: center;
    }
    .label-group input {
        margin-top: 8px;
        align-self: center;
    }
    fieldset {
        display: flex;
        padding: 8px;
        border: 2px solid #8770ff;
        border-radius: 4px;
        color: #1a1a1a;
    }
    .qr {

    }
</style>
