<form action="" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    <input type="file" name="img">
    <input type="submit" value="提交" name="dosubmit">
</form>
