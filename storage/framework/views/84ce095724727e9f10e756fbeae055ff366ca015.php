<?php $__currentLoopData = $navigation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $resource): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    <collapsible-resource-manager :data='<?php echo json_encode($resource, 15, 512) ?>'
                                  :remember-menu-state="<?php echo json_encode($rememberMenuState, 15, 512) ?>">
    </collapsible-resource-manager>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\Users\Dir-CIDS\Documents\Repos\rutaCGitHUB\rutadecrecimiento\public_html\vendor\digital-creative\collapsible-resource-manager\src/../resources/views/navigation.blade.php ENDPATH**/ ?>