<template>
    <div class="wrapper">
        <ui-btn style="margin-bottom: 8px;" @click.prevent="$router.push({name: 'home.add'})">Create QrCode</ui-btn>
        <table class="list">
            <thead>
            <tr>
                <th>Content</th>
                <th>Size</th>
                <th>Preview</th>
                <th style="width: 120px">Options</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(qr,index) in qrs" :key="index">
                <td>{{ qr.content }}</td>
                <td>{{ qr.size }}</td>
                <td style="max-height: 100px; overflow: hidden" :ref="'qr_'+qr.id" v-html="qr.qr"></td>
                <td>
                    <ui-btn style="width: 100px; margin-bottom: 8px;" @click.prevent="remove(qr.id)">Delete</ui-btn>
                </td>
            </tr>
            </tbody>
        </table>
    </div>


</template>

<script>

export default {
    name: "List",
    components: {},
    data() {
        return {
            qrs: null
        }
    },
    created() {
        this.gen();
    },
    methods: {
        gen() {
            axios.get('/api/qrs')
                .then(res => this.qrs = res.data)
        },
        remove(id) {
            axios.delete(`/api/delete/qr/${id}`)
                .then(res => this.gen())
        },
    }
}
</script>

<style scoped>
table.list {
    width: 100%;
    background-color: #ffffff;
    border-collapse: collapse;
    border-width: 2px;
    border-color: #8770ff;
    border-style: solid;
    color: #000000;
}

table.list td, table.list th {
    border-width: 2px;
    border-color: #8770ff;
    border-style: solid;
    padding: 3px;
}

table.GeneratedTable thead {
    background-color: #8770ff;
}
.wrapper {
    width: 100%;
    padding: 8px;
}
</style>
