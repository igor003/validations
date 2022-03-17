

$( function() {
    var input = $('.inputfile' );

    var label    = input.next();
    var labelVal = label.html();

    input.on( 'change', function( e ){
    
       
        // var pdffile_url=URL.createObjectURL(this.files[0]);
  
        // $('.ifrmae_Viewer').append('<iframe id="viewer" frameborder="0" scrolling="no" width="50%" height="250"></iframe>');
        //   $('#viewer').attr('src',pdffile_url);
      fileName = e.target.value.split( '\\' ).pop();
        if( fileName )
            label.html(fileName); 
        else
            label.innerHTML = labelVal;
        $(this).css(' background-color','green')
    });


    document.body.style.zoom = "80%";
    $('#card2').hide();
    $("#flexCheckDefault").on('click',function(){
        if($(this).val() == '0'){
            $(this).val(1);
        }else{
             $(this).val(0);
        }
        
    });
    
  

    $('#datepicker').datetimepicker({
                    format:'Y-m-d H:i:s',
                    timepicker:false,
                    validateOnBlur:true,
                    lang:'ru',
                    maxDate:'0'    //tomorrow is maximum date calendar

    });

    $('#timepicker').datetimepicker({
        datepicker:false,
        format:'H:i',
        step:1,
        defaultTime:'00:00'
    });

    $('#type_machine').on('change',function(e){    
        e.preventDefault();
        var type_id = $('#type_machine').val();

        var type_mentenance = $('#type_mentenance').val();
        var all_mini = $('#show_all').val();
        console.log( type_id);
        if(type_id == ''){
            $('#devices').attr('disabled','disabled');
        }else{
            $('#devices').removeAttr('disabled');
        }
        // if(type_id == '' && type_mentenance == ''){
        //     $("intervention").attr('disabled','disabled');
        //     $("devices").attr('disabled','disabled');
        // }
        
        if(type_id == 9){
            $('.temperature').empty();
            $('.temperature').append('<label for="temper">Temperature °C</label><input value="" name="temper" id="temperature" type="text" class="form-control ">')
            $('.temperature').show();
        }else{
            $('.temperature').hide();
           
        }
        if(type_id == 3){
            $('.shuts').empty();
            $('.shuts').append('<label for="temper">Nmb of shuts</label><input value="" name="nmb_of_shuts" id="shuts" type="text" class="form-control ">')
            $('.shuts').show();
            if($('#cycle').is(':checked')){
              $( "body" ).off( "change", "#shuts", get_shuts_on_input );
            }else{
                 get_shuts_on_input();
            }
           
                
        }else{
            $('.shuts').hide();
           
        }
        $.ajax({
        url:'/devices_list_by_type',
        type:'POST',
        data:{
            id:type_id,
            all:all_mini
        },
        dataType:'json',
        success: function(data){
            $('#devices').empty();
            var i = 0;
            while(i < data.length){
                $('#devices').append("<option selected='selected' value="+data[i].id+">"+ data[i].inventory_number+"</option>");
                i++;
            }  
        }
        })
    });

    $('#date_timepicker_excell_start').datetimepicker({
        format:'Y-m-d',
        onShow:function( ct ){
            this.setOptions({
                maxDate:jQuery('#date_timepicker_excell_end').val()?jQuery('#date_timepicker_excell_end').val():false
            })
        },
        timepicker:false
    });
    $('#date_timepicker_excell_end').datetimepicker({
        format:'Y-m-d',
        onShow:function( ct ){
            this.setOptions({
                minDate:jQuery('#date_timepicker_excell_start').val()?jQuery('#date_timepicker_excell_start').val():false
            })
        },
        timepicker:false,
        maxDate:'0'//tomorrow is maximum date calendar
    });

    $('#date_timepicker_start').on('change',function(e){
        e.preventDefault();
        $('#date_timepicker_end').removeAttr('disabled');

    });
    $('#date_timepicker_end').on('change',function(e){
        e.preventDefault();
            get_interventions_list();
        $('#date_timepicker_start').on('change',function(e){
            e.preventDefault();
           get_interventions_list();

        })
    });


    $('#intervention, #type_machine').on('change',function(){
        var machine = $('#devices').val();
        var type_id = $('#type_machine').val();
        var interv = $('#intervention').val();
        if(interv === '155' && type_id === '4'){
            $.ajax({
                url:'/machine_count',
                type:'POST',
                dataType:'json',
                data:{
                    id_machine:machine,
                },
                   
                success: function(data){
                    $('.count_pce').empty();
                    $('.count_pce').show();
                    $('.count_pce').append('<label for="type_mcahine">Count of pices</label><input value="'+data+'" type="text" name="number_of_pices" class="form-control" id="nmb_of_pices">');
                  
                }   
                });
           }else{
                $('.count_pce').empty();
                $('.count_pce').hide();
           }
       

    });

    $('#type_mentenance_filter').on('change',function(e){
        e.preventDefault();
        
        var type_mentenance = $('#type_mentenance_filter').val();
        var type_machine = $('#id_type_machine').val();
        $.ajax({
            url: '/interventions_list',
            type: 'POST',
            dataType: 'json',
            data:{
                id_mentenance:type_mentenance,
                id_machine_type:type_machine
            },
            success: function(data){
                console.log(data);  
                $('#intervention_filter').empty();
                $('#intervention_filter').removeAttr('disabled');
                $('#intervention_filter').append("<option selected='selected' value=''></option>");
                var i = 0;
                while(i < data.length){
                    $('#intervention_filter').append("<option value="+data[i].id+">"+ data[i].name+"</option>");
                    i++;
                }
            }
        })
        .done(function() {
            console.log("success");
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
    });

    $('#user,#type_mentenance_filter,#devices_filter,#intervention_filter,#flexCheckDefault').on('change', function(e){
        e.preventDefault();
        get_interventions_list();
    });
    $('#type_mentenance, #type_machine,#devices').on('change', function(e){
        e.preventDefault();
        var type_mentenance = $('#type_mentenance').val();
        var type_machine = $('#type_machine').val();
        if(type_mentenance && type_machine){
            $.ajax({
                url:'/interventions_list',
                type:'POST',
                data:{
                    id_mentenance:type_mentenance,
                    id_machine_type:type_machine
                }, 
                dataType:'json',
                success: function(data){
                    $('#intervention').empty();
                    $('#intervention').removeAttr('disabled');
                    $('#devices').removeAttr('disabled');
                    $('#intervention').append("<option selected='selected' value=''></option>");
                    var i = 0;
                    while(i < data.length){
                        $('#intervention').append("<option value="+data[i].id+">"+ data[i].name+"</option>");
                        i++;
                    }
                }   
            });
        }

    });

    if($('#card:visible')){
        $('#card').delay(3800).slideUp();
    }

    $('#date_timepicker_start').datetimepicker({
        format:'Y-m-d',
        onShow:function( ct ){
            this.setOptions({
                maxDate:jQuery('#date_timepicker_end').val()?jQuery('#date_timepicker_end').val():false
            })
        },
        timepicker:false
    });
    $('#date_timepicker_end').datetimepicker({
        format:'Y-m-d',
        onShow:function( ct ){
            this.setOptions({
                minDate:jQuery('#date_timepicker_start').val()?jQuery('#date_timepicker_start').val():false
            })
        },
        timepicker:false
    });
    
});  

function generate_hnml_interventions(data){
    
    var result = '<tr>' +
        '<td class="text-center">'+data.date.substring(0, 10)+'</td>'+
        '<td class="text-center">'+data.device.number+'</td>'+
        '<td class="text-center">'+data.device.inventory_number+'</td>'+
        '<td class="text-center">'+data.type_mentenance.name+'</td>'+
        '<td class="text-center">'+data.intervention.name+'</td>'+
        '<td class="text-center">'+data.duration+'</td>';
        
       
        if(data['device_type']['id'] == 3){
            if(data.nmb_of_shuts != 0){
                result +='<td class="text-center">'+data.nmb_of_shuts+'</td>';
            }else{
                result +='<td class="text-center">---</td>';
            }
        }
        
       result+='<td class="text-center">'+data.user.name+'</td>';
             if(data.report_path != null){
                result +='<td class="text-center">' +
                '<form method="POST" action="/download_interv_report">'+
                ' <input type="hidden" name="report_path" value="'+data.report_path+'">'+
                '<button type="submit"><img height="60px" width = "50px" src="/img/skrepka.png" alt=""></button>'+
                '</form>' +
                '</td>'
             }else{
                result += '<td class="text-center">---</td>';
             }

        if(data['device_type']['id'] == 9){
            result +='<td class="text-center">'+data.temper+'</td>';
        }
        if(data.note != null){
            result +='<td class="text-center">'+data.note+'</td>';
        }else{
            result +='<td class="text-center">---</td>';
        }
        result +='</tr>';
    return result; 
}

function get_interventions_list(){
    var id =$('#id_type_machine').val();
    var user = $('#user').val();
    var type_mentenance = $('#type_mentenance_filter').val();
    var device = $('#devices_filter').val();
    var start_date = $('#date_timepicker_start').val();
    var end_date = $('#date_timepicker_end').val();
    var type_interv = $('#intervention_filter').val();
    var time = $("#flexCheckDefault").val();
    $.ajax({
        url: '/get_interventions',
        type: 'POST',
        dataType: 'json',
        data: {
            id: id,
            user:user,
            id_mentenance:type_mentenance,
            id_device:device,
            start_date:start_date,
            end_date:end_date,
            type_interv:type_interv,
            time:time
        },
        success: function(data){
           
            if(data['0'] != null){
                $('#card2').show();
                $('#sum_time').html("Sum of time: "+data['0']);
            }else{
                $('#sum_time').html("");
                 $('#card2').hide();
            }
            $('#interventions_table').empty();
            var i = 0;
            var time_intervention;
            while(i< data['1'].length){
                $('#interventions_table').append(generate_hnml_interventions(data['1'][i]));
                i++;
            }
        }
    })
    .done(function() {
        console.log("success");
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        console.log("complete");
    });
}

$( document ).ready(function() {
    get_interventions_list();


}); 


function get_shuts_on_input(){
    $('#shuts').on('change',function(){
        var cnt = parseInt($('#shuts').val());
        var machine = $('#devices').val();

        $.ajax({
            url: '/get_shuts',
            type: 'POST',
            dataType: 'json',
            data: {
                cnt:cnt,
                machine:machine,
            },
            success: function(data){

                if(cnt<data.nmb_of_shuts){
                    $('#shuts').css( "color", "red" );
                    $('#shuts').val('Enter the higher number');
                    
                }else{
                     $('#shuts').css( "color", "black" );
                }
               
            }
        })
        .done(function() {
            console.log("success");
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
    });
};