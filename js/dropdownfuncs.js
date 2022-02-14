function idapiquery(apiloc, success, texterror){
  return function (id){
    var cfunc=arguments.callee;
    formData= new FormData();
    formData.set("id", id);
    fetch(`/api/v1/${apiloc}`, { method:"POST", body:formData, credentials: 'same-origin', mode: 'same-origin', cache: 'no-cache', })
    .then(CheckError)
    .then((jsonResponse) => { 
        Swal.fire({ title: success, icon: 'success', })
        .then((jsonResponse) => {
          window.location.reload(true);
      });
    }).catch((error) => {
        console.log(error);
        Swal.fire({ title: texterror, icon: 'error', text: error, showCancelButton: true, confirmButtonText: 'Reintentar',})
        .then((result) => {
            if (result.isConfirmed) {
              cfunc (id);
            }   
        });
    });
  }  
}

var toggledelete = idapiquery('toggledelete', 'El post se ha eliminado/restaurado correctamente', 'El Post no se ha eliminado/restaurado');
var restore = idapiquery('restoreold', 'Esta Version del post se ha reestablecido como la mas reciente.', 'Esta Version del post no se ha reestablecido');

/*
function toggledelete(id){
  formData= new FormData();
  formData.set("id", id);
  fetch("/api/v1/toggledelete", { method:"POST", body:formData, credentials: 'same-origin', mode: 'same-origin', cache: 'no-cache', })
  .then(CheckError)
  .then((jsonResponse) => { 
      Swal.fire({ title: 'El post se ha eliminado/restaurado correctamente', icon: 'success', })
      .then((jsonResponse) => {
        window.location.reload(true);
    });
  }).catch((error) => {
      console.log(error);
      Swal.fire({ title: 'El Post no se ha eliminado/restaurado', icon: 'error', text: error, showCancelButton: true, confirmButtonText: 'Reintentar',})
      .then((result) => {
          if (result.isConfirmed) {
            toggledelete (id);
          }   
      });
  });
}

function restore(id){
  formData= new FormData();
  formData.set("id", id);
  fetch("/api/v1/restoreold", { method:"POST", body:formData, credentials: 'same-origin', mode: 'same-origin', cache: 'no-cache', })
  .then(CheckError)
  .then((jsonResponse) => { 
      Swal.fire({ title: 'Esta Version del post se ha reestablecido como la mas reciente.', icon: 'success', })
      .then((jsonResponse) => {
        window.location.reload(true);
    });
  }).catch((error) => {
      console.log(error);
      Swal.fire({ title: 'Esta Version del post no se ha reestablecido', icon: 'error', text: error, showCancelButton: true, confirmButtonText: 'Reintentar',})
      .then((result) => {
          if (result.isConfirmed) {
            restore (id);
          }   
      });
  });
}
*/