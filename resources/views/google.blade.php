<form action="/uploaded" method="POST" enctype="multipart/form-data">
  @csrf
  <input type="file" name="image" >
  <input type="submit" value="Upload">
</form>