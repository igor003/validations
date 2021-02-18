

$( function() {

    document.body.style.zoom = "80%";
  
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
        console.log(type_mentenance == '');
        console.log(type_id == '');
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

    
     $('#date_timepicker_start').on('change',function(e){
        e.preventDefault();
        $('#date_timepicker_end').removeAttr('disabled');

    })
    $('#date_timepicker_end').on('change',function(e){
        e.preventDefault();
            get_interventions_list();
        $('#date_timepicker_start').on('change',function(e){
            e.preventDefault();
           get_interventions_list();

        })
    })
    $('#type_mentenance_filter').on('change',function(e){
        e.preventDefault();
        $('#intervention_filter').removeAttr('disabled');
    });

    $('#user,#type_mentenance_filter,#devices_filter').on('change', function(e){
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
                    console.log(data);
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
                ' <input type="hidden" name="path" value="'+data.report_path+'">'+
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
            end_date:end_date
        },
        success: function(data){
        
            $('#interventions_table').empty();
            var i = 0;
            var time_intervention;
            while(i< data.length){
                $('#interventions_table').append(generate_hnml_interventions(data[i]));
                  console.log(new DateTime(data[i].duration));
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
