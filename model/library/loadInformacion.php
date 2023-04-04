<script>
    const $informacion_r = <?= json_encode($informacion_r) ?>;
    const $dateTime = '<?= $dateTime ?>';
</script>
<style>
    :root {
        --primary_background: <?= $informacion_r['informacion_primary_background'] ?> !important;
        --primary_background_hover: <?= $informacion_r['informacion_primary_background_hover'] ?> !important;
        --primary_color: <?= $informacion_r['informacion_primary_color'] ?> !important;
        --primary_color_hover: <?= $informacion_r['informacion_primary_color_hover'] ?> !important;
        --secondary_background: <?= $informacion_r['informacion_secondary_background'] ?> !important;
        --secondary_background_hover: <?= $informacion_r['informacion_secondary_background_hover'] ?> !important;
        --secondary_color: <?= $informacion_r['informacion_secondary_color'] ?> !important;
        --secondary_color_hover: <?= $informacion_r['informacion_secondary_color_hover'] ?> !important;
        --tertiary_background: <?= $informacion_r['informacion_tertiary_background'] ?> !important;
        --tertiary_background_hover: <?= $informacion_r['informacion_tertiary_background_hover'] ?> !important;
        --tertiary_color: <?= $informacion_r['informacion_tertiary_color'] ?> !important;
        --tertiary_color_hover: <?= $informacion_r['informacion_tertiary_color_hover'] ?> !important;
        --success: <?= $informacion_r['informacion_success'] ?> !important;
        --info: <?= $informacion_r['informacion_info'] ?> !important;
        --warnning: <?= $informacion_r['informacion_warnning'] ?> !important;
        --error: <?= $informacion_r['informacion_error'] ?> !important;
    }
</style>