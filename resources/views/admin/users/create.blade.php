<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createUserModalLabel">Tambah User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- START FORM -->
                <form action='{{ route('users.create') }}' method='post'>
                    @csrf
                    <div class="mb-3 row">
                        <label for="name" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name='name' id="name"
                                value="{{ Session::get('name') }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="comment" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name='email' id="email"
                                value="{{ Session::get('email') }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="comment" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name='password' id="password"
                                value="{{ Session::get('password') }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="comment" class="col-sm-2 col-form-label">Role</label>
                        <div class="col-sm-10">
                            <select class="form-select" name="role" id="role">
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="submit" class="btn btn-primary" name="submit">SIMPAN</button>
                        </div>
                    </div>
                </form>
                <!-- AKHIR FORM -->
            </div>
        </div>
    </div>
</div>
