<template>
    <div class="container">
        <div class="qr-create">
            <ui-input v-model="qrForm['content']" placeholder="Content"/>
            <ui-input v-model="qrForm['size']" placeholder="Size"/>

            <fieldset>
                <legend>Styles</legend>
                <div class="label-group" style="width: 50%">
                    <label for="background">Background color:</label>
                    <ui-input type="color" v-model="qrForm['background']" id="background"/>
                </div>

                <div class="label-group" style="width: 50%">
                    <label for="fill">Fill color</label>
                    <ui-input type="color" v-model="qrForm['fill']" id="fill"/>
                </div>
            </fieldset>
            <ui-btn @click.prevent="qrCreate">Create</ui-btn>
        </div>
        <div class="qr" ref="qr">

        </div>
    </div>
</template>

<script>

export default {
    name: "Add",

    created() {
        axios.get('/api/user')
            .then(data => this.user = data.data)
    },
    data() {
        return {
            user: null,
            qrForm: {}
        }
    },
    methods: {
        qrCreate() {
            if (this.qrForm['content'] && this.qrForm['size']) {
                if (!this.qrForm['background']) this.qrForm['background'] = '#ffffff';
                if (!this.qrForm['fill']) this.qrForm['fill'] = '#000000'
                console.log(this.qrForm);
                axios.post('/api/qr', {
                    content: this.qrForm['content'],
                    fill: this.hexToRgbA(this.qrForm['fill']),
                    background: this.hexToRgbA(this.qrForm['background']),
                    size: this.qrForm['size'],
                })
                    .then(data => {
                        if (data['data']) this.$router.push({ name: 'home.list' })
                    })

            }else alert('Enter fields in the form!')
        },
        hexToRgbA(hex){
            let c;
            if(/^#([A-Fa-f0-9]{3}){1,2}$/.test(hex)){
                c= hex.substring(1).split('');
                if(c.length== 3){
                    c= [c[0], c[0], c[1], c[1], c[2], c[2]];
                }
                c= '0x'+c.join('');
                return 'rgba('+[(c>>16)&255, (c>>8)&255, c&255].join(',')+',1)';
            }
            throw new Error('Bad Hex');
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
