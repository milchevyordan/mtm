import{d as p,T as c,g as f,a as o,u as s,w as n,F as _,o as g,Z as v,b as r,f as x}from"./app-BD-nXv7b.js";import{_ as y}from"./ResetSaveButtons.vue_vue_type_script_setup_true_lang-bGReoGDa.js";import{_ as m}from"./InputError.vue_vue_type_script_setup_true_lang-CDdF3rV5.js";import{_ as d,a as i}from"./TextInput.vue_vue_type_script_setup_true_lang-Di6V8A2q.js";import{_ as w}from"./SelectMultiple.vue_vue_type_script_setup_true_lang-C6I1k7mC.js";import{_ as V}from"./AuthenticatedLayout.vue_vue_type_script_setup_true_lang-kLeIHGsv.js";import"./multiselect-Dh0_mV6s.js";import"./ApplicationLogo-CmEZCreb.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const j={class:"py-12"},b={class:"mx-auto max-w-7xl sm:px-6 lg:px-8"},k={class:"bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"},$={class:"p-6 text-gray-900 dark:text-gray-100"},S={class:"grid lg:grid-cols-1 xl:grid-cols-2 gap-4"},N=p({__name:"Create",props:{projects:{}},setup(E){const e=c({id:null,date_from:null,date_to:null,projects:[]}),u=async a=>new Promise((t,l)=>{e.post(route("reports.store"),{preserveScroll:!0,preserveState:!0,only:a,onSuccess:()=>{t()},onError:()=>{l(new Error("Error, during update"))}})});return(a,t)=>(g(),f(_,null,[o(s(v),{title:"Report"}),o(V,null,{header:n(()=>t[5]||(t[5]=[r("h2",{class:"text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"}," Report ",-1)])),default:n(()=>[r("div",j,[r("div",b,[r("div",k,[r("div",$,[r("div",S,[r("form",{class:"mt-6 space-y-6",onSubmit:t[4]||(t[4]=x(l=>u(),["prevent"]))},[r("div",null,[o(d,{for:"date_from",value:"Date From"}),o(i,{id:"date_from",modelValue:s(e).date_from,"onUpdate:modelValue":t[0]||(t[0]=l=>s(e).date_from=l),type:"date",max:s(e).date_to,class:"mt-1 block w-full",required:""},null,8,["modelValue","max"]),o(m,{class:"mt-2",message:s(e).errors.date_from},null,8,["message"])]),r("div",null,[o(d,{for:"date_to",value:"Date To"}),o(i,{id:"date_to",modelValue:s(e).date_to,"onUpdate:modelValue":t[1]||(t[1]=l=>s(e).date_to=l),type:"date",min:s(e).date_from,class:"mt-1 block w-full",required:""},null,8,["modelValue","min"]),o(m,{class:"mt-2",message:s(e).errors.date_to},null,8,["message"])]),r("div",null,[o(d,{for:"projects",value:"Projects"}),o(w,{id:"warehouse",modelValue:s(e).projects,"onUpdate:modelValue":t[2]||(t[2]=l=>s(e).projects=l),name:"projects",multiple:!0,options:a.projects,placeholder:"Projects",class:"mt-1 block w-full mb-3.5"},null,8,["modelValue","options"]),o(m,{class:"mt-2",message:s(e).errors.projects},null,8,["message"])]),o(y,{processing:s(e).processing,"recently-successful":s(e).recentlySuccessful,onReset:t[3]||(t[3]=l=>s(e).reset())},null,8,["processing","recently-successful"])],32)])])])])])]),_:1})],64))}});export{N as default};