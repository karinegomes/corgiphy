<template>
    <div class="container mt-100">
        <div class="row">
            <div class="col-sm-7 m-auto">
                <div class="text-center mb-3">
                    <h1>Account Settings</h1>
                </div>

                <ul class="nav nav-pills nav-pills-custom nav-fill text-uppercase mb-5">
                    <li :class="['nav-item', activeClass('profile')]" @click="goTo('/profile')">
                        Profile
                    </li>
                    <li :class="['nav-item', activeClass('favorites')]" @click="goTo('/favorites')">
                        Favorites
                    </li>
                    <li :class="['nav-item', activeClass('history')]" @click="goTo('history')">
                        History
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
  export default {
    name: "AccountOptions",
    props: ['activeTab'],
    methods: {
      activeClass: function (tab) {
        return this.activeTab === tab ? 'active' : '';
      },
      goTo: function (url) {
        location.href = url;
      }
    }
  }
</script>
