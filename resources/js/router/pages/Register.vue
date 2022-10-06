<template>
    <div class="container">
        <div class="register">
            <ui-input type="text" v-model="username" placeholder="Username" />
            <ui-input type="email" v-model="email" placeholder="Email" />
            <ui-input type="password" v-model="passwords[0]" placeholder="Password" />
            <ui-input type="password" v-model="passwords[1]" placeholder="Confirm Password" />

            <ui-btn @click.prevent="register">Submit</ui-btn>
            <router-link to="/login">Login</router-link>
        </div>
    </div>
</template>

<script>

export default {
    name: "Register",
    data() {
        return {
            username: '',
            email: '',
            passwords: [],
        }
    },
    methods: {
        register() {
            if (this.username && this.email.includes('@') && this.passwords[0].length >= 8
                && this.passwords[0] === this.passwords[1]) {
                this.$store.dispatch('register', {
                    name: this.username,
                    email: this.email,
                    password: this.passwords[0],
                    password_confirmation: this.passwords[1],
                })


            } else alert('Please enter data in the form')

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

.register {
    display: flex;
    width: 100%;
    gap: 8px;
    flex-direction: column;
    margin-top: 8px;
}
</style>
