<?php
    // Komponen sederhana untuk menampilkan nilai atau indikator 'Belum diisi'
    // $value di-pass saat include: @include('components.empty-field', ['value' => $var])
    $isEmpty = is_null($value) || (is_string($value) && trim($value) === '');
?>

<?php if(!$isEmpty || $value === '0'): ?>
    <?php echo e($value); ?>

<?php else: ?>
    <span class="text-muted"><small>&#8212; Belum diisi</small></span>
<?php endif; ?>
<?php /**PATH C:\Users\Lenovo\Documents\adi_ppdb\aplikasi_ppdb\resources\views/components/empty-field.blade.php ENDPATH**/ ?>