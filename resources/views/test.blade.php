<form action="testpost" method="post">
    <!--input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"-->
    <input type="hidden" name="token1" value="<?php echo csrf_token(); ?>">
    <button type="submit">POST</button>
</form>