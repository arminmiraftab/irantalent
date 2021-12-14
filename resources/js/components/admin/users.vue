<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title pt-2">users </h3>

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
                                <td>{{ user.full_name | emty(user.full_name)}}</td>
                                <td>{{ user.email | emty(user.email) }}</td>
                                <td>{{ user.level | emty(user.level) }}</td>
                                <td>{{ user.created_at | date | emty(user.created_at) }}</td>
                                <td>{{ user.country.name | str_limit(12) | emty(user.country.name) }}</td>
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

                                <label>Name</label>

                                <input
                                        v-model="form.full_name"
                                        type="text"
                                        name="full_name"
                                        class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('full_name') }"
                                />
                                        <has-error :form="form" field="full_name"></has-error>
                                <label>Email</label>
                                <input
                                        v-model="form.email"
                                        type="text"
                                        name="email"
                                        class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('email') }"
                                />
                                <has-error :form="form" field="email"></has-error>

                                <label>Password</label>
                                <input
                                        v-model="form.password"
                                        type="text"
                                        name="password"
                                        class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('password') }"
                                />
                                <has-error :form="form" field="password"></has-error>
                        <div class="form-group" >
                            <label>country</label>
                            <select class="form-control"  v-model="form.country_id"
                                    name="country_id"
                                    :class="{ 'is-invalid': form.errors.has('country_id') }">
                                <option disabled value="">Please select one</option>

                                <option  v-for="countrys in country" :selected="selected" v-bind:value="countrys.id">{{ countrys.name }}</option>
                                <!--<option>option 2</option>-->

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
<script>
   import Form from 'vform'
    $('#myModal').on('hidden.bs.modal', function () {
        // do something…
    });
    export default {
        data() {
            return {


                users: {},
                country: {},
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
                this.editMode = false;
                if (typeof page === 'undefined') {
                    page = 1;
                }

                this.fetchCountry();
                $('#adminModalCenter').modal('hide');
                axios.get('api/user?page=' + page)
                    .then(data => (this.users = data.data));

            },
            fetchCountry() {

                $('#adminModalCenter').modal('hide');
                axios.get('country')
                    .then(data => (this.country = data.data))
            },

            addUser() {
                this.editMode = false;
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

</script>
