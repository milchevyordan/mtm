import{d,T as p,Q as c,g as f,a as o,u as s,w as n,F as g,o as _,Z as w,b as t,f as h}from"./app-D7oHT88o.js";import{_ as x}from"./ResetSaveButtons.vue_vue_type_script_setup_true_lang-B-aiEDJr.js";import{_ as m}from"./InputError.vue_vue_type_script_setup_true_lang-yptz9s-z.js";import{_ as u,a as v}from"./TextInput.vue_vue_type_script_setup_true_lang-CQR846yp.js";import{_ as y}from"./Select.vue_vue_type_script_setup_true_lang-B4h5BK_V.js";import{_ as b,W as V}from"./AuthenticatedLayout.vue_vue_type_script_setup_true_lang-CG5OVOt9.js";import"./PrimaryButton-FrbOBQhy.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";import"./SecondaryButton.vue_vue_type_script_setup_true_lang-BB4MaLJX.js";import"./multiselect-DwGB295h.js";import"./ApplicationLogo-BluBXKOJ.js";const $={class:"py-12"},k={class:"mx-auto max-w-7xl sm:px-6 lg:px-8"},S={class:"bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"},E={class:"p-6 text-gray-900 dark:text-gray-100"},W={class:"grid lg:grid-cols-1 xl:grid-cols-2 gap-4"},Z=d({__name:"Create",setup(j){const r=p({id:null,warehouse:c().props.auth.user.warehouse,name:null}),i=async l=>new Promise((e,a)=>{r.post(route("projects.store"),{preserveScroll:!0,preserveState:!0,only:l,onSuccess:()=>{e()},onError:()=>{a(new Error("Error, during update"))}})});return(l,e)=>(_(),f(g,null,[o(s(w),{title:"Project"}),o(b,null,{header:n(()=>e[4]||(e[4]=[t("h2",{class:"text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"}," Project ",-1)])),default:n(()=>[t("div",$,[t("div",k,[t("div",S,[t("div",E,[t("div",W,[t("form",{class:"mt-6 space-y-6",onSubmit:e[3]||(e[3]=h(a=>i(),["prevent"]))},[t("div",null,[o(u,{for:"name",value:"Name"}),o(v,{id:"name",modelValue:s(r).name,"onUpdate:modelValue":e[0]||(e[0]=a=>s(r).name=a),type:"text",class:"mt-1 block w-full",required:""},null,8,["modelValue"]),o(m,{class:"mt-2",message:s(r).errors.name},null,8,["message"])]),t("div",null,[o(u,{for:"warehouse",value:"Warehouse"}),o(y,{id:"warehouse",modelValue:s(r).warehouse,"onUpdate:modelValue":e[1]||(e[1]=a=>s(r).warehouse=a),name:"warehouse",options:s(V),placeholder:"Warehouse",class:"mt-1 block w-full mb-3.5"},null,8,["modelValue","options"]),o(m,{class:"mt-2",message:s(r).errors.warehouse},null,8,["message"])]),o(x,{processing:s(r).processing,"recently-successful":s(r).recentlySuccessful,onReset:e[2]||(e[2]=a=>s(r).reset())},null,8,["processing","recently-successful"])],32)])])])])])]),_:1})],64))}});export{Z as default};