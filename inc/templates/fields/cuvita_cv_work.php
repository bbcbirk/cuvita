<?php
//cuvita_education
$value = get_option('cuvita_work');
$inner_arr_default = array(
    'hide_onsite'   =>  '',
    'title'         =>  '',
    'employer'      =>  '',
    'employer_link' =>  '',
    'city'          =>  '',
    'current'       =>  '',
    'startdate'     =>  '',
    'enddate'       =>  '',
    'description'   =>  '',
);
?>
<div>
    <p><button type="button" class="button" id="cv-form-add-work"><?php _e('Add New Work','cuvita'); ?></button></p>
</div>
<div class="form-holder-wrap form-holder-wrap-outer">
    <div id="home_work_wrap" class="form-sortables" >

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
                            <span class="in-collapse-form-title"><?php echo esc_attr($inner_merged_arr['title']) !== '' ? esc_attr($inner_merged_arr['title']) :  __('Title','cuvita'); ?></span><span class="in-collapse-form-employer"><?php echo esc_attr($inner_merged_arr['employer']) !== '' ? ', ' . esc_attr($inner_merged_arr['employer']) : ''; ?></span>
                            <span class="in-collapse-form-hidden"><?php echo esc_attr($inner_merged_arr['hide_onsite']) == 1 ? ' &mdash; '.__('Hidden','cuvita') : ''; ?></span>
                        </h3>
                    </div>
                </div>
                <div class="collapse-form-inside">
                    <p class="flex-end">
                        <input type="checkbox" id="cuvita_work[<?php echo $x; ?>][hide_onsite]" name="cuvita_work[<?php echo $x; ?>][hide_onsite]" value="1" <?php checked(esc_attr($inner_merged_arr['hide_onsite']), 1); ?> class="cv-form-hide-onsite cuvita_work[hide_onsite]">
                        <label for="cuvita_work[<?php echo $x; ?>][hide_onsite]" class="label_cuvita_work[hide_onsite]"><?php _e('Hide on site.','cuvita'); ?></label>
                    </p>
                    <p>
                        <label for="cuvita_work[<?php echo $x; ?>][title]" class="label_cuvita_work[title]"><?php _e('Job Title:','cuvita'); ?></label><br>
                        <input type="text" id="cuvita_work[<?php echo $x; ?>][title]" name="cuvita_work[<?php echo $x; ?>][title]" value="<?php echo esc_attr($inner_merged_arr['title']); ?>" placeholder="<?php _e('Title','cuvita'); ?>" class="widefat collapse-form-inside-title cuvita_work[title]">
                    </p>
                    <p>
                        <label for="cuvita_work[<?php echo $x; ?>][employer]" class="label_cuvita_work[employer]"><?php _e('Employer:','cuvita'); ?></label><br>
                        <input type="text" id="cuvita_work[<?php echo $x; ?>][employer]" name="cuvita_work[<?php echo $x; ?>][employer]" value="<?php echo esc_attr($inner_merged_arr['employer']); ?>" placeholder="<?php _e('Employer','cuvita'); ?>" class="widefat collapse-form-inside-employer cuvita_work[employer]">
                    </p>
                    <p>
                        <label for="cuvita_work[<?php echo $x; ?>][employer_link]" class="label_cuvita_work[employer_link]"><?php _e('Employer Website:','cuvita'); ?></label><br>
                        <input type="url" id="cuvita_work[<?php echo $x; ?>][employer_link]" name="cuvita_work[<?php echo $x; ?>][employer_link]" value="<?php echo esc_attr($inner_merged_arr['employer_link']); ?>" placeholder="<?php _e('Link to Website','cuvita'); ?>" class="widefat cuvita_work[employer_link]">
                    </p>
                    <p>
                        <label for="cuvita_work[<?php echo $x; ?>][city]" class="label_cuvita_work[city]"><?php _e('City:','cuvita'); ?></label><br>
                        <input type="text" id="cuvita_work[<?php echo $x; ?>][city]" name="cuvita_work[<?php echo $x; ?>][city]" value="<?php echo esc_attr($inner_merged_arr['city']); ?>" placeholder="<?php _e('City','cuvita'); ?>" class="widefat cuvita_work[city]">
                    </p>
                    <p>
                        <input type="checkbox" id="cuvita_work[<?php echo $x; ?>][current]" name="cuvita_work[<?php echo $x; ?>][current]" value="1" <?php checked(esc_attr($inner_merged_arr['current']), 1); ?> class="cv-form-currentWork cuvita_work[current]">
                        <label for="cuvita_work[<?php echo $x; ?>][current]" class="label_cuvita_work[current]"><?php _e("I'm currently working here.",'cuvita'); ?></label>
                    </p>
                    <p>
                        <div class="flex-container">
                            <p>
                                <label for="cuvita_work[<?php echo $x; ?>][startdate]" class="label_cuvita_work[startdate]"><?php _e('Startdate:','cuvita'); ?></label><br>
                                <input type="date" id="cuvita_work[<?php echo $x; ?>][startdate]" name="cuvita_work[<?php echo $x; ?>][startdate]" value="<?php echo esc_attr($inner_merged_arr['startdate']); ?>" class="cuvita_work[startdate]">
                            </p>
                            <p>
                                <label for="cuvita_work[<?php echo $x; ?>][enddate]" class="label_cuvita_work[enddate]"><?php _e('Enddate:','cuvita'); ?></label><br>
                                <input type="date" id="cuvita_work[<?php echo $x; ?>][enddate]" name="cuvita_work[<?php echo $x; ?>][enddate]" value="<?php echo esc_attr($inner_merged_arr['enddate']); ?>" class="cv-form-enddate cuvita_work[enddate] <?php echo esc_attr($inner_merged_arr['current']) == 1 ? 'nondisplay' : ''; ?>">
                                <span class="cv-form-enddate-now <?php echo esc_attr($inner_merged_arr['current']) == 1 ? '' : 'nondisplay'; ?>"><?php _e('Now','cuvita'); ?></span>
                            </p>
                        </div>
                    </p>
                    <p>
                        <label for="cuvita_work[<?php echo $x; ?>][description]" class="label_cuvita_work[description]"><?php _e('Description:','cuvita'); ?></label><br>
                        <textarea id="cuvita_work[<?php echo $x; ?>][description]" name="cuvita_work[<?php echo $x; ?>][description]" cols="50" rows="10" class="widefat cuvita_work[description]"><?php echo esc_attr($inner_merged_arr['description']); ?></textarea>
                    </p>
                    <p>
                        <button type="button" class="button-link button-link-delete cv-form-delete"><?php _e('Delete:','cuvita'); ?></button>
                    </p>
                </div>
            </div>

        <?php } ?>
    <?php } ?>

    </div>
</div>
<?php