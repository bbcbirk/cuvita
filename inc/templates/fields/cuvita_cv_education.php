<?php
//cuvita_education
$value = get_option('cuvita_education');
$inner_arr_default = array(
    'hide_onsite'   =>  '',
    'title'         =>  '',
    'school'        =>  '',
    'city'          =>  '',
    'current'       =>  '',
    'startdate'     =>  '',
    'enddate'       =>  '',
    'description'   =>  '',
);
?>
<div>
    <p><button type="button" class="button" id="cv-form-add-education"><?php _e('Add New Education:','cuvita'); ?></button></p>
</div>

<div class="form-holder-wrap form-holder-wrap-outer">
    <div id="home_education_wrap" class="form-sortables" >

    <?php
    if (!empty($value)) {
        
        for ($x = 0; $x < count((array)$value); $x++) {
            $inner_merged_arr = !empty($value[$x]) ? array_merge($inner_arr_default, $value[$x]) : $inner_arr_default;
            ?>
            <div class="collapse-form collapse-form-outer">
                <div class="collapse-form-top collapse-form-top-outer">
                    <div class="collapse-form-title-action">
                        <button type="button" class="collapse-form-action">
                            <span class="toggle-indicator"></span>
                        </button>
                    </div>
                    <div class="collapse-form-title">
                        <h3 class="<?php echo esc_attr($inner_merged_arr['hide_onsite']) == 1 ? 'greyed' : ''; ?>">
                            <span class="in-collapse-form-title"><?php echo esc_attr($inner_merged_arr['title']) !== '' ? esc_attr($inner_merged_arr['title']) : __('Title','cuvita'); ?></span>
                            <span class="in-collapse-form-hidden"><?php echo esc_attr($inner_merged_arr['hide_onsite']) == 1 ? ' &mdash; '.__('Hidden','cuvita') : ''; ?></span>
                        </h3>
                    </div>
                </div>
                <div class="collapse-form-inside">
                    <p class="flex-end">
                        <input type="checkbox" id="cuvita_education[<?php echo $x; ?>][hide_onsite]" name="cuvita_education[<?php echo $x; ?>][hide_onsite]" value="1" <?php checked(esc_attr($inner_merged_arr['hide_onsite']), 1); ?> class="cv-form-hide-onsite cuvita_education[hide_onsite]">
                        <label for="cuvita_education[<?php echo $x; ?>][hide_onsite]" class="label_cuvita_education[hide_onsite]"><?php _e('Hide on site.','cuvita'); ?></label>
                    </p>
                    <p>
                        <label for="cuvita_education[<?php echo $x; ?>][title]" class="label_cuvita_education[title]"><?php _e('Title:','cuvita'); ?></label><br>
                        <input type="text" id="cuvita_education[<?php echo $x; ?>][title]" name="cuvita_education[<?php echo $x; ?>][title]" value="<?php echo esc_attr($inner_merged_arr['title']); ?>" placeholder="<?php _e('Title','cuvita'); ?>" class="widefat collapse-form-inside-title cuvita_education[title]">
                    </p>
                    <p>
                        <label for="cuvita_education[<?php echo $x; ?>][school]" class="label_cuvita_education[school]"><?php _e('School:','cuvita'); ?></label><br>
                        <input type="text" id="cuvita_education[<?php echo $x; ?>][school]" name="cuvita_education[<?php echo $x; ?>][school]" value="<?php echo esc_attr($inner_merged_arr['school']); ?>" placeholder="<?php _e('School','cuvita'); ?>" class="widefat cuvita_education[school]">
                    </p>
                    <p>
                        <label for="cuvita_education[<?php echo $x; ?>][city]" class="label_cuvita_education[city]"><?php _e('City:','cuvita'); ?></label><br>
                        <input type="text" id="cuvita_education[<?php echo $x; ?>][city]" name="cuvita_education[<?php echo $x; ?>][city]" value="<?php echo esc_attr($inner_merged_arr['city']); ?>" placeholder="<?php _e('City','cuvita'); ?>" class="widefat cuvita_education[city]">
                    </p>
                    <p>
                        <input type="checkbox" id="cuvita_education[<?php echo $x; ?>][current]" name="cuvita_education[<?php echo $x; ?>][current]" value="1" <?php checked(esc_attr($inner_merged_arr['current']), 1); ?> class="cv-form-currentStudy cuvita_education[current]">
                        <label for="cuvita_education[<?php echo $x; ?>][current]" class="label_cuvita_education[current]"><?php _e("I'm currently studying here.",'cuvita'); ?></label>
                    </p>
                    <p>
                        <div class="flex-container">
                            <p>
                                <label for="cuvita_education[<?php echo $x; ?>][startdate]" class="label_cuvita_education[startdate]"><?php _e('Startdate:','cuvita'); ?></label><br>
                                <input type="date" id="cuvita_education[<?php echo $x; ?>][startdate]" name="cuvita_education[<?php echo $x; ?>][startdate]" value="<?php echo esc_attr($inner_merged_arr['startdate']); ?>" class="cuvita_education[startdate]">
                            </p>
                            <p>
                                <label for="cuvita_education[<?php echo $x; ?>][enddate]" class="label_cuvita_education[enddate]"><?php _e('Enddate:','cuvita'); ?></label><br>
                                <input type="date" id="cuvita_education[<?php echo $x; ?>][enddate]" name="cuvita_education[<?php echo $x; ?>][enddate]" value="<?php echo esc_attr($inner_merged_arr['enddate']); ?>" class="cv-form-enddate cuvita_education[enddate] <?php echo esc_attr($inner_merged_arr['current']) == 1 ? 'nondisplay' : ''; ?>">
                                <span class="cv-form-enddate-now <?php echo esc_attr($inner_merged_arr['current']) == 1 ? '' : 'nondisplay'; ?>"><?php _e('Now','cuvita'); ?></span>
                            </p>
                        </div>
                    </p>
                    <p>
                        <label for="cuvita_education[<?php echo $x; ?>][description]" class="label_cuvita_education[description]"><?php _e('Description:','cuvita'); ?></label><br>
                        <textarea id="cuvita_education[<?php echo $x; ?>][description]" name="cuvita_education[<?php echo $x; ?>][description]" cols="50" rows="10" class="widefat cuvita_education[description]"><?php echo esc_attr($inner_merged_arr['description']); ?></textarea>
                    </p>
                    <p>
                        <button type="button" class="button-link button-link-delete cv-form-delete"><?php _e('Delete','cuvita'); ?></button>
                    </p>
                </div>
            </div>

        <?php } ?>
    <?php } ?>
    </div>
</div>
<?php
