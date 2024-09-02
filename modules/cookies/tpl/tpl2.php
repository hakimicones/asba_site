

<style type="text/css">
  {style}
  
</style>

<!-- Modal cookies -->
 
<div class="modal" id="cookiesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">

    <div class="modal-content" id="first-content">

      <div class="modal-header">
        <h2 class="modal-title">{titreModule}</h2>
        
      </div>
      <div class="modal-body padding-1rem">
	  
	  			{intro}
 
      </div>
	  <div class="modal-footer modal-center-text">
        <button type="button" class="btn btn-secondary" onclick="parametrer()">{parametrer}</button>
        <button type="button" class="btn btn-primary" onclick="accepter()">{accepter}</button>
      </div>
 
 </div>
 <div class="modal-content  " id="second-content">

      <div class="modal-header">
        <h2 class="modal-title">{parametrer}</h2>
        
      </div>
      <div class="modal-body padding-1rem">
        <div class="accordion" id="cookiesParameter">
          {text}

       </div>   
 
      </div>
    <div class="modal-footer modal-center-text">
        
        <button type="button" class="btn btn-primary" onclick="saveParameter()">{enregistrer}</button>
      </div>
 
 </div>


</div>
</div>


 {cookies}


 

 

<!-- Modal -->





<script type="text/javascript">
 {jsScript} 


</script>