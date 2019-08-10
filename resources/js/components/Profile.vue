<template>
    <div>
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
                        <li :class="['nav-item', activeClass('profile')]" @click="setActive('profile')">
                            Profile
                        </li>
                        <li :class="['nav-item', activeClass('favorites')]" @click="setActive('favorites')">
                            Favorites
                        </li>
                        <li :class="['nav-item', activeClass('history')]" @click="setActive('history')">
                            History
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <profile-tab v-if="activeTab === 'profile'"></profile-tab>
        <favorites-tab v-if="activeTab === 'favorites'"></favorites-tab>
        <history-tab v-if="activeTab === 'history'"></history-tab>
    </div>
</template>

<script>
  import ProfileTab from "./partials/ProfileTab";

  export default {
    name: "Profile",
    data: function () {
      return {
        activeTab: 'profile'
      };
    },
    components: { ProfileTab },
    methods: {
      setActive: function (tab) {
        this.activeTab = tab;
      },
      activeClass: function (tab) {
        return this.activeTab === tab ? 'active' : '';
      }
    }
  }
</script>
