$( function() {
    $('#datepicker').datetimepicker({
                     timepicker:false,
                    format:'Y-m-d',
                     maxDate:'0'//tomorrow is maximum date calendar
    });

    $('#type_machine').on('change',function(e){
        e.preventDefault();
        var type_id = $(this).val();
        var type_mentenance = $('#type_mentenance').val();
    
        $.ajax({
        url:'/devices_list_by_type',
        type:'POST',
        data:{
            id:type_id
        },
            dataType:'json',
            success: function(data){
                console.log(data);
                $('#devices').empty();
                $('#devices').removeAttr('disabled');
                var i = 0;
                while(i < data.length){
                        $('#devices').append("<option selected='selected' value="+data[i].id+">"+ data[i].inventory_number+"</option>");
                        i++;
                    
                }
                   
            }
        })
    });
    $('#type_mentenance').on('change', function(e){
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
                    var i = 0;
                    while(i < data.length){
                            $('#intervention').append("<option selected='selected' value="+data[i].id+">"+ data[i].name+"</option>");
                            i++;
                        
                    }
                }
                    
            });
        }

       
        

    });

});  

