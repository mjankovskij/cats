<?php
echo "Total visitors <b>$data</b>.</p>


<form method='get'>
<label for='pn'>Enter the page number:</label><br>
<input type='text' id='pn'><br>
<button type='submit' id='button'>Go</button><br>

</form> ";

?>

<script>

document.getElementById("button").addEventListener("click", function(e){
  e.preventDefault();
        window.location.replace(`./${document.querySelector('#pn').value}`);
});
</script>