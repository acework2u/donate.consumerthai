<div class="app-body">
    <div class="sidebar border-r-blue">
        <nav class="sidebar-nav" id="floorlist_left">
            <ul class="nav">
                <li class="nav-item">
                    <img src="/img/icon/saijo-logo/saijo_logo.png">
                    <h4>Centralized Control</h4>
                </li>

                <li class="nav-item nav-dropdown border-r-blue">
                    <a class="nav-links nav-dropdown  bg-blue" style="margin-top: 20px;"
                       href="<?php echo base_url('userlist'); ?>">User List</a>
                </li>



            </ul>
        </nav>
    </div>
    <div class="main">
        <ol class="breadcrumb">
            <h2><?php echo @$title;?></h2>

        </ol>


        <div class="container-fluid" id="user-ma">
            <?php if(isAdmin() || isSuperAdmin()) {?>
            <div class="row">
                <div class="col-md-7">
                    <h2>{{title}}</h2>
                    <div class="right mb-1 white"><button data-target="#addUserForm" data-toggle="modal" class="btn btn-success mr-4">New</button><button @click="prevPage" class="bg-blue btn white"><<</button> <button class="btn bg-blue white" @click="nextPage"> >> </button></div>
                    <div class="left"><input class="input-group" v-model="search" type="text" placeholder="search by email"></div>
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th>Email</th>
                            <th>Name</th>
                            <th>Last Name</th>
                            <th>User Role</th>
                            <th>User Group</th>
                            <th>Status</th>
                            <th>Customer Code</th>
                            <th>Action</th>
                        </tr>

                        </thead>

                        <tbody>
                        <tr v-for="user ,index in usersFillter">
                            <td>{{user.email}}</td>
                            <td>{{user.name}}</td>
                            <td>{{user.last_name}}</td>
                            <td>{{user.role_name}}</td>
                            <td>{{user.group_name}}</td>
                            <td>{{user.status}}</td>
                            <td>{{user.id}}</td>
                            <td><i @click="selectUser(user)" data-target="#updateUserForm" data-toggle="modal" class="btn fa fa-edit fa-lg"></i> | <i @click="selectUser(user)" data-target="#delUserForm" data-toggle="modal" class="btn fa fa-trash-o fa-lg"></i></td>
                        </tr>
                        </tbody>

                    </table>
                    <p class="right text-black-50">{{page}} of {{total}}</p>
                </div>
                <div class="col-md-5">
                   <?php if(isSuperAdmin()){ ?>
                    <div class="ml-md-4">
                    <h2>Group</h2>
                        <table class="table table-sm ">
                            <thead>
                            <tr>
                                <th>Index</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="item,index in groupList">
                                <td>{{item.id}}</td>
                                <td>{{item.name}}</td>
                                <?php if(getUserRoleId()==1){?>
                                <td><i class="btn fa fa-edit fa-lg"></i> | <i  class="btn fa fa-trash-o fa-lg"></i></td>
                                <?php }else{ ?>
                                    <td> </td>
                               <?php } ?>

                            </tr>
                            </tbody>
                        </table>
                </div>
                   <?php } else{ ?>

                   <?php }?>

                </div>
            </div>
            <?php }else{?>
                <div class="row">
                    <div class="col-md-3">
                        <p class="alert-danger">You do not have access to data.</p>
                    </div>
                </div>
           <?php }?>

            <!--- Modal --->
            <div class="modal fade" id="addUserForm" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-blue white">
                            <h5 class="modal-title" id="exampleModalLongTitle">Add New User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                    @click="userCancel()">
                                <span class="white" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="alert alert-success" role="alert" v-if="successMessage">
                                {{successMessage}}
                            </div>

                            <div class="alert alert-danger" role="alert" v-if="errorMessage">
                                {{errorMessage}}

                            </div>

                            <div class="form-row">
                                <div class="col">
                                    <label class="col-form-label">Name</label>
                                    <input class="input-group" type="text" v-model="newUser.name" required>
                                </div>
                                <div class="col ml-1">
                                    <label class="col-form-label">Last Name</label>
                                    <input type="text" v-model="newUser.lastname" class="input-group">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label class="col-form-label">Email</label>
                                    <input v-model="newUser.email" class="input-group">
                                </div>

                                <div class="col">
                                    <label class="col-form-label">Password</label>
                                    <input v-model="newUser.password" class="input-group" type="password">
                                </div>
                            </div>

                            <div class="form-row">

                                <div class="col">
                                    <label class="col-form-label">Group</label>
                                    <select v-model="newUser.group_id" class="form-control">
                                        <option v-for="user_g ,index in groupList" :key="user_g.id"  :value="user_g.id" >{{user_g.name}}</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label class="col-form-label">Role</label>
                                    <select v-model="newUser.role_id" class="form-control">
                                        <option v-for="user_r ,index in roleList" :key="user_r.id"  :value="user_r.id" >{{user_r.name}}</option>
                                    </select>
                                </div>


                            </div>




                            <div class="form-row mt-1">

                                <div class="col">

                                </div>
                                <div class="col">

                                </div>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                    @click="userCancel()">Cancel
                            </button>
                            <button type="submit" class="btn btn-primary" @click="saveUser('new')">Add</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--- Update User Modal -->
            <div class="modal fade" id="updateUserForm" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-blue white">
                            <h5 class="modal-title" id="exampleModalLongTitle">Update User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                    @click="userCancel()">
                                <span class="white" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="alert alert-success" role="alert" v-if="successMessage">
                                {{successMessage}}
                            </div>

                            <div class="alert alert-danger" role="alert" v-if="errorMessage">
                                {{errorMessage}}

                            </div>

                            <div class="form-row">
                                <div class="col">
                                    <label class="col-form-label">Name</label>
                                    <input class="input-group" type="text" v-model="clickedUser.name" required>
                                </div>
                                <div class="col ml-1">
                                    <label class="col-form-label">Last Name</label>
                                    <input type="text" v-model="clickedUser.last_name" class="input-group">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label class="col-form-label">Email</label>
                                    <input v-model="clickedUser.email" class="input-group">
                                </div>

                                <div class="col">
                                    <label class="col-form-label">Password</label>
                                    <input ref="chgpassword" v-model="clickedUser.password" class="input-group" type="password">
                                </div>
                            </div>

                            <div class="form-row">

                                <div class="col">
                                    <label class="col-form-label">Group</label>
                                    <select v-model="clickedUser.customer_group_id" class="form-control">
                                        <option v-for="user_g ,index in groupList" :key="user_g.id"  :value="user_g.id" >{{user_g.name}}</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label class="col-form-label">Role</label>
                                    <select v-model="clickedUser.user_role_id" class="form-control">
                                        <option v-for="user_r ,index in roleList" :key="user_r.id"  :value="user_r.id" >{{user_r.name}}</option>
                                    </select>
                                </div>

                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                    @click="userCancel()">Cancel
                            </button>
                            <button type="submit" class="btn btn-primary" @click="saveUser('update')">Update</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--Modal Delete-->
            <div class="modal fade" id="delUserForm" tabindex="-1" role="dialog"
                 aria-labelledby="Delete Floor" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Delete User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                    @click="userCancel()">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-success" role="alert" v-if="successMessage">
                                {{successMessage}}
                            </div>

                            <div class="alert alert-danger" role="alert" v-if="errorMessage">
                                {{errorMessage}}

                            </div>
                            <p>Are you sure you want to delete this account email {{clickedUser.email}} ?</p>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                    @click="userCancel()">Cancel
                            </button>
                            <button type="button" class="btn btn-danger" @click="saveUser('delete')"
                            >Delete
                            </button>
                        </div>

                    </div>
                </div>
            </div>




        </div>
    </div>
