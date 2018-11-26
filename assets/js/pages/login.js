var base_url = window.location.origin;
var apiUrl = base_url + "/api-v01/user/logon";

Vue.use(VeeValidate);

var app = new Vue({
    el:"#app",
    data() {
        return {
            userFill: {user_name: "", password: ""},
            newUser: {
                name: '',
                lastname: '',
                email: '',
                company_name: '',
                user_name: '',
                password: '',
                confirm_password: ''
            },
            msgError: "",
            msgSuccess: "",
            is_login_mode: true,
            is_errors: [],
            is_success: []
        }
    },
    methods: {
        userLogin(e) {

            if (this.userFill.user_name != "" && this.userFill.password != "") {
                let dataForm = this.toFormData(this.userFill)
                axios.post(apiUrl, dataForm).then(function (res) {

                    console.log(res.data)

                    if (res.data.error) {
                        app.is_errors = []
                        app.is_success = []
                        app.is_errors.push("Login fail")
                        console.log(this.is_errors)

                    } else {
                        // this.success.push("Login Success")
                        app.is_success = []
                        app.is_errors = []
                        app.is_success.push("Login Success")
                        console.log(this.is_success)


                        setTimeout(() => {
                            this.success = []
                            window.location.href = '/admin'
                        }, 1500);
                    }


                }).catch(error => {
                    console.log(error)
                })
                // console.log(this.userFill)

                e.preventDefault();
            }


            // if (!this.userFill.user_name) this.is_errors.push('Username required.')
            // if (!this.userFill.password) this.is_errors.push(' Password required.')
            // e.preventDefault();
        },
        changMode(){
            return this.is_login_mode = !this.is_login_mode
        },
        toFormData: function (obj) {
            var form_data = new FormData();
            for (var key in obj) {
                form_data.append(key, obj[key]);
            }
            return form_data;
        }
    },
    computed: {
        conditionSign() {
            return this.is_login_mode
        }
    }
});
