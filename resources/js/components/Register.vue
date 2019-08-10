<template>
    <div class="container mt-100 text-center">
        <div class="row mb-5">
            <div class="col-sm-7 m-auto">
                <h1 class="text-custom">Woof!</h1>
                <h1 class="mb-5">Are you gonna be my best friend?</h1>

                <form class="text-left">
                    <div class="form-group">
                        <label for="username">Choose a username</label>
                        <input type="text" name="username" class="form-control" id="username">
                    </div>
                    <div class="form-group">
                        <label for="email">Enter an email address</label>
                        <input type="email" name="email" class="form-control" id="email">
                    </div>
                    <div class="form-group">
                        <label for="password">Choose a password</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>
                    <button type="submit" class="btn btn-pink btn-lg btn-block mt-5">Sign Up</button>
                </form>
            </div>
        </div>

        <a href="/login" class="text-bigger-13">Already have an account?</a>
    </div>
</template>

<script>
  export default {
    name: "Register"
  }
</script>
