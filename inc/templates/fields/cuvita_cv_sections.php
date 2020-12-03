<?php

$sectionOrder = get_option('cuvita_cv_order');
$default = array(
    'section_id'    =>  '',
    'title'         =>  '',
    'other'      =>  '',
);

$savedIds = array();
$index = 0;
?>
<div class="form-holder-wrap form-holder-wrap-outer">
    <div id="home_cv_wrap" class="form-sortables">
    <?php
    if (!empty($sectionOrder)) {
        foreach ($sectionOrder as $section => $arr) {
            foreach ($arr as $key => $value) {
                if ($key == 'section_id') {
                    array_push($savedIds, $value);
                }
            }
        }
        
        foreach ($sectionOrder as $i => $arr) {
            $section =  !empty($arr) ? array_merge($default, $arr) : $default;
            ?>
            <div class="collapse-form">
                <div class="collapse-form-top">
                    <div class="collapse-form-title">
                        <h3 class="">
                            <input type="hidden" id="cuvita_cv_order[<?php echo $index; ?>][section_id]" name="cuvita_cv_order[<?php echo $index; ?>][section_id]" value="<?php echo esc_attr($section['section_id']) !== '' ? esc_attr($section['section_id']) : ''; ?>" class="cuvita_cv_order[section_id]">
                            <input type="hidden" id="cuvita_cv_order[<?php echo $index; ?>][other]" name="cuvita_cv_order[<?php echo $index; ?>][other]" value="<?php echo esc_attr($section['other']) !== '' ? esc_attr($section['other']) : ''; ?>" class="cuvita_cv_order[other]">
                            <input type="hidden" id="cuvita_cv_order[<?php echo $index; ?>][title]" name="cuvita_cv_order[<?php echo $index; ?>][title]" value="<?php echo esc_attr($section['title']) !== '' ? esc_attr($section['title']) : 'NaN'; ?>" class="cuvita_cv_order[title]">
                            <span class="in-collapse-form-title"><?php echo esc_attr($section['title']) !== '' ? esc_attr($section['title']) : 'NaN'; ?></span>
                        </h3>
                    </div>
                </div>
            </div>
            <?php 
            $index++;
        }
    }
    if(!in_array("1", $savedIds)) {
        ?>
        <div class="collapse-form">
            <div class="collapse-form-top">
                <div class="collapse-form-title">
                    <h3 class="">
                        <input type="hidden" id="cuvita_cv_order[<?php echo $index; ?>][section_id]" name="cuvita_cv_order[<?php echo $index; ?>][section_id]" value="1" class="cuvita_cv_order[section_id]">
                        <input type="hidden" id="cuvita_cv_order[<?php echo $index; ?>][other]" name="cuvita_cv_order[<?php echo $index; ?>][other]" value="false" class="cuvita_cv_order[other]">
                        <input type="hidden" id="cuvita_cv_order[<?php echo $index; ?>][title]" name="cuvita_cv_order[<?php echo $index; ?>][title]" value="<?php _e('Work Experience','cuvita'); ?>" class="cuvita_cv_order[title]">
                        <span class="in-collapse-form-title"><?php _e('Work Experience','cuvita'); ?></span>
                    </h3>
                </div>
            </div>
        </div>
        <?php 
        $index++;
    }
    if(!in_array("2", $savedIds)) {
        ?>
        <div class="collapse-form">
            <div class="collapse-form-top">
                <div class="collapse-form-title">
                    <h3 class="">
                        <input type="hidden" id="cuvita_cv_order[<?php echo $index; ?>][section_id]" name="cuvita_cv_order[<?php echo $index; ?>][section_id]" value="2" class="cuvita_cv_order[section_id]">
                        <input type="hidden" id="cuvita_cv_order[<?php echo $index; ?>][other]" name="cuvita_cv_order[<?php echo $index; ?>][other]" value="false" class="cuvita_cv_order[other]">
                        <input type="hidden" id="cuvita_cv_order[<?php echo $index; ?>][title]" name="cuvita_cv_order[<?php echo $index; ?>][title]" value="<?php _e('Education','cuvita'); ?>" class="cuvita_cv_order[title]">
                        <span class="in-collapse-form-title"><?php _e('Education','cuvita'); ?></span>
                    </h3>
                </div>
            </div>
        </div>
        <?php
        $index++; 
    }

    ?>
    </div>
</div>