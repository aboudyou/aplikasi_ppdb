 <?php if(Route::has('sso.redirect')): ?>
 <div class="row">
     <div class="col-6">
         <div class="d-grid">
             <a href="<?php echo e(route('sso.redirect', ['provider' => 'google'])); ?>" type="submit"
                 class="btn mt-2 btn-light-primary bg-light text-muted">
                 <img src="../assets/images/authentication/google.svg" alt="img"> <span
                     class="d-none d-sm-inline-block"> Google</span>
             </a>
         </div>
     </div>
     <div class="col-6">
         <div class="d-grid">
             <a href="<?php echo e(route('sso.redirect', ['provider' => 'github'])); ?>" type="button"
                 class="btn mt-2 btn-light-secondary bg-light text-muted">
                 <img width="20" height="20" src="../assets/images/authentication/github.png" alt="img">
                 <span class="d-none d-sm-inline-block"> Github</span>
             </a>
         </div>
     </div>

 </div>
<?php endif; ?>
<?php /**PATH C:\Users\Lenovo\Documents\adi_ppdb\aplikasi_ppdb\resources\views/auth/sso.blade.php ENDPATH**/ ?>