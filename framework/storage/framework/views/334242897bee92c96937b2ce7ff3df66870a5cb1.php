<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/theme.css?v=2.3.1')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/content/nyks/css/nyks.css')); ?>" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha512-iQQV+nXtBlmS3XiDrtmL+9/Z+ibux+YuowJjI4rcpO7NYgTzfTOiFNm09kWtfZzEB9fQ6TwOVc8lFVWooFuD/w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title><?php echo e(Hyvikk::get('app_name')); ?></title>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-52376036-7"></script>
  </head>
  <body>
    <section class="fullscreen t-center fullwidth cover" style="background-color: rgba(0,204,55,242)">
      <div class="container-xs mxw-350 v-center">
        <div class="card">
          <div class="card-body">
            <div class="t-center">
              <h1 class="bold-title"><?php echo app('translator')->get('frontend.forget_password'); ?></h1>
                <p class="bold mt-3">
                  <?php echo app('translator')->get('frontend.forgot_text'); ?>
                </p>

                <?php if(session('error')): ?>
                  <div class="alert alert-danger xs-mt">
                    <?php echo e(session('error')); ?>

                  </div>
                <?php endif; ?>

                <?php if(session('success')): ?>
                  <div class="alert alert-success xs-mt">
                    <?php echo e(session('success')); ?>

                  </div>
                <?php endif; ?>

                <div class="form dark xs-mt normal-title">
                  <form action="<?php echo e(url('forgot-password')); ?>" method="post">
                    <!-- Email -->
                    <?php echo e(csrf_field()); ?>

                    <input type="email" name="email" id="email" placeholder="<?php echo app('translator')->get('frontend.email_placeholder'); ?>" class="classic_form bg-white radius" value="<?php echo e(old('email')); ?>"/>
                    <!-- Send Button -->
                    <button type="submit" id="submit" class="bg-colored1 click-effect white bold qdr-hover-6 classic_form uppercase no-border radius">
                        <?php echo app('translator')->get('frontend.reset_link'); ?>
                    </button>
                    <!-- End Send Button -->
                  </form>
                </div>
          
                <div class="radius-sm gray8" style="background-color:rgba(255,255,255,.5)">
                  <h5 class="mt-1">
                    <?php echo app('translator')->get('frontend.dont_have_account'); ?>
                    <a href="<?php echo e(url('/#register')); ?>" class="underline"><?php echo app('translator')->get('frontend.regi'); ?></a>
                  </h5>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="<?php echo e(asset('assets/frontend/js/jquery.min.js?v=2.3')); ?>"></script>
    <!-- PAGE OPTIONS - You can find special scripts for this version -->
    <script src="<?php echo e(asset('assets/frontend/content/nyks/js/plugins.js')); ?>"></script>
    <!-- <script src="content/antares/js/plugins.js"></script> -->
    <!-- MAIN SCRIPTS - Classic scripts for all theme -->
    <script src="<?php echo e(asset('assets/frontend/js/scripts.js?v=2.3.1')); ?>"></script>
    <script>
       window.setTimeout(function () { 
            $(".alert").alert('close'); 
        }, 3000);
    </script>
  </body>
</html><?php /**PATH /var/www/vhosts/emolimo.savvyhost.co/httpdocs/framework/resources/views/frontend/auth/forgot_password.blade.php ENDPATH**/ ?>