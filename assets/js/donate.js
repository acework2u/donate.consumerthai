var baseUrl = window.location.origin;

var appDonate = new Vue({
    el: "#appDonate",
    data() {
        return {
            siteLang: "thai",
            isActive: false,
            isThaiActive: true
        }
    },
    created(){

    }
   ,
    mounted() {
        this.$nextTick(() => {
            // this.curentLang()
            setTimeout(this.curentLang(), 1000)
        })
    },
    methods: {
        switchlang(text) {
            // console.log(this.$refs.inputlang.value);
            // let siteLang = this.$refs.inputlang.value
            // if (siteLang == "english") {
            //     this.isActive = true
            //     this.isThaiActive = false
            // } else {
            //     this.isActive = false
            //     this.isThaiActive = true
            // }
            let siteLang = text
            if(text=="en"){
                this.isActive = true
                this.isThaiActive = false
            }else{
                this.isActive = false
                this.isThaiActive = true
            }


        },
        curentLang() {
            this.siteLang = this.$refs.inputlang.value
            console.log(this.siteLang+"eng="+this.isActive+"thai="+this.isThaiActive)

            if(this.siteLang=="english"){
                this.isActive = true
                this.isThaiActive = false
            }else{
                this.isActive = false
                this.isThaiActive = true
            }
        }
    },
    computed: {
        fillCurentLang() {
            return this.siteLang
        },
        classEng() {
            return {
                "lang-active": this.isActive
            }
        },
        classThai() {
            return {
                "lang-active": this.isThaiActive
            }
        }

    }


});
// var payconfirm = new Vue({
//     el:"#tranferconfirm",
//     data(){
//         return{
//             donorName:""
//         }
//     },
//     methods:{
//         donorSearch(){
//             setTimeout(()=>{
//                 console.log(this.donorName)
//             },2000)
//
//         }
//     }
//
//
// });
