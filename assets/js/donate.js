var baseUrl = window.location.origin;

var appDonate = new Vue({
    el: "#appDonate",
    data() {
        return {
            siteLang: "",
            amount: "",
            donateAmount: "",
            dataconn: "",
            datacheck: {},
            login: "",
            senha: "",
            log:""
        }
    },
    create() {

    },
    mounted() {
        this.$nextTick(() => {


        })
    },
    methods: {
        switchlang() {
            console.log(this.$refs);
        },
        padAmount(str, max) {
            return str.length < max ? pad("0" + str, max) : str;
        },
        pad(strNumber) {
            var num = strNumber.toString()
            return num.padStart(12, '0');
        },
        checkAmount(event) {
            console.log(event);
            if (event) {
                // alert(event.target.value)
                this.amount = event.target.value
            }

            let apiConfirmData = baseUrl + "/api-v01/confirm-data"

            let orderNo = this.$refs.orderno.value;

            let dataInfo = {order_no:orderNo,donate_amount:this.donate_amount}

            console.log(dataInfo)

            var fromData = this.toFormData(dataInfo)

            axios.post(apiConfirmData,fromData).then((res)=>{
                if(res.data.error){

                }else{
                    appDonate.dataconn = res.data.message
                }

                appDonate.dataconn = res.data.message

                console.log(orderNo)





            }).catch((err)=>{

            })






        },
        checkData() {
            let apiConfirmData = baseUrl + "/api-v01/confirm-data"

            let orderNo = this.$refs.orderno.value

            let dataInfo = {order_no:orderNo,donate_amount:this.donate_amount}

            var fromData = this.toFormData(dataInfo)

            axios.post(apiConfirmData,fromData).then((res)=>{
                if(res.data.error){

                }else{
                    // this.dataconn = res.data


                    console.log(res)
                }
            }).catch((err)=>{

            })

        },
        toFormData: function (obj) {
            var form_data = new FormData();
            for (var key in obj) {
                form_data.append(key, obj[key]);
            }
            return form_data;
        },
        sub: function(event){

            if(this.login == "" || this.senha == ""){

                this.log = "Preencha o campo para login.";
                event.preventDefault();
            }else{
                this.log = "Go";
            }
        }
    },
    computed: {
        filterAmount() {
            let amt = this.amount * 100;
            this.donateAmount = this.pad(amt);
            return this.donateAmount
        },
        filterDataConn(){
            return this.dataconn
        }

    }


});
