@if(Session::has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Holy guacamole!</strong> {{session('success')}}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

@endif

@if($errors->any())
 
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Holy guacamole!</strong> 
  <ul class="mb-0">
    @foreach($errors->all() as $error)
        <li> {{$error}}</li>
    @endforeach
  </ul>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

@endif
<script>
    document.addEventListener('DOMContentLoaded',(e) =>{
        const alert = document.querySelector('.alert-danger');
        const success = document.querySelector('.alert-success');
        if(alert){
            setTimeout(() => {
                alert.remove();
            }, 3000);
        }
        if(success){
            setTimeout((e)=>{
                success.remove();
            },3000)
        }
    })
</script>