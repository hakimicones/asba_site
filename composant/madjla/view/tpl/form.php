<style type="text/css">
  
label {
    color: #000;
}

</style>

<div class="container">
<div class="cadre" id="madjla-content">

  
<form id="form-1" method="post" enctype="multipart/form-data">
 <div class="form-group">
  <label for="exampleFormControlInput1">{nomprenom}</label>
<input class="form-control" type="text" name="name" placeholder="{nomprenom}">
 </div>
  <div class="form-group">
  <label for="exampleFormControlInput1">{titre}</label>
<input class="form-control" type="text" name="titre" placeholder="{titre}">
 </div>

 <div class="form-group">
    <label for="exampleFormControlInput1">{email}</label>
    <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
  </div>
  <div class="form-group">
    <label for="exampleFormControlFile1">{article}</label>
    <input type="file" name="file" class="form-control-file" id="article" onChange="verif_extension(this);">
  </div>
   <input type="hidden" name="task" value="envArticle">
  <button type="submit" class="btn btn-primary">{send}</button>
 
</form>
</div>
</div>

<script type="text/javascript">
/*
$("#form-1").on("submit", function()
{

$("#form-1").submit();

});
*/
  //madjla-content
  
function  verif_extension(elem) {


var ext = get_extension(elem.value);
if (ext !='pdf' &&  ext !='doc' && ext !='docx') {

alert("Seuls les extentions pdf (.pdf) et  word (.doc,.docx) sont acceptées ");

$("#article").val('');

}


} 
function get_extension(filename) {
    return filename.slice((filename.lastIndexOf('.') - 1 >>> 0) + 2);
}


</script>