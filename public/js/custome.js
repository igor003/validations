
   



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
                    maxDate:'0'//tomorrow is maximum date calendar
    });

    $('#timepicker').datetimepicker({
        datepicker:false,
        format:'H:i',
        step:1,
        defaultTime:'00:00'
    });

    $('#type_machine,#type_mentenance').on('change',function(e){    
        e.preventDefault();
        var type_id = $('#type_machine').val();
        var type_mentenance = $('#type_mentenance').val();
        
        if(type_id == '' && type_mentenance == ''){
            $("intervention").attr('disabled','disabled');
            $("devices").attr('disabled','disabled');
        }
    
        $.ajax({
        url:'/devices_list_by_type',
        type:'POST',
        data:{
            id:type_id
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
    $('#type_mentenance, #type_machine').on('change', function(e){
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
                    var i = 0;
                    while(i < data.length){
                        $('#intervention').append("<option selected='selected' value="+data[i].id+">"+ data[i].name+"</option>");
                        i++;
                    }
                }   
            });
        }

    });

   if($('#card:visible')){
        $('#card').delay(1800).slideUp();
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
        '<td class="text-center">'+data.date+'</td>'+
        '<td class="text-center">'+data.type_mentenance.name+'</td>'+
        '<td class="text-center">'+data.device.inventory_number+'</td>'+
        '<td class="text-center">'+data.intervention.name+'</td>'+
        '<td class="text-center">'+data.duration+'</td>'+
        '<td class="text-center">'+data.note+'</td>'+
        '<td class="text-center">'+data.user.name+'</td>';
             if(data.report_path != null){
                result +='<td class="text-center">' +
                '<form method="POST" action="/download_interv_report">'+
                ' <input type="hidden" name="report_path" value="'+data.report_path+'">'+
                '<button type="submit"><img height="40px" width = "40px" src="/img/download.png" alt=""></button>'+
                '</form>' +
                '</td>'
             }else{
                result += '<td class="text-center"><img height="40px" width = "40px" src="/img/error.jpg" alt=""></td>';
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
            console.log(data);
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
