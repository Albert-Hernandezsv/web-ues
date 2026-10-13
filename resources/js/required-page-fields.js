// Follow each repeated element's active checkbox without requiring inactive drafts.
export function syncRequiredTitle(input) {
 const statusName=input.name.replace(/\[title\]$/, '[status]');
 const checkbox=Array.from(input.form.elements).find(field=>field.name===statusName&&field.type==='checkbox');
 if(checkbox) input.required=checkbox.checked;
}
function initializeRequiredFields(){
 document.querySelectorAll('[data-required-active]').forEach(input=>{
  const update=()=>syncRequiredTitle(input);
  input.form.addEventListener('change',update);
  input.form.addEventListener('reset',()=>setTimeout(update,0));
  update();
 });
}
if(document.readyState==='loading')document.addEventListener('DOMContentLoaded',initializeRequiredFields);else initializeRequiredFields();
