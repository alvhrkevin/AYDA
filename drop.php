<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
Province :
<select id="billing_state">
  <option value="">- select -</option>
  <option value="1">Italy</option>
  <option value="2">France</option>
  <option value="3">Algeria</option>
  <option value="4">UK</option>
</select>
<br><br>
Country : 
<select id="billing_town">
</select>

state = {"1":["Rome","Milan","Parma"],"2":["Paris","Lile","Nice"],"3":["Algiers","Jijel","Bejaia"],"4":["London","Manchester"]}
<script>
$(document).ready(function(){
	//this if you want that changing province this alert country value
    $("#billing_state").on("change",function(e){
  	    
          $("#billing_town").children().remove();
          var city =state[$(this).val()];
          if(!city) return;
          $("#billing_town").append('<option value="">- Select -</option>')
          for(i=0; i< city.length;i++) {
            //console.log(city[i]);
            $("#billing_town").append('<option value="'+city[i]+'">'+city[i]+'</option>');
          }
          
    });
  
    // when changing country this alert country value itself
    $("#billing_town").on("change",function(e){
  	    alert($(this).val());
    });
});
</script>