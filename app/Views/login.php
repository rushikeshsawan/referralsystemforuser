<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Login</title>
    <style>
        /* sign in FORM */
        #logreg-forms {
            width: 412px;
            margin: 10vh auto;
            background-color: #f3f3f3;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
            transition: all 0.3s cubic-bezier(.25, .8, .25, 1);
        }

        #logreg-forms form {
            width: 100%;
            max-width: 410px;
            padding: 15px;
            margin: auto;
        }

        #logreg-forms .form-control {
            position: relative;
            box-sizing: border-box;
            height: auto;
            padding: 10px;
            font-size: 16px;
        }

        #logreg-forms .form-control:focus {
            z-index: 2;
        }

        #logreg-forms .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        #logreg-forms .form-signin input[type="password"] {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

        #logreg-forms .social-login {
            width: 390px;
            margin: 0 auto;
            margin-bottom: 14px;
        }

        #logreg-forms .social-btn {
            font-weight: 100;
            color: white;
            width: 190px;
            font-size: 0.9rem;
        }

        #logreg-forms a {
            display: block;
            padding-top: 10px;
            color: lightseagreen;
        }

        #logreg-form .lines {
            width: 200px;
            border: 1px solid red;
        }


        #logreg-forms button[type="submit"] {
            margin-top: 10px;
        }

        #logreg-forms .facebook-btn {
            background-color: #3C589C;
        }

        #logreg-forms .google-btn {
            background-color: #DF4B3B;
        }

        #logreg-forms .form-reset,
        #logreg-forms .form-signup {
            display: none;
        }

        #logreg-forms .form-signup .social-btn {
            width: 210px;
        }

        #logreg-forms .form-signup input {
            margin-bottom: 2px;
        }

        .form-signup .social-login {
            width: 210px !important;
            margin: 0 auto;
        }

        /* Mobile */

        @media screen and (max-width:500px) {
            #logreg-forms {
                width: 300px;
            }

            #logreg-forms .social-login {
                width: 200px;
                margin: 0 auto;
                margin-bottom: 10px;
            }

            #logreg-forms .social-btn {
                font-size: 1.3rem;
                font-weight: 100;
                color: white;
                width: 200px;
                height: 56px;

            }


        }
    </style>
</head>

<body>

    <div>
        <div id="logreg-forms">
            <form class="form-signin" action="<?= base_url() ?>login" method="post">
                <h1 class="h3 mb-3 font-weight-normal" style="text-align: center"> Sign in</h1>

                <div class="text-danger"> <?php if ((validation_list_errors())) {
                                                echo validation_list_errors();
                                            }  ?></div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="hidden" name="login" value="login">
                    <input type="email" name="email" placeholder="Please Enter Your Email Address" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" placeholder="Please Enter Your Password" class="form-control" id="exampleInputPassword1" required>
                </div>
                <?php
                if (session()->get('error')) {
                ?>

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->get('error') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php

                }

                ?>
                <?php
                if (session()->get('success')) {
                ?>

                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->get('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php

                }

                ?>
                <div class="text-center">
                    <button class="btn btn-success btn-block " type="submit"><i class="fas fa-sign-in-alt"></i> Sign in</button>

                </div>
                <hr>
                <!-- <p>Don't have an account!</p>  -->
                <div class="text-center">
                    <button class="btn btn-primary btn-block" type="button" id="btn-signup"><i class="fas fa-user-plus"></i> Sign up New Account</button>

                </div>
            </form>



            <form action="<?= base_url() ?>sign-up" method="post" class="form-signup">

                <h1 class="h3 mb-3 font-weight-normal" style="text-align: center"> Register</h1>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">First Name</label>
                    <input type="text" value="<?= set_value('fname') ?>" name="fname" id="user-name" class="form-control" placeholder="First name" required="" autofocus="">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Last Name</label>
                    <input type="text" name="lname" id="user-name" value="<?= set_value('lname') ?>" class="form-control" placeholder="Last name" required="" autofocus="">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Referred By</label>
                    <input type="text" name="referedby" id="user-name" class="form-control" value="<?= set_value('referedby') ?>" placeholder="Referred By" required="" autofocus="">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Pan Card</label>
                    <input type="text" name="pancard" id="user-name" class="form-control" value="<?= set_value('pancard') ?>" placeholder="Pan Card" required="" autofocus="">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" name="email" id="user-email" class="form-control" placeholder="Email address" value="<?= set_value('email') ?>" required autofocus="">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Password</label>
                    <input type="password" name="password" id="user-pass" value="<?= set_value('password') ?>" class="form-control" placeholder="Password" required autofocus="">
                </div>
                <div class="text-center">
                    <button class="btn btn-primary btn-block " type="submit"><i class="fas fa-sign-in-alt"></i> Sign Up</button>

                </div>
                <hr>
                <!-- <p>Don't have an account!</p>  -->
                <div class="text-center">
                    <button href="#" class="btn btn-success btn-block" id="cancel_signup" id="btn-signup"><i class="fas fa-user-plus"></i> Login</button>

                </div>

            </form>
            <br>

        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script>
    function toggleResetPswd(e) {
        e.preventDefault();
        $('#logreg-forms .form-signin').toggle() // display:block or none
        $('#logreg-forms .form-reset').toggle() // display:block or none
    }

    function toggleSignUp(e) {
        e.preventDefault();
        $('#logreg-forms .form-signin').toggle(); // display:block or none
        $('#logreg-forms .form-signup').toggle(); // display:block or none
    }

    $(() => {
        // Login Register Form
        $('#logreg-forms #forgot_pswd').click(toggleResetPswd);
        $('#logreg-forms #cancel_reset').click(toggleResetPswd);
        $('#logreg-forms #btn-signup').click(toggleSignUp);
        $('#logreg-forms #cancel_signup').click(toggleSignUp);
    })
</script>

</html>