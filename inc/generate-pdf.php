<?php
function generate_pdf() {
    
    require_once get_template_directory() . '/inc/fpdf182/fpdf.php';
    class PDF extends FPDF
    {
        // Page footer
        function Footer()
        {
            // Position at 1.5 cm from bottom
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Helvetica','',8);
            // Page number
            $this->Cell(0,10,$this->PageNo().'/{nb}',0,0,'C');
        }
    }

    $pdf = new PDF('P', 'mm', 'A4');
    $pdf->AliasNbPages();
    $pdf->SetMargins(12.7, 12.7, 12.7);
    $font_family = 'Helvetica';
    $h1_fontsize = 20;
    $h2_fontsize = 11;
    $h3_fontsize = 10;
    $body_fontsize = 10;
    $pdf->AddPage();


    $pdf->SetFont($font_family,'B',$h1_fontsize);
    $pdf->Cell(0,16,'Navn', 0, 2, 'C');


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
    $pdf->SetFont($font_family,'',$h2_fontsize);
    $section_title_width;
    $longest = 0;
    $section_title_arr = array('Work Experience', 'Education', 'Contact Info');
    foreach ($section_title_arr as $key) {
        $longest = $pdf->GetStringWidth(strtoupper(str_replace(' ', '_', $key))) > $longest ? $pdf->GetStringWidth(strtoupper(str_replace(' ', '_', $key))) : $longest;
    }
    if ($longest+6 > 45) {
        $section_title_width = 40;
    } else {
        $section_title_width = $longest+1;
    }


    /**
    * Divider
    */
    $pdf->SetFont($font_family,'',$body_fontsize);
    $pdf->Cell(0,0,'', 'B', 2, 'C');
    $pdf->Cell(0,6,'', 0, 2, 'C');

    /**
     * Contact
     */
    $pdf->SetFont($font_family,'',$h2_fontsize);
    $xPos = $pdf->GetX();
    $yPos_img = $pdf->GetY();
    $yPos = $pdf->GetY();
    $pdf->MultiCell($section_title_width,$h2_fontsize/2,strtoupper('Contact Info'));
    $pdf->SetXY($xPos+$section_title_width+5, $yPos);

    $cuvita_contact_info = array(
        'Address'       =>  'Test',
        'Zipcode/City'  =>  '',
        'Born'          =>  '',
        'Civil Status'  =>  '',
        'Phone'         =>  '',
        'E-mail'        =>  '',
        'Website'       =>  '',
    );
    $i=false;
    foreach ($cuvita_contact_info as $key => $value) {
        $pdf->SetFont($font_family,'',$body_fontsize);
        if ($i) {
            $xPos = $pdf->GetX();
            $yPos = $pdf->GetY();
            $pdf->MultiCell($section_title_width,0,'');
            $pdf->SetXY($xPos+$section_title_width+5, $yPos);
        }
        $i = true;
        $xPos = $pdf->GetX();
        $yPos = $pdf->GetY();
        $pdf->MultiCell(30,6,html_utf8($key));
        $pdf->SetXY($xPos+32, $yPos);

        $pdf->MultiCell(45,6,html_utf8($value));
        

        $pdf->SetFont($font_family,'',$body_fontsize);
        $xPos = $pdf->GetX();
        $yPos = $pdf->GetY();
        $pdf->MultiCell($section_title_width,0,'');
        $pdf->SetXY($xPos+$section_title_width+5, $yPos);
        $pdf->MultiCell(0,1,'');
        
    }
    $pdf->Cell(0,6,'', 0, 2, 'C');

    $xPos = $pdf->GetX();
    $yPos = $pdf->GetY();
    $pdf->Image('http://localhost/exam/wp/wp-content/uploads/2008/06/100_5478.jpg',$xPos+$section_title_width+5+32+47,$yPos_img, 50);
    $imgSize = getimagesize('http://localhost/exam/wp/wp-content/uploads/2008/06/100_5478.jpg'); 
    $factor = $imgSize[1]/$imgSize[0];
    if ($yPos < $yPos_img+(50*$factor)+6) {
        $pdf->SetXY($xPos, $yPos_img+(50*$factor)+6);
    }

    /**
    * Divider
    */
    $pdf->SetFont($font_family,'',$body_fontsize);
    $pdf->Cell(0,0,'', 'B', 2, 'C');
    $pdf->Cell(0,6,'', 0, 2, 'C');

    /**
     * About ME
     */
    $yPos_img = $pdf->GetY();
    $yPos = $pdf->GetY();
    $pdf->MultiCell($section_title_width,$h2_fontsize/2,strtoupper('About Me'));
    $pdf->SetXY($xPos+$section_title_width+5, $yPos);
    $pdf->SetFont($font_family,'',$body_fontsize);
    $aboutme = esc_attr('Ipsum Lorem') !== '' ? esc_attr('Ipsum Lorem') : '';
    $pdf->MultiCell(0,$body_fontsize*0.7, html_utf8($aboutme));
    $pdf->Cell(0,6,'', 0, 2, 'C');
    
    $pdf->AddPage();
    /**
    * Divider
    */
    $pdf->SetFont($font_family,'',$body_fontsize);
    $pdf->Cell(0,0,'', 'B', 2, 'C');
    $pdf->Cell(0,6,'', 0, 2, 'C');

    /**
    * Work
    */
    $pdf->SetFont($font_family,'',$h2_fontsize);
    $xPos = $pdf->GetX();
    $yPos = $pdf->GetY();
    $pdf->MultiCell($section_title_width,$h2_fontsize/2,strtoupper('Work Experience'));
    $pdf->SetXY($xPos+$section_title_width+5, $yPos);
    for ($x = 0; $x < count((array)$cuvita_education); $x++) {
        $education = !empty($cuvita_education[$x]) ? array_merge($cuvita_education_form_default, $cuvita_education[$x]) : $cuvita_education_form_default;
        if (esc_attr($education['hide_onsite']) != 1) {
            
            $pdf->SetFont($font_family,'',$h2_fontsize);
            if ($x > 0) {
                $xPos = $pdf->GetX();
                $yPos = $pdf->GetY();
                $pdf->MultiCell($section_title_width,0,'');
                $pdf->SetXY($xPos+$section_title_width+5, $yPos);
            }
            $title = esc_attr($education['title']) !== '' ? esc_attr($education['title']) : '';
            $pdf->MultiCell(0,$h2_fontsize/2,strtoupper(html_utf8($title)));
    
            $pdf->SetFont($font_family,'B',$h3_fontsize);
            $xPos = $pdf->GetX();
            $yPos = $pdf->GetY();
            $pdf->MultiCell($section_title_width,0,'');
            $pdf->SetXY($xPos+$section_title_width+5, $yPos);
            $time_and_place = esc_attr($education['school']) !== '' ? esc_attr($education['school']) . ', ' : '';
            $time_and_place .= esc_attr($education['city']) !== '' ? esc_attr($education['city']) . ', ' : '';
            $time_and_place .= esc_attr($education['startdate']) !== '' ? formatDateToMonthYear(esc_attr($education['startdate'])) . ' - ' : '';
            if (isset($education['current']) && esc_attr($education['current']) == 1) {
                $time_and_place .= 'Nu';
            } else {
                $time_and_place .= esc_attr($education['enddate']) !== '' ? formatDateToMonthYear(esc_attr($education['enddate'])) : '';
            }
            $pdf->MultiCell(0,$h3_fontsize*0.7, html_utf8($time_and_place));

            $pdf->SetFont($font_family,'',$body_fontsize);
            $xPos = $pdf->GetX();
            $yPos = $pdf->GetY();
            $pdf->MultiCell($section_title_width,0,'');
            $pdf->SetXY($xPos+$section_title_width+5, $yPos);
            $description = esc_attr($education['description']) !== '' ? esc_attr($education['description']) : '';
            $pdf->MultiCell(0,$body_fontsize*0.7, html_utf8($description));

            $pdf->SetFont($font_family,'',$body_fontsize);
            $xPos = $pdf->GetX();
            $yPos = $pdf->GetY();
            $pdf->MultiCell($section_title_width,0,'');
            $pdf->SetXY($xPos+$section_title_width+5, $yPos);
            $pdf->MultiCell(0,$body_fontsize*0.6,'');
        }  
    }
    
    /**
    * Divider
    */
    $pdf->SetFont($font_family,'',$body_fontsize);
    $pdf->Cell(0,0,'', 'B', 2, 'C');
    $pdf->Cell(0,6,'', 0, 2, 'C');
    
    /**
    * Education
    */
    $pdf->SetFont($font_family,'',$h2_fontsize);
    $xPos = $pdf->GetX();
    $yPos = $pdf->GetY();
    $pdf->MultiCell($section_title_width,$h2_fontsize/2,strtoupper('Education'));
    $pdf->SetXY($xPos+$section_title_width+5, $yPos);
    for ($x = 0; $x < count((array)$cuvita_education); $x++) {
        $education = !empty($cuvita_education[$x]) ? array_merge($cuvita_education_form_default, $cuvita_education[$x]) : $cuvita_education_form_default;
        if (esc_attr($education['hide_onsite']) != 1) {
            
            $pdf->SetFont($font_family,'',$h2_fontsize);
            if ($x > 0) {
                $xPos = $pdf->GetX();
                $yPos = $pdf->GetY();
                $pdf->MultiCell($section_title_width,0,'');
                $pdf->SetXY($xPos+$section_title_width+5, $yPos);
            }
            $title = esc_attr($education['title']) !== '' ? esc_attr($education['title']) : '';
            $pdf->MultiCell(0,$h2_fontsize/2,strtoupper(html_utf8($title)));
    
            $pdf->SetFont($font_family,'',$h3_fontsize);
            $xPos = $pdf->GetX();
            $yPos = $pdf->GetY();
            $pdf->MultiCell($section_title_width,0,'');
            $pdf->SetXY($xPos+$section_title_width+5, $yPos);
            $time_and_place = esc_attr($education['school']) !== '' ? esc_attr($education['school']) . ', ' : '';
            $time_and_place .= esc_attr($education['city']) !== '' ? esc_attr($education['city']) . ', ' : '';
            $time_and_place .= esc_attr($education['startdate']) !== '' ? formatDateToMonthYear(esc_attr($education['startdate'])) . ' - ' : '';
            if (isset($education['current']) && esc_attr($education['current']) == 1) {
                $time_and_place .= 'Nu';
            } else {
                $time_and_place .= esc_attr($education['enddate']) !== '' ? formatDateToMonthYear(esc_attr($education['enddate'])) : '';
            }
            $pdf->MultiCell(0,$h3_fontsize*0.7, html_utf8($time_and_place));

            $pdf->SetFont($font_family,'',$body_fontsize);
            $xPos = $pdf->GetX();
            $yPos = $pdf->GetY();
            $pdf->MultiCell($section_title_width,0,'');
            $pdf->SetXY($xPos+$section_title_width+5, $yPos);
            $description = esc_attr($education['description']) !== '' ? esc_attr($education['description']) : '';
            $pdf->MultiCell(0,$body_fontsize*0.7, html_utf8($description));

            $pdf->SetFont($font_family,'',$body_fontsize);
            $xPos = $pdf->GetX();
            $yPos = $pdf->GetY();
            $pdf->MultiCell($section_title_width,0,'');
            $pdf->SetXY($xPos+$section_title_width+5, $yPos);
            $pdf->MultiCell(0,$body_fontsize*0.6,'');
        }  
    }
    
    
    $pdf->Output('F', get_template_directory() . '/inc/doc.pdf');
}

//generate_pdf();