function Timer() {
    
   axios.get('/commandeTimer')
   .then(function(response) {
        //   console.log(response.data);
            if(0!=response.data[0])
            {
              $('#notification').show();
                $('#notification').html( "<span class='badge alert'>"+response.data[0]+"</span>");
                var n= response.data[0];
               console.log(response.data[0]);
                var ligne="";
              for (var i = 0; i<n; i++) 
              {
                 ligne+= " <li class='li_li'><p class='li_a' >"+response.data[1][i]['name']+" "+response.data[1][i]['date_collecte']+"</p></li> ";
              }
              $('.dropdown').html(ligne);
            }
            else
            $('#notification').hide();
        });
   setTimeout("Timer()",5000);
   }
  Timer();


  // -------------
  $(function() {
  
    // Dropdown toggle
    $('.dropdown-toggle').click(function(){
      $(this).next('.dropdown').toggle();
    });
    
    $(document).click(function(e) {
      var target = e.target;
      if (!$(target).is('.dropdown-toggle') && !$(target).parents().is('.dropdown-toggle')) {
        $('.dropdown').hide();
      }
    });
  });
  // ------------
  $(document).ready(function(){
    var next = 1;
    var cliicked=0;
    var clmin=0;
    $(".add-more").click(function(e){
      if(cliicked<4 )
      {
        e.preventDefault();
        var addto = "#prixop" + next;
        var addRemove = "#field" + (next);
        next = next + 1
        var newIn = '<input class="input op_d" id="field' + next + '" name="option' + next + '" type="text"/>'+'<input class="input op_p" id="prixop' + next + '" name="prixop' + next + '" type="number" step="0.01" placeholder="0.0"/>';
        var newInput = $(newIn);
       // var removeBtn = '<button id="remove' + (next - 1) + '" class="btn btn-danger remove-me" >-</button></div><div id="field">';
        //var removeButton = $(removeBtn);
        $(addto).after(newInput);
        //$(addRemove).after(removeButton);
        $("#field" + next).attr('data-source',$(addto).attr('data-source'));
        $("#count").val(next); 
        cliicked+=1;
       console.log(cliicked);
      }else {}
    });
});
