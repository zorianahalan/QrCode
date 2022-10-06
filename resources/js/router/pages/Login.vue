<template>
    <div class="container">
        <div class="login">
            <ui-input v-model="email" type="email" placeholder="Email" />
            <ui-input v-model="password" type="password" placeholder="Password" />

            <ui-btn @click.prevent="login">Submit</ui-btn>
            <router-link to="/register">Register</router-link>
        </div>

    </div>
</template>

<script>
export default {
    name: "Login",
    components: {},
    data() {
        return {
            email: '',
            password: ''
        }
    },
    methods: {
        login() {
            if (this.email && this.password.length >= 8) {
                this.$store.dispatch("login", {
                    email: this.email,
                    password: this.password
                })
            }else alert('Please enter the form')
        }
    }
}
</script>

<style scoped>
    .container {
        display: flex;
        margin: 0 auto;
        width: 320px;
    }

    .login {
        display: flex;
        width: 100%;
        gap: 8px;
        flex-direction: column;
        margin-top: 8px;
    }
</style>
