import{d as q,T as $,g as c,a as e,u as l,w as o,F as x,o as p,Z as T,b as a,l as j,t as w,k as P}from"./app-8aef-zbq.js";import{_ as V}from"./Accordion.vue_vue_type_script_setup_true_lang-CaKabsir.js";import{_ as B}from"./ChangeLogs.vue_vue_type_script_setup_true_lang-CpPkdwR2.js";import{_ as F}from"./InputError.vue_vue_type_script_setup_true_lang-B3cdBZbw.js";import{_ as r}from"./InputLabel.vue_vue_type_script_setup_true_lang-DVF5N2w3.js";import{_ as L}from"./Select.vue_vue_type_script_setup_true_lang-qKqhfhez.js";import{_ as d}from"./TextInput.vue_vue_type_script_setup_true_lang-BKZG1Dsw.js";import{_ as N}from"./Table.vue_vue_type_script_setup_true_lang-DF6UAjvQ.js";import{P as S}from"./ProductType-DHxMMxY3.js";import{W as m,_ as C,w as E,f as I,d as Q}from"./AuthenticatedLayout.vue_vue_type_script_setup_true_lang-B6GVW8KZ.js";import{_ as W}from"./DocumentText.vue_vue_type_script_setup_true_lang-CQjamFFK.js";import"./Modal.vue_vue_type_script_setup_true_lang-yXVRXlGc.js";import"./multiselect-6QWsk2Fb.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";import"./ApplicationLogo-BJWOFB24.js";const D={class:"py-12"},K={class:"mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-6"},M={class:"bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"},Z={class:"p-6 text-gray-900 dark:text-gray-100"},z={class:"grid lg:grid-cols-1 xl:grid-cols-2 gap-4"},A={class:"mt-6 space-y-6"},G={class:"relative rounded-lg shadow-sm bg-white dark:bg-gray-800 py-4 sm:py-6 px-4 mt-4"},H={class:"text-gray-900 dark:text-gray-100"},J={class:"flex gap-1.5"},O={class:"flex gap-1.5"},R={class:"flex gap-1.5"},ce=q({__name:"Show",props:{product:{},dataTable:{},changeLogs:{}},setup(k){var f,g,y,h,v,b;const u=k,_=$({quantities:{Varna:((g=(f=u.product.quantity)==null?void 0:f.find(t=>t.warehouse==m.Varna))==null?void 0:g.quantity)??null,France:((h=(y=u.product.quantity)==null?void 0:y.find(t=>t.warehouse==m.France))==null?void 0:h.quantity)??null,Netherlands:((b=(v=u.product.quantity)==null?void 0:v.find(t=>t.warehouse==m.Netherlands))==null?void 0:b.quantity)??null}});return(t,n)=>(p(),c(x,null,[e(l(T),{title:"Product"}),e(C,null,{header:o(()=>n[0]||(n[0]=[a("h2",{class:"text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"}," Product ",-1)])),default:o(()=>[a("div",D,[a("div",K,[a("div",M,[a("div",Z,[a("div",z,[a("div",A,[a("div",null,[e(r,{for:"name",value:"Име"}),e(d,{id:"name","model-value":t.product.name,type:"text",class:"mt-1 block w-full",disabled:"",autocomplete:"name"},null,8,["model-value"])]),a("div",null,[e(r,{for:"type",value:"Type"}),e(L,{"selected-option-value":t.product.type,name:"type",options:l(S),placeholder:"Type",class:"mt-1 block w-full mb-3.5"},null,8,["selected-option-value","options"]),e(F,{class:"mt-2",message:l(_).errors.type},null,8,["message"])]),a("div",null,[e(r,{for:"internal_id",value:"Internal Id"}),e(d,{id:"internal_id","model-value":t.product.internal_id,type:"text",disabled:"",class:"mt-1 block w-full"},null,8,["model-value"])]),a("div",null,[e(r,{for:"minimum_quantity",value:"Minimum Quantity"}),e(d,{id:"minimum_quantity","model-value":t.product.minimum_quantity,type:"number",step:"1",disabled:"",class:"mt-1 block w-full"},null,8,["model-value"])]),(p(!0),c(x,null,j(l(E),(s,i)=>(p(),c("div",{key:i},[e(r,{for:"quantities_"+s.name,value:`Quantity ${s.name}`},null,8,["for","value"]),e(d,{id:"quantities_"+s.name,"model-value":l(_).quantities[s.name],type:"number",step:"1",disabled:"",class:"mt-1 block w-full"},null,8,["id","model-value"])]))),128))])])])]),e(B,{"change-logs-limited":t.product.change_logs_limited,"change-logs":t.changeLogs},null,8,["change-logs-limited","change-logs"]),a("div",G,[e(V,null,{head:o(()=>n[1]||(n[1]=[a("div",{class:"font-semibold text-xl sm:text-2xl mb-4 text-gray-900 dark:text-gray-100"}," Projects ",-1)])),default:o(()=>[a("div",H,[e(N,{"data-table":t.dataTable,"per-page-options":[5,10,15,20,50],"global-search":!0,"advanced-filters":!1},{"cell(project.warehouse)":o(({value:s,item:i})=>[a("div",J,w(i.project?l(I)(l(m),i.project.warehouse):""),1)]),"cell(created_at)":o(({value:s,item:i})=>[a("div",O,w(l(Q)(s)),1)]),"cell(action)":o(({value:s,item:i})=>[a("div",R,[e(l(P),{class:"border border-gray-300 dark:border-gray-700 rounded-md p-1 active:scale-90 transition",title:"Show project",href:t.route("projects.show",i.project_id)},{default:o(()=>[e(W,{classes:"w-4 h-4 text-[#909090]"})]),_:2},1032,["href"])])]),_:1},8,["data-table"])])]),_:1})])])])]),_:1})],64))}});export{ce as default};