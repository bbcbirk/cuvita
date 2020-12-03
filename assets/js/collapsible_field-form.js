jQuery(document).ready( function($) {

    /**
     * Delete
     */
    $('.form-holder-wrap #home_education_wrap').on('click', '.cv-form-delete', function() {
        var confirmDel = confirm("Are you sure you want to delete?");
        if (confirmDel) {
            $(this).closest('.collapse-form').remove();
            renameOption(0,'#home_education_wrap .collapse-form', 'cuvita_education', educationOptions);
        }
    });

    $('.form-holder-wrap #home_work_wrap').on('click', '.cv-form-delete', function() {
        var confirmDel = confirm("Are you sure you want to delete?");
        if (confirmDel) {
            $(this).closest('.collapse-form').remove();
            renameOption(0,'#home_work_wrap .collapse-form', 'cuvita_work', workOptions);
        }
    });

    $('.form-holder-wrap #home_other_wrap').on('click', '.cv-form-delete', function() {
        var confirmDel = confirm("Are you sure you want to delete?");
        if (confirmDel) {
            $('textarea.cuvita_tinymce').each(function(i,el) {
                var id = $(el).attr('id');
                tinyMCE.execCommand('mceRemoveEditor', false, id);
                //tinyMCE.execCommand('mceRemoveControl', false, id);
            });
            $(this).closest('.collapse-form').remove();
            renameOptionOtherSection(0,'#home_other_wrap .collapse-form.collapse-form-outer', 'cuvita_other', otherOtherOptions, '.form-holder-wrap.form-holder-wrap-inner .collapse-form.collapse-form-inner', otherInnerOptions);
            $('textarea.cuvita_tinymce').each(function(i,el) {
                
                var id = $(el).attr('id');
                tinyMCE.execCommand('mceAddEditor', false, id);
                //tinyMCE.execCommand('mceRemoveControl', false, id);
            });
            getTinyMceStyling();
        }
    });

    $('.form-holder-wrap #home_other_wrap').on('click', '.cv-form-delete-inner', function() {
        var confirmDel = confirm("Are you sure you want to delete?");
        if (confirmDel) {
            $('textarea.cuvita_tinymce').each(function(i,el) {
                var id = $(el).attr('id');
                tinyMCE.execCommand('mceRemoveEditor', false, id);
                //tinyMCE.execCommand('mceRemoveControl', false, id);
            });
            $(this).closest('.collapse-form-inner').remove();
            renameOptionOtherSubSection(0, $(this), 'cuvita_other', otherInnerOptions);
            $('textarea.cuvita_tinymce').each(function(i,el) {
                
                var id = $(el).attr('id');
                tinyMCE.execCommand('mceAddEditor', false, id);
                //tinyMCE.execCommand('mceRemoveControl', false, id);
            });
            getTinyMceStyling();
        }
    });
    
    /**
     * Change Name
     */
    $('.form-holder-wrap').on('input', '.collapse-form-inside-title', function() {
        var formtitle = $(this).closest('.collapse-form').find('.in-collapse-form-title').first();
        if (!$(this).val()) {
            formtitle.text('Title');
        } else {
            formtitle.text($(this).val());
        }
    });
    
    $('.form-holder-wrap').on('input', '.collapse-form-inside-employer', function() {
        var formEmp = $(this).closest('.collapse-form').find('.in-collapse-form-employer');
        if (!$(this).val()) {
            formEmp.text('');
        } else {
            formEmp.text(', '+ $(this).val());
        }
    });

    /**
     * Collapse
     */
    $('.form-holder-wrap.form-holder-wrap-outer').on('click', '.collapse-form-top.collapse-form-top-outer', function() {
        var content = $(this).next();
        if ($(this).hasClass('active')){
            $(this).removeClass('active');
            content.removeClass('active');
            content.css({'max-height': '0'});
        } else {
            $(this).addClass("active");
            content.addClass("active");
            content.css({'max-height': content.prop('scrollHeight') + "px"});
        }
    });

    $('.form-holder-wrap.form-holder-wrap-outer').on('click', '.collapse-form-top.collapse-form-top-inner', function() {
        var content = $(this).next();
        var outerContent = $(this).closest('.collapse-form.collapse-form-outer').find('.collapse-form-top.collapse-form-top-outer').first().next();
        if ($(this).hasClass('active')){
            $(this).removeClass('active');
            content.removeClass('active');
            content.css({'max-height': '0'});
            outerContent.css({'max-height': outerContent.prop('scrollHeight') + "px"});
        } else {
            $(this).addClass("active");
            content.addClass("active");
            setCollapsHeightFromInner($(this));
        }
    });
    

    /**
     * Hide on site
     */
    $('.form-holder-wrap').on('change', '.cv-form-hide-onsite', function() {
        var formHeading = $(this).closest('.collapse-form').find('.collapse-form-title h3').first();
        var formtitleHidden = $(this).closest('.collapse-form').find('.in-collapse-form-hidden').first();
        if ($(this).is(':checked')) {
            formHeading.addClass("greyed");
            formtitleHidden.html(' &mdash; Hidden');
        } else {
            formHeading.removeClass("greyed");
            formtitleHidden.html('');

        }
    });

    /**
     * Currently date
     */
    $('.form-holder-wrap').on('change', '.cv-form-currentStudy', function() {
        var formEnddate = $(this).closest('.collapse-form-inside').find('.cv-form-enddate');
        if ($(this).is(':checked')) {
            formEnddate.addClass("nondisplay");
            formEnddate.next().removeClass('nondisplay');
        } else {
            formEnddate.removeClass('nondisplay');
            formEnddate.next().addClass("nondisplay");
        }
    });

    $('.form-holder-wrap').on('change', '.cv-form-currentWork', function() {
        var formEnddate = $(this).closest('.collapse-form-inside').find('.cv-form-enddate');
        if ($(this).is(':checked')) {
            formEnddate.addClass("nondisplay");
            formEnddate.next().removeClass('nondisplay');
        } else {
            formEnddate.removeClass('nondisplay');
            formEnddate.next().addClass("nondisplay");
        }
    });


    /**
     * Number of columns
     */
    $('.form-holder-wrap.form-holder-wrap-outer').on('change', '.cuvita_other\\[under_sections\\]\\[number_of_columns\\]', function() {
        if ($(this).is(':checked')) {
            
            var value = $(this).val();
            var cullum2 = $(this).closest('.collapse-form-inside').find('.column_2');
            var cullum3 = $(this).closest('.collapse-form-inside').find('.column_3');
            switch (value) {
                case '1':
                    cullum2.addClass('hidden');
                    cullum3.addClass('hidden');
                    break;
                case '2':
                    cullum2.removeClass('hidden');
                    cullum3.addClass('hidden');
                    break;
                case '3':
                    cullum2.removeClass('hidden');
                    cullum3.removeClass('hidden');
                    break;
                default:
                    break;
            }
            setCollapsHeightFromInner($(this));
        }
    });

    /**
     * Sortables
     */
    $('#home_education_wrap.form-sortables').sortable({
        placeholder: "form-sortables-placeholder",
        items: '> .collapse-form',
        handle: '> .collapse-form-top > .collapse-form-title',
        //containment: '#wpwrap',
        start: function(e, ui) {
            $('.collapse-form-top').each(function(index) {
                var content = $(this).next();
                if ($(this).hasClass('active')) {
                    $(this).removeClass('active');
                    content.removeClass('active');
                    content.css({'max-height': '0'});
                }
            });
        },
        update: function(e, ui) {
            renameOption(0,'#home_education_wrap .collapse-form', 'cuvita_education', educationOptions);
        },
    });

    $('#home_work_wrap.form-sortables').sortable({
        placeholder: "form-sortables-placeholder",
        items: '> .collapse-form',
        handle: '> .collapse-form-top > .collapse-form-title',
        //containment: '#wpwrap',
        start: function(e, ui) {
            $('.collapse-form-top').each(function(index) {
                var content = $(this).next();
                if ($(this).hasClass('active')) {
                    $(this).removeClass('active');
                    content.removeClass('active');
                    content.css({'max-height': '0'});
                }
            });
        },
        update: function(e, ui) {
            renameOption(0,'#home_work_wrap .collapse-form', 'cuvita_work', workOptions);
        },
    });
    
    $('#home_other_wrap.form-sortables').sortable({
        placeholder: "form-sortables-placeholder",
        items: '> .collapse-form',
        handle: '> .collapse-form-top > .collapse-form-title',
        //containment: '#wpwrap',
        start: function(e, ui) {
            $('textarea.cuvita_tinymce').each(function(i,el) {
                var id = $(el).attr('id');
                tinyMCE.execCommand('mceRemoveEditor', false, id);
                //tinyMCE.execCommand('mceRemoveControl', false, id);
            });

            $('.collapse-form-top').each(function(index) {
                var content = $(this).next();
                if ($(this).hasClass('active')) {
                    $(this).removeClass('active');
                    content.removeClass('active');
                    content.css({'max-height': '0'});
                }
            });
        },
        update: function(e, ui) {
            renameOptionOtherSection(0,'#home_other_wrap .collapse-form.collapse-form-outer', 'cuvita_other', otherOtherOptions, '.form-holder-wrap.form-holder-wrap-inner .collapse-form.collapse-form-inner', otherInnerOptions);
        },
        stop: function(e,ui) {
            $('textarea.cuvita_tinymce').each(function(i,el) {
                var id = $(el).attr('id');
                tinyMCE.execCommand('mceAddEditor', false, id);
                //tinyMCE.execCommand('mceAddControl', false, id);
            });
        },
    });

    $('#home_cv_wrap.form-sortables').sortable({
        placeholder: "form-sortables-placeholder",
        items: '> .collapse-form',
        handle: '> .collapse-form-top > .collapse-form-title',
        //containment: '#wpwrap',
        update: function(e, ui) {
            renameOptionSectionOrder(0,'#home_cv_wrap .collapse-form', 'cuvita_cv_order', sectionOrderOptions);
        },
    });

    innerSortable();
    function innerSortable() {
        $('#home_other_wrap .form-sortables.form-sortables-inner').sortable({
            placeholder: "form-sortables-placeholder",
            items: '> .collapse-form-inner',
            handle: '> .collapse-form-top > .collapse-form-title',
            //containment: '#wpwrap',
            start: function(e, ui) {
                $('textarea.cuvita_tinymce').each(function(i,el) {
                    var id = $(el).attr('id');
                    tinyMCE.execCommand('mceRemoveEditor', false, id);
                    //tinyMCE.execCommand('mceRemoveControl', false, id);
                });
    
                $('#home_other_wrap .form-sortables.form-sortables-inner .collapse-form-top').each(function(index) {
                    var content = $(this).next();
                    if ($(this).hasClass('active')) {
                        $(this).removeClass('active');
                        content.removeClass('active');
                        content.css({'max-height': '0'});
                    }
                });
            },
            update: function(e, ui) {
                renameOptionOtherSubSection(0, $(ui.item), 'cuvita_other', otherInnerOptions);
            },
            stop: function(e,ui) {
                $('textarea.cuvita_tinymce').each(function(i,el) {
                    var id = $(el).attr('id');
                    tinyMCE.execCommand('mceAddEditor', false, id);
                    //tinyMCE.execCommand('mceAddControl', false, id);
                });
            },
        });
    }


    /**
     * option_names
     */
    var educationOptions = [
        'hide_onsite',
        'title',
        'school',
        'city',
        'current',
        'startdate',
        'enddate',
        'description',
    ];
    var workOptions = [
        'hide_onsite',
        'title',
        'employer',
        'employer_link',
        'city',
        'current',
        'startdate',
        'enddate',
        'description',
    ];
    var otherOtherOptions = [
        'id',
        'hide_onsite',
        'title',
    ];
    var otherInnerOptions = [
        'hide_onsite',
        'number_of_columns',
        'title1',
        'description1',
        'title2',
        'description2',
        'title3',
        'description3',
    ];

    var sectionOrderOptions = [
        'section_id',
        'title',
        'other',
    ];

    /**
     * Adding new
     */
    $('#cv-form-add-education').on('click', function() {
        renameOption(1,'#home_education_wrap .collapse-form', 'cuvita_education', educationOptions);
        $('#home_education_wrap').prepend(`
        <div class="collapse-form collapse-form-outer">
            <div class="collapse-form-top collapse-form-top-outer">
                <div class="collapse-form-title-action">
                    <button type="button" class="collapse-form-action">
                        <span class="toggle-indicator"></span>
                    </button>
                </div>
                <div class="collapse-form-title">
                    <h3>
                        <span class="in-collapse-form-title">Title</span>
                        <span class="in-collapse-form-hidden"></span>
                    </h3>
                </div>
            </div>
            <div class="collapse-form-inside">
                <p class="flex-end">
                    <input type="checkbox" id="cuvita_education[0][hide_onsite]" name="cuvita_education[0][hide_onsite]" value="1" class="cv-form-hide-onsite cuvita_education[hide_onsite]">
                    <label for="cuvita_education[0][hide_onsite]" class="label_cuvita_education[hide_onsite]">Hide on site.</label>
                </p>
                <p>
                    <label for="cuvita_education[0][title]" class="label_cuvita_education[title]">Title:</label><br>
                    <input type="text" id="cuvita_education[0][title]" name="cuvita_education[0][title]" value="" placeholder="Title" class="widefat collapse-form-inside-title cuvita_education[title]">
                </p>
                <p>
                    <label for="cuvita_education[0][school]" class="label_cuvita_education[school]">School:</label><br>
                    <input type="text" id="cuvita_education[0][school]" name="cuvita_education[0][school]" value="" placeholder="School" class="widefat cuvita_education[school]">
                </p>
                <p>
                    <label for="cuvita_education[0][city]" class="label_cuvita_education[city]">City:</label><br>
                    <input type="text" id="cuvita_education[0][city]" name="cuvita_education[0][city]" value="" placeholder="City" class="widefat cuvita_education[city]">
                </p>
                <p>
                    <input type="checkbox" id="cuvita_education[0][current]" name="cuvita_education[0][current]" value="1" class="cv-form-currentStudy cuvita_education[current]">
                    <label for="cuvita_education[0][current]" class="label_cuvita_education[current]">I'm currently studying here.</label>
                </p>
                <p>
                    <div class="flex-container">
                        <p>
                            <label for="cuvita_education[0][startdate]" class="label_cuvita_education[startdate]">Startdate:</label><br>
                            <input type="date" id="cuvita_education[0][startdate]" name="cuvita_education[0][startdate]" value="" class="cuvita_education[startdate]">
                        </p>
                        <p>
                            <label for="cuvita_education[0][enddate]" class="label_cuvita_education[enddate]">Enddate:</label><br>
                            <input type="date" id="cuvita_education[0][enddate]" name="cuvita_education[0][enddate]" value="" class="cv-form-enddate cuvita_education[enddate]">
                            <span class="cv-form-enddate-now nondisplay">Now</span>
                        </p>
                    </div>
                </p>
                <p>
                    <label for="cuvita_education[0][description]" class="label_cuvita_education[description]">Description:</label><br>
                    <textarea id="cuvita_education[0][description]" name="cuvita_education[0][description]" cols="50" rows="10" class="widefat cuvita_education[description]"></textarea>
                </p>
                <p>
                    <button type="button" class="button-link button-link-delete cv-form-delete">Delete</button>
                </p>
            </div>
        </div>
        `);
    });

    $('#cv-form-add-work').on('click', function() {
        renameOption(1,'#home_work_wrap .collapse-form', 'cuvita_work', workOptions);
        $('#home_work_wrap').prepend(`
        <div class="collapse-form collapse-form-outer">
            <div class="collapse-form-top collapse-form-top-outer">
                <div class="collapse-form-title-action">
                    <button type="button" class="collapse-form-action">
                        <span class="toggle-indicator"></span>
                    </button>
                </div>
                <div class="collapse-form-title">
                    <h3>
                        <span class="in-collapse-form-title">Title</span><span class="in-collapse-form-employer"></span>
                        <span class="in-collapse-form-hidden"></span>
                    </h3>
                </div>
            </div>
            <div class="collapse-form-inside">
                <p class="flex-end">
                    <input type="checkbox" id="cuvita_work[0][hide_onsite]" name="cuvita_work[0][hide_onsite]" value="1" class="cv-form-hide-onsite cuvita_work[hide_onsite]">
                    <label for="cuvita_work[0][hide_onsite]" class="label_cuvita_work[hide_onsite]">Hide on site.</label>
                </p>
                <p>
                    <label for="cuvita_work[0][title]" class="label_cuvita_work[title]">Job Title:</label><br>
                    <input type="text" id="cuvita_work[0][title]" name="cuvita_work[0][title]" value="" placeholder="Title" class="widefat collapse-form-inside-title cuvita_work[title]">
                </p>
                <p>
                    <label for="cuvita_work[0][employer]" class="label_cuvita_work[employer]">Employer:</label><br>
                    <input type="text" id="cuvita_work[0][employer]" name="cuvita_work[0][employer]" value="" placeholder="Employer" class="widefat cuvita_work[employer]">
                </p>
                <p>
                    <label for="cuvita_work[0][employer_link]" class="label_cuvita_work[employer_link]">Employer:</label><br>
                    <input type="url" id="cuvita_work[0][employer_link]" name="cuvita_work[0][employer_link]" value="" placeholder="Link to Website" class="widefat cuvita_work[employer_link]">
                </p>
                <p>
                    <label for="cuvita_work[0][city]" class="label_cuvita_work[city]">City:</label><br>
                    <input type="text" id="cuvita_work[0][city]" name="cuvita_work[0][city]" value="" placeholder="City" class="widefat cuvita_work[city]">
                </p>
                <p>
                    <input type="checkbox" id="cuvita_work[0][current]" name="cuvita_work[0][current]" value="1"  class="cv-form-currentWork cuvita_work[current]">
                    <label for="cuvita_work[0][current]" class="label_cuvita_work[current]">I'm currently working here.</label>
                </p>
                <p>
                    <div class="flex-container">
                        <p>
                            <label for="cuvita_work[0][startdate]" class="label_cuvita_work[startdate]">Startdate:</label><br>
                            <input type="date" id="cuvita_work[0][startdate]" name="cuvita_work[0][startdate]" value="" class="cuvita_work[startdate]">
                        </p>
                        <p>
                            <label for="cuvita_work[0][enddate]" class="label_cuvita_work[enddate]">Enddate:</label><br>
                            <input type="date" id="cuvita_work[0][enddate]" name="cuvita_work[0][enddate]" value="" class="cv-form-enddate cuvita_work[enddate]">
                            <span class="cv-form-enddate-now nondisplay">Now</span>
                        </p>
                    </div>
                </p>
                <p>
                    <label for="cuvita_work[0][description]" class="label_cuvita_work[description]">Description:</label><br>
                    <textarea id="cuvita_work[0][description]" name="cuvita_work[0][description]" cols="50" rows="10" class="widefat cuvita_work[description]"></textarea>
                </p>
                <p>
                    <button type="button" class="button-link button-link-delete cv-form-delete">Delete</button>
                </p>
            </div>
        </div>
        `);
    });

    $('#cv-form-add-section').on('click', function() {
        maxID++;
        $('textarea.cuvita_tinymce').each(function(i,el) {
            var id = $(el).attr('id');
            tinyMCE.execCommand('mceRemoveEditor', false, id);
            //tinyMCE.execCommand('mceRemoveControl', false, id);
        });
        renameOptionOtherSection(1,'#home_other_wrap .collapse-form.collapse-form-outer', 'cuvita_other', otherOtherOptions, '.form-holder-wrap.form-holder-wrap-inner .collapse-form.collapse-form-inner', otherInnerOptions);
        $('#home_other_wrap').prepend(`
        <div class="collapse-form collapse-form-outer">
            <div class="collapse-form-top collapse-form-top-outer">
                <div class="collapse-form-title-action">
                    <button type="button" class="collapse-form-action">
                        <span class="toggle-indicator"></span>
                    </button>
                </div>
                <div class="collapse-form-title">
                    <h3 class="">
                        <input type="hidden" id="cuvita_other[0][id]" name="cuvita_other[0][id]" value="${maxID}" class="cuvita_other[id]">
                        <span class="in-collapse-form-title">Title</span>
                        <span class="in-collapse-form-hidden"></span>
                    </h3>
                </div>
            </div>
            <div class="collapse-form-inside">
                <p class="flex-end">
                    <input type="checkbox" id="cuvita_other[0][hide_onsite]" name="cuvita_other[0][hide_onsite]" value="1" class="cv-form-hide-onsite cuvita_other[hide_onsite]">
                    <label for="cuvita_other[0][hide_onsite]" class="label_cuvita_other[hide_onsite]">Hide on site.</label>
                </p>
                <p>
                    <label for="cuvita_other[0][title]" class="label_cuvita_other[title]">Section Title:</label><br>
                    <input type="text" id="cuvita_other[0][title]" name="cuvita_other[0][title]" value="" placeholder="Title" class="widefat collapse-form-inside-title cuvita_other[title]">
                </p>
                <div>
                    <p><button type="button" class="button cv-form-add-undersection">Add New Subsection</button></p>
                </div>
                <div class="form-holder-wrap form-holder-wrap-inner">
                    <div class="form-sortables form-sortables-inner">
                    </div>
                </div>
                <p>
                    <button type="button" class="button-link button-link-delete cv-form-delete">Delete Section</button>
                </p>
            </div>
        </div>
        `);
        $('textarea.cuvita_tinymce').each(function(i,el) {
                
            var id = $(el).attr('id');
            tinyMCE.execCommand('mceAddEditor', false, id);
            //tinyMCE.execCommand('mceRemoveControl', false, id);
        });
        innerSortable();
    });

    $('#home_other_wrap').on('click', '.cv-form-add-undersection', function() {
        $('textarea.cuvita_tinymce').each(function(i,el) {
            var id = $(el).attr('id');
            tinyMCE.execCommand('mceRemoveEditor', false, id);
            //tinyMCE.execCommand('mceRemoveControl', false, id);
        });
        renameOptionOtherSubSection(1, $(this), 'cuvita_other', otherInnerOptions);
        var sectionidstring = $(this).closest('.collapse-form-inside').find('.cuvita_other\\[title\\]').first().attr('id');
        var sectionindex = sectionidstring.slice(sectionidstring.search('\\[')+1,sectionidstring.search('\\]'));
        $(this).closest('.collapse-form-inside').find('.form-sortables.form-sortables-inner').first().prepend(`
        <div class="collapse-form collapse-form-inner">
            <div class="collapse-form-top collapse-form-top-inner">
                <div class="collapse-form-title-action">
                    <button type="button" class="collapse-form-action">
                        <span class="toggle-indicator"></span>
                    </button>
                </div>
                <div class="collapse-form-title">
                    <h3 class="">
                        <span>Subsection: </span>
                        <span class="in-collapse-form-title">Title</span>
                        <span class="in-collapse-form-hidden"></span>
                    </h3>
                </div>
            </div>
            <div class="collapse-form-inside">
                <p class="flex-end">
                    <input type="checkbox" id="cuvita_other[${sectionindex}][under_sections][0][hide_onsite]" name="cuvita_other[${sectionindex}][under_sections][0][hide_onsite]" value="1" class="cv-form-hide-onsite cuvita_other[under_sections][hide_onsite]">
                    <label for="cuvita_other[${sectionindex}][under_sections][0][hide_onsite]" class="label_cuvita_other[under_sections][hide_onsite]">Hide on site.</label>
                </p>
                <p>
                    <label>
                        <input type="radio" name="cuvita_other[${sectionindex}][under_sections][0][number_of_columns]" value="1" checked class="cuvita_other[under_sections][number_of_columns]">
                        1 Column Layout
                    </label>
                    <br>
                    <label>
                        <input type="radio" name="cuvita_other[${sectionindex}][under_sections][0][number_of_columns]"  value="2"  class="cuvita_other[under_sections][number_of_columns]">
                        2 Column Layout
                    </label>
                    <br>
                    <label>
                        <input type="radio" name="cuvita_other[${sectionindex}][under_sections][0][number_of_columns]"  value="3" class="cuvita_other[under_sections][number_of_columns]">
                        3 Column Layout
                    </label>
                </p>
                <div class="column_1">
                    <p>
                        <label for="cuvita_other[${sectionindex}][under_sections][0][title1]" class="label_cuvita_other[under_sections][title1]">Subsection Title:</label><br>
                        <input type="text" id="cuvita_other[${sectionindex}][under_sections][0][title1]" name="cuvita_other[${sectionindex}][under_sections][0][title1]" value="" placeholder="Title" class="widefat collapse-form-inside-title cuvita_other[under_sections][title1]">
                    </p>
                    <p>
                        <label for="cuvita_other-${sectionindex}-under_sections-0-description1" class="label_cuvita_other[under_sections][description1]">Description:</label><br>
                    </p>
                    <textarea class="cuvita_other[under_sections][description1] cuvita_tinymce wp-editor-area" rows="10" autocomplete="off" cols="40" name="cuvita_other[${sectionindex}][under_sections][0][description1]" id="cuvita_other-${sectionindex}-under_sections-0-description1"></textarea>
                </div>
                <div class="column_2 hidden">
                    <p>
                        <label for="cuvita_other[${sectionindex}][under_sections][0][title2]" class="label_cuvita_other[under_sections][title2]">Subsection Title:</label><br>
                        <input type="text" id="cuvita_other[${sectionindex}][under_sections][0][title2]" name="cuvita_other[${sectionindex}][under_sections][0][title2]" value="" placeholder="Title" class="widefat cuvita_other[under_sections][title2]">
                    </p>
                    <p>
                        <label for="cuvita_other-${sectionindex}-under_sections-0-description2" class="label_cuvita_other[under_sections][description2]">Description:</label><br>
                    </p>
                    <textarea class="cuvita_other[under_sections][description2] cuvita_tinymce wp-editor-area" rows="10" autocomplete="off" cols="40" name="cuvita_other[${sectionindex}][under_sections][0][description2]" id="cuvita_other-${sectionindex}-under_sections-0-description2"></textarea>
                </div>
                <div class="column_3 hidden">
                    <p>
                        <label for="cuvita_other[${sectionindex}][under_sections][0][title3]" class="label_cuvita_other[under_sections][title3]">Subsection Title:</label><br>
                        <input type="text" id="cuvita_other[${sectionindex}][under_sections][0][title3]" name="cuvita_other[${sectionindex}][under_sections][0][title3]" value="" placeholder="Title" class="widefat cuvita_other[under_sections][title3]">
                    </p>
                    <p>
                        <label for="cuvita_other-${sectionindex}-under_sections-0-description3" class="label_cuvita_other[under_sections][description3]">Description:</label><br>
                    </p>
                    <textarea class="cuvita_other[under_sections][description3] cuvita_tinymce wp-editor-area" rows="10" autocomplete="off" cols="40" name="cuvita_other[${sectionindex}][under_sections][0][description3]" id="cuvita_other-${sectionindex}-under_sections-0-description3"></textarea>
                </div>
                <p>
                    <button type="button" class="button-link button-link-delete cv-form-delete-inner">Delete Subsection</button>
                </p>
            </div>
        </div>
        `);
        wp.editor.initialize(
            'cuvita_other-'+sectionindex+'-under_sections-0-description1',
            { 
                tinymce: { 
                    wpautop: true, 
                    plugins: 'charmap colorpicker compat3x directionality fullscreen hr image lists media paste tabfocus textcolor wordpress wpautoresize wpdialogs wpeditimage wpemoji wpgallery wplink wptextpattern wpview', 
                    toolbar1: 'formatselect bold italic | bullist numlist | blockquote | alignleft aligncenter alignright | link unlink | wp_more | spellchecker' 
                }, 
                quicktags: false 
            }
        );
        wp.editor.initialize(
            'cuvita_other-'+sectionindex+'-under_sections-0-description2',
            { 
                tinymce: { 
                    wpautop: true, 
                    plugins: 'charmap colorpicker compat3x directionality fullscreen hr image lists media paste tabfocus textcolor wordpress wpautoresize wpdialogs wpeditimage wpemoji wpgallery wplink wptextpattern wpview', 
                    toolbar1: 'formatselect bold italic | bullist numlist | blockquote | alignleft aligncenter alignright | link unlink | wp_more | spellchecker' 
                }, 
                quicktags: false 
            }
        );
        wp.editor.initialize(
            'cuvita_other-'+sectionindex+'-under_sections-0-description3',
            { 
                tinymce: { 
                    wpautop: true, 
                    plugins: 'charmap colorpicker compat3x directionality fullscreen hr image lists media paste tabfocus textcolor wordpress wpautoresize wpdialogs wpeditimage wpemoji wpgallery wplink wptextpattern wpview', 
                    toolbar1: 'formatselect bold italic | bullist numlist | blockquote | alignleft aligncenter alignright | link unlink | wp_more | spellchecker' 
                }, 
                quicktags: false 
            }
        );
        $('textarea.cuvita_tinymce').each(function(i,el) {
                
            var id = $(el).attr('id');
            tinyMCE.execCommand('mceAddEditor', false, id);
            //tinyMCE.execCommand('mceRemoveControl', false, id);
        });
        var outerContent = $(this).closest('.collapse-form.collapse-form-outer').find('.collapse-form-top.collapse-form-top-outer').first().next();
        outerContent.css({'max-height': (outerContent.prop('scrollHeight')+45) + "px"});
    });


    /**
     * Renaming
     */
    function renameOption($indexIncr, $basewrapper, $optionbase, $options) {
        $($basewrapper).each(function(index) {
            var newIndex = index+$indexIncr;
            $options.forEach(element => {
                var inputs = $(this).find('.'+$optionbase+'\\['+element+'\\]');
                var inputsLabel = $(this).find('.label_'+$optionbase+'\\['+element+'\\]');

                inputs.attr('name', $optionbase+'['+newIndex+']['+element+']');
                inputs.attr('id', $optionbase+'['+newIndex+']['+element+']');

                inputsLabel.attr('for', $optionbase+'['+newIndex+']['+element+']');
            });
        });
    }

    function renameOptionSectionOrder($indexIncr, $basewrapper, $optionbase, $options) {
        $($basewrapper).each(function(index) {
            var newIndex = index+$indexIncr;
            $options.forEach(element => {
                var inputs = $(this).find('.'+$optionbase+'\\['+element+'\\]');
                inputs.attr('name', $optionbase+'['+newIndex+']['+element+']');
                inputs.attr('id', $optionbase+'['+newIndex+']['+element+']');
            });
        });
    }
    
    function renameOptionOtherSection($indexIncr, $basewrapper, $optionbase, $outeroptions, $innerBasewrapper, $inneroptions) {
        $($basewrapper).each(function(i, value) {
            var $this = $(value);
            var $outerindex = i;
            var newIndex = $outerindex+$indexIncr;
            $outeroptions.forEach(element => {
                var inputs = $this.find('.'+$optionbase+'\\['+element+'\\]');
                var inputsLabel = $this.find('.label_'+$optionbase+'\\['+element+'\\]');

                inputs.attr('name', $optionbase+'['+newIndex+']['+element+']');
                inputs.attr('id', $optionbase+'['+newIndex+']['+element+']');

                inputsLabel.attr('for', $optionbase+'['+newIndex+']['+element+']');
            });

            $this.find($innerBasewrapper).each(function(y, innervalue) {
                $inneroptions.forEach(element => {
                    var inputs = $(innervalue).find('.'+$optionbase+'\\[under_sections\\]\\['+element+'\\]');
                    var inputsLabel = $(innervalue).find('.label_'+$optionbase+'\\[under_sections\\]\\['+element+'\\]');

                    if(element == 'description1' || element == 'description2' || element == 'description3') {
                        inputs.attr('name', $optionbase+'['+newIndex+'][under_sections]['+y+']['+element+']');
                        inputs.attr('id', $optionbase+'-'+newIndex+'-under_sections-'+y+'-'+element);

                        inputsLabel.attr('for', $optionbase+'-'+newIndex+'-under_sections-'+y+'-'+element);
                    } else {
                        inputs.attr('name', $optionbase+'['+newIndex+'][under_sections]['+y+']['+element+']');
                        inputs.attr('id', $optionbase+'['+newIndex+'][under_sections]['+y+']['+element+']');

                        inputsLabel.attr('for', $optionbase+'['+newIndex+'][under_sections]['+y+']['+element+']');
                    }
                });
            });

        });
    }

    function renameOptionOtherSubSection($indexIncr, $insideObject, $optionbase, $options) {
        var $basewrapper = $insideObject.closest('.collapse-form.collapse-form-outer').find('.collapse-form.collapse-form-inner');
        $($basewrapper).each(function(index) {
            var id = $(this).find('.cuvita_other\\[under_sections\\]\\[title1\\]').attr('id');
            var sectionIndex = id.slice(id.search('\\[')+1,id.search('\\]'));
            var newIndex = index+$indexIncr;
            $options.forEach(element => {
                var inputs = $(this).find('.'+$optionbase+'\\[under_sections\\]\\['+element+'\\]');
                var inputsLabel = $(this).find('.label_'+$optionbase+'\\[under_sections\\]\\['+element+'\\]');

                if(element == 'description1' || element == 'description2' || element == 'description3') {
                    inputs.attr('name', $optionbase+'['+sectionIndex+'][under_sections]['+newIndex+']['+element+']');
                    inputs.attr('id', $optionbase+'-'+sectionIndex+'-under_sections-'+newIndex+'-'+element);

                    inputsLabel.attr('for', $optionbase+'-'+sectionIndex+'-under_sections-'+newIndex+'-'+element);
                } else {
                    inputs.attr('name', $optionbase+'['+sectionIndex+'][under_sections]['+newIndex+']['+element+']');
                    inputs.attr('id', $optionbase+'['+sectionIndex+'][under_sections]['+newIndex+']['+element+']');

                    inputsLabel.attr('for', $optionbase+'['+sectionIndex+'][under_sections]['+newIndex+']['+element+']');
                }
            });
        });
    }

    /**
     * Other
     */
    function setCollapsHeightFromInner($object) {
        content = $object.closest('.collapse-form').find('.collapse-form-top.collapse-form-top-inner').first().next();
        outerContent = $object.closest('.collapse-form.collapse-form-outer').find('.collapse-form-top.collapse-form-top-outer').first().next();
        content.css({'max-height': content.prop('scrollHeight') + "px"});
        outerContent.css({'max-height': (outerContent.prop('scrollHeight')+content.prop('scrollHeight')) + "px"});
    }

    function getTinyMceStyling() {
        $('<link/>', {
            rel: 'stylesheet',
            type: 'text/css',
            href: 'http://localhost/cuvita/wp-includes/css/editor.min.css?ver=5.4.2'
         }).appendTo('head');
    }
   
});

