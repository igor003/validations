

$( function() {
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
});  


