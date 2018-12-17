<!DOCTYPE html>
<html>
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>SRV Selection Software</title>
    <!-- Icons-->
    <link href="<?php echo base_url('node_modules/@coreui/icons/css/coreui-icons.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('node_modules/flag-icon-css/css/flag-icon.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('node_modules/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('node_modules/simple-line-icons/css/simple-line-icons.css') ?>" rel="stylesheet">

    <!-- Add this to <head> -->
<!--    <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap/dist/css/bootstrap.min.css"/>-->
<!--    <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.css"/>-->


    <!-- Main styles for this application-->
    <link href="<?php echo base_url('css/style.css') ?>" rel="stylesheet">

    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());
        // Shared ID
        gtag('config', 'UA-118965717-3');
        // Bootstrap ID
        gtag('config', 'UA-118965717-5');
    </script>
</head>
<body class="index-bg">
<div class="row index-nav bg-white">
    <div class="d-flex-left text-left home pointer unactive" onclick="window.location.href='home'">
        <img src="img/icon/home-icon.png" class="index-nav-icon"><span class="text-blue index-nav-text">Home</span>
    </div>
    <div class="col d-flex text-center pointer unactive" onclick="window.location.href='setting.html'">
        <img src="img/icon/setting-icon.png" class="index-nav-icon"><span
                class="text-blue index-nav-text">Setting</span>
    </div>
    <div class="col d-flex text-center pointer" onclick="window.location.href='signin.html'">
        <img src="img/icon/account-icon.png" class="index-nav-icon"><span
                class="text-blue index-nav-text">Account</span>
    </div>
