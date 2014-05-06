<?php
	include 'connect.php';
	include 'portable-utf8.php';
	include 'keyboard.php';
?>

<!--<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<script type="text/javascript">
  google.load("elements", "1", {
  packages: "transliterate"
  });
  var control;
  function roman2gur() {
  var options = {
      sourceLanguage: google.elements.transliteration.LanguageCode.ENGLISH,         
      destinationLanguage: [google.elements.transliteration.LanguageCode.PUNJABI],
      shortcutKey: 'ctrl+g',
      transliterationEnabled: true
  };

</script>-->



  <link rel=stylesheet href=css/form.css type=text/css>

  <div class = "form search-form">
        <form action="" name="searchForm" method="get">
            <input name="searchQuery" id="inputbox" type="text" class="search-textbox" placeholder="Type to search" required>
		<div class="circle">
            <input type="submit" name="submit" value="" class="search-btn">
		</div>
        </form>
  </div>
  <div id="dialog" title="Keyboard">
	<div class="keyboard">
	<?php
	    keyboard();
	?>
	</div>
  </div>
 
  <button id="opener">Open Dialog</button>
  <script>
 inputBox = $('.search-textbox');


 $('.keyboard-button').click(function(){
   var inputString = inputBox.val();
   var buttonPressed = $(this).html();
   inputString += buttonPressed;
   inputBox.val(inputString);
});
  </script>
<?php
	
	    function meaningSearch($queryString, $connect)
	    {
        	 $searchQuery = "SELECT * FROM translation WHERE text LIKE  '%$queryString%' AND language_id=13";
		
         	  if ($search = mysqli_query($connect, $searchQuery)) {
        	    while ($english = $search->fetch_assoc()) {	    
		        $scripture_id = $english["scripture_id"];
		        $scriptureQuery = "select * FROM scripture WHERE id = $scripture_id";		    
		        $scriptureResult = mysqli_query($connect, $scriptureQuery);
		        $punjabi = $scriptureResult->fetch_array(MYSQLI_BOTH);
		        
		        echo "<div class=hymn>";
		        
		        echo "<div class=punjabi>";	
		        echo $punjabi["scripture"]; 
               		echo "</div>";
                
	                echo "<div class=english>";
        	        echo $english["text"];
                	echo "</div>";
                
	                echo "</div>";
                     }
      		   }
	      }

	      function scriptureSearch($queryString, $connect){
	   	 $queryArray = utf8_split($queryString);
		 
		 $totalAlphabets = count($queryArray);
		 $counter = 0;

		 $searchQuery = "SELECT * FROM `scripture`  WHERE CONCAT(' ', REPLACE(`Scripture`, ',', ' ')) RLIKE '";
		
		 while($counter < ($totalAlphabets-1)){
			$searchQuery = $searchQuery.$queryArray[$counter]."[[:alpha:]]* +";
			$counter = $counter + 1;
		}
		$searchQuery = $searchQuery.$queryArray[$totalAlphabets-1]."'";

         	if ($search = mysqli_query($connect, $searchQuery)) {
        	    while ($punjabi = $search->fetch_assoc()) {	    
		        $scripture_id = $punjabi["id"];
		        $englishQuery = "select * FROM translation WHERE scripture_id = $scripture_id AND language_id = 13";
		        $englishResult = mysqli_query($connect, $englishQuery);
		        $english = $englishResult->fetch_array(MYSQLI_BOTH);
		        
		        echo "<div class=hymn>";
		        
		        echo "<div class=punjabi>";	
		        echo $punjabi["scripture"]; 
               		echo "</div>";
                
	                echo "<div class=english>";
        	        echo $english["text"];
                	echo "</div>";
                
	                echo "</div>";
                     }
      		   }
	  }
         if(isset($_GET['submit'])){
	   $queryString = $_GET['searchQuery'];
	   scriptureSearch($queryString, $connect);
	  // meaningSearch($queryString, $connect);
		   
        }
?>
