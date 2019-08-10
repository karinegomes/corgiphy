<template>
    <div class="container mt-100">
        <div class="row">
            <div class="col-sm-7 m-auto">
                <div class="d-flex justify-content-center mb-5">
                    <div>
                        <img src="/img/avatar.png" style="width: 220px">
                    </div>
                </div>

                <div class="text-center mb-3">
                    <h1>Account Settings</h1>
                </div>

                <ul class="nav nav-pills nav-pills-custom nav-fill text-uppercase mb-5">
                    <li class="nav-item active">
                        Profile
                    </li>
                    <li class="nav-item">
                        Favorites
                    </li>
                    <li class="nav-item">
                        History
                    </li>
                </ul>

                <form class="text-left">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" id="username">
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" name="email" class="form-control" id="email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>
                    <div class="form-group">
                        <label for="new-password">New password</label>
                        <input type="password" name="new_password" class="form-control" id="new-password">
                    </div>
                    <button type="submit" class="btn btn-pink btn-lg btn-block mt-5">Save Changes</button>
                </form>

            </div>
        </div>
    </div>

</template>

<script>
  export default {
    name: "Profile"
  }
</script>
