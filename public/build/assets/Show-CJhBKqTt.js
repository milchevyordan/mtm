import{d as f,g as _,a,u as l,w as s,F as g,o as y,Z as h,b as e,t as v,q as b}from"./app-DNzCrRZN.js";import{_ as x}from"./Accordion.vue_vue_type_script_setup_true_lang-DFxW5qM2.js";import{_ as d}from"./InputLabel.vue_vue_type_script_setup_true_lang-CEVvSszl.js";import{_ as w}from"./SelectMultiple.vue_vue_type_script_setup_true_lang-BJ-VNSSt.js";import{_ as n}from"./TextInput.vue_vue_type_script_setup_true_lang-OgsLRRa5.js";import{_ as k}from"./Table.vue_vue_type_script_setup_true_lang-BCLJ4Lew.js";import{P}from"./ProductType-DHxMMxY3.js";import{_ as j,r as $,f as B,e as p}from"./AuthenticatedLayout.vue_vue_type_script_setup_true_lang-JRAjt2nF.js";import"./multiselect-CuXlu8jW.js";import"./Select.vue_vue_type_script_setup_true_lang-CijPz9Ej.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";import"./ApplicationLogo-zYrl91-7.js";const C={class:"py-12"},E={class:"mx-auto max-w-7xl sm:px-6 lg:px-8"},F={class:"bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"},S={class:"p-6 text-gray-900 dark:text-gray-100"},T={class:"grid lg:grid-cols-1 xl:grid-cols-2 gap-4"},V={class:"mt-6 space-y-6"},D={class:"relative rounded-lg shadow-sm bg-white dark:bg-gray-800 py-4 sm:py-6 px-4 mt-4"},N={class:"text-gray-900 dark:text-gray-100"},q={class:"flex gap-1.5"},Q=f({__name:"Show",props:{report:{},projects:{},dataTable:{},pdfPath:{}},setup(m){const r=m,c=async()=>{if(r.report.pdf_path){p(r.report.pdf_path);return}await new Promise((t,o)=>{b.reload({only:["pdfPath"],onSuccess:t,onError:o})}),r.pdfPath&&p(r.pdfPath)};return(t,o)=>(y(),_(g,null,[a(l(h),{title:"Отчет"}),a(j,null,{header:s(()=>o[0]||(o[0]=[e("h2",{class:"text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"}," Отчет ",-1)])),default:s(()=>[e("div",C,[e("div",E,[e("div",F,[e("div",S,[e("div",T,[e("div",V,[e("div",null,[a(d,{for:"date_from",value:"Дата От"}),a(n,{id:"date_from","model-value":t.report.date_from,type:"date",class:"mt-1 block w-full",disabled:""},null,8,["model-value"])]),e("div",null,[a(d,{for:"date_to",value:"Дата До"}),a(n,{id:"date_to","model-value":t.report.date_to,type:"date",class:"mt-1 block w-full",disabled:""},null,8,["model-value"])]),e("div",null,[a(d,{for:"projects",value:"Projects"}),a(w,{id:"warehouse","selected-options-values":t.report.projects.map(i=>i.id),name:"projects",multiple:!0,options:t.projects,disabled:"",placeholder:"Projects",class:"mt-1 block w-full mb-3.5"},null,8,["selected-options-values","options"])])])])])]),e("div",D,[a(x,null,{head:s(()=>o[1]||(o[1]=[e("div",{class:"font-semibold text-xl sm:text-2xl mb-4 text-gray-900 dark:text-gray-100"}," Продукти ",-1)])),default:s(()=>[e("div",N,[a(k,{"data-table":t.dataTable,"per-page-options":[5,10,15,20,50],"global-search":!0,"type-search":!0,"advanced-filters":!1},{additionalContent:s(()=>[e("div",{class:"w-full flex gap-2"},[e("button",{class:"w-full md:w-auto border border-gray-300 dark:border-gray-700 rounded-md px-5 py-1.5 active:scale-95 transition hover:bg-gray-50 dark:hover:bg-gray-800",onClick:c}," Изтегли Pdf ")])]),"cell(product.type)":s(({value:i,item:u})=>[e("div",q,v(l($)(l(B)(l(P),u.product.type))),1)]),_:1},8,["data-table"])])]),_:1})])])])]),_:1})],64))}});export{Q as default};