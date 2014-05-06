  <link rel="stylesheet" href="css/jquery-ui.css">
   <link rel="stylesheet" href="/resources/demos/style.css">
   
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  
  <script>
  var isOpen = false;
  $(function() {
    $( "#dialog" ).dialog({
      autoOpen: false,
      resizable: false,
      position: { my: "top top", at: "center center" },
      show: {
        effect: "blind",
        duration: 500
      },
      hide: {
        effect: "fadeOut",
        duration: 500
      }
    });
 
    $( "#opener" ).click(function() {
    if(isOpen){
	$("#dialog").dialog("close");
	isOpen = false;
    }
    else{
      var width = window.innerWidth;
      if(width > 400){ width = 400; }
      $("#dialog").dialog({width: width});
      $( "#dialog" ).dialog( "open" );
    isOpen = true;
    }
    });
  });

</script>
<?php

function keyboard(){

	$punjabiAlphabets = array (
		"ੳ", "ਅ", "ੲ", "ਸ", "ਹ", 
		"ਕ", "ਖ", "ਗ", "ਘ", "ਙ", 
		"ਚ", "ਛ", "ਜ", "ਝ", "ਞ", 
		"ਟ", "ਠ", "ਡ", "ਢ", "ਣ", 
		"ਤ", "ਥ", "ਦ", "ਧ", "ਨ", 
		"ਪ", "ਫ", "ਬ", "ਭ", "ਮ", 
		"ਯ", "ਰ", "ਲ", "ਵ", "ੜ"
	);
	$i = 0;
	while($i < 28){
		echo "<button class=keyboard-button>".$punjabiAlphabets[$i]."</button>";
		$i++;
	}
}

?>
