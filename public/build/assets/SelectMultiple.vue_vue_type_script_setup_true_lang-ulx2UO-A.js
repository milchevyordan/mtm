import{s as V}from"./multiselect-D7Xk1hqr.js";import{g as y,h as O}from"./AuthenticatedLayout.vue_vue_type_script_setup_true_lang-Ch8_Gsdz.js";import{d as B,A as d,B as S,m as i,C as M,p,o as k,c as A,u as g}from"./app-BDKB0qeh.js";const C=B({__name:"SelectMultiple",props:d({name:{},placeholder:{},options:{},selectedOptionsValues:{},reset:{type:Boolean},searchable:{type:Boolean,default:!0},disabled:{type:Boolean,default:!1},capitalize:{type:Boolean,default:!1},id:{}},{modelValue:{},modelModifiers:{}}),emits:d(["select","remove"],["update:modelValue"]),setup(u,{emit:m}){const r=m,a=u,t=S(u,"modelValue"),s=i([]),o=i(null);M(()=>{c(),b()}),p(()=>a.options,()=>{c()}),p(()=>a.reset,e=>{e&&h()});const v=e=>{t.value=[...t.value||[],e.value],r("select",{name:a.name,value:t.value})},f=e=>{var l;t.value=(l=t.value)==null?void 0:l.filter(n=>n!==e.value),r("remove",{name:a.name,value:e})},c=()=>{s.value=y(O(a.options),a.capitalize)},b=()=>{const e=a.selectedOptionsValues??t.value;if(!Array.isArray(e)){o.value=[];return}o.value=s.value.filter(l=>l.value!==null&&e.includes(l.value))},h=()=>{t.value=[],o.value=[]};return(e,l)=>(k(),A(g(V),{id:e.id,modelValue:o.value,"onUpdate:modelValue":l[0]||(l[0]=n=>o.value=n),options:s.value,label:"name","track-by":"value",autocomplete:"off",multiple:!0,searchable:e.searchable,disabled:e.disabled,"allow-empty":!0,placeholder:"Select "+e.placeholder,"deselect-label":"Press enter to remove","select-label":"Press enter to select","selected-label":"Selected",onSelect:v,onRemove:f},null,8,["id","modelValue","options","searchable","disabled","placeholder"]))}});export{C as _};