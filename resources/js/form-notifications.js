import Swal from 'sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
const dialog = Swal.mixin({confirmButtonText:'Entendido',confirmButtonColor:'#1e3a5f',cancelButtonColor:'#475569',customClass:{popup:'ues-dialog',title:'ues-dialog-title',htmlContainer:'ues-dialog-content'},heightAuto:false});
const titles={success:'¡Listo!',error:'No se pudo completar la acción',warning:'Atención',info:'Información'};
async function showNotices(){
 const container=document.querySelector('[data-form-notifications]');
 if(!container)return;
 const notices=JSON.parse(container.dataset.notices);
 container.hidden=true;
 for(const notice of notices)await dialog.fire({icon:notice.kind,title:titles[notice.kind],text:notice.text});
}
const approved=new WeakSet(),pending=new WeakSet();
document.addEventListener('submit',async(event)=>{
 const form=event.target;
 const destructive=form.querySelector('input[name="_method"]')?.value.toUpperCase()==='DELETE';
 if(!destructive&&!form.dataset.confirm)return;
 if(approved.has(form)){approved.delete(form);return;}
 event.preventDefault();event.stopImmediatePropagation();
 if(pending.has(form))return;
 pending.add(form);
 const submitter=event.submitter;
 try{
  const result=await dialog.fire({icon:'warning',title:form.dataset.confirm||'¿Eliminar este registro?',text:'Esta acción no se puede deshacer.',showCancelButton:true,confirmButtonText:'Sí, eliminar',cancelButtonText:'Cancelar',confirmButtonColor:'#b91c1c',focusCancel:true});
  if(result.isConfirmed&&form.isConnected){
   if(!form.reportValidity())return;
   form.removeAttribute('onsubmit');approved.add(form);form.requestSubmit(submitter||undefined);
  }
 }finally{pending.delete(form);}
},true);
if(document.readyState==='loading')document.addEventListener('DOMContentLoaded',showNotices);else showNotices();
