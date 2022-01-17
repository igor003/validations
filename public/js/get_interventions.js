  $('#date_timepicker_end').on('change',function(e){
        e.preventDefault();
            get_interventions_list();
        $('#date_timepicker_start').on('change',function(e){
            e.preventDefault();
           get_interventions_list();

        })
    });
 $('#user,#type_mentenance_filter,#devices_filter,#intervention_filter,#flexCheckDefault').on('change', function(e){
        e.preventDefault();
        get_interventions_list();
    });