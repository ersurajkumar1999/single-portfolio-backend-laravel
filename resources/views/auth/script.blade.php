<script type="text/javascript">
    var app = new Vue({
        el: '#auth-page',
        data: {
            bbDeviceInfo:'',
            allowSubmit: false,
            contractType: '',
            isloading:  false,
            loginForm: {
                username: 'owner321',
                password: 'password'
            }
        },
        created: function() {
            this.pageInit();
            console.log("isloading", this.isloading);
        },
        watch: {
        },
        methods: {
            pageInit: function() {
                // this.doLogin();
            },
            doLogin: async  function(){
                let self = this;
                self.isloading = true;
                try {
                    const response = await axios.post('/api/login', this.loginForm);
                    console.log('Login successful', response);
                    window.location.href = "/";
                } catch (error) {
                    console.log('Login failed', error);
                }finally{
                    self.isloading = false;
                    // toastr.success("Message here","Title here");
                }
            },
        }
    });
</script>
<script>
        $(document).ready(function() {
            $("#login_form").submit(function(e){
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                let data = {
                    _token: $('#token').val(),
                    username: $('#username').val(),
                    password: $('#password').val()
                }
                $.ajax({
                    url: "{{ route('auth.login') }}",
                    type: 'POST',
                    data: data,
                    beforeSend: function() {
                        $('#loginButton').prop('disabled', true);
                    },
                    success: function(response) {
                        console.log("response", response.status);
                        if (response.status) {
                            // toastr.success(response.message);
                            window.location.href = "/";
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr) {
                        toastr.error('An error occurred');
                    },
                    complete: function() {
                        $('#loginButton').prop('disabled', false);
                    }
                });
            })
            $('#loginButton').click(function() {
                let username = $('#username').val();
                let password = $('#password').val();

                $.ajax({
                    url: "{{ route('auth.login') }}",
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        username: username,
                        password: password
                    },
                    beforeSend: function() {
                        $('#loginButton').prop('disabled', true);
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message);
                            window.location.href = "/";
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr) {
                        toastr.error('An error occurred');
                    },
                    complete: function() {
                        $('#loginButton').prop('disabled', false);
                    }
                });
            });
        });
    </script>
