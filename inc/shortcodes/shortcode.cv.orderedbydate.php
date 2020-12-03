<?php 
$cuvita_education = get_option('cuvita_education');
$cuvita_education_form_default = array(
    'hide_onsite'   =>  '',
    'title'         =>  '',
    'school'        =>  '',
    'city'          =>  '',
    'current'       =>  '',
    'startdate'     =>  '',
    'enddate'       =>  '',
    'description'   =>  '',
);
if (!empty($cuvita_education)) {
    $cuvita_education = sortCvByNewest($cuvita_education);
}

$cuvita_work = get_option('cuvita_work');
$cuvita_work_form_default = array(
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
if (!empty($cuvita_work)) {
    $cuvita_work = sortCvByNewest($cuvita_work);
}

$sectionOrder = get_option('cuvita_cv_order');


if (!empty($sectionOrder)) { 
    foreach ($sectionOrder as $index => $sectionArr) {

        switch ($sectionArr['section_id']) {
            case '1':
                if (count((array)$cuvita_work) > 0 && !empty($cuvita_work)) {

                    ?>
                    <section class="cv-section">
                        <h2 class="section-title"><?php echo $sectionArr['title']; ?></h2>
                        <div class="section-content">
                        <?php
                
                        for ($x = 0; $x < count((array)$cuvita_work); $x++) {
                            $work = !empty($cuvita_work[$x]) ? array_merge($cuvita_work_form_default, $cuvita_work[$x]) : $cuvita_work_form_default;
                            if (esc_attr($work['hide_onsite']) != 1) {
                                ?>
                                <div class="under-section">
                                    <h3><?php echo esc_attr($work['title']) !== '' ? esc_attr($work['title']) : ''; ?></h3>
                                    <p class="work-meta meta">
                                        <?php
                                            echo esc_attr($work['employer_link']) !== '' && esc_attr($work['employer']) !== '' ? '<a href="'.esc_attr($work['employer_link']).'" target="_blank">' : '';
                                            echo esc_attr($work['employer']) !== '' ? esc_attr($work['employer']) : '';
                                            echo esc_attr($work['employer_link']) !== '' && esc_attr($work['employer']) !== '' ? '</a>' : '';
                                            echo esc_attr($work['employer']) !== '' ? ', ' : '';
                                            echo esc_attr($work['city']) !== '' ? esc_attr($work['city']) . ', ' : '';
                                            echo esc_attr($work['startdate']) !== '' ? formatDateToMonthYear(esc_attr($work['startdate'])) . ' &ndash; ' : '';
                                            if (isset($work['current']) && esc_attr($work['current']) == 1) {
                                                echo 'Nu';
                                            } else {
                                                echo esc_attr($work['enddate']) !== '' ? formatDateToMonthYear(esc_attr($work['enddate'])) : '';
                                            }
                                        ?>
                                    </p>
                                    <p class="work-description description">
                                        <?php echo esc_attr($work['description']) !== '' ? esc_attr($work['description']) : ''; ?>
                                    </p>
                                </div>
                                <?php
                            }  
                        }
                
                        ?>
                        </div>
                    </section>
                    <?php
                }
                break;

            case '2':
                if (count((array)$cuvita_education) > 0 && !empty($cuvita_education)) {

                    ?>
                    <section class="cv-section">
                        <h2 class="section-title"><?php echo $sectionArr['title']; ?></h2>
                        <div class="section-content">
                        <?php
                
                        for ($x = 0; $x < count((array)$cuvita_education); $x++) {
                            $education = !empty($cuvita_education[$x]) ? array_merge($cuvita_education_form_default, $cuvita_education[$x]) : $cuvita_education_form_default;
                            if (esc_attr($education['hide_onsite']) != 1) {
                                ?>
                                <div class="under-section">
                                    <h3><?php echo esc_attr($education['title']) !== '' ? esc_attr($education['title']) : ''; ?></h3>
                                    <p class="education-meta meta">
                                        <?php 
                                            echo esc_attr($education['school']) !== '' ? esc_attr($education['school']) . ', ' : '';
                                            echo esc_attr($education['city']) !== '' ? esc_attr($education['city']) . ', ' : '';
                                            echo esc_attr($education['startdate']) !== '' ? formatDateToMonthYear(esc_attr($education['startdate'])) . ' &ndash; ' : '';
                                            if (isset($education['current']) && esc_attr($education['current']) == 1) {
                                                echo 'Nu';
                                            } else {
                                                echo esc_attr($education['enddate']) !== '' ? formatDateToMonthYear(esc_attr($education['enddate'])) : '';
                                            }
                                        ?>
                                    </p>
                                    <p class="education-description description">
                                        <?php echo esc_attr($education['description']) !== '' ? esc_attr($education['description']) : ''; ?>
                                    </p>
                                </div>
                                <?php
                            }  
                        }
                
                        ?>
                        </div>
                    </section>
                    <?php
                }
                break;
            
            default:
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
                $cuvita_other_section = get_other_section($sectionArr['section_id']);
                if (count((array)$cuvita_other_section) > 0) {

                    ?>
                    <section class="cv-section">
                        <h2 class="section-title"><?php echo $cuvita_other_section['title']; ?></h2>
                        <div class="section-content section-other">
                        <?php

                        for ($x = 0; $x < count((array)$cuvita_other_section['under_sections']); $x++) {
                            $inner_section = !empty($cuvita_other_section['under_sections'][$x]) ? array_merge($inner_arr_default, $cuvita_other_section['under_sections'][$x]) : $inner_arr_default;
                            if (esc_attr($inner_section['hide_onsite']) != 1) {
                                ?>
                                <div class="column-container under-section <?php echo $inner_section['number_of_columns'] == '2' || $inner_section['number_of_columns'] == '3' ? 'has-columns' : ''; ?>">
                                
                                    <div class="collumn-1">
                                        <?php
                                        if (esc_attr($inner_section['title1']) !== '') {
                                            ?>
                                            <h3><?php echo esc_attr($inner_section['title1']) ?></h3>
                                            <?php
                                        }
                                        ?>
                                        <p>
                                            <?php echo $inner_section['description1'] !== '' ? $inner_section['description1'] : ''; ?>
                                        </p>
                                    </div>
                                    <?php
                                    if ($inner_section['number_of_columns'] == '2' || $inner_section['number_of_columns'] == '3' ) {
                                        ?>
                                        <div class="collumn-2">
                                            <?php
                                            if (esc_attr($inner_section['title2']) !== '') {
                                                ?>
                                                <h3><?php echo esc_attr($inner_section['title2']) ?></h3>
                                                <?php
                                            }
                                            ?>
                                            <p>
                                                <?php echo $inner_section['description2'] !== '' ? $inner_section['description2'] : ''; ?>
                                            </p>
                                        </div>
                                        <?php
                                    }
                                    if ($inner_section['number_of_columns'] == '3' ) {
                                        ?>
                                        <div class="collumn-3">
                                            <?php
                                            if (esc_attr($inner_section['title3']) !== '') {
                                                ?>
                                                <h3><?php echo esc_attr($inner_section['title3']) ?></h3>
                                                <?php
                                            }
                                            ?>
                                            <p>
                                                <?php echo $inner_section['description3'] !== '' ? $inner_section['description3'] : ''; ?>
                                            </p>
                                        </div>
                                        <?php
                                    }
                                    ?>
    
                                </div>
                                <?php
                            }  
                        }
                        ?>
                        </div>
                    </section>
                    <?php
                }
                break;
        }
    }
}



