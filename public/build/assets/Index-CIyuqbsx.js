import{d as j,m as h,T as C,g,a,u as e,w as s,F as $,o as b,Z as S,b as t,k as n,e as M,t as i,h as E,f as V,q as B}from"./app-BDKB0qeh.js";import{_ as F}from"./ResetSaveButtons.vue_vue_type_script_setup_true_lang-BGmeT33M.js";import{_ as y}from"./Modal.vue_vue_type_script_setup_true_lang-DMf-Tx8h.js";import{_ as v}from"./Table.vue_vue_type_script_setup_true_lang-DOrQf0rV.js";import{P as N}from"./ProductType-DHxMMxY3.js";import{_ as W,f as w,W as q,d as m,r as I}from"./AuthenticatedLayout.vue_vue_type_script_setup_true_lang-Ch8_Gsdz.js";import{_ as K}from"./Document.vue_vue_type_script_setup_true_lang-DMM_qafl.js";import{_ as x}from"./DocumentText.vue_vue_type_script_setup_true_lang-Ctsgb_X5.js";import{_ as L}from"./PencilSquare.vue_vue_type_script_setup_true_lang-CxOqqb5j.js";import{_ as R}from"./Trash.vue_vue_type_script_setup_true_lang-DiC6zez7.js";import"./PrimaryButton-Bgy5znnT.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";import"./SecondaryButton.vue_vue_type_script_setup_true_lang-BMRjcZWp.js";import"./Select.vue_vue_type_script_setup_true_lang-Bz26zGgq.js";import"./multiselect-D7Xk1hqr.js";import"./ApplicationLogo-DTsC1tCr.js";const U={class:"py-12"},Z={class:"mx-auto max-w-7xl sm:px-6 lg:px-8"},z={class:"bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"},A={class:"p-6 text-gray-900 dark:text-gray-100"},G={class:"w-full flex gap-2"},H={class:"flex gap-1.5"},J={class:"flex gap-1.5"},O={class:"flex gap-1.5"},Q=["onClick"],X=["onClick"],Y={key:0,class:"text-gray-900 dark:text-gray-100"},ee={class:"flex gap-1.5"},te={class:"flex gap-1.5"},ae={class:"flex gap-1.5"},se={class:"border-b border-gray-100 dark:border-gray-700 px-3.5 p-3 text-xl font-medium"},we=j({__name:"Index",props:{dataTable:{},showProductsDataTable:{}},setup(re){const u=h(!1),k=()=>{u.value=!1},D=async o=>{await new Promise((c,d)=>{B.reload({data:{project_id:o},only:["showProductsDataTable"],onSuccess:c,onError:d})}),u.value=!0},p=h(!1),l=C({id:null,name:null,created_at:null}),P=o=>{l.id=o.id,l.name=o.name,l.created_at=o.created_at,p.value=!0},f=()=>{p.value=!1,l.reset()},T=()=>{l.delete(route("projects.destroy",l.id),{preserveScroll:!0}),f()};return(o,c)=>(b(),g($,null,[a(e(S),{title:"Project"}),a(W,null,{header:s(()=>c[1]||(c[1]=[t("h2",{class:"text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"}," Project ",-1)])),default:s(()=>[t("div",U,[t("div",Z,[t("div",z,[t("div",A,[a(v,{"data-table":o.dataTable,"per-page-options":[5,10,15,20,50],"global-search":!0,"show-trashed":!0,"advanced-filters":!1},{additionalContent:s(()=>[t("div",G,[a(e(n),{class:"w-full md:w-auto border border-gray-300 dark:border-gray-700 rounded-md px-5 py-1.5 active:scale-95 transition hover:bg-gray-50 dark:hover:bg-gray-800",href:o.route("projects.create")},{default:s(()=>c[2]||(c[2]=[M(" Create Project ")])),_:1},8,["href"])])]),"cell(warehouse)":s(({value:d,item:r})=>[t("div",H,i(e(w)(e(q),d)),1)]),"cell(created_at)":s(({value:d,item:r})=>[t("div",J,i(e(m)(d)),1)]),"cell(action)":s(({value:d,item:r})=>[t("div",O,[a(e(n),{class:"border border-gray-300 dark:border-gray-700 rounded-md p-1 active:scale-90 transition",title:"Edit project",href:o.route("projects.edit",r.id)},{default:s(()=>[a(L,{classes:"w-4 h-4 text-[#909090]"})]),_:2},1032,["href"]),a(e(n),{class:"border border-gray-300 dark:border-gray-700 rounded-md p-1 active:scale-90 transition",title:"Show project",href:o.route("projects.show",r.id)},{default:s(()=>[a(x,{classes:"w-4 h-4 text-[#909090]"})]),_:2},1032,["href"]),t("button",{class:"border border-gray-300 dark:border-gray-700 rounded-md p-1 active:scale-90 transition",title:"Show products",onClick:_=>D(r.id)},[a(K,{classes:"w-4 h-4 text-[#909090]"})],8,Q),t("button",{title:"Delete",class:"border border-gray-300 dark:border-gray-700 rounded-md p-1 active:scale-90 transition",onClick:_=>P(r)},[a(R,{classes:"w-4 h-4 text-[#909090]"})],8,X)])]),_:1},8,["data-table"])])])])])]),_:1}),a(y,{show:u.value,"max-width":"6xl",onClose:k},{default:s(()=>[c[3]||(c[3]=t("div",{class:"px-3.5 p-3 text-xl font-medium"}," Products ",-1)),o.showProductsDataTable?(b(),g("div",Y,[a(v,{"data-table":o.showProductsDataTable,"per-page-options":[5,10,15,20,50],"global-search":!0,"type-search":!0,"advanced-filters":!1,"prop-name":"showProductsDataTable"},{"cell(created_at)":s(({value:d,item:r})=>[t("div",ee,i(e(m)(d)),1)]),"cell(product.type)":s(({value:d,item:r})=>[t("div",te,i(e(I)(e(w)(e(N),r.product.type))),1)]),"cell(action)":s(({value:d,item:r})=>[t("div",ae,[a(e(n),{class:"border border-gray-300 dark:border-gray-700 rounded-md p-1 active:scale-90 transition",title:"Show product",href:o.route("products.show",r.product_id)},{default:s(()=>[a(x,{classes:"w-4 h-4 text-[#909090]"})]),_:2},1032,["href"])])]),_:1},8,["data-table"])])):E("",!0)]),_:1},8,["show"]),a(y,{show:p.value,onClose:f},{default:s(()=>{var d,r;return[t("div",se," Delete project "+i(((d=e(l))==null?void 0:d.name)??"")+" added on "+i(e(m)((r=e(l))==null?void 0:r.created_at))+" ? ",1),t("form",{class:"col-span-2 flex justify-end gap-3 my-2 pt-1 px-4",onSubmit:V(T,["prevent"])},[a(F,{processing:e(l).processing,"recently-successful":e(l).recentlySuccessful,"is-delete":!0,onReset:c[0]||(c[0]=_=>e(l).reset())},null,8,["processing","recently-successful"])],32)]}),_:1},8,["show"])],64))}});export{we as default};