<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title pt-2">acsses </h3>

                        <div class="card-tools">
                            <button data-toggle="modal" data-target="#adminModalCenter"
                                    class="btn btn-info"
                                    @click="newUser"
                            >
                                <i class="fa fa-plus mr-1"></i>Add User
                            </button>
                        </div>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>level</th>
                                <th>Date</th>
                                <th>country</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="user in users.data" :key="user.id">
                                <td>{{ user.user.full_name | emty(user.user.full_name ) }}</td>
                                <td>{{ user.level | emty(user.level)}}</td>
                                <!--<td>{{ // user.level | emty(user.level) }}</td>-->
                                <!--<td>{{ // user.created_at | date | emty(user.created_at) }}</td>-->
                                <!--<td>{{ // user.country.name | str_limit(12) | emty(user.country.name) }}</td>-->
                                <td>
                                    <button class="fa fa-edit text-info" @click="editUser(user)"></button>
                                    /
                                    <button @click="deleteUser(user.id)"><i class="fa fa-trash text-danger"></i></button>
                                </td>
                            </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <pagination :data="users" @pagination-change-page="fetchUser"></pagination>

        <!-- Button trigger modal -->


        <!-- Modal -->
        <div class="modal fade" id="adminModalCenter" tabindex="-1" role="dialog" aria-labelledby="adminModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNewModalLongTitle" v-show="!editMode">Add User</h5>
                        <h5 class="modal-title" id="addNewModalLongTitle" v-show="editMode">Update User</h5>                        <button type="button" class="close" @click="fetchUser()" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <form @submit.prevent="editMode? editUserinfo() : addUser() " @keydown="form.onKeydown($event)">

                        <div class="modal-body">


                            <div class="form-group" >
                                <label>user</label>
                                <select class="form-control"  v-model="form.country_id"
                                        name="country_id"
                                        :class="{ 'is-invalid': form.errors.has('country_id') }">
                                    <option disabled value="">Please select one</option>

                                    <option  v-for="countrys in country" :selected="selected" v-bind:value="countrys.id">{{ countrys.name }}</option>
                                    <!--<option>option 2</option>-->

                                </select>
                            </div>

                            <div class="form-group" >
                                <label>skill</label>
                                <select class="form-control"  v-model="form.skills"
                                        name="country_id"
                                        :class="{ 'is-invalid': form.errors.has('skills') }">
                                    <option disabled value="">Please select one</option>

                                    <option  v-for="s in skills" :selected="selected" >{{ skill_name }}</option>
                                    <!--<option>option 2</option>-->

                                </select>
                            </div>
                            <div class="form-group" >
                                <label>level</label>
                                <select class="form-control"  v-model="form.country_id"
                                        name="country_id"
                                        :class="{ 'is-invalid': form.errors.has('country_id') }">
                                    <option disabled value="">Please select one</option>
                                    <option  value="basic">basic</option>
                                    <option  value="intermediate">intermediate</option>
                                    <option  value="advance">advance</option>


                                </select>
                            </div>



                        </div>
                        <div class="modal-footer">

                            <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                            <button type="submit" :disabled="form.busy" v-show="!editMode"  class="btn btn-primary">Save changes</button>
                            <button type="submit" :disabled="form.busy" v-show="editMode" class="btn btn-success">update</button>
                        </div></form>
                </div>
            </div>
        </div>
    </div>
</template>
<!--<script>-->
<!--import Form from 'vform'-->

<!--export default {-->
<!--data: () => ({-->
<!--form: new Form({-->
<!--username: '',-->
<!--password: ''-->
<!--})-->
<!--}),-->

<!--methods: {-->
<!--async login () {-->
<!--const response = await this.form.post('/api/user')-->
<!--// ...-->
<!--}-->
<!--}-->
<!--}-->
<!--</script>-->
<script>
    // console.log(users);
    import Form from 'vform'
    $('#myModal').on('hidden.bs.modal', function () {
        // do something…
    });
    export default {
        data() {
            return {
                skills: {},
                user: {},
                users: {},
                country: {},
                skill: {},
                editMode: false,
                edittest: false,
                // Create a new form instance
                form: new Form({
                    id:"",
                       full_name: "",
                    email: "",
                    password: "",
                    country_id: "",
                    // country: {name:""},
                }),
            };
        },
        created(){
            this.fetchUser();
            this.fetchCountry();
            this.fetchusers();
            this.fetchskill();

            //     axios.get('api/user')
            //         .then(({data}) => (this.users = data.data))

        },
        methods: {

            editUserinfo(){
                this.edittest=true;
                this.form.put('api/user/'+this.form.id).then(()=>
                    Toast.fire({
                        icon: 'success',
                        title: 'User Updateed successfully'
                    })
                );
                $('#adminModalCenter').modal('hide');
                this.fetchUser();

                // this.edittest='api/user/'+this.form.id
            },
            newUser() {

                $('#adminModalCenter').modal('show')

            },
            editUser(user) {
                this.editMode = true;
                this.form .reset();
                $('#adminModalCenter').modal('show');

                this.form.fill(user);
            },

            fetchUser(page) {
                if (typeof page === 'undefined') {
                    page = 1;
                }

                this.editMode = false;
                $('#adminModalCenter').modal('hide');
                axios.get('api/skill_user?page=' + page)
                    .then(data => (this.users = data.data));

            },
            fetchCountry() {

                $('#adminModalCenter').modal('hide');
                axios.get('country')
                    .then(data => (this.country = data.data))
            },
            fetchskill() {

                $('#adminModalCenter').modal('hide');
                axios.get('api/skill')
                    .then(data => (this.skills = data.data))
            },
            fetchusers() {

                $('#adminModalCenter').modal('hide');
                axios.get('/api/user')
                    .then(data => (this.user = data.data))
            },

            addUser() {
                this.$Progress.start();
                this.form.post('/api/user')
                    .then(() => {
                        this.form .reset();
                        $('#adminModalCenter').modal('hide');
                        this.fetchUser();
                        // Fire.$emit('afterCreate')
                        this.$Progress.finish();
                        Toast.fire({
                            icon: 'success',
                            title: 'User Created successfully'
                        })
                    })
            },
            deleteUser(id)
            {
                this.form.delete('api/user/' + id)
                    .then(() => {
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )
                                this.fetchUser();
                            }

                        })
                            .catch(() => {
                                if (result.isConfirmed) {
                                    Swal.fire(
                                        'User Not Deleted!',
                                        'Your file has been deleted.',
                                        'danger'
                                    )
                                }
                            })
                    })
            },



        },

    }
    $(document).ready(function() {
        $('select').selectpicker();
    });
    // $('select').selectpicker();

</script>
