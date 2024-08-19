<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xtora - Admin Login</title>

    <link rel="shortcut icon" type="image/png" href="assets/images/general/favicon-1.png">
    <link href="../css2-1?family=Maven+Pro:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/common/css/bootstrap.min-1.css">
    <link rel="stylesheet" href="/common/css/all.min-1.css">
    <link rel="stylesheet" href="/common/css/line-awesome.min-1.css">
    <link rel="stylesheet" href="/common/admin/css/bootstrap-toggle.min.css">

    
    <link rel="stylesheet" href="/common/admin/css/select2.min.css">
    <link rel="stylesheet" href="/common/admin/css/admin.css">
    <link rel="stylesheet" href="/common/admin/css/custom-style.css">


    <link rel="stylesheet" href="/common/admin/css/auth.css">
<style>
    .ball {
        position: absolute;
        border-radius: 100%;
        opacity: 0.7;
        display: none;
    }
</style>
</head>

<body>
    <div class="login_area">
    <div class="login">
        <div class="login__header">
            <h2>Admin Login</h2>
        </div>
        <div class="login__body">
            <!-- <h4>user login</h4> -->
            <form action="{{ route('admin.login') }}" method="POST">
                @csrf
                <div class="field">
                    <input type="text" class="@error('field') is-invalid @enderror"  name="field" placeholder="email address">
                    <span class="show-pass"><i class="fas fa-envelope"></i></span>
                </div>
                <div class="field">
                    <input type="password" class="@error('password') is-invalid @enderror" name="password" placeholder="Password">
                    <span class="show-pass"><i class="fas fa-lock"></i></span>
                </div>
                <div class="login__footer">
                    <div class="field_remember">
                        <div class="remember_wrapper">
                            <input type="checkbox" name="remember" id="remember">
                            <label class="remember" for="remember">Remember</label>
                        </div>
                    </div>
                    <div class="field_foget">
                        <a href="#">Forgot password?</a>
                    </div>
                </div>
                <div class="field">
                    <button type="submit" class="sign-in">Sign in</button>
                </div>
            </form>
        </div>
    </div>
</div>




    <script src="/common/js/jquery-3.7.1.min-1.js"></script>
    <script src="/common/js/bootstrap.bundle.min-1.js"></script>
    <script src="/common/admin/js/bootstrap-toggle.min.js"></script>
    <script src="/common/admin/js/jquery.slimscroll.min.js"></script>



    <script src="assets/common/js/sweetalert2.min-1.js"></script>
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-right',
        customClass: {
            popup: 'colored-toast'
        },
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
</script>



    

    <script src="/common/admin/js/select2.min.js"></script>
    <script src="/common/admin/js/admin.js"></script>
    <script src="/common/js/ckeditor.js"></script>
    
    <script>
           (function($) {
            "use strict";
            $(document).ready(function() {
                "use strict";

                $(".trumEdit").each(function () {
                    ClassicEditor
                    .create(this)
                    .then(editor => {
                        window.editor = editor;
                    });
                });
            });

        })(jQuery);

    </script>
    <script>
    "use strict";
    // Some random colors
    const colors = ["#00adad", "#e3e3e3", "red", "green", "blue"];

    const numBalls = 50;
    const balls = [];

    for (let i = 0; i < numBalls; i++) {
        let ball = document.createElement("div");
        ball.classList.add("ball");
        ball.style.background = colors[Math.floor(Math.random() * colors.length)];
        ball.style.left = `${Math.floor(Math.random() * 80)}vw`;
        ball.style.top = `${Math.floor(Math.random() * 80)}vh`;
        ball.style.transform = `scale(${Math.random()})`;
        ball.style.width = `${Math.random()}em`;
        ball.style.height = ball.style.width;

        balls.push(ball);
        document.body.append(ball);
    }

    // Keyframes
    balls.forEach((el, i, ra) => {
        let to = {
            x: Math.random() * (i % 2 === 0 ? -11 : 11),
            y: Math.random() * 12
        };

        let anim = el.animate(
            [
                { transform: "translate(0, 0)" },
                { transform: `translate(${to.x}rem, ${to.y}rem)` }
            ],
            {
                duration: (Math.random() + 1) * 2000, // random duration
                direction: "alternate",
                fill: "both",
                iterations: Infinity,
                easing: "ease-in-out"
            }
        );
    });
</script>


</body>

</html>
