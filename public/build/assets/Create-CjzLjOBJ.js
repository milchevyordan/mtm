import{d as c,T as p,g as f,a as t,u as l,w as n,F as g,o as _,Z as x,b as a,f as v}from"./app-BD-nXv7b.js";import{_ as y}from"./ResetSaveButtons.vue_vue_type_script_setup_true_lang-bGReoGDa.js";import{_ as m}from"./InputError.vue_vue_type_script_setup_true_lang-CDdF3rV5.js";import{_ as i,a as u}from"./TextInput.vue_vue_type_script_setup_true_lang-Di6V8A2q.js";import{_ as w}from"./AuthenticatedLayout.vue_vue_type_script_setup_true_lang-kLeIHGsv.js";import"./ApplicationLogo-CmEZCreb.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const V={class:"py-12"},b={class:"mx-auto max-w-7xl sm:px-6 lg:px-8"},k={class:"bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"},$={class:"p-6 text-gray-900 dark:text-gray-100"},E={class:"grid lg:grid-cols-1 xl:grid-cols-2 gap-4"},M=c({__name:"Create",setup(S){const s=p({id:null,name:null,email:null}),d=async o=>new Promise((e,r)=>{s.post(route("users.store"),{preserveScroll:!0,preserveState:!0,only:o,onSuccess:()=>{e()},onError:()=>{r(new Error("Error, during update"))}})});return(o,e)=>(_(),f(g,null,[t(l(x),{title:"User"}),t(w,null,{header:n(()=>e[4]||(e[4]=[a("h2",{class:"text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"}," User ",-1)])),default:n(()=>[a("div",V,[a("div",b,[a("div",k,[a("div",$,[a("div",E,[a("form",{class:"mt-6 space-y-6",onSubmit:e[3]||(e[3]=v(r=>d(),["prevent"]))},[a("div",null,[t(i,{for:"name",value:"Name"}),t(u,{id:"name",modelValue:l(s).name,"onUpdate:modelValue":e[0]||(e[0]=r=>l(s).name=r),type:"text",class:"mt-1 block w-full",required:"",autocomplete:"name"},null,8,["modelValue"]),t(m,{class:"mt-2",message:l(s).errors.name},null,8,["message"])]),a("div",null,[t(i,{for:"email",value:"Email"}),t(u,{id:"email",modelValue:l(s).email,"onUpdate:modelValue":e[1]||(e[1]=r=>l(s).email=r),type:"email",class:"mt-1 block w-full",required:"",autocomplete:"username"},null,8,["modelValue"]),t(m,{class:"mt-2",message:l(s).errors.email},null,8,["message"])]),t(y,{processing:l(s).processing,"recently-successful":l(s).recentlySuccessful,onReset:e[2]||(e[2]=r=>l(s).reset())},null,8,["processing","recently-successful"])],32)])])])])])]),_:1})],64))}});export{M as default};