import{s as O}from"./multiselect-DwGB295h.js";import{e as V,r as B}from"./AuthenticatedLayout.vue_vue_type_script_setup_true_lang-CG5OVOt9.js";import{d as y,A as r,B as S,l as d,C as M,p as i,o as k,c as j,u as w}from"./app-D7oHT88o.js";const U=y({__name:"Select",props:r({name:{},placeholder:{},options:{},selectedOptionValue:{},reset:{type:Boolean},searchable:{type:Boolean,default:!0},disabled:{type:Boolean,default:!1},capitalize:{type:Boolean,default:!1},id:{}},{modelValue:{},modelModifiers:{}}),emits:r(["select","remove","refresh"],["update:modelValue"]),setup(s,{emit:p}){const n=p,l=s,a=S(s,"modelValue"),t=d([]),o=d(null);M(()=>{u(l.options),f()}),i(()=>l.options,e=>{u(e)}),i(()=>l.reset,e=>{e&&b()});const m=e=>{a.value=e.value,n("select",{name:l.name,value:e.value})},v=()=>{a.value=null,n("remove",{name:l.name,value:null})},u=e=>{t.value=V(B(e),l.capitalize)},f=()=>{o.value=t.value.find(e=>e.value==(l.selectedOptionValue??a.value))||null},b=()=>{a.value=null,o.value=null};return(e,c)=>(k(),j(w(O),{modelValue:o.value,"onUpdate:modelValue":c[0]||(c[0]=h=>o.value=h),options:t.value,label:"name","track-by":"value",autocomplete:"off",multiple:!1,searchable:e.searchable,disabled:e.disabled,"allow-empty":!0,placeholder:"Select "+e.placeholder,"deselect-label":"Press enter to remove","select-label":"Press enter to select","selected-label":"Selected",onSelect:m,onRemove:v},null,8,["modelValue","options","searchable","disabled","placeholder"]))}});export{U as _};