</div>

<script>
    var base_url = window.location.origin;
    let apiUrl = base_url + "/api-v01/user/user-list";
    let apiGroup = base_url + "/api-v01/user/group-list";
    let apiUser = base_url + "/api-v01/user/ma";

  var Users =   new Vue({
        el:"#user-ma",
        data(){
            return{
                usersInfo: [],
                groupList:[],
                title:"User List",
                newUser:{email:"",name:"",lastname:"",password:"",role_id:4,group_id:1},
                roleList:[{id:3,name:"technician"},{id:4,name:"customer"}],
                clickedUser: {},
                limit:150,
                start:0,
                total:"",
                currentPage:1,
                search:'',
                successMessage:'',
                errorMessage:''
            }
        },
        created(){
            this.getUserList()
            this.getGroupList()
        },
        mounted() {
            this.$nextTick(() => {
                this.getUserList()
                this.getGroupList()
            })

        },
        methods:{
            getUserList(){
                axios.get(apiUrl+"?limit="+this.limit+"&start="+this.start).then(response => (this.usersInfo = response.data.userinfo,this.total = response.data.total_list))
            },
            getGroupList(){
                axios.get(apiGroup).then(response =>(this.groupList = response.data)).catch(error => { // console.log(error);
                })
            },
            saveUser(actions){

                var dataUser

                    if(actions==="new"){
                        dataUser = this.newUser
                        if(!this.newUser.name){
                            this.errorMessage ="Name required."

                        }
                        if(!this.newUser.email){
                            this.errorMessage ="Name required."

                        }else if(!this.validEmail(this.newUser.email)){
                            this.errorMessage ="Valid email required."

                        }
                    }
                    if(actions ==="delete"){
                        dataUser = this.clickedUser
                    }

                    if(actions ==="update"){
                        var passd = this.$refs.chgpassword.value
                        if(!passd){
                            this.clickedUser.password = passd
                        }

                        dataUser = this.clickedUser
                    }

                console.log(dataUser)
                this.clearMessage()

                var fromData = this.toFormData(dataUser)
                    axios.post(apiUser+'?action='+actions,fromData).then(function (response) {

                        Users.newUser = {email:"",name:"",lastname:"",password:"",role_id:4,group_id:1}
                        if(actions ==="new"){
                            Users.clickedUser = {}
                       }

                     if(response.data.error){
                         Users.errorMessage = response.data.message

                    }else{
                         Users.successMessage = response.data.message
                         Users.getUserList()
                    }

                    }).catch(error=>{})
            },
            nextPage(){
                this.start = this.start+this.limit
                this.getUserList()
            },
            prevPage(){
                if(this.start >0){
                    this.start = this.start - this.limit
                    this.getUserList()
                }
            },
            userCancel: function () {
                this.clearMessage()
            },
            toFormData: function (obj) {
                var form_data = new FormData();
                for (var key in obj) {
                    form_data.append(key, obj[key]);
                }
                return form_data;
            },
            clearMessage: function () {
                this.errorMessage=""
                this.successMessage =""

            },
            validEmail: function (email) {
                var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(email);
            },
            onSubmitForm: function(e){
                e.preventDefault();
                this.saveUser = true;

            },
            selectUser(user){
                this.clickedUser = user;
            }
        },
        computed:{
            usersFillter:function () {
                return this.usersInfo.filter((blog)=>{
                    return blog.email.toLowerCase().indexOf(this.search) >=0
                })
            },
            page:function () {
                return this.limit+this.start
            }

        }
    });


</script>
