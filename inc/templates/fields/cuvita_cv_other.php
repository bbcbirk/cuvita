<?php

$value = get_option('cuvita_other');
$outer_arr_default = array(
    'id'                =>  '',
    'hide_onsite'       =>  '',
    'title'             =>  '',
    'under_sections'    =>  '',
);
$inner_arr_default = array(
    'hide_onsite'       =>  '',
    'number_of_columns' =>  '1',
    'title1'            =>  '',
    'description1'      =>  '',
    'title2'            =>  '',
    'description2'      =>  '',
    'title3'            =>  '',
    'description3'      =>  '',
);
$maxId = 3;
$unsavedId = 3;

?>

<div>
    <p><button type="button" class="button" id="cv-form-add-section"><?php _e('Add New Section','cuvita'); ?></button></p>
</div>
<div class="form-holder-wrap form-holder-wrap-outer">
    <div id="home_other_wrap" class="form-sortables">
        <?php
        if (!empty($value)) { 
            $idarr = array();
            for ($i=0; $i < count((array)$value); $i++) { 
                $section_merged_arr = !empty($value[$i]) ? array_merge($outer_arr_default, $value[$i]) : $outer_arr_default;
                array_push($idarr, esc_attr($section_merged_arr['id']));
            }
            $maxId = count($idarr) > 0 ? max($idarr) : 0;
            if ($maxId < 3) {
                $maxId = 2;
            }
            $unsavedId = 0;
            for ($x = 0; $x < count((array)$value); $x++) {
                $section_merged_arr = !empty($value[$x]) ? array_merge($outer_arr_default, $value[$x]) : $outer_arr_default;
            ?>
                <div class="collapse-form collapse-form-outer">
                    <div class="collapse-form-top collapse-form-top-outer">
                        <div class="collapse-form-title-action">
                            <button type="button" class="collapse-form-action">
                                <span class="toggle-indicator"></span>
                            </button>
                        </div>
                        <div class="collapse-form-title">
                            <h3 class="<?php echo esc_attr($section_merged_arr['hide_onsite']) == 1 ? 'greyed' : ''; ?>">
                                <input type="hidden" id="cuvita_other[<?php echo $x; ?>][id]" name="cuvita_other[<?php echo $x; ?>][id]" value="<?php echo esc_attr($section_merged_arr['id']) !== '' ? esc_attr($section_merged_arr['id']) : $maxId+$x+1; ?>" class="cuvita_other[id]">
                                <?php $unsavedId += esc_attr($section_merged_arr['id']) !== '' ? 0 : 1; ?>
                                <span class="in-collapse-form-title"><?php echo esc_attr($section_merged_arr['title']) !== '' ? esc_attr($section_merged_arr['title']) : __('Title','cuvita'); ?></span>
                                <span class="in-collapse-form-hidden"><?php echo esc_attr($section_merged_arr['hide_onsite']) == 1 ? ' &mdash; '.__('Hidden','cuvita') : ''; ?></span>
                            </h3>
                        </div>
                    </div>
                    <div class="collapse-form-inside">
                        <p class="flex-end">
                            <input type="checkbox" id="cuvita_other[<?php echo $x; ?>][hide_onsite]" name="cuvita_other[<?php echo $x; ?>][hide_onsite]" value="1" <?php checked(esc_attr($section_merged_arr['hide_onsite']), 1); ?> class="cv-form-hide-onsite cuvita_other[hide_onsite]">
                            <label for="cuvita_other[<?php echo $x; ?>][hide_onsite]" class="label_cuvita_other[hide_onsite]"><?php _e('Hide on site.','cuvita'); ?></label>
                        </p>
                        <p>
                            <label for="cuvita_other[<?php echo $x; ?>][title]" class="label_cuvita_other[title]"><?php _e('Section Title:','cuvita'); ?></label><br>
                            <input type="text" id="cuvita_other[<?php echo $x; ?>][title]" name="cuvita_other[<?php echo $x; ?>][title]" value="<?php echo esc_attr($section_merged_arr['title']); ?>" placeholder="<?php _e('Title','cuvita'); ?>" class="widefat collapse-form-inside-title cuvita_other[title]">
                        </p>
                        <div>
                            <p><button type="button" class="button cv-form-add-undersection"><?php _e('Add New Subsection','cuvita'); ?></button></p>
                        </div>
                        <div class="form-holder-wrap form-holder-wrap-inner">
                            <div class="form-sortables form-sortables-inner">
                            <?php 
                            if (!empty($section_merged_arr['under_sections'])) { 
                                for ($y = 0; $y < count((array)$section_merged_arr['under_sections']); $y++) {
                                    $undersection_merged_arr = !empty($section_merged_arr['under_sections'][$y]) ? array_merge($inner_arr_default, $section_merged_arr['under_sections'][$y]) : $inner_arr_default;
                                ?>
                                    <div class="collapse-form collapse-form-inner">
                                        <div class="collapse-form-top collapse-form-top-inner">
                                            <div class="collapse-form-title-action">
                                                <button type="button" class="collapse-form-action">
                                                    <span class="toggle-indicator"></span>
                                                </button>
                                            </div>
                                            <div class="collapse-form-title">
                                                <h3 class="<?php echo esc_attr($undersection_merged_arr['hide_onsite']) == 1 ? 'greyed' : ''; ?>">
                                                    <span><?php _e('Subsection:','cuvita'); ?> </span>
                                                    <span class="in-collapse-form-title"><?php echo esc_attr($undersection_merged_arr['title1']) !== '' ? esc_attr($undersection_merged_arr['title1']) : __('Title','cuvita'); ?></span>
                                                    <span class="in-collapse-form-hidden"><?php echo esc_attr($undersection_merged_arr['hide_onsite']) == 1 ? ' &mdash; '.__('Hidden','cuvita') : ''; ?></span>
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="collapse-form-inside">
                                            <p class="flex-end">
                                                <input type="checkbox" id="cuvita_other[<?php echo $x; ?>][under_sections][<?php echo $y; ?>][hide_onsite]" name="cuvita_other[<?php echo $x; ?>][under_sections][<?php echo $y; ?>][hide_onsite]" value="1" <?php checked(esc_attr($undersection_merged_arr['hide_onsite']), 1); ?> class="cv-form-hide-onsite cuvita_other[under_sections][hide_onsite]">
                                                <label for="cuvita_other[<?php echo $x; ?>][under_sections][<?php echo $y; ?>][hide_onsite]" class="label_cuvita_other[under_sections][hide_onsite]"><?php _e('Hide on site.','cuvita'); ?></label>
                                            </p>
                                            <p>
                                                <label>
                                                    <input type="radio" name="cuvita_other[<?php echo $x; ?>][under_sections][<?php echo $y; ?>][number_of_columns]" value="1" <?php checked(esc_attr($undersection_merged_arr['number_of_columns']), 1); ?> class="cuvita_other[under_sections][number_of_columns]">
                                                    <?php _e('1 Column Layout','cuvita'); ?>
                                                </label>
                                                <br>
                                                <label>
                                                    <input type="radio" name="cuvita_other[<?php echo $x; ?>][under_sections][<?php echo $y; ?>][number_of_columns]"  value="2" <?php checked(esc_attr($undersection_merged_arr['number_of_columns']), 2); ?> class="cuvita_other[under_sections][number_of_columns]">
                                                    <?php _e('2 Column Layout','cuvita'); ?>
                                                </label>
                                                <br>
                                                <label>
                                                    <input type="radio" name="cuvita_other[<?php echo $x; ?>][under_sections][<?php echo $y; ?>][number_of_columns]"  value="3" <?php checked(esc_attr($undersection_merged_arr['number_of_columns']), 3); ?> class="cuvita_other[under_sections][number_of_columns]">
                                                    <?php _e('3 Column Layout','cuvita'); ?>
                                                </label>
                                            </p>
                                            <div class="column_1">
                                                <p>
                                                    <label for="cuvita_other[<?php echo $x; ?>][under_sections][<?php echo $y; ?>][title1]" class="label_cuvita_other[under_sections][title1]"><?php _e('Subsection Title:','cuvita'); ?></label><br>
                                                    <input type="text" id="cuvita_other[<?php echo $x; ?>][under_sections][<?php echo $y; ?>][title1]" name="cuvita_other[<?php echo $x; ?>][under_sections][<?php echo $y; ?>][title1]" value="<?php echo esc_attr($undersection_merged_arr['title1']); ?>" placeholder="<?php _e('Title','cuvita'); ?>" class="widefat collapse-form-inside-title cuvita_other[under_sections][title1]">
                                                </p>
                                                <p>
                                                    <label for="cuvita_other-<?php echo $x; ?>-under_sections-<?php echo $y; ?>-description1" class="label_cuvita_other[under_sections][description1]"><?php _e('Description:','cuvita'); ?></label><br>
                                                </p>
                                                <?php
                                                $content = $undersection_merged_arr['description1'];
                                                $editor_id = 'cuvita_other-'.$x.'-under_sections-'.$y.'-description1';
                                                $settings = array(
                                                    'media_buttons' =>  false,
                                                    'textarea_name' =>  'cuvita_other['.$x.'][under_sections]['.$y.'][description1]',
                                                    'teeny'         =>  true,
                                                    'textarea_rows' =>  10,
                                                    'editor_class'  =>  'cuvita_other[under_sections][description1] cuvita_tinymce',
                                                    'quicktags'     =>  false,

                                                );
                                                echo wp_editor($content, $editor_id, $settings);
                                                ?>
                                            </div>
                                            <div class="column_2 <?php echo esc_attr($undersection_merged_arr['number_of_columns']) == 1 ? 'hidden' : ''; ?>">
                                                <p>
                                                    <label for="cuvita_other[<?php echo $x; ?>][under_sections][<?php echo $y; ?>][title2]" class="label_cuvita_other[under_sections][title2]"><?php _e('Subsection Title:','cuvita'); ?></label><br>
                                                    <input type="text" id="cuvita_other[<?php echo $x; ?>][under_sections][<?php echo $y; ?>][title2]" name="cuvita_other[<?php echo $x; ?>][under_sections][<?php echo $y; ?>][title2]" value="<?php echo esc_attr($undersection_merged_arr['title2']); ?>" placeholder="<?php _e('Title','cuvita'); ?>" class="widefat cuvita_other[under_sections][title2]">
                                                </p>
                                                <p>
                                                    <label for="cuvita_other-<?php echo $x; ?>-under_sections-<?php echo $y; ?>-description2" class="label_cuvita_other[under_sections][description2]"><?php _e('Description:','cuvita'); ?></label><br>
                                                </p>
                                                <?php
                                                $content = $undersection_merged_arr['description2'];
                                                $editor_id = 'cuvita_other-'.$x.'-under_sections-'.$y.'-description2';
                                                $settings = array(
                                                    'media_buttons' =>  false,
                                                    'textarea_name' =>  'cuvita_other['.$x.'][under_sections]['.$y.'][description2]',
                                                    'teeny'         =>  true,
                                                    'textarea_rows' =>  10,
                                                    'editor_class'  =>  'cuvita_other[under_sections][description2]',
                                                    'quicktags'     =>  false,

                                                );
                                                echo wp_editor($content, $editor_id, $settings);
                                                ?>
                                            </div>
                                            <div class="column_3 <?php echo esc_attr($undersection_merged_arr['number_of_columns']) != 3 ? 'hidden' : ''; ?>">
                                                <p>
                                                    <label for="cuvita_other[<?php echo $x; ?>][under_sections][<?php echo $y; ?>][title3]" class="label_cuvita_other[under_sections][title3]"><?php _e('Subsection Title:','cuvita'); ?></label><br>
                                                    <input type="text" id="cuvita_other[<?php echo $x; ?>][under_sections][<?php echo $y; ?>][title3]" name="cuvita_other[<?php echo $x; ?>][under_sections][<?php echo $y; ?>][title3]" value="<?php echo esc_attr($undersection_merged_arr['title3']); ?>" placeholder="<?php _e('Title','cuvita'); ?>" class="widefat cuvita_other[under_sections][title3]">
                                                </p>
                                                <p>
                                                    <label for="cuvita_other-<?php echo $x; ?>-under_sections-<?php echo $y; ?>-description3" class="label_cuvita_other[under_sections][description1]"><?php _e('Description:','cuvita'); ?></label><br>
                                                </p>
                                                <?php
                                                $content = $undersection_merged_arr['description3'];
                                                $editor_id = 'cuvita_other-'.$x.'-under_sections-'.$y.'-description3';
                                                $settings = array(
                                                    'media_buttons' =>  false,
                                                    'textarea_name' =>  'cuvita_other['.$x.'][under_sections]['.$y.'][description3]',
                                                    'teeny'         =>  true,
                                                    'textarea_rows' =>  10,
                                                    'editor_class'  =>  'cuvita_other[under_sections][description3]',
                                                    'quicktags'     =>  false,
                                                );
                                                echo wp_editor($content, $editor_id, $settings);
                                                ?>
                                            </div>
                                            <p>
                                                <button type="button" class="button-link button-link-delete cv-form-delete-inner"><?php _e('Delete Subsection','cuvita'); ?></button>
                                            </p>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                            </div>
                        </div>
                        <p>
                            <button type="button" class="button-link button-link-delete cv-form-delete"><?php _e('Delete Section','cuvita'); ?></button>
                        </p>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
        <script>
            var maxID = <?php echo $maxId+$unsavedId; ?>;
        </script>
    </div>
</div>

<?php