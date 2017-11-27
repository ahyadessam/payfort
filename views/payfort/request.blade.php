<html xmlns='http://www.w3.org/1999/xhtml'>
<head></head>
<body>

<form action="{{ $action }}" id="payfortRequest" method="post" name="payfortRequest">
  <?php
  foreach($parameters_array As $key=>$val){
    echo '<input type="hidden" name="'.$key.'" value="'.htmlentities($val).'" />';
  }
  ?>
</form>
<script type="text/javascript">
  document.payfortRequest.submit();
</script>

</body>
</html>
