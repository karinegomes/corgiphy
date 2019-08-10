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

                <profile-tab></profile-tab>

            </div>
        </div>
    </div>

</template>

<script>
  import ProfileTab from "./partials/ProfileTab";

  export default {
    name: "Profile",
    components: { ProfileTab }
  }
</script>
