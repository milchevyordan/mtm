import{d as q,T as $,g as c,a as e,u as l,w as o,F as x,o as p,Z as T,b as a,l as j,t as w,k as V}from"./app-Bvi4oo79.js";import{_ as B}from"./Accordion.vue_vue_type_script_setup_true_lang-CnMZKeIC.js";import{_ as F}from"./ChangeLogs.vue_vue_type_script_setup_true_lang-CND-MQvF.js";import{_ as L}from"./InputError.vue_vue_type_script_setup_true_lang-CVNr40G0.js";import{_ as r}from"./InputLabel.vue_vue_type_script_setup_true_lang-W2pR4QhM.js";import{_ as N}from"./Select.vue_vue_type_script_setup_true_lang-Bu_DsJ47.js";import{_ as d}from"./TextInput.vue_vue_type_script_setup_true_lang-_zxVFMTy.js";import{_ as S}from"./Table.vue_vue_type_script_setup_true_lang-8r9q4G17.js";import{P as C}from"./ProductType-DHxMMxY3.js";import{W as m,_ as E,w as P,f as W,d as D}from"./AuthenticatedLayout.vue_vue_type_script_setup_true_lang-BmktDnBJ.js";import{_ as K}from"./DocumentText.vue_vue_type_script_setup_true_lang-Ckg6r2c-.js";import"./Modal.vue_vue_type_script_setup_true_lang-Bdnk4ETl.js";import"./multiselect-Yf9tzmof.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";import"./ApplicationLogo-CQlkyxkR.js";const Z={class:"py-12"},z={class:"mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-6"},A={class:"bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"},G={class:"p-6 text-gray-900 dark:text-gray-100"},H={class:"grid lg:grid-cols-1 xl:grid-cols-2 gap-4"},I={class:"mt-6 space-y-6"},J={class:"relative rounded-lg shadow-sm bg-white dark:bg-gray-800 py-4 sm:py-6 px-4 mt-4"},M={class:"text-gray-900 dark:text-gray-100"},O={class:"flex gap-1.5"},Q={class:"flex gap-1.5"},R={class:"flex gap-1.5"},ce=q({__name:"Show",props:{product:{},dataTable:{},changeLogs:{}},setup(k){var f,g,y,v,h,b;const u=k,_=$({quantities:{Varna:((g=(f=u.product.quantity)==null?void 0:f.find(t=>t.warehouse==m.Varna))==null?void 0:g.quantity)??null,France:((v=(y=u.product.quantity)==null?void 0:y.find(t=>t.warehouse==m.France))==null?void 0:v.quantity)??null,Netherlands:((b=(h=u.product.quantity)==null?void 0:h.find(t=>t.warehouse==m.Netherlands))==null?void 0:b.quantity)??null}});return(t,n)=>(p(),c(x,null,[e(l(T),{title:"Продукт"}),e(E,null,{header:o(()=>n[0]||(n[0]=[a("h2",{class:"text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"}," Продукт ",-1)])),default:o(()=>[a("div",Z,[a("div",z,[a("div",A,[a("div",G,[a("div",H,[a("div",I,[a("div",null,[e(r,{for:"name",value:"Име"}),e(d,{id:"name","model-value":t.product.name,type:"text",class:"mt-1 block w-full",disabled:"",autocomplete:"name"},null,8,["model-value"])]),a("div",null,[e(r,{for:"type",value:"Тип"}),e(N,{"selected-option-value":t.product.type,name:"type",options:l(C),placeholder:"Тип",class:"mt-1 block w-full mb-3.5"},null,8,["selected-option-value","options"]),e(L,{class:"mt-2",message:l(_).errors.type},null,8,["message"])]),a("div",null,[e(r,{for:"internal_id",value:"Вътрешен №"}),e(d,{id:"internal_id","model-value":t.product.internal_id,type:"text",disabled:"",class:"mt-1 block w-full"},null,8,["model-value"])]),a("div",null,[e(r,{for:"minimum_quantity",value:"Минимално Количество"}),e(d,{id:"minimum_quantity","model-value":t.product.minimum_quantity,type:"number",step:"1",disabled:"",class:"mt-1 block w-full"},null,8,["model-value"])]),(p(!0),c(x,null,j(l(P),(s,i)=>(p(),c("div",{key:i},[e(r,{for:"quantities_"+s.name,value:`Количество ${s.name}`},null,8,["for","value"]),e(d,{id:"quantities_"+s.name,"model-value":l(_).quantities[s.name],type:"number",step:"1",disabled:"",class:"mt-1 block w-full"},null,8,["id","model-value"])]))),128))])])])]),e(F,{"change-logs-limited":t.product.change_logs_limited,"change-logs":t.changeLogs},null,8,["change-logs-limited","change-logs"]),a("div",J,[e(B,null,{head:o(()=>n[1]||(n[1]=[a("div",{class:"font-semibold text-xl sm:text-2xl mb-4 text-gray-900 dark:text-gray-100"}," Проекти ",-1)])),default:o(()=>[a("div",M,[e(S,{"data-table":t.dataTable,"per-page-options":[5,10,15,20,50],"global-search":!0,"advanced-filters":!1},{"cell(project.warehouse)":o(({value:s,item:i})=>[a("div",O,w(i.project?l(W)(l(m),i.project.warehouse):""),1)]),"cell(created_at)":o(({value:s,item:i})=>[a("div",Q,w(l(D)(s)),1)]),"cell(action)":o(({value:s,item:i})=>[a("div",R,[e(l(V),{class:"border border-gray-300 dark:border-gray-700 rounded-md p-1 active:scale-90 transition",title:"Покажи проект",href:t.route("projects.show",i.project_id)},{default:o(()=>[e(K,{classes:"w-4 h-4 text-[#909090]"})]),_:2},1032,["href"])])]),_:1},8,["data-table"])])]),_:1})])])])]),_:1})],64))}});export{ce as default};