</div>
<div class="index-container" id="selection-login">
    <div class="col-3 index-logo-container">
        <img src="img/logo/saijo-logo.png" class="index-logo">
    </div>
    <div class="col-12 d-flex flex-column">
        <div class="index-header-container d-flex">
            <span class="text-blue index-header-srv default">SRV</span>
            <span class="text-blue index-header-sub default">Selection<br>Software</span>
        </div>
    </div>



    <div v-if="conditionSign">

        <div class="d-flex flex-column">
            <div v-if="success.length" class="alert alert-success" role="alert">
                <span v-for="msg in success">{{msg}}</span>
            </div>
            <div v-if="is_errors.length" class="alert alert-danger" role="alert">
                <span v-for="msg in is_errors">{{msg}}</span>
            </div>
        </div>
        <div class="d-flex flex-column">
            <div class="login-contrainer input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text input-login-text bg-blue text-white text-left default"
                          id="username-span">Username</span>
                </div>
                <label for="username" class="input-login-label text-blue" id="username-l">|</label>
                <input class="form-control input-login TabOnLogin" id="username" v-model="userFill.user_name"
                       type="text" tabindex="1">
            </div>
        </div>
        <div class="d-flex flex-column">
            <div class="login-contrainer input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text input-login-text bg-blue text-white text-left default"
                          id="password-span">Password</span>
                </div>
                <label for="password" class="input-login-label text-blue" id="password-l">|</label>
                <input class="form-control input-login TabOnLogin" id="password" v-model="userFill.password"
                       type="password" tabindex="2">
            </div>
        </div>
        <div class="d-flex flex-column">
            <div class="login-contrainer">
                <button class="login-button bg-blue text-white" id="sign_in" @click="userLogin">Sign in</button>
                <a class="btn txt-green" @click="userLogin"></a>
                <button class="login-button index-button-margin bg-blue text-white" @click="swichInUp">Sign up new
                    account
                </button>
            </div>
        </div>
    </div>
    <div v-else>
        <div class="d-flex flex-column">
            <div v-if="success.length" class="alert alert-success" role="alert">
                <span v-for="msg in success">{{msg}}</span>
            </div>
            <div v-if="is_errors.length" class="alert alert-danger" role="alert">
                <span v-for="msg in is_errors">{{msg}}</span>
            </div>
        </div>
        <div class="d-flex flex-column">
            <div class="login-contrainer input-group mb-2 ">
                <div class="input-group-prepend">
                    <span class="input-group-text input-login-text bg-blue text-white text-left"
                          id="name-span">Name*</span>
                </div>
                <label for="name" class="input-login-label text-blue" id="name-l">|</label>
                <input class="form-control input-login TabOnEnter" id="name" type="text" tabindex="1"
                       v-model="newUser.name">
            </div>
        </div>
        <div class="d-flex flex-column">
            <div class="login-contrainer input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text input-login-text bg-blue text-white text-left" id="lastname-span">Lastname*</span>
                </div>
                <label for="lastname" class="input-login-label text-blue" id="lastname-l">|</label>
                <input class="form-control input-login TabOnEnter" id="lastname" type="text" tabindex="2"
                       v-model="newUser.lastname">
            </div>
        </div>
        <div class="d-flex flex-column">
            <div class="login-contrainer input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text input-login-text bg-blue text-white text-left"
                          id="email-span">E-mail*</span>
                </div>
                <label for="email" class="input-login-label text-blue" id="email-l">|</label>
                <input v-validate="'required|email'" class="form-control input-login TabOnEnter" name="email" id="email"
                       type="email" tabindex="3" v-model="newUser.email">

            </div>
        </div>
        <div class="d-flex flex-column">
            <div class="login-contrainer input-group mb-5">
                <div class="input-group-prepend">
                    <span class="input-group-text input-login-text bg-blue text-white text-left" id="company-span">Company*</span>
                </div>
                <label for="company" class="input-login-label text-blue" id="company-l">|</label>
                <input class="form-control input-login TabOnEnter" id="company" type="text" tabindex="4"
                       v-model="newUser.company_name">
            </div>
        </div>
        <div class="d-flex flex-column">
            <div class="login-contrainer input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text input-login-text bg-blue text-white text-left" id="username-span">Username*</span>
                </div>
                <label for="username" class="input-login-label text-blue" id="username-l">|</label>
                <input class="form-control input-login TabOnEnter" id="username" type="text" tabindex="5"
                       v-model="newUser.user_name">
            </div>
        </div>
        <div class="d-flex flex-column">
            <div class="login-contrainer input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text input-login-text bg-blue text-white text-left" id="password-span">Password*</span>
                </div>
                <label for="password" class="input-login-label text-blue" id="password-l">|</label>
                <input v-validate="'required'" data-vv-as="password" name="password"
                       class="form-control input-login TabOnEnter" id="password" type="password" tabindex="6"
                       v-model="newUser.password" placeholder="Password" ref="password">

            </div>
        </div>
        <div class="d-flex flex-column">
            <div class="login-contrainer input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text input-login-text input-login-label-confirm bg-blue text-white text-left"
                          id="con_password-span">Confirm<br>Password*</span>
                </div>
                <label for="con_password" class="input-login-label text-blue" id="con_password-l">|</label>
                <input v-validate="'required|confirmed:password'" class="form-control input-login TabOnEnter"
                       name="password_confirmation" id="con_password" type="password" tabindex="7"
                       v-model="newUser.confirm_password" placeholder="Password, Again" data-vv-as="password">
            </div>
            <div class="alert alert-danger" v-show="errors.any()">
                <div v-if="errors.has('password')">
                    {{ errors.first('password') }}
                </div>
                <div v-if="errors.has('password_confirmation')">
                    {{ errors.first('password_confirmation') }}
                </div>
            </div>
        </div>

        <div class="d-flex flex-column">
            <div class="login-contrainer">
                <button class="login-button bg-blue text-white" id="sign_up" @click="userRegister">Sign up new account
                </button>
                <button class="login-button index-button-margin bg-blue text-white" id="sign_in" @click="swichInUp">Sign
                    in
                </button>
            </div>
        </div>
    </div>

</div>
<!-- CoreUI and necessary plugins-->
<script src="<?php echo base_url('js/jquery.min.js') ?>"></script>
<script src="<?php echo base_url('js/vue.js') ?>"></script>
<script src="<?php echo base_url('js/axios.js') ?>"></script>
<script src="<?php echo base_url('js/jquery-ui.js') ?>"></script>
<script src="<?php echo base_url('js/popper.min.js') ?>"></script>
<script src="<?php echo base_url('js/bootstrap.min.js') ?>"></script>
<script src="<?php echo base_url('node_modules/pace-progress/pace.min.js') ?>"></script>
<script src="<?php echo base_url('node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js') ?>"></script>
<script src="<?php echo base_url('node_modules/@coreui/coreui/dist/js/coreui.min.js') ?>"></script>
<!-- Plugins and scripts required by this view-->
<script src="js/script.js"></script>
<script>
    $(document).on("keypress", ".TabOnEnter", function (e) {
        //Only do something when the user presses enter
        if (e.keyCode == 13) {
            var nextElement = $('[tabindex="' + (this.tabIndex + 1) + '"]');
            console.log(this, nextElement);
            if (nextElement.length)
                nextElement.focus()
            else
                $('[tabindex="1"]').focus();
        }
    });

    $(document).on("keypress", ".TabOnLogin", function (e) {
        //Only do something when the user presses enter
        if (e.keyCode == 13) {
            var nextElement = $('[tabindex="' + (this.tabIndex + 1) + '"]');
            console.log(this, nextElement);
            if (nextElement.length)
                nextElement.focus()
            else
                $('[tabindex="1"]').focus();
        }
    });

    //Hidden inputs should get their tabindex fixed, not in scope ;)
    //$(function(){ $('input[tabindex="4"]').fadeOut();  })
