<br>

<center>
<h6>Timer</h6>
<div id="response"></div>
</center>
<script type="text/javascript">
setInterval(function()  {
    var xmlhttp=new XMLHttpRequest();
      xmlhttp.open("GET","response.php",false);
      xmlhttp.send(null);
      document.getElementById("response").innerHTML=xmlhttp.responseText;
}, 1000);

</script>