import{d as c,T as f,g as _,a as o,u as e,w as n,F as g,o as x,Z as v,b as r,f as y}from"./app-DNzCrRZN.js";import{_ as w}from"./ResetSaveButtons.vue_vue_type_script_setup_true_lang-YRV1gGzj.js";import{_ as m}from"./InputError.vue_vue_type_script_setup_true_lang-D8oswhFt.js";import{_ as d}from"./InputLabel.vue_vue_type_script_setup_true_lang-CEVvSszl.js";import{_ as V}from"./SelectMultiple.vue_vue_type_script_setup_true_lang-BJ-VNSSt.js";import{_ as i}from"./TextInput.vue_vue_type_script_setup_true_lang-OgsLRRa5.js";import{_ as j,t as u}from"./AuthenticatedLayout.vue_vue_type_script_setup_true_lang-JRAjt2nF.js";import"./PrimaryButton-PQwFCoLq.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";import"./SecondaryButton.vue_vue_type_script_setup_true_lang-iIhSi5i1.js";import"./multiselect-CuXlu8jW.js";import"./ApplicationLogo-zYrl91-7.js";const b={class:"py-12"},k={class:"mx-auto max-w-7xl sm:px-6 lg:px-8"},$={class:"bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"},S={class:"p-6 text-gray-900 dark:text-gray-100"},E={class:"grid lg:grid-cols-1 xl:grid-cols-2 gap-4"},A=c({__name:"Create",props:{projects:{}},setup(h){const s=f({id:null,date_from:null,date_to:null,projects:[]}),p=async a=>new Promise((t,l)=>{s.post(route("reports.store"),{preserveScroll:!0,preserveState:!0,only:a,onSuccess:()=>{t()},onError:()=>{l(new Error("Error, during update"))}})});return(a,t)=>(x(),_(g,null,[o(e(v),{title:"Отчет"}),o(j,null,{header:n(()=>t[5]||(t[5]=[r("h2",{class:"text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"}," Отчет ",-1)])),default:n(()=>[r("div",b,[r("div",k,[r("div",$,[r("div",S,[r("div",E,[r("form",{class:"mt-6 space-y-6",onSubmit:t[4]||(t[4]=y(l=>p(),["prevent"]))},[r("div",null,[o(d,{for:"date_from",value:"Дата От"}),o(i,{id:"date_from",modelValue:e(s).date_from,"onUpdate:modelValue":t[0]||(t[0]=l=>e(s).date_from=l),type:"date",max:e(s).date_to||e(u),class:"mt-1 block w-full",required:""},null,8,["modelValue","max"]),o(m,{class:"mt-2",message:e(s).errors.date_from},null,8,["message"])]),r("div",null,[o(d,{for:"date_to",value:"Дата До"}),o(i,{id:"date_to",modelValue:e(s).date_to,"onUpdate:modelValue":t[1]||(t[1]=l=>e(s).date_to=l),type:"date",min:e(s).date_from,max:e(u),class:"mt-1 block w-full",required:""},null,8,["modelValue","min","max"]),o(m,{class:"mt-2",message:e(s).errors.date_to},null,8,["message"])]),r("div",null,[o(d,{for:"projects",value:"Projects"}),o(V,{id:"warehouse",modelValue:e(s).projects,"onUpdate:modelValue":t[2]||(t[2]=l=>e(s).projects=l),name:"projects",multiple:!0,options:a.projects,placeholder:"Projects",class:"mt-1 block w-full mb-3.5"},null,8,["modelValue","options"]),o(m,{class:"mt-2",message:e(s).errors.projects},null,8,["message"])]),o(w,{processing:e(s).processing,"recently-successful":e(s).recentlySuccessful,onReset:t[3]||(t[3]=l=>e(s).reset())},null,8,["processing","recently-successful"])],32)])])])])])]),_:1})],64))}});export{A as default};