</script>
<script src="https://cdn.jsdelivr.net/npm/vee-validate@latest/dist/vee-validate.js"></script>
<script>
    var base_url = window.location.origin;
    var apiUrl = base_url + "/api-v01/user/logon";

    Vue.use(VeeValidate);

    var users = new Vue({
        el: '#selection-login',
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
                success: []
            }
        },
        created() {

        },
        mounted() {
            this.$nextTick(() => {


            })

        },
        methods: {
            userLogin(e) {

                if (this.userFill.user_name != "" && this.userFill.password != "") {
                    let dataForm = this.toFormData(this.userFill)
                    axios.post(apiUrl, dataForm).then(function (response) {

                        console.log(response.data)

                        if (response.data.error) {
                            users.is_errors = []
                            users.is_errors.push("Login fail")

                        } else {
                            users.success.push("Login Success")

                            setTimeout(() => {
                                users.success = []
                                window.location.href = '/home.html'
                            }, 1500);
                        }


                    }).catch(error => {
                    })
                    // console.log(this.userFill)

                    e.preventDefault();
                }

                this.clearMsg();
                if (!this.userFill.user_name) this.is_errors.push('Username required.')
                if (!this.userFill.password) this.is_errors.push(' Password required.')
                e.preventDefault();
            },
            userRegister(e) {
                let newUserApi = base_url + "/api-v01/user/register"


                this.is_errors = []

                if (!this.newUser.email) {
                    this.is_errors.push('Email required.')
                    e.preventDefault()
                }
                if (!this.newUser.password) {
                    this.is_errors.push(' password required.')
                    e.preventDefault()
                }
                if (!this.newUser.user_name) {
                    this.is_errors.push(' User Name required.')
                    e.preventDefault()
                }
                if (!this.newUser.name) {
                    this.is_errors.push(' Name required.')
                    e.preventDefault()
                }
                if (!this.newUser.lastname) {
                    this.is_errors.push(' Last Name required.')
                    e.preventDefault()
                }


                let dataForm = this.toFormData(this.newUser)
                this.$validator
                    .validateAll()
                    .then(function (res) {

                        // console.log(res)
                        // Validation success if response === true
                        if(res){
                            axios.post(newUserApi, dataForm).then(function (response) {

                                console.log(response)

                                if (response.data.error) {
                                    /*** Error ****/
                                    users.is_errors = []
                                    users.success = []
                                    users.is_errors.push(response.data.message)

                                } else {
                                    users.is_errors = []
                                    users.success = []
                                    users.success.push(response.data.message)
                                    /*** Success **/
                                    users.newUser = {
                                        name: '',
                                        lastname: '',
                                        email: '',
                                        company_name: '',
                                        user_name: '',
                                        password: '',
                                        confirm_password: ''
                                    }
                                }



                            }).catch(error => { })
                        }




                    })
                    .catch(function (e) {
                        // Catch errors
                    })


                console.log(this.newUser)

            },
            redirectHome() {
                setTimeout(function () {
                    window.location.href = 'home.html'
                }, 1000)
            },
            swichInUp() {
                this.is_login_mode = !this.is_login_mode
                this.clearMsg()
                console.log(this.is_login_mode)
            },
            clearMsg() {
                users.is_errors = []
                users.success = []
            },
            toFormData: function (obj) {
                var form_data = new FormData();
                for (var key in obj) {
                    form_data.append(key, obj[key]);
                }
                return form_data;
            },
            doLogin() {
                let dataForm = this.toFormData(this.userFill)
                console.log(dataForm)
                // axios.post(apiUrl).then().catch()
            }
        },
        computed: {
            conditionSign() {
                return this.is_login_mode
            }
        }
    })
</script>

<!-- Add this after vue.js -->
<!--<script src="//unpkg.com/babel-polyfill@latest/dist/polyfill.min.js"></script>-->
<!--<script src="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.js"></script>-->
</body>
</html>
