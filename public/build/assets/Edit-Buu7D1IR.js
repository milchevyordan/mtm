import{d as E,T as g,m as j,g as S,a as t,u as s,w as d,F as D,o as V,Z as F,b as a,f as _,t as p,k as C}from"./app-BD-nXv7b.js";import{_ as T}from"./Accordion.vue_vue_type_script_setup_true_lang-Dxc_LPIL.js";import{_ as P}from"./ChangeLogs.vue_vue_type_script_setup_true_lang-BlfMQnzH.js";import{_ as h}from"./ResetSaveButtons.vue_vue_type_script_setup_true_lang-bGReoGDa.js";import{_ as v}from"./InputError.vue_vue_type_script_setup_true_lang-CDdF3rV5.js";import{_ as x,a as W}from"./TextInput.vue_vue_type_script_setup_true_lang-Di6V8A2q.js";import{_ as B}from"./Modal.vue_vue_type_script_setup_true_lang-BfLFEjDD.js";import{_ as L}from"./Select.vue_vue_type_script_setup_true_lang-CAbFV41H.js";import{_ as M}from"./Table.vue_vue_type_script_setup_true_lang-VUJ_9u2v.js";import{_ as N,W as R,d as y,a as U}from"./AuthenticatedLayout.vue_vue_type_script_setup_true_lang-kLeIHGsv.js";import{_ as q}from"./PencilSquare.vue_vue_type_script_setup_true_lang-C8ptuY90.js";import{_ as Z}from"./Trash.vue_vue_type_script_setup_true_lang-Cb6jFHg4.js";import"./multiselect-Dh0_mV6s.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";import"./ApplicationLogo-CmEZCreb.js";const z={class:"py-12"},A={class:"mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-6"},G={class:"bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"},H={class:"p-6 text-gray-900 dark:text-gray-100"},I={class:"grid lg:grid-cols-1 xl:grid-cols-2 gap-4"},J={class:"relative rounded-lg shadow-sm bg-white dark:bg-gray-800 py-4 sm:py-6 px-4 mt-4"},K={class:"text-gray-900 dark:text-gray-100"},O={class:"flex gap-1.5"},Q={class:"flex gap-1.5"},X=["onClick"],Y={class:"border-b border-gray-100 dark:border-gray-700 px-3.5 p-3 text-xl font-medium"},_e=E({__name:"Edit",props:{project:{},dataTable:{},changeLogs:{}},setup(b){const c=b,r=g({_method:"put",id:c.project.id,name:c.project.name,warehouse:c.project.warehouse}),w=async n=>new Promise((e,o)=>{r.post(route("projects.update",c.project.id),{preserveScroll:!0,preserveState:!0,forceFormData:!0,only:U(n),onSuccess:()=>{e()},onError:()=>{o(new Error("Error, during update"))}})}),m=j(!1),f=()=>{m.value=!1,l.reset()},$=n=>{var e;l.id=n.id,l.name=(e=n.product)==null?void 0:e.name,l.created_at=n.created_at,m.value=!0},l=g({id:null,name:null,created_at:null}),k=()=>{l.delete(route("projects.destroy-product"),{preserveScroll:!0}),f()};return(n,e)=>(V(),S(D,null,[t(s(F),{title:"Project"}),t(N,null,{header:d(()=>e[5]||(e[5]=[a("h2",{class:"text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"}," Project ",-1)])),default:d(()=>[a("div",z,[a("div",A,[a("div",G,[a("div",H,[a("div",I,[a("form",{class:"mt-6 space-y-6",onSubmit:e[3]||(e[3]=_(o=>w(),["prevent"]))},[a("div",null,[t(x,{for:"name",value:"Name"}),t(W,{id:"name",modelValue:s(r).name,"onUpdate:modelValue":e[0]||(e[0]=o=>s(r).name=o),type:"text",class:"mt-1 block w-full",required:""},null,8,["modelValue"]),t(v,{class:"mt-2",message:s(r).errors.name},null,8,["message"])]),a("div",null,[t(x,{for:"warehouse",value:"Warehouse"}),t(L,{modelValue:s(r).warehouse,"onUpdate:modelValue":e[1]||(e[1]=o=>s(r).warehouse=o),name:"warehouse",options:s(R),placeholder:"Warehouse",class:"mt-1 block w-full mb-3.5"},null,8,["modelValue","options"]),t(v,{class:"mt-2",message:s(r).errors.warehouse},null,8,["message"])]),t(h,{processing:s(r).processing,"recently-successful":s(r).recentlySuccessful,onReset:e[2]||(e[2]=o=>s(r).reset())},null,8,["processing","recently-successful"])],32)])])]),a("div",J,[t(T,null,{head:d(()=>e[6]||(e[6]=[a("div",{class:"font-semibold text-xl sm:text-2xl mb-4 text-gray-900 dark:text-gray-100"}," Products ",-1)])),default:d(()=>[a("div",K,[t(M,{"data-table":n.dataTable,"per-page-options":[5,10,15,20,50],"global-search":!0,"advanced-filters":!1},{"cell(created_at)":d(({value:o,item:i})=>[a("div",O,p(s(y)(o)),1)]),"cell(action)":d(({value:o,item:i})=>{var u;return[a("div",Q,[t(s(C),{class:"border border-[#E9E7E7] rounded-md p-1 active:scale-90 transition",title:"Edit product",href:n.route("products.edit",(u=i.product)==null?void 0:u.id)},{default:d(()=>[t(q,{classes:"w-4 h-4 text-[#909090]"})]),_:2},1032,["href"]),a("button",{title:"Delete product",class:"border border-[#E9E7E7] rounded-md p-1 active:scale-90 transition",onClick:ee=>$(i)},[t(Z,{classes:"w-4 h-4 text-[#909090]"})],8,X)])]}),_:1},8,["data-table"])])]),_:1})]),t(P,{"change-logs-limited":n.project.change_logs_limited,"change-logs":n.changeLogs},null,8,["change-logs-limited","change-logs"])])])]),_:1}),t(B,{show:m.value,onClose:f},{default:d(()=>{var o,i;return[a("div",Y," Delete product "+p(((o=s(l))==null?void 0:o.name)??"")+" added on "+p(s(y)((i=s(l))==null?void 0:i.created_at))+" ? ",1),a("form",{class:"col-span-2 flex justify-end gap-3 mt-2 pt-1 px-4",onSubmit:_(k,["prevent"])},[t(h,{processing:s(l).processing,"recently-successful":s(l).recentlySuccessful,"is-delete":!0,onReset:e[4]||(e[4]=u=>s(l).reset())},null,8,["processing","recently-successful"])],32)]}),_:1},8,["show"])],64))}});export{_e as default};